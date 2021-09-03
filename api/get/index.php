<?php require_once __DIR__ . "/../app/_config/index.php";

use Http\Auth;
use Http\Response;
use Http\Request;
use Http\Headers;

Headers::both();

$auth = Auth::verifyToken();
$req = Request::getJson();

//! Request not found
!$req && Response::message(["message" => "Requires JSON request!"], 405);

//*-----------------------------------------
//# Get all envelopes
if ($req->request === "envelopes/all") {
  // Get data
  $db->where("owner", $auth->owner);
  $db->orderBy("percentage", "desc");
  $envelopes = $db->get(
    "envelopes",
    null,
    "*, round((values_total/values_goal)*100,2) as percentage"
  );

  $res = [];
  foreach ($envelopes as $envelope) {
    $res[] = [
      "id" => $envelope["_id"],
      "name" => $envelope["name"],
      "desc" => $envelope["desc"],
      "owner" => $envelope["owner"],
      "account" => $envelope["account"],
      "created" => $envelope["created"],
      "pinned" => filter_var($envelope["pinned"], FILTER_VALIDATE_BOOLEAN),
      "tag" => [
        "name" => $envelope["tag_name"],
        "color" => $envelope["tag_color"],
      ],
      "values" => [
        "goal" => $envelope["values_goal"],
        "total" => $envelope["values_total"],
        "percentage" => $envelope["percentage"],
      ],
    ];
  }

  // Return data
  Response::message(["data" => $res]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get envelope by ID
if ($req->request === "envelopes/id") {
  // Get envelope
  $db->where("owner", $auth->owner);
  $db->where("_id", $req->id);
  $envelope = $db->getOne("envelopes");

  // Get history
  $db->where("owner", $auth->owner);
  $db->where("envelope_id", $envelope["_id"]);
  $db->orderBy("_id", "desc");
  $history = $db->get("history", null, [
    "DATE_FORMAT(date, '%m/%d/%Y') as Date",
    "amount as Amount",
    "source as Source",
    "method as Method",
  ]);

  $percentage =
    $envelope["values_goal"] > 0
      ? round(($envelope["values_total"] / $envelope["values_goal"]) * 100)
      : 0;

  $res = [
    "id" => $envelope["_id"],
    "name" => $envelope["name"],
    "desc" => $envelope["desc"],
    "owner" => $envelope["owner"],
    "account" => $envelope["account"],
    "created" => $envelope["created"],
    "defaultMethod" => $envelope["default_method"],
    "defaultDepositMethod" => $envelope["default_deposit_method"],
    "method" => "",
    "source" => "",
    "tag" => [
      "name" => $envelope["tag_name"],
      "color" => $envelope["tag_color"],
    ],
    "values" => [
      "goal" => $envelope["values_goal"],
      "total" => $envelope["values_total"],
      "percentage" => $percentage,
    ],
    "history" => $history,
  ];

  // Return data
  Response::message(["data" => $res]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get initial settings
if ($req->request === "envelopes/new") {
  // Get account data
  $db->where("owner", $auth->owner);
  $db->where("account", null, "IS NOT");
  $db->where("account != ''");
  $db->groupBy("account");
  $accounts = $db->get("envelopes", null, ["account"]);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  $return = [];
  foreach ($accounts as $account) {
    $return["accounts"][] = [
      "name" => $account["account"],
      "value" => $account["account"],
    ];
  }

  // Get tag data
  $db->where("owner", $auth->owner);
  $db->groupBy("tag_name, tag_color");
  $tags = $db->get("envelopes", null, ["tag_name", "tag_color"]);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  foreach ($tags as $tag) {
    $return["tags"][] = [
      "name" => $tag["tag_name"],
      "value" => $tag["tag_name"],
      "color" => $tag["tag_color"],
    ];
  }

  // Return data
  Response::message(["data" => $return]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get all tags
if ($req->request === "envelopes/tags") {
  // Get data
  $db->where("owner", $auth->owner);
  $db->groupBy("tag_name, tag_color");
  $tags = $db->get("envelopes", null, ["tag_name", "tag_color"]);

  $return = [];
  foreach ($tags as $tag) {
    $return[] = [
      "name" => $tag["tag_name"],
      "value" => $tag["tag_name"],
      "color" => $tag["tag_color"],
    ];
  }

  // Return data
  Response::message(["data" => $return]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get all users
if ($req->request === "users/all") {
  //! Require Role
  $auth->role !== "admin" &&
    Response::message(
      ["message" => "You are not authorized to view this information!"],
      401
    );

  // Get data
  $users = $db->get("users", null, "*, NULL as password");

  // Return data
  Response::message(["data" => $users]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get all summary data
if ($req->request === "summary/all") {
  // Get all envelope data
  $db->where("owner", $auth->owner);
  $db->groupBy("account");
  $db->orderBy("percentage", "desc");
  $db->orderBy("account", "desc");
  $accounts = $db->get("envelopes", null, [
    "account",
    "ROUND(SUM(values_goal),2) as goal",
    "ROUND(SUM(values_total),2) as total",
    "ROUND((SUM(values_total) / SUM(values_goal))*100,2) as percentage",
  ]);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Get all transactions to accounts
  $t = $db->subQuery("t");
  $t->where("owner", $auth->owner);
  $t->get("envelopes");
  $db->join($t, "h.envelope_id=t._id", "LEFT");
  $db->groupBy("account");
  $transactions = $db->get(
    "history h",
    null,
    "t.account, ROUND(SUM(h.amount),2) as amount"
  );

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Get all historical data
  $db->where("owner", $auth->owner);
  $db->groupBy("method");
  $db->orderBy("method", "desc");
  $history = $db->get("history", null, [
    "method",
    "ROUND(SUM(amount),2) as amount",
    "ROUND(SUM(total),2) as total",
    "ROUND(SUM(total + amount),2) as expected",
  ]);

  $trans = [];
  foreach ($transactions as $k) {
    $trans[$k["account"]] = $k["amount"];
  }

  $res = [];
  foreach ($accounts as $account) {
    $res[] = [
      "name" => empty($account["account"])
        ? "Uncategorized"
        : $account["account"],
      "values" => [
        "goal" => $account["goal"],
        "total" => $account["total"],
        "percentage" => $account["percentage"],
      ],
      "amount" => isset($trans[$account["account"]])
        ? $trans[$account["account"]]
        : "",
    ];
  }
  $accounts = $res;

  $res = [];
  foreach ($history as $hist) {
    $res[] = [
      "name" => empty($hist["method"]) ? "Uncategorized" : $hist["method"],
      "values" => [
        "total" => $hist["amount"],
      ],
    ];
  }
  $history = $res;

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message([
    "data" => [
      "accounts" => $accounts,
      "history" => $history,
      "transactions" => $transactions,
    ],
  ]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get account summary
if ($req->request === "summary/account") {
  //! Require data
  !isset($req->data->account) &&
    Response::message(["message" => "Account required!"], 406);

  // If dates sent
  isset($req->data->dates) &&
    $db->where(
      "date",
      [
        $req->data->dates->start . " 00:00:00",
        $req->data->dates->end . " 23:59:59",
      ],
      "BETWEEN"
    );

  // Get all transactions to accounts
  $e = $db->subQuery("e");
  $e->where("owner", $auth->owner);
  $e->where("account", $req->data->account);
  $e->get("envelopes");
  $db->where("e._id", null, "IS NOT");
  $db->orderBy("t.date", "desc");
  $db->join($e, "e._id=t.envelope_id", "LEFT");
  $transactions = $db->get("history t", null, [
    "e._id as id",
    "e.name as 'Envelope Name'",
    "t.amount as Amount",
    "t.total as Total",
    "t.source as Source",
    "t.method as Method",
    "t.date as Date",
  ]);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  $summary = [];
  foreach ($transactions as $values) {
    isset($summary[$values["Method"]])
      ? ($summary[$values["Method"]] += (int) $values["Amount"])
      : ($summary[$values["Method"]] = (int) $values["Amount"]);
  }

  // Return data
  Response::message([
    "data" => ["summary" => $summary, "transactions" => $transactions],
  ]);
}
//*-----------------------------------------
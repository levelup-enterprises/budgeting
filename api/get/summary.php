<?php

use Http\Response;

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
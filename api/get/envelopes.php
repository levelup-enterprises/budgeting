<?php

use Http\Response;

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
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
  $envelopes = $db->get("envelopes");

  $res = [];
  foreach ($envelopes as $envelope) {
    $percentage =
      $envelope["values_goal"] > 0
        ? round(($envelope["values_total"] / $envelope["values_goal"]) * 100)
        : 0;

    $res[] = [
      "id" => $envelope["_id"],
      "name" => $envelope["name"],
      "desc" => $envelope["desc"],
      "owner" => $envelope["owner"],
      "account" => $envelope["account"],
      "created" => $envelope["created"],
      "tag" => [
        "name" => $envelope["tag_name"],
        "color" => $envelope["tag_color"],
      ],
      "values" => [
        "goal" => $envelope["values_goal"],
        "total" => $envelope["values_total"],
        "percentage" => $percentage,
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
  $db->orderBy("_id", "desc");
  $history = $db->get("history", null, [
    "DATE_FORMAT(date, '%m/%d/%Y') as date",
    "amount",
    "source",
    "method",
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
    "method" => $envelope["default_method"],
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
//# Get all tags
if ($req->request === "envelopes/tags") {
  //! Require Role

  // Get data
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
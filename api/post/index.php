<?php require_once __DIR__ . "/../app/_config/index.php";

use Http\Auth;
use Http\Response;
use Http\Request;
use Http\Headers;

Headers::post();

$auth = Auth::verifyToken();
$req = Request::getJson();

//*-----------------------------------------
//# Add new envelope
if ($req->request === "envelopes/add") {
  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  // Conversion object
  $columns = [
    "name" => "name",
    "desc" => "desc",
    "account" => "account",
    "defaultMethod" => "default_method",
  ];

  // Initialize insert object
  $insert = [
    "owner" => $auth->owner,
    "created" => (new DateTime())->format("Y-m-d H:i:s"),
  ];

  foreach ($req->data as $key => $data) {
    isset($columns[$key]) && ($insert[$columns[$key]] = $data);
  }

  $insert["name"] = ucfirst($insert["name"]);
  isset($insert["default_method"])
    ? ($insert["default_method"] = ucfirst($insert["default_method"]))
    : ($insert["default_method"] = "Cash");

  // Load nested values
  $insert["tag_name"] = ucfirst($req->data->tag->name);
  $insert["tag_color"] = $req->data->tag->color;
  $insert["values_total"] = $req->data->values->total;
  $insert["values_goal"] = $req->data->values->goal;

  // Post data
  $db->insert("envelopes", $insert);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => $req->data->name . " envelope added!"]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Update total envelope
if ($req->request === "envelopes/edit/total") {
  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  //! Require fields
  $required = ["id", "amount", "total"];
  $data = array_keys((array) $req->data);
  $data = array_diff($required, $data);
  count($data) > 0 &&
    Response::message(
      ["message" => "Value(s) required!", "values" => array_values($data)],
      406
    );

  // Initialize insert object
  $insert = [
    "envelope_id" => $req->data->id,
    "owner" => $auth->owner,
    "amount" => $req->data->amount,
    "total" => $req->data->total,
    "date" => (new DateTime())->format("Y-m-d H:i:s"),
  ];

  !empty($req->data->source) &&
    ($insert["source"] = ucfirst($req->data->source));
  !empty($req->data->method) &&
    ($insert["method"] = ucfirst($req->data->method));

  // Update total
  $db->startTransaction();
  $db->where("_id", $req->data->id);
  $db->update("envelopes", ["values_total" => $req->data->total], 1);

  //! Return errors
  if ($db->getLastErrno()) {
    $db->rollback();
    Response::message(["message" => $db->getLastError()], 400);
  }

  // Update history
  $db->insert("history", $insert);

  //! Return errors
  if ($db->getLastErrno()) {
    $db->rollback();
    Response::message(["message" => $db->getLastError()], 400);
  }
  // Cleared to commit
  $db->commit();

  // Return data
  Response::message(["message" => "Total updated!"]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Edit envelope
if ($req->request === "envelopes/edit") {
  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  // Conversion object
  $columns = [
    "owner" => "owner",
    "name" => "name",
    "desc" => "desc",
    "account" => "account",
  ];

  // Initialize insert object
  $update = [];
  foreach ($req->data as $key => $data) {
    isset($columns[$key]) && ($update[$columns[$key]] = $data);
  }
  // Load nested values
  $update["tag_name"] = $req->data->tag->name;
  $update["tag_color"] = $req->data->tag->color;
  $update["values_total"] = $req->data->values->total;
  $update["values_goal"] = $req->data->values->goal;

  // Post data
  $db->where("_id", $req->data->id);
  $db->update("envelopes", $update, 1);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => $req->data->name . " envelope added!"]);
}
//*-----------------------------------------

//*-----------------------------------------
//# Get new user
if ($req->request === "users/add") {
  //! Require Role
  $auth->role !== "super_user" &&
    Response::message(
      ["message" => "You are not authorized to view this information!"],
      401
    );

  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  //! Check required fields
  $required = ["fname", "lname", "email", "defaultSource", "password"];
  $data = array_keys((array) $req->data);
  $data = array_diff($required, $data);
  count($data) > 0 &&
    Response::message(
      ["message" => "Value(s) required!", "values" => array_values($data)],
      406
    );

  // Initialize insert object
  $insert = [
    "name" => $req->data->fname . " " . $req->data->lname,
    "email" => $req->data->email,
    "default_source" => $req->data->defaultSource,
    "password" => password_hash($req->data->password, PASSWORD_DEFAULT),
    "token" => bin2hex(openssl_random_pseudo_bytes(16)),
    "created" => (new DateTime())->format("Y-m-d H:i:s"),
  ];

  //@ Build id
  $insert["_id"] =
    strtolower($req->data->fname[0]) .
    strtolower(preg_replace("/\s+/", "", $req->data->lname)) .
    "-" .
    rand(10000, 99999);

  // Post data
  $db->insert("users", $insert);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => $insert["name"] . " added!"]);
}
//*-----------------------------------------
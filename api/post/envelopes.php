<?php

use Http\Response;
use Utilities\Utility;

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

  //! Check required fields
  Utility::requiredFields(["id", "amount", "total"], $req->data);

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
//# Update Pinned
if ($req->request === "envelopes/pin") {
  //! Require data
  !isset($req->data->id) &&
    Response::message(["message" => "Id required!"], 406);

  // Update data
  $db->rawQuery("UPDATE envelopes SET pinned = pinned ^ 1 WHERE _id = ?", [
    $req->data->id,
  ]);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => "Envelope pinned!"]);
}
//*-----------------------------------------
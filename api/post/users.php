<?php

use Http\Response;
use Utilities\Utility;

//*-----------------------------------------
//# Create new user
if ($req->request === "users/add") {
  //! Require Role
  $auth->role !== "admin" &&
    Response::message(
      ["message" => "You are not authorized to view this information!"],
      401
    );

  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  //! Check required fields
  Utility::requiredFields(
    ["fname", "lname", "email", "defaultMethod", "password"],
    $req->data
  );

  // Initialize insert object
  $insert = [
    "name" => $req->data->fname . " " . $req->data->lname,
    "email" => $req->data->email,
    "default_method" => $req->data->defaultMethod,
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

//*-----------------------------------------
//# Reset password
if ($req->request === "users/password") {
  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  //! Check required fields
  Utility::requiredFields(["password"], $req->data);

  // Initialize insert object
  $insert = [
    "password" => password_hash($req->data->password, PASSWORD_DEFAULT),
  ];

  // Post data
  $db->where("_id", $auth->owner);
  $db->update("users", $insert);

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => "Password updated!"]);
}
//*-----------------------------------------
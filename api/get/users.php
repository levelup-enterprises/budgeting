<?php

use Http\Response;

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
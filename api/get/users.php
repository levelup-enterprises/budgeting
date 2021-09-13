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

//*-----------------------------------------
//# Get profile data
if ($req->request === "users/profile") {
  // Get account and user data
  $a = $db->subQuery("a");
  $a->get("accounts");
  $db->where("u._id", $auth->owner);
  $db->join($a, "a.user_id=u._id", "LEFT");
  $user = $db->getOne("users as u", [
    "a.active",
    "a.expires",
    "a.tier",
    "u.name",
    "u.email",
    "u.phone",
  ]);

  // Return data
  Response::message(["data" => $user]);
}
//*-----------------------------------------
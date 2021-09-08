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

//# Envelopes
if (str_starts_with($req->request, "envelopes/")) {
  require_once "./envelopes.php";
}

//# Users
if (str_starts_with($req->request, "users/")) {
  require_once "./users.php";
}

//# Summary
if (str_starts_with($req->request, "summary/")) {
  require_once "./summary.php";
}

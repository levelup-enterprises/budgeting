<?php require_once __DIR__ . "/../app/_config/index.php";

use Http\Auth;
use Http\Response;
use Http\Request;
use Http\Headers;

Headers::delete();

$auth = Auth::verifyToken();
$req = Request::getJson();

//*-----------------------------------------
//# Delete envelope
if ($req->request === "envelope") {
  //! Require data
  !isset($req->data) && Response::message(["message" => "Invalid data!"], 406);

  // Delete envelope
  $db->where("owner", $auth->owner);
  $db->where("_id", $req->data);
  $db->delete("envelopes");

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Delete history
  $db->where("owner", $auth->owner);
  $db->where("envelope_id", $req->data);
  $db->delete("transactions");

  //! Return errors
  $db->getLastErrno() &&
    Response::message(["message" => $db->getLastError()], 400);

  // Return data
  Response::message(["message" => "Envelope deleted!"]);
}
//*-----------------------------------------

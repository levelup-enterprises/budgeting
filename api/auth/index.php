<?php require_once __DIR__ . "/../app/_config/index.php";

use Http\Auth;
use Http\JWT;
use Http\Headers;
use Http\Response;
use Http\Request;

Headers::both();

$req = Request::getJson();

//! Request not found
!$req && Response::message(["message" => "Requires JSON request!"], 405);

//*-----------------------------------------
//# Get token
if ($req->request === "token") {
  Response::message(Auth::getToken());
}
//*-----------------------------------------

//*-----------------------------------------
//# Handle login
if ($req->request === "user/login") {
  if (isset($req->data->email) && isset($req->data->password)) {
    // Get user
    $db->where("email", $req->data->email);
    $user = $db->getOne("users");

    //! Return errors
    $db->getLastErrno() &&
      Response::message(["message" => $db->getLastError()], 400);

    //! User not found
    $db->count < 1 &&
      Response::message(
        ["message" => "Username or password are incorrect!"],
        401
      );

    //! Password incorrect
    !password_verify($req->data->password, $user["password"]) &&
      Response::message(
        ["message" => "Username or password are incorrect!"],
        401
      );

    $payload = [
      "owner" => $user["_id"],
      "role" => $user["role"],
      "defaultDateRange" => $user["default_date_range"],
      "defaultMethod" => $user["default_method"],
    ];

    Response::message((new JWT())->createJWT($payload));
  }

  Response::message(["message" => "Username and password required!"], 406);
}
//*-----------------------------------------
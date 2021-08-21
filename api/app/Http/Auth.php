<?php

namespace Http;

use Http\JWT;

class Auth
{
  public static function getToken()
  {
    if (isset(API_CREDS[$_SERVER["PHP_AUTH_USER"]])) {
      if (API_CREDS[$_SERVER["PHP_AUTH_USER"]] === $_SERVER["PHP_AUTH_PW"]) {
        return (new JWT())->createJWT(["role" => $_SERVER["PHP_AUTH_USER"]]);
      } else {
        Response::message(["message" => "Unauthorized user!"], 401);
      }
    }
    Response::message(["message" => "Credentials required!"], 400);
  }

  public static function verifyToken($status = null)
  {
    // Prevent preflight errors
    if ($_SERVER["REQUEST_METHOD"] !== "OPTIONS") {
      if (Request::getToken()) {
        $token = Request::getToken();
        return $status
          ? (new JWT())->verifyJWT($token, true)
          : (new JWT())->verifyJWT($token);
      } else {
        Response::message(
          [
            "error" => [
              "message" => "You are not authorized to view this information!",
            ],
          ],
          401
        );
      }
    }
  }

  public static function generateSecret()
  {
    $secret = bin2hex(random_bytes(32));
    putenv("SECRET=$secret");
  }
}
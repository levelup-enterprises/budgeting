<?php

namespace Http;

class Headers
{
  static function get()
  {
    header("Access-Control-Allow-Origin:" . CORS_ACCESS);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header(
      "Access-Control-Allow-Headers: Origin, Content-Type, Authentication, Authorization, Access"
    );
    header("Content-Type: application/json; charset=UTF-8");
  }

  static function post()
  {
    header("Access-Control-Allow-Origin:" . CORS_ACCESS);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header(
      "Access-Control-Allow-Headers: Origin, Content-Type, Authentication, Authorization, Access"
    );
    header("Content-Type: application/json; charset=UTF-8");
  }

  static function both()
  {
    header("Access-Control-Allow-Origin:" . CORS_ACCESS);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header(
      "Access-Control-Allow-Headers: Origin, Content-Type, Authentication, Authorization, Access"
    );
    header("Content-Type: application/json; charset=UTF-8");
  }

  static function delete()
  {
    header("Access-Control-Allow-Origin:" . CORS_ACCESS);
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, DELETE, OPTIONS");
    header(
      "Access-Control-Allow-Headers: Origin, Content-Type, Authentication, Authorization, Access"
    );
    header("Content-Type: application/json; charset=UTF-8");
  }
}
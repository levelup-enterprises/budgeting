<?php

namespace Utilities;

use Http\Response;

class Utility
{
  /**
   * Check for required fields
   *
   * @param array $required array of fields
   * @param object $req requested data
   * @return bool
   */
  public static function requiredFields(array $required, object $req)
  {
    $data = array_keys((array) $req);
    $data = array_diff($required, $data);
    count($data) > 0 &&
      Response::message(
        ["message" => "Value(s) required!", "values" => array_values($data)],
        406
      );

    return true;
  }
}
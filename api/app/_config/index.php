<?php
/**
 ** Import Vendor Library -----------------------------------------------------
 * Imports vendor autoload file for use in project.
 *  - Declare required classes
 */
require_once __DIR__ . "/../../vendor/autoload.php";

// Declare libraries
use Http\Request;
use Dotenv\Dotenv;
use Utilities\DB;

/**
 ** DB Usage ----------------------------------------------------------------
 * If you intend to connect to a db within your project
 * add the table names below in the TABLE definition.
 * - Use the array key to reference the table
 * - Ex: TABLE[0] = 'demo'
 *
 * The framework is built on the
 * thingengineer/mysqli-database-class library.
 * Learn more at https://github.com/ThingEngineer/PHP-MySQLi-Database-Class
 */

/**
 * DB Table
 * @var \Array
 * Enter table names as array for easy changes
 *
 * 0 - leads
 *
 * 1 - users
 */
define("TABLE", ["leads", "users"]);

/**
 ** Site Info ----------------------------------------------------------------
 * Set site variables here.
 * - TITLE refers to the meta title name
 * - PROD_URL is the production url common name
 * - VERSION of the current build. Also appends version to js and css files
 *    to force caching updates
 */

// Set production url
define("PROD_URL", "envelopes.cash");

/**
 ** System ---------------------------------------------------------------------
 * Set system variables here.
 * - DBDATA include database connection information
 * - TIMEOUT set session timeout for protected pages
 * - JWT_EXPIRE set expiration time in hours for jwt token
 * - PROC_TIMER set process timer to return execution time
 * - Set default timezone for date/time references
 * - LOCAL checks for local ip and sets env
 * - STAGE compares current url host with PROD_URL var to detect stage env
 */

// DB connection info
define("DBDATA", include "db.php");

// Set Session Timeout
define("TIMEOUT", 18000); // 30 mins 1800

// Set Session Timeout
define("JWT_EXPIRE", 3); // hours

// Start Process Timer
define("PROC_TIMER", microtime(true));

// Set the default timezone
date_default_timezone_set("America/Chicago");

// Set local Env
if ($_SERVER["REMOTE_ADDR"] === "127.0.0.1") {
  define("LOCAL", true);
} else {
  define("LOCAL", false);
}

// Set stage Env
if (Request::getHost() !== PROD_URL) {
  define("STAGE", true);
  define("CORS_ACCESS", "*");
} else {
  define("STAGE", false);
  define("CORS_ACCESS", PROD_URL);
}

/**
 ** Error Handling ----------------------------------------------------------------
 * Sets error display based environment
 * - Allows php warnings in prod
 */

if (!STAGE) {
  error_reporting(E_ALL ^ E_WARNING);
} else {
  error_reporting(E_ALL);
  ini_set("display_errors", "On");
}

/**
 ** Initialize Classes -------------------------------------------------------------
 * Initialize commonly used classes for the project.
 *  - DotEnv - bring in root env file
 */

(new DotEnv(__DIR__ . "/../../"))->load();

/**
 ** Start DB -------------------------------------------------------------
 * Enable access to the database from any element in the project.
 *  - Classes must initiate the DB instance or bring pass the $db var
 *
 * Enabled by default
 */

$useDB = true; // Disable if not using db
$db = $useDB ? (new DB())->start() : null;

/**
 ** API credentials -------------------------------------------------------
 * Manage access credentials for the api/backend
 */

define("API_CREDS", [
  "general" => "DFGfertdFdfg.345er@edwesfd.sdfhkjher!",
]);
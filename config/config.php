<?php

//Note: This file should be included first in every php page.
error_reporting(E_ALL);
ini_set('display_errors', 'On');
define('BASE_PATH', dirname(dirname(__FILE__)));
// define('APP_FOLDER', 'simpleadmin');
define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/model/MysqliDb/MysqliDb.php';
require_once BASE_PATH . '/data/helpers.php';


define('DB_HOST', "localhost");
define('DB_USER', "user");
define('DB_PASSWORD', "root");
define('DB_NAME', "banner_system");

/**
 * Get instance of DB object
 */
function getDbInstance() {
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}
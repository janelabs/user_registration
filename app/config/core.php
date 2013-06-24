<?php
define('ENV_PRODUCTION', false);
define('APP_HOST', 'user_registration.dietcake.com');
define('APP_BASE_PATH', '/');
define('APP_URL', 'http://user_registration.dietcake.com/');

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);
ini_set('error_log', LOGS_DIR.'php.log');
ini_set('session.auto_start', 0);

// MySQL: board
define('DB_DSN', 'mysql:host=localhost;dbname=user');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_ATTR_TIMEOUT', 3);

// encryption key
define('ENC_KEY', 'us3rM4na63mnt!890');

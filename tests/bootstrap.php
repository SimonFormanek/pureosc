<?php
echo 'bootstrap in '.getcwd()."\n";

define('DIR_FS_ADMIN', dirname(getcwd()).'/catalog/admin');

require_once dirname(__DIR__).'/vendor/autoload.php';

\Ease\Shared::initializeGetText('pureosc', 'cs_CZ', '../i18n');

define('TITLE', 'TEST TITLE');
define('MYSQL_DEBUG', 'on');


define('STORE_SESSIONS', 'False');


if (file_exists('.scrutinizer.yml')) {
    $dirPrefix = '';
} else { // we are in tests
    $dirPrefix = '../';
}

define('USE_PCONNECT', 'False');

if (file_exists($dirPrefix.'../oscconfig/dbconfigure.php')) {
    include_once $dirPrefix.'../oscconfig/dbconfigure.php';
} else {
    define('DB_PORT', 3306);
    define('DB_SERVER', 'localhost');
    define('DB_DATABASE', 'pureosc');
    define('DB_SERVER_USERNAME', 'pureosc');
    define('DB_SERVER_PASSWORD', 'pureosc');

//EasePHP Framework
    define('DB_HOST', constant('DB_SERVER'));
    define('DB_PASSWORD', constant('DB_SERVER_PASSWORD'));
    define('DB_USERNAME', constant('DB_SERVER_USERNAME'));
    define('DB_TYPE', 'mysql');
}



include_once $dirPrefix.'catalog/includes/filenames.php';
include_once $dirPrefix.'catalog/includes/database_tables.php';
include_once $dirPrefix.'catalog/includes/functions/general.php';
include_once $dirPrefix.'catalog/includes/functions/database.php';
include_once $dirPrefix.'catalog/includes/functions/sessions.php';

define('DIR_WS_MODULES', $dirPrefix.'catalog/includes/modules/');

tep_db_connect();


$db = \Ease\Shared::db();

foreach ($db->queryToArray('select configuration_key, configuration_value from configuration') as $config) {
    define($config['configuration_key'], $config['configuration_value']);
    //echo $config['configuration_key'].':'.$config['configuration_value']."\n";
}

$oscTemplate = new oscTemplate();



<?php
echo 'bootstrap in '.getcwd()."\n";

define('DIR_FS_ADMIN', dirname(getcwd()).'/catalog/admin' );

require_once dirname(__DIR__).'/vendor/autoload.php';

\Ease\Shared::initializeGetText('pureosc', 'cs_CZ', '../i18n');

define('DB_SERVER', 'localhost');
define('DB_DATABASE', 'pureosc');
define('DB_SERVER_USERNAME', 'pureosc');
define('DB_SERVER_PASSWORD', 'pureosc');
define('USE_PCONNECT','False');

define('STORE_SESSIONS', 'False');

include_once '../catalog/includes/filenames.php';
include_once '../catalog/includes/database_tables.php';
include_once '../catalog/includes/functions/general.php';
include_once '../catalog/includes/functions/database.php';
include_once '../catalog/includes/functions/sessions.php';

tep_db_connect(); 

//EasePHP Framework
define('DB_HOST', constant('DB_SERVER'));
define('DB_PASSWORD', constant('DB_SERVER_PASSWORD'));
define('DB_USERNAME', constant('DB_SERVER_USERNAME'));
define('DB_TYPE', 'mysql');

$db = \Ease\Shared::db();

foreach ($db->queryToArray('select configuration_key, configuration_value from configuration') as $config) {
    define($config['configuration_key'], $config['configuration_value']);
    //echo $config['configuration_key'].':'.$config['configuration_value']."\n";
}

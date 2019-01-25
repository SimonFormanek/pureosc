#!/usr/bin/php -q
<?php
//require('includes/application_top.php');
error_reporting(0);
@ini_set('display_errors', 0);
define('HTTP_HOST', 'localhost');
require('../../oscconfig/admin/configure.php');
require('../../oscconfig/dbconfigure.php');
require(DIR_WS_INCLUDES.'filenames.php');
///echo "database_tables.php\n";
require(DIR_WS_INCLUDES.'database_tables.php');
///echo "load functions: database.php\n";
require(DIR_WS_FUNCTIONS.'database.php');
//echo "!! DB_CONNECT\n";
tep_db_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die('DB_SERVER:'.DB_SERVER.' DB_SERVER_USERNAME_ROOT:'.DB_SERVER_USERNAME_ROOT.' DB_SERVER_PASSWORD_ROOT:'.DB_SERVER_PASSWORD_ROOT.' Unable to connect to database server!');
///echo "Ctu konfiguraci..\n";
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from '.TABLE_CONFIGURATION);
while ($configuration       = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
    //echo $configuration['cfgKey']." = ".$configuration['cfgValue']."\n";
}


while (1) {
    if (date("s") > 55) {
        exit;
    } elseif (
        (date("s") == 1) ||
        (date("s") == 5) ||
        (date("s") == 10) ||
        (date("s") == 15) ||
        (date("s") == 20) ||
        (date("s") == 25) ||
        (date("s") == 30) ||
        (date("s") == 35) ||
        (date("s") == 40) ||
        (date("s") == 45) ||
        (date("s") == 50) ||
        (date("s") == 55)
    ) {
        echo date("s")."\n";
        $lng_code_query = tep_db_query("SELECT code FROM ".TABLE_LANGUAGES);
        while ($lng_code       = tep_db_fetch_array($lng_code_query)) {
//echo 'code:'. $lng_code['code'] . "\n";
            exec("./writecache.php ".$lng_code['code'].' shop');
//   	exec("./writecache.php " . $lng_code['code'] . ' admin');
        }
    }
    sleep(1);
}

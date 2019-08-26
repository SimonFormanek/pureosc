#!/usr/bin/php -q
<?php
//require('includes/application_top.php');
error_reporting(1);
@ini_set('display_errors', 1);
//define('HTTP_HOST', 'localhost');
require('../../../oscconfig/static.php'); //???
require('../../../oscconfig/admin/configure.php');
require('../../../oscconfig/dbconfigure.php');
require(DIR_WS_INCLUDES.'filenames.php');
///echo "database_tables.php\n";
require(DIR_WS_INCLUDES.'database_tables.php');
///echo "load functions: database.php\n";
require(DIR_WS_FUNCTIONS.'database.php');
//echo "!! DB_CONNECT\n";
tep_db_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die('DB_SERVER:'.DB_SERVER.' DB_SERVER_USERNAME_ROOT:'.DB_SERVER_USERNAME_ROOT.' DB_SERVER_PASSWORD_ROOT:'.DB_SERVER_PASSWORD_ROOT.' Unable to connect to database server!');
if (!file_exists(DIR_FS_MASTER_ROOT_DIR . 'log/')) {
  mkdir(DIR_FS_MASTER_ROOT_DIR . 'log/', 0777);
}

while (1) {
    if (date("s") > 56) {
    if ($debug_level > 2) {echo 'exit > 56';}
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
        if ($argv[1] == 'css'){ //generate only css
        if ($debug_level > 2) echo "generating only CSS...\n";
          exec('./' . DIR_WS_INCLUDES . 'css/cssgen.php');
        } else { 
        if ($debug_level > 2) echo "generating ALL ...\n";
          exec('./' . DIR_WS_INCLUDES . 'css/cssgen.php');
        $lng_code_query = tep_db_query("SELECT code FROM languages WHERE sort_order > 0");
        while ($lng_code       = tep_db_fetch_array($lng_code_query)) {
          exec("./writecache.php ".$lng_code['code'] ." shop  >> " . DIR_FS_MASTER_ROOT_DIR . 'log/' . $lng_code['code'] . ".log") ;
        }
      }
    }
    sleep(1);
}

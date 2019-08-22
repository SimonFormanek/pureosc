<?php
/*
  $Id: database_optimizer_cron.php,v 1.0 2011/02/02
  database_optimizer_cron.php Originally Created by: Jack_mcs - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Portions Copyright 2011 oscommerce-solution.com
  Released under the GNU General Public License
*/
/*************************** OPTIONS AND EDITABLE STRINGS ****************************************/
$message = 'Store database has been optimized.';
$subject = 'Database %s has been optimized';
$verbose = true;  //show results
/*************** DON"T EDIT BELOW HERE UNLESS YOU UNDERSTAND THE CONSEQUENCES ********************/
require('includes/configure.php');
require('includes/filenames.php');
require('includes/database_tables.php');
require('includes/functions/database.php');
require('includes/functions/database_optimizer.php');
require('includes/functions/general.php');
require('includes/functions/html_output.php');
require('includes/languages/english/database_optimizer.php');
// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');
 
$config = array();
$config_query = tep_db_query("select * FROM configuration WHERE configuration_key LIKE 'DATABASE_OPTIMIZER%'");
while ($loadconfig = tep_db_fetch_array($config_query)) {
 
    switch ($loadconfig['configuration_key']) {
        case 'DATABASE_OPTIMIZER_ENABLE':        $config['main_switch'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_PERIOD':        $config['period'] = $config['optimize'] =$loadconfig['configuration_value']; 
                                                 define('DATABASE_OPTIMIZER_PERIOD', $config['period']);
        break;
        case 'DATABASE_OPTIMIZER_ANALYZE':       $config['analyze'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_CUSTOMERS':     $config['customers'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_CUSTOMERS_OLD': $config['customers_old'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_CUSTOMERS_OORDERS': $config['customers_ooders'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_PRODUCT_NOTIFICATIONS': $config['notifications'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_ORDERS_CC':     $config['orders_cc'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_ORPHAN_ADDR_BOOK': $config['orphan_addr_book'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_ORPHAN_ORDERS': $config['orphan_orders'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_ORPHAN_PRODUCTS': $config['orphan_products'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_SESSIONS':      $config['sessions'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_USER_TRACKING': $config['usertracking'] = $loadconfig['configuration_value']; break;
        case 'DATABASE_OPTIMIZER_EMAIL_NOTIFY':  $config['email_address'] = $loadconfig['configuration_value']; break; 
                                                 define('DATABASE_OPTIMIZER_EMAIL_NOTIFY', $config['email_address']);
        break;
    }
}
 
if ($config['main_switch'] == 'true') {
    $query = tep_db_query("select last_update from database_optimizer");
    $mainDate = tep_db_fetch_array($query);
    $dateArray  = explode("-",$mainDate['last_update']);
    $date1Int = mktime(0,0,0, $dateArray[1], $dateArray[2], $dateArray[0]);
    $daysLastRan = abs(floor((time() - $date1Int )/(60*60*24)));
    $wasUpdated = false;
    $forceOptimize = false;       //not ran manually
    require('includes/modules/database_optimizer_common.php');
}
 
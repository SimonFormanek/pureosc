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
$verbose = false;  //show results
/*************** DON"T EDIT BELOW HERE UNLESS YOU UNDERSTAND THE CONSEQUENCES ********************/
$config = array();              //re-assign these to keep coding similar to cron file for less maintenance
$config['period'] = DATABASE_OPTIMIZER_PERIOD;
$config['email_address'] = DATABASE_OPTIMIZER_EMAIL_NOTIFY;
$config['analyze'] = '';
$config['optimize'] = '';
$optionSelected = false;
foreach ($optionsArray as $option) { //build these to keep coding similar to cron file for less maintenance
    if (isset($_POST[$option['post']]) && $_POST[$option['post']] == 'on') {
        switch ($option['option']) {
            case TEXT_DO_OPTIMIZE:       $config['optimize']      = DATABASE_OPTIMIZER_OPTIMIZE;      $optionSelected = true; break;
            case TEXT_DO_ANALYZE:        $config['analyze']       = DATABASE_OPTIMIZER_ANALYZE;       $optionSelected = true; break;
            case TEXT_DO_CUSTOMERS:      $config['customers']     = DATABASE_OPTIMIZER_CUSTOMERS;     $optionSelected = true; break;
            case TEXT_DO_CUSTOMERS_OLD:  $config['customers_old'] = DATABASE_OPTIMIZER_CUSTOMERS_OLD; $optionSelected = true; break;
            case TEXT_DO_PRODUCT_NOTIFICATIONS: $config['notifications'] = DATABASE_OPTIMIZER_PRODUCT_NOTIFICATIONS; $optionSelected = true; break;
            case TEXT_DO_ORDERS_CC:      $config['orders_cc']     = DATABASE_OPTIMIZER_ORDERS_CC;     $optionSelected = true; break;
            case TEXT_DO_ORPHAN_ADDR_BOOK: $config['orphan_addr_book'] = DATABASE_OPTIMIZER_ORPHAN_ADDR_BOOK; $optionSelected = true; break;
            case TEXT_DO_ORPHAN_ORDERS:   $config['orphan_orders'] = DATABASE_OPTIMIZER_ORPHAN_ORDERS; $optionSelected = true; break;
            case TEXT_DO_ORPHAN_PRODUCTS: $config['orphan_products'] = DATABASE_OPTIMIZER_ORPHAN_PRODUCTS; $optionSelected = true; break;
            case TEXT_DO_SESSIONS:       $config['sessions']      = DATABASE_OPTIMIZER_SESSIONS;      $optionSelected = true; break;
            case TEXT_DO_SUPERTRACKER:   $config['supertracker']  = DATABASE_OPTIMIZER_SUPERTRACKER;  $optionSelected = true; break;
            case TEXT_DO_USER_TRACKING:  $config['usertracking']  = DATABASE_OPTIMIZER_USER_TRACKING; $optionSelected = true; break;
        }
    }
}
$config['optimize'] = ($forceOptimize ? 1 : $config['optimize']); //force an optimize if ran locally
if ($optionSelected) {                
    $query = tep_db_query("select last_update from database_optimizer");
    $mainDate = tep_db_fetch_array($query, MYSQL_ASSOC);
    $dateArray  = explode("-",$mainDate['last_update']);
    $date1Int = @mktime(0,0,0, $dateArray[1], $dateArray[2], (int)$dateArray[0]);
    $daysLastRan = 99999;  //if ran locally use this one to force a run
    $wasUpdated = false;
    require('includes/modules/database_optimizer_common.php');
}
 
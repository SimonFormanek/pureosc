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
define('HEADING_TITLE', 'Database Optimizer');
define('HEADING_TITLE_AUTHOR', 'by <a href="http://addons.oscommerce.com/profile/17188" target="_blank"><span style="color:#800080; font-size:12px;">Jack York</span></a> from <a href="http://www.oscommerce-solution.com/" target="_blank"><span style="font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px;">oscommerce-solution.com</span></a>');
define('HEADING_TITLE_SUPPORT_THREAD', '<a href="http://forums.oscommerce.com/topic/370724-database-optimizer/" target="_blank"><span style="color: sienna;">(visit the support thread)</span></a>');
define('TEXT_MISSING_VERSION_CHECKER', 'Version Checker is not installed. See <a href="http://addons.oscommerce.com/info/7819" target="_blank">here</a> for details.');
define('TEXT_HELP', '
<div style="position:relative; margin-left:auto; margin-right:auto; width:90%;">
  <div class="section_row shadow" style="position:absolute; left:-180px; top:-28px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("database_optimizer_help.php", "file=need_help") . '\');" title="Need Help?">Instructions</a></div>
  </div>
  <div class="section_row shadow" style="position:absolute; left:-40px; top:-28px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("database_optimizer_help.php", "file=need_install") . '\');" title="Need Installation Help?">Need An Addon?</a></div>
  </div>  
  <div class="section_row shadow" style="position:absolute; left:100px; top:-28px">
    <div class="section_column"><a href="javascript:void(null);" onclick="showHelp(\'' .tep_href_link("database_optimizer_help.php", "file=need_host") . '\');" title="Need Host?">Need A Host?</a></div>
  </div>
</div>
<div id="do_help" title="Database Optimizer Help" style="display: none;"></div> 
'); 
define('TEXT_DATABASE_OPTIMIZER', 'Select the following options and click update to run the optimizer. The items in red can remove data you may not want removed.
Please be sure to <a class="smallText" style="color:#dd0000" href="javascript:popupWindow(\'database_optimizer_popup.php\')">read the descriptions</a> if there are any concerns.
');
define('TEXT_DO_ANALYZE', 'Perform Analyze');
define('TEXT_DO_OPTIMIZE', 'Perform Optimize');
define('TEXT_DO_CUSTOMERS', 'Remove Customer Sessions');
define('TEXT_DO_CUSTOMERS_OLD', 'Remove Old Customers');
define('TEXT_DO_PRODUCT_NOTIFICATIONS', 'Remove Product Notifications');
define('TEXT_DO_ORDERS_CC', 'Remove CC Numbers');
define('TEXT_DO_ORPHAN_ADDR_BOOK', 'Remove Orphan Address Book Entries');
define('TEXT_DO_ORPHAN_ORDERS', 'Remove Orphan Orders');
define('TEXT_DO_ORPHAN_PRODUCTS', 'Remove Orphan Products');
define('TEXT_DO_SESSIONS', 'Remove Sessions');
define('TEXT_DO_SUPERTRACKER', 'Remove SuperTracker');
define('TEXT_DO_USER_TRACKING', 'Remove User Tracking');
define('TEXT_EXPLAIN_ANALYZE', 'Cleans up the keys in the tables. Improves the speed of the database.');
define('TEXT_EXPLAIN_OPTIMIZE', 'Defragments the database and reduces query times in some cases.');
define('TEXT_EXPLAIN_CUSTOMERS', 'Removes entries from the customer basket and customer basket attributes tables based on the configuration setting.');
define('TEXT_EXPLAIN_CUSTOMERS_OLD', '<span style="color:#dd0000;">Removes entries from the customers and address book tables based on the configuration setting and whether the customer has ever logged in.</span>');
define('TEXT_EXPLAIN_PRODUCT_NOTIFICATIONS', 'Removes entries from the products notification table when the customer and/or product no longer exist.');
define('TEXT_EXPLAIN_ORDERS_CC', '<span style="color:#dd0000;">Removes credit card numbers from the orders table based on the configuration setting.</span>');
define('TEXT_EXPLAIN_ORPHAN_ADDR_BOOK', 'Removes entries from the address book table that are not related to a customer.');
define('TEXT_EXPLAIN_ORPHAN_ORDERS', 'Removes orders when the customer for the order no longer exists. See <span style="font-weight:bold;color:#ff0000">WARNING</span> in Instructions above.');
define('TEXT_EXPLAIN_ORPHAN_PRODUCTS', 'Removes products that do not have an entry in the products_to_categories table.');
define('TEXT_EXPLAIN_SESSIONS', 'Removes entries from the sessions table based on the configuration setting.');
define('TEXT_EXPLAIN_SUPERTRACKER', 'Removes entries from the SuperTracker table based on the configuration setting.');
define('TEXT_EXPLAIN_USER_TRACKING', 'Removes entries from the user tracking table based on the configuration setting (User Tracking must be installed).');
$optionsArray = array(array('option' => TEXT_DO_ANALYZE, 'post' => (str_replace(" ", "_", TEXT_DO_ANALYZE)), 'explain' => TEXT_EXPLAIN_ANALYZE),
                      array('option' => TEXT_DO_OPTIMIZE, 'post' => (str_replace(" ", "_", TEXT_DO_OPTIMIZE)), 'explain' => TEXT_EXPLAIN_OPTIMIZE),
                      array('option' => TEXT_DO_CUSTOMERS, 'post' => (str_replace(" ", "_", TEXT_DO_CUSTOMERS)), 'explain' => TEXT_EXPLAIN_CUSTOMERS),
                      array('option' => TEXT_DO_CUSTOMERS_OLD, 'post' => (str_replace(" ", "_", TEXT_DO_CUSTOMERS_OLD)), 'explain' => TEXT_EXPLAIN_CUSTOMERS_OLD),
                      array('option' => TEXT_DO_PRODUCT_NOTIFICATIONS, 'post' => (str_replace(" ", "_", TEXT_DO_PRODUCT_NOTIFICATIONS)), 'explain' => TEXT_EXPLAIN_PRODUCT_NOTIFICATIONS),
                      array('option' => TEXT_DO_ORDERS_CC, 'post' => (str_replace(" ", "_", TEXT_DO_ORDERS_CC)), 'explain' => TEXT_EXPLAIN_ORDERS_CC),
                      array('option' => TEXT_DO_ORPHAN_ADDR_BOOK, 'post' => (str_replace(" ", "_", TEXT_DO_ORPHAN_ADDR_BOOK)), 'explain' => TEXT_EXPLAIN_ORPHAN_ADDR_BOOK),
                      array('option' => TEXT_DO_ORPHAN_ORDERS, 'post' => (str_replace(" ", "_", TEXT_DO_ORPHAN_ORDERS)), 'explain' => TEXT_EXPLAIN_ORPHAN_ORDERS),
                      array('option' => TEXT_DO_ORPHAN_PRODUCTS, 'post' => (str_replace(" ", "_", TEXT_DO_ORPHAN_PRODUCTS)), 'explain' => TEXT_EXPLAIN_ORPHAN_PRODUCTS),
                      array('option' => TEXT_DO_SESSIONS, 'post' => (str_replace(" ", "_", TEXT_DO_SESSIONS)), 'explain' => TEXT_EXPLAIN_SESSIONS)
                 );
/*
PURE TODO:
$db_query = tep_db_query("SHOW TABLES LIKE 'supertracker'"); */
if (tep_db_num_rows($db_query) && ! isset($_GET['reset'])) { 
    $optionsArray[] =  array('option' => TEXT_DO_SUPERTRACKER, 'post' => (str_replace(" ", "_", TEXT_DO_SUPERTRACKER)), 'explain' => TEXT_EXPLAIN_SUPERTRACKER);
//}
/*$db_query = tep_db_query("SHOW TABLES LIKE 'user_tracking'"); 
if (tep_db_num_rows($db_query) && ! isset($_GET['reset'])) { */
    $optionsArray[] =  array('option' => TEXT_DO_USER_TRACKING, 'post' => (str_replace(" ", "_", TEXT_DO_USER_TRACKING)), 'explain' => TEXT_EXPLAIN_USER_TRACKING);
//}
define('ERROR_DB_FAILURE', 'There is a problem with the database. This page will not work.');
define('ERROR_FAILED_DB_CONNECTION', 'Failed to connect to the database');
define('ERROR_NO_OPTION_SELECTED', 'At least one option must be selected');
define('SUCCESS_DATABASE_UPDATED', 'The Database Optimizer database has been successfully updated.');

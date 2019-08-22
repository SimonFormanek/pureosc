<?php

function DO_CheckDatabase() {
   global $messageStack;
 
    $db_query = tep_db_query("SHOW TABLES LIKE 'database_optimizer'"); 
    if (tep_db_num_rows($db_query) && ! isset($_GET['reset'])) {
        return true;
    } else {
        $db_sql_array   = array();
        $db_sql_array[] = array('DROP TABLE IF EXISTS database_optimizer');
        $db_sql_array[] = array('CREATE TABLE database_optimizer (
                           last_update DATE NOT NULL,
                           customers_last_update DATE NOT NULL,
                           customers_old_last_update DATE NOT NULL,
                           orders_last_update DATE NOT NULL,
                           orphan_addr_book_last_update DATE NOT NULL,  
                           orphan_products_last_update DATE NOT NULL,  
                           products_notifications_last_update DATE NOT NULL,
                           sessions_last_update DATE NOT NULL,
                           supertracker_last_update DATE NOT NULL,
                           user_tracking_last_update DATE NOT NULL
                          );');
        $db_sql_array[] = array("INSERT INTO database_optimizer (last_update, customers_last_update, orders_last_update, sessions_last_update, supertracker_last_update, user_tracking_last_update) VALUES (now(), now(), now(), now(), now(), now())");
                          
        foreach ($db_sql_array as $sql_array) {
            foreach ($sql_array as $value) {
                if (tep_db_query($value) == false) {
                     $messageStack->add(ERROR_DB_FAILURE, 'error');
                     return false;
                }
            }
        }

        /**** Get or Set the configuration group IP ****/    
        $db_query = tep_db_query("select configuration_group_id as id from configuration_group where configuration_group_title = 'Database Optimizer'");
        if (tep_db_num_rows($db_query) == 0) {
            $db_query = tep_db_query("select max(configuration_group_id) as id from configuration_group ");
            $max = tep_db_fetch_array($db_query);
            $configuration_group_id = $max['id'] + 1;

            // create configuration group
            $db_query = "INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible ) VALUES ('" . $configuration_group_id . "', 'Database Optimizer', 'Database Optimizer Store Wide Settings', '22' , '1')";
            tep_db_query($db_query);
        } else { //delete all of the setting options for this addon
            $id = tep_db_fetch_array($db_query);
            $configuration_group_id = $id['id'];  
            
            $delete_query = "DELETE FROM configuration where configuration_group_id = " . (int)$configuration_group_id ;
            tep_db_query($delete_query);
        }    

        /**** Set the configuration settings ****/
        $db_sql_array   = array();
        $db_sql_array[] = array("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function)
        VALUES
          ('Database Optimizer ON/OFF',      'DATABASE_OPTIMIZER_ENABLE',                 'true', '<center><b><h2>Database Optimizer</h2><i>Developed by:</i><br>Jack_MCS @ Oscommerce Solution<br><a href=\"\/\/oscommerce-solution.com\//check_unreleased_updates.php?id=2.0&name=DataBaseOptimzer\" target=\"_blank\">Check Updates</a></b></center><br>Optimize DB<br>(true=on false=off)', '" . $configuration_group_id . "', '1', 'tep_cfg_select_option(array(\'true\', \'false\'), ', NOW(), NULL),
          ('Optimize Database Period',       'DATABASE_OPTIMIZER_PERIOD',                 '1',    'How often the database should be optimized. Recommended setting is 1. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '15', NULL, NOW(), NULL),
          ('Analyze Database Period',        'DATABASE_OPTIMIZER_ANALYZE',                '14',   'How often the database should be analyzed. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '20', NULL, NOW(), NULL),
          ('Truncate Customers',             'DATABASE_OPTIMIZER_CUSTOMERS',              '20',   'Should older entries in the customers and customers basket tables be removed? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '25', NULL, NOW(), NULL),
          ('Truncate Customers Old',         'DATABASE_OPTIMIZER_CUSTOMERS_OLD',          '180',  'Should older entries in the customers and address book tables be removed? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '30', NULL, NOW(), NULL),
          ('Truncate Customers Orders',      'DATABASE_OPTIMIZER_CUSTOMERS_ORDERS',       'Opt C','How to handle old customers with orders? This only works if Truncate Customers Old is enabled.<br><br>Opt A: Delete customer but leave orders<br>Opt B: Delete customer and orders<br>Opt C: Skip customers with orders', '" . $configuration_group_id . "', '31', 'tep_cfg_select_option(array(\'Opt A\', \'Opt B\', \'Opt C\'), ', NOW(), NULL),
          ('Truncate Product Notifications', 'DATABASE_OPTIMIZER_PRODUCT_NOTIFICATIONS',  '10',   'Should entries in the product notification table be deleted if the customer and/or product no longer exist?  (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '33', NULL, NOW(), NULL),
          ('Truncate Orders CC Number',      'DATABASE_OPTIMIZER_ORDERS_CC',              '10',   'Should credit card details be removed from the orders table? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '35', NULL, NOW(), NULL),
          ('Truncate Orphan Address Book',   'DATABASE_OPTIMIZER_ORPHAN_ADDR_BOOK',       '10',   'Should address book entries not tied to a customer be deleted? (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '40', NULL, NOW(), NULL),
          ('Truncate Orphan Products',       'DATABASE_OPTIMIZER_ORPHAN_PRODUCTS',        '14',   'Should products that do not have an entry in the products_to_categories table be deleted? (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '42', NULL, NOW(), NULL),
          ('Truncate Sessions',              'DATABASE_OPTIMIZER_SESSIONS',               '14',   'Should older entries in the sessions table be removed? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '45', NULL, NOW(), NULL),
          ('Truncate SuperTracker',          'DATABASE_OPTIMIZER_SUPERTRACKER',           '',   'Should older entries in the SuperTracker table be removed? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '50', NULL, NOW(), NULL),
          ('Truncate User Tracking',         'DATABASE_OPTIMIZER_USER_TRACKING',          '',    'Should older entries in the user tracking table be removed? Enter the number of days between removals or leave blank for no removal. (<b>Value entered must be in days</b>)', '" . $configuration_group_id . "', '55', NULL, NOW(), NULL),
          ('Email Notification',             'DATABASE_OPTIMIZER_EMAIL_NOTIFY',           '', 'Enter the email address that you would like the email sent to. Enter multiple email addresses by separating them with a comma. A blank entry means no emails will be sent.', '" . $configuration_group_id . "', '60', NULL, NOW(), NULL),
          ('Enable Version Checker',         'DATABASE_OPTIMIZER_ENABLE_VERSION_CHECKER', 'false', 'Enables the code that checks if updates are available.', '" . $configuration_group_id . "', '70', 'tep_cfg_select_option(array(\'true\', \'false\'), ', NOW(), NULL)
        ;");
     
        foreach ($db_sql_array as $sql_array) {
            foreach ($sql_array as $value) {
                if (tep_db_query($value) == false) {
                     $messageStack->add(ERROR_DB_FAILURE, 'error');
                     return false;
                }
            }
        } 
    } 
    
    $messageStack->add(SUCCESS_DATABASE_UPDATED, 'success');
    return true;
}
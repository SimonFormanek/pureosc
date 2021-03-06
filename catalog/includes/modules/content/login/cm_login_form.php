<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class cm_login_form {

    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_login_form() {
        $this->code = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title = _('Login Form');
        $this->description = _('Show a login form on the login page');

        if (defined('MODULE_CONTENT_LOGIN_FORM_STATUS')) {
            $this->sort_order = MODULE_CONTENT_LOGIN_FORM_SORT_ORDER;
            $this->enabled = (MODULE_CONTENT_LOGIN_FORM_STATUS == 'True');
        }
    }

    function execute() {
        global $_GET, $_POST, $sessiontoken, $login_customer_id, $messageStack, $oscTemplate;

        $error = false;

        if (isset($_GET['action']) && ($_GET['action'] == 'process') && isset($_POST['formid']) && ($_POST['formid'] == $sessiontoken)) {
            $email_address = tep_db_prepare_input($_POST['email_address']);
            $password = tep_db_prepare_input($_POST['password']);

// Check if email exists
            $customer_query = tep_db_query("select customers_id, customers_password from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' limit 1");
            if (!tep_db_num_rows($customer_query)) {
                $error = true;
            } else { 
                $customer = tep_db_fetch_array($customer_query);
                $custPass = $customer['customers_password']; 
                $custId = $customer['customers_id']; 
                
//kdyz je hromadne zasifrovano, desifrovat                
                $beRehash = false; 
                if(strpos($custPass, 'CrYpTeD') === 0) { //je na zacatku, nesmi byt false
                
                  $custPass = substr($custPass, 7);
                  
                  $custPass = jsp_passless_decrypt($custPass);
                  
                  $beRehash = true; 
                }

// Check that password is good
                if (! tep_validate_password($password, $custPass)) { 
                
                    $error = true; 
                } else {
// set $login_customer_id globally and perform post login code in catalog/login.php
                    $login_customer_id = (int) $custId;

//nove (ciste) zahashovani hesla, pokud je jeste postaru a/nebo prave odsifrovane
                    $info = password_get_info($custPass);
                    if(($info['algo'] < 1) || $beRehash) { //unknown algo 

                      tep_db_query("UPDATE " . TABLE_CUSTOMERS . " SET customers_password = '" . password_hash($password, PASSWORD_ARGON2ID) . "' WHERE customers_id = '" . (int) $custId . "'");
//TODO:                      tep_db_query("UPDATE " . TABLE_CUSTOMERS . " SET customers_password = '" . password_hash($password, cfg('HASH_ALGO')) . "' WHERE customers_id = '" . (int) $custId . "'");
                    }

// migrate old hashed password to new phpass password
/*
                    if (tep_password_type($customer['customers_password']) != 'phpass') {
                        tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_encrypt_password($password) . "' where customers_id = '" . (int) $login_customer_id . "'");
                    }
*/                    

                }
            }
        }

        if ($error === true) {
            $messageStack->add('login', _('Error: No match for E-Mail Address and/or Password.'));
        }

        ob_start();
        include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/login_form.php');
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    function isEnabled() {
        return $this->enabled;
    }

    function check() {
        return defined('MODULE_CONTENT_LOGIN_FORM_STATUS');
    }

    function install() {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Login Form Module', 'MODULE_CONTENT_LOGIN_FORM_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '1', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
        return array('MODULE_CONTENT_LOGIN_FORM_STATUS', 'MODULE_CONTENT_LOGIN_FORM_CONTENT_WIDTH', 'MODULE_CONTENT_LOGIN_FORM_SORT_ORDER');
    }

}
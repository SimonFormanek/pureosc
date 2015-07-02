<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class cm_pwa_login {
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_pwa_login() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_PWA_LOGIN_TITLE;
      $this->description = MODULE_CONTENT_PWA_LOGIN_DESCRIPTION;

      if ( defined('MODULE_CONTENT_PWA_LOGIN_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_PWA_LOGIN_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_PWA_LOGIN_STATUS == 'True');
      }
    }

    function execute() {
      global $oscTemplate;


      ob_start();
      include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/pwa_login.php');
      $template = ob_get_clean();

      $oscTemplate->addContent($template, $this->group);
            
    }
    function isEnabled() {
       global $cart;
      if (!tep_session_is_registered('customer_id') && ($cart->count_contents() > 0) && (MODULE_CONTENT_PWA_LOGIN_STATUS == 'True')) {
      return $this->enabled;
    }
   }

    function check() {
      return defined('MODULE_CONTENT_PWA_LOGIN_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Login Form Module', 'MODULE_CONTENT_PWA_LOGIN_STATUS', 'True', 'Do you want to enable the login form module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_PWA_LOGIN_CONTENT_WIDTH', 'Half', 'Should the content be shown in a full or half width container?', '6', '2', 'tep_cfg_select_option(array(\'Full\', \'Half\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_PWA_LOGIN_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, `set_function`) values ('Require Telephone Number', 'GUEST_CHECKOUT_TELEPHONE', 'true', 'Require Telephone Number?', 6, 5, '', now(),  'tep_cfg_select_option(array(\'true\', \'false\'),')");
      tep_db_query("alter table " . TABLE_CUSTOMERS . " add column `customers_guest` INT(1) NOT NULL DEFAULT '0' AFTER `customers_newsletter`");
      tep_db_query("alter table " . TABLE_ORDERS . " add column `customers_guest` INT(1) NOT NULL DEFAULT '0' AFTER `customers_address_format_id`");
      tep_db_query("alter table " . TABLE_ADDRESS_BOOK . " add column `customers_guest` INT(1) NOT NULL DEFAULT '0' AFTER `customers_id`");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
      tep_db_query("alter table " . TABLE_CUSTOMERS . " drop `customers_guest`");
      tep_db_query("alter table " . TABLE_ORDERS . " drop `customers_guest`");
      tep_db_query("alter table " . TABLE_ADDRESS_BOOK . " drop `customers_guest`");
    }

    function keys() {
      return array('MODULE_CONTENT_PWA_LOGIN_STATUS', 'MODULE_CONTENT_PWA_LOGIN_CONTENT_WIDTH', 'MODULE_CONTENT_PWA_LOGIN_SORT_ORDER', 'GUEST_CHECKOUT_TELEPHONE');
    }
  }
?>

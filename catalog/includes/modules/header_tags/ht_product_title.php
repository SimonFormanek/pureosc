<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce
  Released under the GNU General Public License
 */

class ht_product_title {

    var $code = 'ht_product_title';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct() {
            $this->ht_product_title();
    }

    function ht_product_title() {
      $this->title = _('Product Title');
      $this->description = _('Add the title of the current product to the page title');

        if (defined('MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS')) {
            $this->sort_order = cfg('MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER');
            $this->enabled = (cfg('MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS') == 'True');
        }
    }

    function execute() {
        global $oscTemplate, $_GET, $languages_id, $product_check;

        if (basename($_SERVER['PHP_SELF']) == FILENAME_PRODUCT_INFO) {
            if (isset($_GET['products_id'])) {
                $product_info_query = tep_db_query("select pd.products_name, pd.products_seo_title from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int) $_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int) $languages_id . "'");
                $product_info = tep_db_fetch_array($product_info_query);

                if (tep_not_null($product_info['products_seo_title'])) {
                    $oscTemplate->setTitle($product_info['products_seo_title'] . ', ' . $oscTemplate->getTitle());
                } else {
                    $oscTemplate->setTitle($product_info['products_name'] . ', ' . $oscTemplate->getTitle());
                }
            }
        }
    }

    function isEnabled() {
        return $this->enabled;
    }

    function check() {
        return defined('MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS');
    }

    function install() {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Product Title Module', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS', 'True', 'Do you want to allow product titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
        return array('MODULE_HEADER_TAGS_PRODUCT_TITLE_STATUS', 'MODULE_HEADER_TAGS_PRODUCT_TITLE_SORT_ORDER');
    }

}
<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class ht_manufacturer_title
{
    var $code    = 'ht_manufacturer_title';
    var $group   = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct()
    {
            $this->ht_manufacturer_title();
    }

    function ht_manufacturer_title()
    {
        $this->title       = _('Manufacturer Title');
        $this->description = _('Add the title of the current manufacturer to the page title');

        if (defined('MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS')) {
            $this->sort_order = MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER;
            $this->enabled    = (MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS == 'True');
        }
    }

    function execute()
    {
        global  $_GET, $oscTemplate, $manufacturers, $languages_id;

        if (basename($_SERVER['PHP_SELF']) == FILENAME_DEFAULT) {
            if (isset($_GET['manufacturers_id']) && is_numeric($_GET['manufacturers_id'])) {
                $manufacturers_query = tep_db_query("select manufacturers_name, manufacturers_seo_title from ".TABLE_MANUFACTURERS." where manufacturers_id = '".(int) $_GET['manufacturers_id']."'");
                if (tep_db_num_rows($manufacturers_query)) {
                    $manufacturers = tep_db_fetch_array($manufacturers_query);

                    if (tep_not_null($manufacturers['manufacturers_seo_title'])) {
                        $oscTemplate->setTitle($manufacturers['manufacturers_seo_title'].', '.$oscTemplate->getTitle());
                    } else {
                        $oscTemplate->setTitle($manufacturers['manufacturers_name'].', '.$oscTemplate->getTitle());
                    }
                }
            }
        }
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Manufacturer Title Module', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS', 'True', 'Do you want to allow manufacturer titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_HEADER_TAGS_MANUFACTURER_TITLE_STATUS', 'MODULE_HEADER_TAGS_MANUFACTURER_TITLE_SORT_ORDER');
    }
}
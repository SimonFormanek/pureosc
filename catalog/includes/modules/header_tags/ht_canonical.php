<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

class ht_canonical {

    var $code = 'ht_canonical';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct() {
    
        $this->title = _('Canonical Header Links');
        $this->description = _('Add header canonical links to category and product pages');

        if (defined('MODULE_HEADER_TAGS_CANONICAL_STATUS')) {
            $this->sort_order = cfg('MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER');
            $this->enabled = (cfg('MODULE_HEADER_TAGS_CANONICAL_STATUS') == 'True');
        }
    }

    function execute() {
        global $_GET, $cPath, $oscTemplate;

        if (basename($_SERVER['PHP_SELF']) == FILENAME_PRODUCT_INFO) {
            $oscTemplate->addBlock('<link rel="canonical" href="' . tep_href_link(FILENAME_PRODUCT_INFO,
                            'products_id=' . (int) $_GET['products_id'], 'NONSSL', false) . '" />' . "\n",
                    $this->group);
        } elseif (basename($_SERVER['PHP_SELF']) == FILENAME_DEFAULT) {
            if (isset($cPath) && tep_not_null($cPath)) {
                $oscTemplate->addBlock('<link rel="canonical" href="' . tep_href_link(FILENAME_DEFAULT,
                                'cPath=' . $cPath, 'NONSSL', false) . '" />' . "\n",
                        $this->group);
            } elseif (isset($_GET['manufacturers_id']) && tep_not_null($_GET['manufacturers_id'])) {
                $oscTemplate->addBlock('<link rel="canonical" href="' . tep_href_link(FILENAME_DEFAULT,
                                'manufacturers_id=' . (int) $_GET['manufacturers_id'],
                                'NONSSL', false) . '" />' . "\n", $this->group);
            }
        }
    }

    function isEnabled() {
        return $this->enabled;
    }

    function check() {
        return defined('MODULE_HEADER_TAGS_CANONICAL_STATUS');
    }

    function install() {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Canonical Module', 'MODULE_HEADER_TAGS_CANONICAL_STATUS', 'True', 'Do you want to enable the Canonical module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '",
                        $this->keys()) . "')");
    }

    function keys() {
        return array('MODULE_HEADER_TAGS_CANONICAL_STATUS', 'MODULE_HEADER_TAGS_CANONICAL_SORT_ORDER');
    }

}
<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce
  Portions Copyright 2011 oscommerce-solution.com

  Released under the GNU General Public License
*/

  class bm_header_tags_social {
    var $code = 'bm_header_tags_social';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function bm_header_tags_social() {
      $this->title = MODULE_BOXES_HEADER_TAGS_SOCIAL_TITLE;
      $this->description = MODULE_BOXES_HEADER_TAGS_SOCIAL_DESCRIPTION;

      if ( defined('MODULE_BOXES_HEADER_TAGS_SOCIAL_STATUS') ) {
        $this->sort_order = MODULE_BOXES_HEADER_TAGS_SOCIAL_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_HEADER_TAGS_SOCIAL_STATUS == 'True' && HEADER_TAGS_DISPLAY_COLUMN_BOX == 'true' && basename($_SERVER['PHP_SELF']) == FILENAME_PRODUCT_INFO);

        $this->group = ((MODULE_BOXES_HEADER_TAGS_SOCIAL_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate, $languages_id;

      $align = 'style="margin-left:auto; margin-right:auto; width:' . BOX_WIDTH . 'px;"';
      $inInfoBox = true;
      echo 'call '.$inInfoBox.'<br>';
      include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php');
      $inInfoBox = false;
      $data = '<div ' . $align . ' >' . $dataStr . '</div>';

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_HEADER_TAGS_SOCIAL_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Information Module', 'MODULE_BOXES_HEADER_TAGS_SOCIAL_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_HEADER_TAGS_SOCIAL_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_HEADER_TAGS_SOCIAL_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_HEADER_TAGS_SOCIAL_STATUS', 'MODULE_BOXES_HEADER_TAGS_SOCIAL_CONTENT_PLACEMENT', 'MODULE_BOXES_HEADER_TAGS_SOCIAL_SORT_ORDER');
    }
  }
?>

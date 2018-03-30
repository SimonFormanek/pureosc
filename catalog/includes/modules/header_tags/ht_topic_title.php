<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class ht_topic_title {
    var $code = 'ht_topic_title';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function ht_topic_title() {
      $this->title = MODULE_HEADER_TAGS_TOPIC_TITLE_TITLE;
      $this->description = MODULE_HEADER_TAGS_TOPIC_TITLE_DESCRIPTION;

      if ( defined('MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS') ) {
        $this->sort_order = MODULE_HEADER_TAGS_TOPIC_TITLE_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS == 'True');
      }
    }

    function execute() {
      global $PHP_SELF, $oscTemplate, $topics, $current_topic_id, $languages_id;

      if (basename($PHP_SELF) == FILENAME_ARTICLES) {
        if ($current_topic_id > 0) {
          $topics_query = tep_db_query("select topics_name, topics_heading_title from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = '" . (int)$current_topic_id . "' and language_id = '" . (int)$languages_id . "' limit 1");
          if (tep_db_num_rows($topics_query) > 0) {
            $topics = tep_db_fetch_array($topics_query);

            if (tep_not_null($topics['topics_heading_title'])) {
              $oscTemplate->setTitle($topics['topics_heading_title'] . ', ' . $oscTemplate->getTitle());
            }
            else {
              $oscTemplate->setTitle($topics['topics_name'] . ', ' . $oscTemplate->getTitle());
            }
          }
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Topic Title Module', 'MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS', 'True', 'Do you want to allow topic titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_TOPIC_TITLE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_HEADER_TAGS_TOPIC_TITLE_STATUS', 'MODULE_HEADER_TAGS_TOPIC_TITLE_SORT_ORDER');
    }
  }
?>

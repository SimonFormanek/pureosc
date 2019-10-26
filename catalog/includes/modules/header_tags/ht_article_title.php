<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce
  Released under the GNU General Public License
 */

class ht_article_title {

    var $code = 'ht_article_title';
    var $group = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct() {
      $this->title = _('Article Title');
      $this->description = _('Add the title of the current article to the page title');

        if (defined('MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS')) {
            $this->sort_order = constant('MODULE_HEADER_TAGS_ARTICLE_TITLE_SORT_ORDER');
            $this->enabled = (constant('MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS') == 'True');
        }
    }

    function execute() {
        global $oscTemplate, $_GET, $languages_id, $article_check;

        if ((basename($_SERVER['PHP_SELF']) == cfg('FILENAME_ARTICLE_INFO')) || (basename($_SERVER['PHP_SELF']) == cfg('FILENAME_ARTICLE_BLOG'))) {
            if (isset($_GET['articles_id'])) {
                $article_info_query = tep_db_query("select ad.articles_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int) $_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int) $languages_id . "'");
                $article_info = tep_db_fetch_array($article_info_query);

                $oscTemplate->setTitle($article_info['articles_name'] . ', ' . $oscTemplate->getTitle());
            }
        }
    }

    function isEnabled() {
        return $this->enabled;
    }

    function check() {
        return defined('MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS');
    }

    function install() {
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Article Title Module', 'MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS', 'True', 'Do you want to allow article titles to be added to the page title?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_ARTICLE_TITLE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
        tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
        return array('MODULE_HEADER_TAGS_ARTICLE_TITLE_STATUS', 'MODULE_HEADER_TAGS_ARTICLE_TITLE_SORT_ORDER');
    }

}

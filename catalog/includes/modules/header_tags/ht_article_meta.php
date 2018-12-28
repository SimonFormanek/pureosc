<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class ht_article_meta
{
    var $code    = 'ht_article_meta';
    var $group   = 'header_tags';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function __construct()
    {
        $this->ht_article_meta();
    }

    function ht_article_meta()
    {
        $this->title       = MODULE_HEADER_TAGS_ARTICLE_META_TITLE;
        $this->description = MODULE_HEADER_TAGS_ARTICLE_META_DESCRIPTION;

        if (defined('MODULE_HEADER_TAGS_ARTICLE_META_STATUS')) {
            $this->sort_order = MODULE_HEADER_TAGS_ARTICLE_META_SORT_ORDER;
            $this->enabled    = (MODULE_HEADER_TAGS_ARTICLE_META_STATUS == 'True');
        }
    }

    function execute()
    {
        global $PHP_SELF, $oscTemplate, $_GET, $languages_id, $article_check;
        $meta_show = '';
        if ((basename($PHP_SELF) == FILENAME_ARTICLE_INFO) || (basename($PHP_SELF)
            == FILENAME_ARTICLE_BLOG)) {
            if (isset($_GET['articles_id'])) {
                if ($article_check['total'] > 0) {
                    $meta_info_query = tep_db_query("select ad.articles_head_desc_tag from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_DESCRIPTION." ad where  a.articles_id = '".(int) $_GET['articles_id']."' and ad.articles_id = a.articles_id and ad.language_id = '".(int) $languages_id."'");
                    $meta_info       = tep_db_fetch_array($meta_info_query);

                    if (tep_not_null($meta_info['articles_head_desc_tag'])) {
                        $oscTemplate->addBlock('<meta name="description" content="'.tep_output_string(strip_tags($meta_info['articles_head_desc_tag'])).'" />',
                            $this->group);
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
        return defined('MODULE_HEADER_TAGS_ARTICLE_META_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Articles Meta Module', 'MODULE_HEADER_TAGS_ARTICLE_META_STATUS', 'True', 'Do you want to allow article meta tags to be added to the page header?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_HEADER_TAGS_ARTICLE_META_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_HEADER_TAGS_ARTICLE_META_STATUS', 'MODULE_HEADER_TAGS_ARTICLE_META_KEYWORDS_STATUS',
            'MODULE_HEADER_TAGS_ARTICLE_META_SORT_ORDER');
    }
}

?>

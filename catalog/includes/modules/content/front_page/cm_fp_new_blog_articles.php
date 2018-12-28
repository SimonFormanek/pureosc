<?php
/*
  cm_fp_new_blog_articles.php
  Released under the GNU General Public License v2.0 or later
 */

class cm_fp_new_blog_articles
{
    public $version = '1.0';
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    function __construct()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       = MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_TITLE;
        $this->description = MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_DESCRIPTION;
        $this->description .= '<div class="secWarning">'.MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION.'</div>';

        if (defined('MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS')) {
            $this->sort_order = MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS
                == 'True');
        }
    }

    public function execute()
    {
        global $oscTemplate, $PHP_SELF, $languages_id;
        $articles_all_array     = array();
        $articles_all_query_raw = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_id, au.authors_name, td.topics_id, td.topics_name from ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id left join ".TABLE_TOPICS_DESCRIPTION." td on a2t.topics_id = td.topics_id left join ".TABLE_AUTHORS." au on a.authors_id = au.authors_id left join ".TABLE_ARTICLES_DESCRIPTION." ad on a.articles_id = ad.articles_id  
     where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now()))  and a.articles_status = '1' and a.articles_is_blog = 1 and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' order by a.articles_date_added desc, ad.articles_name";
        $listing_sql            = $articles_all_query_raw;
        $listing_split          = new splitPageResults($listing_sql,
            MAX_ARTICLES_PER_PAGE);
        if ($listing_split->number_of_rows > 0) {
            ob_start();
            define('MAIN_PAGE_BLOG', 'true');
            echo '<div class="col-sm-'.(int) MODULE_CONTENT_FRONT_PAGE_MESSAGE_CONTENT_WIDTH.'">
        	<div class="contentText">';

            echo '<h2 class="mainpage-blog">'.MAIN_PAGE_BLOG_ARTICLES.'</h2>';
            include(DIR_WS_MODULES.FILENAME_ARTICLE_LISTING);
            echo '<div align="right"><a class="btn btn-default" href="'.tep_href_link(FILENAME_ARTICLES,
                'showblogarticles=true').'"><span class="glyphicon glyphicon-chevron-right"></span> '.TEXT_DISPLAY_ALL_BLOG_ARTICLES.'</a><br />&nbsp;</div>';
            echo '</div></div>';
            $template = ob_get_clean();
            $oscTemplate->addContent($template, $this->group);
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return defined('MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS');
    }

    public function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_VERSION', '".$this->version."', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable New Blog Articles Module', 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS', 'True', 'Should the new blog articles block be shown on the front page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_SORT_ORDER', '90', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '3', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Max Products', 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_MAX_DISPLAY_NEW_ARTICLES', '3', 'Maximum number of new blog articles to show on the front page.', '6', '2', now())");
    }

    public function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    public function keys()
    {
        $keys   = array();
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_VERSION';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_STATUS';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_SORT_ORDER';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_CONTENT_WIDTH';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_BLOG_ARTICLES_MAX_DISPLAY_NEW_ARTICLES';
        return $keys;
    }
}

// End class
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//  This is the end of the module class.                                  //
//  Everything past this point is an independent function, not a method.  //
//                                                                        //
////////////////////////////////////////////////////////////////////////////
////
// Function to show a disabled entry (Value is shown but cannot be changed)
if (!function_exists('tep_cfg_disabled')) {

    function tep_cfg_disabled($value)
    {
        return tep_draw_input_field('configuration_value', $value, ' disabled');
    }
}

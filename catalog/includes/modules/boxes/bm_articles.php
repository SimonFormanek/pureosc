<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

class bm_articles
{
    var $code    = 'bm_articles';
    var $group   = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function bm_articles()
    {
        $this->title       =  _('Articles'); 
        $this->description = _('Show Article Manager Articles InfoBox'); 

        if (defined('MODULE_BOXES_ARTICLES_STATUS')) {
            $this->sort_order = MODULE_BOXES_ARTICLES_SORT_ORDER;
            $this->enabled    = (MODULE_BOXES_ARTICLES_STATUS == 'True');

            $this->group = ((MODULE_BOXES_ARTICLES_CONTENT_PLACEMENT == 'Left Column')
                    ? 'boxes_column_left' : 'boxes_column_right');
        }
    }

    function execute()
    {
        global $oscTemplate, $languages_id;

        $topicCtr      = 0;
        $topics_string = '';

        $articlesArray = array();
        $tree          = array();

        function GetBoldTags($page, $id = 0)
        {
            $boldTags = array();
            if (basename($_SERVER['PHP_SELF']) === $page) {
                if ($id == 0) {
                    $boldTags['start'] = '<b>';
                    $boldTags['stop']  = '</b>';
                } else if ((int) $_GET['articles_id'] == $id) {
                    $boldTags['start'] = '<b>';
                    $boldTags['stop']  = '</b>';
                }
            } else {
                $boldTags['start'] = '';     //fill these in to prevent STRICT errors
                $boldTags['stop']  = '';
            }
            return $boldTags;
        }

        function SortBySetting($a, $b)
        {
            return strnatcasecmp($a["sort_order"], $b["sort_order"]);
        }

        function tep_show_topic($counter, $tree, &$topics_string)
        {
            global $tPath_array, $topicCtr;

            for ($i = 0; $i < $tree[$counter]['level']; $i++) {
                $topics_string .= "&nbsp;&nbsp;";
            }

            $topics_string .= '<span class="articleLinkMarker">&nbsp;&nbsp;<a href="';

            if ($tree[$counter]['parent'] == 0) {
                $tPath_new = 'tPath='.$counter;
            } else {
                $tPath_new = 'tPath='.$tree[$counter]['path'];
            }

            $topics_string .= tep_href_link(FILENAME_ARTICLES, $tPath_new).'">';

            if (isset($tPath_array) && in_array($counter, $tPath_array)) {
                $topics_string .= '<b>';
            }

            // display topic name
            $topics_string .= $tree[$counter]['name'];

            if (isset($tPath_array) && in_array($counter, $tPath_array)) {
                $topics_string .= '</b>';
            }

            if (tep_has_topic_subtopics($counter)) {
                $topics_string .= ' -&gt;';
            }

            $topics_string .= '</a>';

            if (SHOW_ARTICLE_COUNTS == 'true') {
                $articles_in_topic = tep_count_articles_in_topic($counter);
                if ($articles_in_topic > 0) {
                    $topics_string .= '&nbsp;('.$articles_in_topic.')';
                }
            }

            $topics_string .= '</span><br />';

            if (tep_not_null(ARTICLE_BOX_DISPLAY_TOPICS_LINKS_LIMIT) && $topicCtr
                >= ARTICLE_BOX_DISPLAY_TOPICS_LINKS_LIMIT) {
                $topics_string .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLE_TOPICS,
                        '', 'NONSSL').'">'.$boldTags['start'].'<div style="float:right; color:red;">...more</div>'.$boldTags['stop'].'</a></span><br />';
                return;
            }
            $topicCtr++;

            if ($tree[$counter]['next_id'] != false) {
                tep_show_topic($tree[$counter]['next_id'], $tree, $topics_string);
            }
        }
        /** <!-- topics //--> * */
        if (ARTICLE_BOX_DISPLAY_TOPICS_SECTION == 'true') {
            $tree = array();

            $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.parent_id = '0' and t.topics_id = td.topics_id and td.language_id = '".(int) $languages_id."' order by sort_order, td.topics_name");
            while ($topics       = tep_db_fetch_array($topics_query)) {
                $tree[$topics['topics_id']] = array('name' => $topics['topics_name'],
                    'parent' => $topics['parent_id'],
                    'level' => 0,
                    'path' => $topics['topics_id'],
                    'next_id' => false);

                if (isset($parent_id)) {
                    $tree[$parent_id]['next_id'] = $topics['topics_id'];
                }

                $parent_id = $topics['topics_id'];

                if (!isset($first_topic_element)) {
                    $first_topic_element = $topics['topics_id'];
                }
            }

            //------------------------
            if (tep_not_null($tPath)) {
                $new_path = '';
                reset($tPath_array);

                while (list($key, $value) = each($tPath_array)) {
                    unset($parent_id);
                    unset($first_id);
                    $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.parent_id = '".(int) $value."' and t.topics_id = td.topics_id and td.language_id = '".(int) $languages_id."' order by sort_order, td.topics_name");

                    if (tep_db_num_rows($topics_query)) {
                        $new_path .= $value;
                        while ($row      = tep_db_fetch_array($topics_query)) {
                            $tree[$row['topics_id']] = array('name' => $row['topics_name'],
                                'parent' => $row['parent_id'],
                                'level' => $key + 1,
                                'path' => $new_path.'_'.$row['topics_id'],
                                'next_id' => false);

                            if (isset($parent_id)) {
                                $tree[$parent_id]['next_id'] = $row['topics_id'];
                            }

                            $parent_id = $row['topics_id'];

                            if (!isset($first_id)) {
                                $first_id = $row['topics_id'];
                            }

                            $last_id = $row['topics_id'];
                        }
                        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
                        $tree[$value]['next_id']   = $first_id;
                        $new_path                  .= '_';
                    } else {
                        break;
                    }
                }
            }
            $topicCtr = 1;
            tep_show_topic($first_topic_element, $tree, $topics_string);
        }


        /*         * ******************* BUILD ALL ARTICLES ******************* */
        if (ARTICLE_BOX_DISPLAY_ALL_ARTICLES_SECTION == 'true') {
            $articles_all_count = '';
            if (SHOW_ARTICLE_COUNTS == 'true') {
                $articles_new_query = tep_db_query("SELECT a.articles_id from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_TO_TOPICS." a2t, ".TABLE_TOPICS_DESCRIPTION." td, ".TABLE_AUTHORS." au, ".TABLE_ARTICLES_DESCRIPTION." ad where a.authors_id = au.authors_id and a2t.topics_id = td.topics_id and (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_is_blog = 0 and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."'");
                $articles_all_count = (tep_db_num_rows($articles_new_query) ? tep_db_num_rows($articles_new_query)
                        : '');
            }

            $articlesArray['all_articles']['sort_order'] = ARTICLE_BOX_DISPLAY_ALL_ARTICLES_SECTION_SORT_ORDER;
            $boldTags                                    = array();
            $boldTags                                    = GetBoldTags(FILENAME_ARTICLES);

            $articlesArray['all_articles']['string'] = '<span class="articleLinkHdr">';
            $articlesArray['all_articles']['string'] .= '<a href="'.tep_href_link(FILENAME_ARTICLES,
                    '', 'NONSSL').'">'.$boldTags['start'].BOX_ALL_ARTICLES.$boldTags['stop'].'</a>';
            $articlesArray['all_articles']['string'] .= '&nbsp;'.$articles_all_count.'</span><br />';

            if (ARTICLE_BOX_DISPLAY_All_ARTICLES_LINKS == 'true') {
                $allArticles = tep_get_all_articles_array();
                $ctr         = 0;
                foreach ($allArticles as $all) {
                    if (!tep_not_null(ARTICLE_BOX_DISPLAY_ALL_ARTICLES_LINKS_LIMIT)
                        || (tep_not_null(ARTICLE_BOX_DISPLAY_ALL_ARTICLES_LINKS_LIMIT)
                        && $ctr < ARTICLE_BOX_DISPLAY_ALL_ARTICLES_LINKS_LIMIT)) {
                        $boldTags                                = GetBoldTags(FILENAME_ARTICLE_INFO,
                            $all['id']);
                        $articlesArray['all_articles']['string'] .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                                'articles_id='.$all['id'], 'NONSSL').'">'.$boldTags['start'].$all['text'].$boldTags['stop'].'</a></span>'.(SEPARATE_ARTICLES
                            == 'true' ? '<hr class="separatorArticle">' : '<br />');
                    } else {
                        $articlesArray['all_articles']['string'] .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                                '', 'NONSSL').'">'.$boldTags['start'].'<div style="float:right; color:red;">...more</div>'.$boldTags['stop'].'</a></span><br />';
                        break;
                    }
                    $ctr++;
                }
            }
        }

        /*         * ******************* BUILD NEW ARTICLES ******************* */
        if (ARTICLE_BOX_DISPLAY_NEW_ARTICLES_SECTION == 'true') {
            $articles_new_count = '';
            if (SHOW_ARTICLE_COUNTS == 'true') {
                $articles_new_query = tep_db_query("SELECT a.articles_id from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_TO_TOPICS." a2t, ".TABLE_TOPICS_DESCRIPTION." td, ".TABLE_AUTHORS." au, ".TABLE_ARTICLES_DESCRIPTION." ad where a.authors_id = au.authors_id and a2t.topics_id = td.topics_id and (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_is_blog = 0 and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' and a.articles_date_added > SUBDATE(now( ), INTERVAL '".NEW_ARTICLES_DAYS_DISPLAY."' DAY)");
                $articles_new_count = (tep_db_num_rows($articles_new_query) ? tep_db_num_rows($articles_new_query)
                        : '');
            }

            if ($articles_new_count) {
                $articlesArray['new_articles']['sort_order'] = ARTICLE_BOX_DISPLAY_NEW_ARTICLES_SECTION_SORT_ORDER;
                $boldTags                                    = GetBoldTags(FILENAME_ARTICLES_NEW);
                $articlesArray['new_articles']['string']     = '<span class="articleLinkHdr">';
                $articlesArray['new_articles']['string']     .= '<a href="'.tep_href_link(FILENAME_ARTICLES_NEW,
                        '', 'NONSSL').'">'.$boldTags['start'].BOX_NEW_ARTICLES.$boldTags['stop'].'</a>';
                $articlesArray['new_articles']['string']     .= '&nbsp;'.$articles_new_count.'</span><br />';

                if (ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS == 'true') {
                    $newArticles = tep_get_new_articles_array();
                    $ctr         = 0;
                    foreach ($newArticles as $new) {
                        if (!tep_not_null(ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS_LIMIT)
                            || (tep_not_null(ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS_LIMIT)
                            && $ctr < ARTICLE_BOX_DISPLAY_NEW_ARTICLES_LINKS_LIMIT)) {
                            $boldTags                                = GetBoldTags(FILENAME_ARTICLE_INFO,
                                $new['id']);
                            $articlesArray['new_articles']['string'] .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                                    'articles_id='.$new['id'], 'NONSSL').'">'.$boldTags['start'].$new['text'].$boldTags['stop'].'</a></span>'.(SEPARATE_NEW_ARTICLES
                                == 'true' ? '<hr class="separatorArticle">' : '<br />');
                        } else {
                            $articlesArray['new_articles']['string'] .= '<span class="articleLinkHdr">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES_NEW,
                                    '', 'NONSSL').'">'.$boldTags['start'].'<div style="float:right; color:red;">...more</div>'.$boldTags['stop'].'</a></span><br />';
                            break;
                        }
                        $ctr++;
                    }
                }
            }
        }

        /*         * ******************* BUILD TOPICS ******************* */
        if (ARTICLE_BOX_DISPLAY_TOPICS_SECTION == 'true') {
            $articlesArray['all_topics']['sort_order'] = ARTICLE_BOX_DISPLAY_TOPICS_SECTION_SORT_ORDER;
            $boldTags                                  = GetBoldTags(FILENAME_ARTICLE_TOPICS);
            $articlesArray['all_topics']['string']     = '<span class="articleLinkHdr"><a href="'.tep_href_link(FILENAME_ARTICLE_TOPICS,
                    '', 'NONSSL').'">'.$boldTags['start'].BOX_ARTICLE_TOPICS.$boldTags['stop'].'</a></span><br />';
            if (ARTICLE_BOX_DISPLAY_TOPICS_LINKS == 'true') {
                $articlesArray['all_topics']['string'] .= preg_replace('/(<br \/>)+$/',
                    '', $topics_string);
            }
            $articlesArray['all_topics']['string'] .= (SEPARATE_TOPICS == 'true'
                    ? '<hr class="separatorArticle">' : '<br />');
        }


        /*         * ******************* BUILD RSS LINK ******************* */
        if (ARTICLE_BOX_DISPLAY_RSS_FEED_SECTION == 'true') {
            $articlesArray['rss_feed']['sort_order'] = ARTICLE_BOX_DISPLAY_RSS_FEED_SECTION_SORT_ORDER;
            $articlesArray['rss_feed']['string']     = '<span class="articleLinkHdr"><a href="'.tep_href_link(FILENAME_ARTICLES_RSS,
                    '', 'NONSSL').'" target="_blank">'.BOX_RSS_ARTICLES.'</a></span><br />';
        }


        /*         * ******************* BUILD SUBMIT LINK ******************* */
        if (ARTICLE_BOX_DISPLAY_SUBMIT_ARTICLE_SECTION == 'true') {
            $articlesArray['submit_article']['sort_order'] = ARTICLE_BOX_DISPLAY_SUBMIT_ARTICLE_SECTION_SORT_ORDER;
            $boldTags                                      = GetBoldTags(FILENAME_ARTICLE_SUBMIT);
            $articlesArray['submit_article']['string']     = '<span class="articleLinkHdr"><a href="'.tep_href_link(FILENAME_ARTICLE_SUBMIT,
                    '', 'NONSSL').'">'.$boldTags['start'].BOX_ARTICLE_SUBMIT.$boldTags['stop'].'</a></span><br />';
        }


        /*         * ******************* BUILD UPCOMING ARTICLES LINK ******************* */
        if (ARTICLE_BOX_DISPLAY_UPCOMING_SECTION == 'true') {
            $upcoming_query = tep_db_query("select a.articles_date_added, a.articles_date_available as date_expected, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_id, td.topics_name from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_TO_TOPICS." a2t, ".TABLE_TOPICS_DESCRIPTION." td, ".TABLE_AUTHORS." au, ".TABLE_ARTICLES_DESCRIPTION." ad where to_days(a.articles_date_available) > to_days(now()) and a.articles_id = a2t.articles_id and a2t.topics_id = td.topics_id and a.authors_id = au.authors_id and a.articles_status = '1' and a.articles_is_blog = 0 and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' order by date_expected limit ".MAX_DISPLAY_UPCOMING_ARTICLES);
            if (tep_db_num_rows($upcoming_query) > 0) {
                $articlesArray['upcoming']['sort_order'] = ARTICLE_BOX_DISPLAY_UPCOMING_SECTION_SORT_ORDER;
                $articlesArray['upcoming']['string']     = BOX_UPCOMING_ARTICLES.'<br />';
                while ($upcoming                                = tep_db_fetch_array($upcoming_query)) {
                    $dateParts                           = explode(" ",
                        $upcoming['date_expected']);
                    $articlesArray['upcoming']['string'] .= '&nbsp;'.$upcoming['articles_name'].'<br />&nbsp;&nbsp; '.$dateParts['0'].'<br />';
                }
                $articlesArray['upcoming']['string'] = substr($articlesArray['upcoming']['string'],
                        0, -4).'<br />';
            }
        }


        /*         * ******************* ADD A SEARCH FUNCTION ******************* */
        if (ARTICLE_BOX_DISPLAY_SEARCH_ARTICLES_SECTION == 'true') {
            $articlesArray['search']['sort_order'] = ARTICLE_BOX_DISPLAY_SEARCH_ARTICLES_SECTION_SORT_ORDER;
            $articlesArray['search']['string']     = '<div class="articleSearch">' /* . TEXT_ARTICLE_SEARCH */.
                tep_draw_form('article_search',
                    tep_href_link('article_manager_search_result.php', '',
                        'NONSSL', false), 'get').
                '<input class="form-control" type="text" name="article_keywords" value="'.TEXT_ARTICLE_SEARCH_STRING.'" onFocus="form.article_keywords.value=\'\';" style="width: 99%" maxlength="35" >'.
                tep_hide_session_id()./* tep_draw_button(IMAGE_BUTTON_SEARCH, 'fa fa-search', null, 'primary', null, 'btn-success') */
                '</form></div>'; //pure:bugfix:articles tep_draw_button (line above)
        }

        /*         * ******************* ADD BLOG TOPICS ******************* */
        if (ARTICLE_BOX_DISPLAY_ALL_BLOG_SECTION == 'true') {
            $articles_all_count = '';
            if (SHOW_ARTICLE_COUNTS == 'true') {
                $articles_new_query = tep_db_query("SELECT a.articles_id from ".TABLE_ARTICLES." a, ".TABLE_ARTICLES_TO_TOPICS." a2t, ".TABLE_TOPICS_DESCRIPTION." td, ".TABLE_AUTHORS." au, ".TABLE_ARTICLES_DESCRIPTION." ad where a.authors_id = au.authors_id and a2t.topics_id = td.topics_id and (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_is_blog = 1 and a.articles_id = ad.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."'");
                $articles_all_count = (tep_db_num_rows($articles_new_query) ? tep_db_num_rows($articles_new_query)
                        : '');
            }

            $articlesArray['blog']['sort_order'] = ARTICLE_BOX_DISPLAY_ALL_BLOG_SECTION_SORT_ORDER;
            $boldTags                            = array();
            $boldTags                            = GetBoldTags(FILENAME_ARTICLE_BLOG);

            $articlesArray['blog']['string'] = '<span class="articleLinkHdr">';
            $articlesArray['blog']['string'] .= '<a href="'.tep_href_link(FILENAME_ARTICLES,
                    'showblogarticles=true', 'NONSSL').'">'.$boldTags['start'].BOX_ALL_BLOG_ARTICLES.$boldTags['stop'].'</a>';
            $articlesArray['blog']['string'] .= '&nbsp;'.$articles_all_count.'</span><br />';

            if (ARTICLE_BOX_DISPLAY_All_BLOG_LINKS == 'true') {
                $allArticles = tep_get_all_blog_articles_array();
                $ctr         = 0;
                foreach ($allArticles as $all) {
                    if (!tep_not_null(ARTICLE_BOX_DISPLAY_ALL_BLOG_LINKS_LIMIT) || (tep_not_null(ARTICLE_BOX_DISPLAY_ALL_BLOG_LINKS_LIMIT)
                        && $ctr < ARTICLE_BOX_DISPLAY_ALL_BLOG_LINKS_LIMIT)) {
                        $boldTags                        = GetBoldTags(FILENAME_ARTICLE_BLOG,
                            $all['id']);
                        $articlesArray['blog']['string'] .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLE_BLOG,
                                'articles_id='.$all['id'], 'NONSSL').'">'.$boldTags['start'].$all['text'].$boldTags['stop'].'</a></span>'.(SEPARATE_BLOG_ARTICLES
                            == 'true' ? '<hr class="separatorBlogArticle">' : '<br />');
                    } else {
                        $articlesArray['blog']['string'] .= '<span class="articleLinkMarker">-&nbsp;<a href="'.tep_href_link(FILENAME_ARTICLES,
                                '', 'NONSSL').'">'.$boldTags['start'].'<div style="float:right; color:red;">...more</div>'.$boldTags['stop'].'</a></span><br />';
                        break;
                    }
                    $ctr++;
                }
            }
        }


        /*         * ******************* SORT THE DISPLAY  ******************* */
        usort($articlesArray, "SortBySetting");

        $content = '';
        foreach ($articlesArray as $line) {
            $content .= $line['string'];
        }
        /*         * ******************* DISPLAY IT ALL ******************* */


        $data = '<div class="panel panel-default">'.
            '  <div class="panel-heading">'.MODULE_BOXES_ARTICLES_BOX_TITLE.'</div>'.
            '  <div class="panel-body">'.$content.'</div>'.
            '</div>';

        $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_BOXES_ARTICLES_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Article Manager Authors Infobox', 'MODULE_BOXES_ARTICLES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_ARTICLES_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_ARTICLES_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_BOXES_ARTICLES_STATUS', 'MODULE_BOXES_ARTICLES_CONTENT_PLACEMENT',
            'MODULE_BOXES_ARTICLES_SORT_ORDER');
    }
}

?>

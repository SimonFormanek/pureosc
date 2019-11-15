<?php
/*
  $Id: articles-topics.php, v1.5.1 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');



require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLE_TOPICS);
$breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLE_TOPICS));
require(DIR_WS_INCLUDES.'template_top.php');
?>


<h1><?php echo HEADING_ARTICLE_TOPICS; ?></h1>


<div class="contentContainer">
    <div class="contentPadd txtPage">
        <?php
        $topics_array = array();
        $topics_array = tep_get_topics($topics_array);
        $totalTopics  = count($topics_array);

        if ($totalTopics == 0) {
            ?>
            <tr>
                <td class="main" ><?php echo TEXT_ARTICLE_TOPICS_NOT_FOUND; ?></td>
            </tr>
            <?php
        } else {
            for ($i = 0; $i < $totalTopics; ++$i) {
                $articles_query = tep_db_query("select a.articles_id, ad.articles_name, ad.articles_description  from   ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_DESCRIPTION." ad on a.articles_id = ad.articles_id left join ".TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1'  and a2t.topics_id = ".$topics_array[$i]['id']." and ad.language_id = '".(int) $languages_id."' order by ad.articles_name");

                if ($topics_array[$i]['parent'] == 0)
                        echo '<div><hr style="border solid 2px;"></div>';

                echo '<div class="main"><a href="'.tep_href_link(FILENAME_ARTICLES,
                    'tPath='.$topics_array[$i]['id']).'"><b>'.$topics_array[$i]['text'].'</b></a> ( '.tep_count_articles_in_topic($topics_array[$i]['id']).' ) </div>';
                echo '<div>';

                while ($articles = tep_db_fetch_array($articles_query)) {
                    $shortDescr = substr($articles['articles_description'], 0,
                        40);
                    echo '<div style="width:100%">';
                    echo '<div class="smallText" style="display:inline-block; padding-left:6px"><a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                        'articles_id='.$articles['articles_id']).'">'.strip_tags($articles['articles_name']).'</a> - '.strip_tags($shortDescr).'<span style="color:#ff0000;">...more</span></div>';
                    echo '</div>';
                }
                echo '</div>';
            }
        } // end of else
        ?> 

        <!--- BEGIN Header Tags SEO Social Bookmarks -->
        <?php
        if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS == 'true') {
            include(DIR_WS_MODULES.'header_tags_social_bookmarks.php');
        }
        ?>
        <!--- END Header Tags SEO Social Bookmarks --> 

    </div>
</div>
<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
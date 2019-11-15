<?php
/*
  $Id: articles.php, v1.5.1 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');

$authors_description = '';
$authors_url         = '';

// the following tPath references come from application_top.php
$topic_depth = 'top';

if (isset($tPath) && tep_not_null($tPath)) {
    $topics_articles_query = tep_db_query("SELECT COUNT(*) as total from ".TABLE_ARTICLES_TO_TOPICS." where topics_id = '".(int) $current_topic_id."'");
    $topics_articles       = tep_db_fetch_array($topics_articles_query);
    if ($topics_articles['total'] > 0) {
        $topic_depth = 'articles'; // display articles
    } else {
        $topic_parent_query = tep_db_query("SELECT COUNT(*) as total from ".TABLE_TOPICS." where parent_id = '".(int) $current_topic_id."'");
        $topic_parent       = tep_db_fetch_array($topic_parent_query);
        if ($topic_parent['total'] > 0) {
            $topic_depth = 'nested'; // navigate through the topics
        } else {
            $topic_depth = 'articles'; // topic has no articles, but display the 'no articles' message
        }
    }
}

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLES);

if ($topic_depth == 'top' && !isset($_GET['authors_id'])) {
    $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLES));
}

require(DIR_WS_INCLUDES.'template_top.php');
?>

<?php
if ($topic_depth == 'nested') {
    $topic_query = tep_db_query("select td.topics_name, td.topics_heading_title, td.topics_description from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.topics_id = '".(int) $current_topic_id."' and td.topics_id = '".(int) $current_topic_id."' and td.language_id = '".(int) $languages_id."'");
    $topic       = tep_db_fetch_array($topic_query);
    $heading     = (tep_not_null($topic['topics_heading_title']) ? $topic['topics_heading_title']
            : HEADING_TITLE);
} elseif ($topic_depth == 'articles' || isset($_GET['authors_id'])) {
    $topic_query = tep_db_query("select td.topics_name, td.topics_heading_title, td.topics_description from ".TABLE_TOPICS." t, ".TABLE_TOPICS_DESCRIPTION." td where t.topics_id = '".(int) $current_topic_id."' and td.topics_id = '".(int) $current_topic_id."' and td.language_id = '".(int) $languages_id."'");
    $topic       = tep_db_fetch_array($topic_query);
    $heading     = ( tep_not_null($topic['topics_heading_title']) ? $topic['topics_heading_title']
            : HEADING_TITLE);
} else {
    $showBlogArticles = ((isset($_GET['showblogarticles']) && $_GET['showblogarticles']
        == 'true') ? ' and a.articles_is_blog = 1 ' : '');
    $heading          = (($showBlogArticles === false) ? HEADING_TITLE : HEADING_TITLE_BLOG);
}
?>

<div class="page-header">
    <h1><?php echo $heading ?></h1>
</div>

<div class="contentContainer">
    <div class="contentText">
        <?php
        if ($topic_depth == 'nested') {
            if (tep_not_null($topic['topics_description'])) {
                ?>
                <div><h2><?php echo $topic['topics_description']; ?></h1></div>

                <?php
                if (isset($tPath) && strpos('_', $tPath)) {
                    // check to see if there are deeper topics within the current topic
                    $topic_links = array_reverse($tPath_array);
                    for ($i = 0, $n = sizeof($topic_links); $i < $n; $i++) {
                        $topics_query = tep_db_query("SELECT COUNT(*) as total from ".TABLE_TOPICS." t left join ".TABLE_TOPICS_DESCRIPTION." td on t.topics_id = td.topics_id where t.parent_id = '".(int) $topic_links[$i]."' and td.language_id = '".(int) $languages_id."'");
                        $topics       = tep_db_fetch_array($topics_query);
                        if ($topics['total'] > 0) {
                            $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from ".TABLE_TOPICS." t left join ".TABLE_TOPICS_DESCRIPTION." td on t.topics_id = td.topics_id where t.parent_id = '".(int) $topic_links[$i]."' and td.language_id = '".(int) $languages_id."' order by sort_order, td.topics_name");
                            break; // we've found the deepest topic the customer is in
                        }
                    }
                } else {
                    $topics_query = tep_db_query("select t.topics_id, td.topics_name, t.parent_id from ".TABLE_TOPICS." t left join ".TABLE_TOPICS_DESCRIPTION." td on t.topics_id = td.topics_id where t.parent_id = '".(int) $current_topic_id."' and td.language_id = '".(int) $languages_id."' order by sort_order, td.topics_name");
                }

                if (tep_db_num_rows($topics_query) > 0) {
                    while ($topics = tep_db_fetch_array($topics_query)) {
                        $articles_query = tep_db_query("select count(*) as ttl from ".TABLE_ARTICLES_TO_TOPICS." where topics_id = '".(int) $topics['topics_id']."'");
                        $articles       = tep_db_fetch_array($articles_query);
                        echo '<div class="main"><a href="'.tep_href_link(FILENAME_ARTICLES,
                            'tPath='.$topics['topics_id']).'"><b>'.$topics['topics_name'].'</b></a> ( '.$articles['ttl'].' )</div>';
                        echo '<div class="smallText">'.$topics['topics_description'].'<div>';
                    } //end of while
                }
            }
            // needed for the new articles module shown below
            $new_articles_topic_id = $current_topic_id;
            ?>
            <?php
        } elseif ($topic_depth == 'articles' || isset($_GET['authors_id'])) {

            if (isset($_GET['authors_id'])) { // We are asked to show only a specific topic
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
                    $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t left join ".TABLE_TOPICS_DESCRIPTION." td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and au.authors_id = '".(int) $_GET['authors_id']."' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' and a2t.topics_id = '".(int) $_GET['filter_id']."' order by a.articles_date_added desc, ad.articles_name";
                } else { // We show them all
                    $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t left join ".TABLE_TOPICS_DESCRIPTION." td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and au.authors_id = '".(int) $_GET['authors_id']."' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' order by a.articles_date_added desc, ad.articles_name";
                }
            } else { // show the articles in a given category
                if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) { // We are asked to show only specific catgeory
                    $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t left join ".TABLE_TOPICS_DESCRIPTION." td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' and a2t.topics_id = '".(int) $current_topic_id."' and au.authors_id = '".(int) $_GET['filter_id']."' order by a.articles_date_added desc, ad.articles_name";
                } else { // We show them all
                    $listing_sql = "select a.articles_id, a.authors_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_name, td.topics_name, a2t.topics_id from ".TABLE_ARTICLES." a left join ".TABLE_AUTHORS." au using(authors_id), ".TABLE_ARTICLES_DESCRIPTION." ad, ".TABLE_ARTICLES_TO_TOPICS." a2t left join ".TABLE_TOPICS_DESCRIPTION." td using(topics_id) where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_id = a2t.articles_id and ad.articles_id = a2t.articles_id and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' and a2t.topics_id = '".(int) $current_topic_id."' order by a.articles_date_added desc, ad.articles_name";
                }
            }

            if (isset($_GET['authors_id'])) {
                $author_query        = tep_db_query("select au.authors_name, aui.authors_description, au.authors_image, aui.authors_url from ".TABLE_AUTHORS." au left join ".TABLE_AUTHORS_INFO." aui on au.authors_id = aui.authors_id where au.authors_id = '".(int) $_GET['authors_id']."' and aui.languages_id = '".(int) $languages_id."'");
                $authors             = tep_db_fetch_array($author_query);
                $author_name         = $authors['authors_name'];
                $authors_description = $authors['authors_description'];
                $authors_url         = $authors['authors_url'];

                echo '<div>'.TEXT_ARTICLES_BY.$author_name.'</div>';
            }

            $authorsImage = DIR_WS_IMAGES.'article_manager_uploads/'.$authors['authors_image'];
            if (file_exists($authorsImage) && is_file($authorsImage)) {
                ?>
                <div align="right"><h1><?php
                        echo tep_image($authorsImage, HEADING_TITLE,
                            HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
                        ?></h1></div>
            <?php } ?>
            <?php
            // optional Article List Filter
            if (ARTICLE_LIST_FILTER) {
                if (isset($_GET['authors_id'])) {
                    $filterlist_sql = "select distinct t.topics_id as id, td.topics_name as name from ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id left join ".TABLE_TOPICS." t on a2t.topics_id = t.topics_id left join ".TABLE_TOPICS_DESCRIPTION." td on a2t.topics_id = td.topics_id where a.articles_status = '1' and td.language_id = '".(int) $languages_id."' and a.authors_id = '".(int) $_GET['authors_id']."' order by td.topics_name";
                } else {
                    $filterlist_sql = "select distinct au.authors_id as id, au.authors_name as name from ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id left join ".TABLE_AUTHORS." au on a.authors_id = au.authors_id where a.articles_status = '1' and a2t.topics_id = '".(int) $current_topic_id."' order by au.authors_name";
                }
                $filterlist_query = tep_db_query($filterlist_sql);
                if (tep_db_num_rows($filterlist_query) > 1) {
                    echo '<div align="right" class="main">'.tep_draw_form('filter',
                        FILENAME_ARTICLES, 'get').TEXT_SHOW.'&nbsp;';
                    if (isset($_GET['authors_id'])) {
                        echo tep_draw_hidden_field('authors_id',
                            $_GET['authors_id']);
                        $options = array(array('id' => '', 'text' => TEXT_ALL_TOPICS));
                    } else {
                        echo tep_draw_hidden_field('tPath', $tPath);
                        $options = array(array('id' => '', 'text' => TEXT_ALL_AUTHORS));
                    }
                    echo tep_draw_hidden_field('sort', $_GET['sort']);
                    while ($filterlist = tep_db_fetch_array($filterlist_query)) {
                        $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
                    }
                    echo tep_draw_pull_down_menu('filter_id', $options,
                        (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''),
                        'onchange="this.form.submit()"');
                    echo '</form></div>';
                }
            }
            ?>
            <?php if (tep_not_null($topic['topics_description'])) { ?>
                <div align="left" colspan="2"><h2><?php echo $topic['topics_description']; ?></h2></div>
            <?php } ?>
            <?php if (tep_not_null($authors_description)) { ?>
                <div class="main" colspan="2" valign="top"><?php echo $authors_description; ?></div>
            <?php } ?>
                <?php if (tep_not_null($authors_url)) { ?>
                <div class="main" colspan="2" valign="top"><?php
                    echo sprintf(TEXT_MORE_INFORMATION, $authors_url);
                    ?></div>
    <?php } ?>

            <div><?php include(DIR_WS_MODULES.FILENAME_ARTICLE_LISTING); ?></div>

            <?php
        } else { // default page
            ?>
            <div class="main"><?php
                echo '<b>'.(($showBlogArticles == 'true') ? TEXT_CURRENT_ARTICLES
                        : TEXT_CURRENT_BLOG_ARTICLES).'</b>';
                ?></div>
            <?php
            $articles_all_array     = array();
            $articles_all_query_raw = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_id, au.authors_name, td.topics_id, td.topics_name from ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id left join ".TABLE_TOPICS_DESCRIPTION." td on a2t.topics_id = td.topics_id left join ".TABLE_AUTHORS." au on a.authors_id = au.authors_id left join ".TABLE_ARTICLES_DESCRIPTION." ad on a.articles_id = ad.articles_id  where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now()))  and a.articles_status = '1' ".$showBlogArticles." and ad.language_id = '".(int) $languages_id."' and td.language_id = '".(int) $languages_id."' order by a.articles_date_added desc, ad.articles_name";
            $listing_sql            = $articles_all_query_raw;
            ?>
            <div><?php include(DIR_WS_MODULES.FILENAME_ARTICLE_LISTING); ?></div>
            <?php
            if (($articles_all_split->number_of_rows > 0) && ((ARTICLE_PREV_NEXT_BAR_LOCATION
                == 'bottom') || (ARTICLE_PREV_NEXT_BAR_LOCATION == 'both'))) {
                ?> 
                <div class="row">
                    <div class="col-sm-6 pagenumber hidden-xs">
        <?php echo $articles_all_split->display_count(TEXT_DISPLAY_NUMBER_OF_ARTICLES); ?>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right pagenav"><ul class="pagination"><?php
                                echo $articles_all_split->display_links(MAX_DISPLAY_PAGE_LINKS,
                                    tep_get_all_get_params(array('page', 'info',
                                    'x', 'y')));
                                ?></ul></div>
                        <span class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></span>
                    </div>
                </div>            
                <?php
            }
            ?>
            <div><?php include(DIR_WS_MODULES.FILENAME_ARTICLES_UPCOMING); ?></div>
<?php }
?>
    </div>

    <div class="buttonSet">
        <div class="text-right"><?php
echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon glyphicon-chevron-right',
    tep_href_link(FILENAME_DEFAULT));
?></div>
    </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
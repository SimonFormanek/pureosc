<?php
/*
  $Id: article_manager_search_result.php, v1.5.1 2010/07/12 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 http://www.oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_ARTICLE_MANAGER_SEARCH_RESULT);
//TODO:all used languages
$searchFor = preg_replace($safe_search_whitelisted_chars, '', $_GET['article_keywords']);
//$searchFor = preg_replace('/[^A-Za-z0-9_ -]/', '', $_GET['article_keywords']);

$articles_query = tep_db_query("select * from ".TABLE_ARTICLES." a left join ".TABLE_ARTICLES_DESCRIPTION." ad on a.articles_id = ad.articles_id where a.articles_status = 1 and ( ad.articles_name LIKE '%".$searchFor."%' or ad.articles_description LIKE '%".$searchFor."%' ) and language_id = ".(int) $languages_id);

$breadcrumb->add(NAVBAR_TITLE,
    tep_href_link(FILENAME_ARTICLE_MANAGER_SEARCH_RESULT));

require(DIR_WS_INCLUDES.'template_top.php');
?>

<div class="page-header">
    <h1><?php echo HEADING_TITLE; ?></h1>
</div>

<div class="contentContainer">
    <div class="contentText">
        <?php echo TEXT_INFORMATION; ?>

        <?php
        if (tep_db_num_rows($articles_query)) {
            echo '<div width="100%">';
            while ($articles = tep_db_fetch_array($articles_query)) {
                $cleanedDescription = trim(strip_tags($articles['articles_description']));
                echo '<div class="articlePadding">';
                echo '<div class="smallText"><a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                    'articles_id='.$articles['articles_id']).'"><b>'.$articles['articles_name'].'</b></a></div>';
                echo '<div class="smallText">'.(strlen($cleanedDescription) > MAX_ARTICLE_ABSTRACT_LENGTH
                        ? substr($cleanedDescription, 0,
                        MAX_ARTICLE_ABSTRACT_LENGTH).'<a href="'.tep_href_link(FILENAME_ARTICLE_INFO,
                        'articles_id='.$articles['articles_id']).'">'.TEXT_SEARCH_SEE_MORE.'</a>'
                        : $cleanedDescription ).'</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<div class="main">'.TEXT_NO_ARTICLES_FOUND.'</div>';
        }
        ?>

    </div>

    <div class="buttonSet">
        <div class="text-right"><?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE,
                'glyphicon glyphicon-chevron-right',
                tep_href_link(FILENAME_DEFAULT));
            ?></div>
    </div>
</div>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
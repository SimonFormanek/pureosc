<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce
  Portions Copyright 2009 http://www.oscommerce-solution.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_INFO);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_INFO));
  $article_check_query = tep_db_query("SELECT COUNT(*) as total from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
  $article_check = tep_db_fetch_array($article_check_query);
  
  require(DIR_WS_INCLUDES . 'template_top.php');
?>


   <?php 
   if ($article_check['total'] < 1) { ?>
      <div class="page-header" ><?php echo HEADING_ARTICLE_NOT_FOUND; ?></div>
      <div class="main" ><?php echo TEXT_ARTICLE_NOT_FOUND; ?></div>
   <?php
   } else {
      $article_info_query = tep_db_query("select a.articles_id, a.articles_date_added, a.articles_date_available, a.authors_id, ad.articles_name, ad.articles_description, ad.articles_image, ad.articles_url, au.authors_name, au.authors_image from " . TABLE_ARTICLES . " a left join " . TABLE_AUTHORS . " au using(authors_id), " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_status = '1' and a.articles_id = '" . (int)$_GET['articles_id'] . "' and ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "'");
      $article_info = tep_db_fetch_array($article_info_query);
      tep_db_query("update " . TABLE_ARTICLES_DESCRIPTION . " set articles_viewed = articles_viewed+1 where articles_id = '" . (int)$_GET['articles_id'] . "' and language_id = '" . (int)$languages_id . "'");
      $articles_name = $article_info['articles_name'];
      $articles_author_id = $article_info['authors_id'];
      $articles_author = $article_info['authors_name'];
   ?> 
    <div class="page-header">
      <div style="float:left"><h1><?php echo $articles_name; ?></h1></div>
      <?php if (tep_not_null($article_info['articles_image']) && file_exists(DIR_WS_IMAGES . 'article_manager_uploads/'.$article_info['articles_image'])) { ?>
      <div style="float:right"><?php echo tep_image(DIR_WS_IMAGES . 'article_manager_uploads/'.$article_info['articles_image'], $article_info['articles_name'], ARTICLES_IMAGE_WIDTH, ARTICLES_IMAGE_HEIGHT); ?></div>
      <?php } ?>
    </div>
    <div class="smallText" style="clear:both; margin:5px 0">
   
         <?php
         if (tep_not_null($articles_author) && DISPLAY_AUTHOR_ARTICLE_LISTING == 'true') {
            $authorsImage = DIR_WS_IMAGES . 'article_manager_uploads/' . $article_info['authors_image'];
            if (file_exists($authorsImage) && is_file($authorsImage)) {
                echo '<div style="width:100px"><a href="' . tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $article_info['authors_id']) . '">' . tep_image($authorsImage, $article_info['authors_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></div>';
            } else {
                echo TEXT_BY . '<a href="' . tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $article_info['authors_id']) . '">' . $article_info['authors_name'] . '</a>';
            }
         }
         ?>   
    </div>
    
    <div class="contentContainer">
      <div class="contentText">
        <?php echo stripslashes($article_info['articles_description']); ?>
      </div>
      
    <?php 
    if (tep_not_null($article_info['articles_url'])) { ?>
      <div class="articlePadding"><?php echo sprintf(TEXT_MORE_INFORMATION, "http://" . urlencode($article_info['articles_url']) ); ?></div>
    <?php
    }
    if (DISPLAY_DATE_ADDED_ARTICLE_LISTING == 'true') {
        if ($article_info['articles_date_available'] > date('Y-m-d H:i:s')) { ?>
          <div class="articlePadding"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($article_info['articles_date_available'])); ?></div>
        <?php
        } else { ?>
          <div class="articlePadding"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($article_info['articles_date_added'])); ?></div>
    <?php
        }
    }
    ?>       

    <div class="articlePadding">
    <?php
    //added for cross-sell
       if ( (USE_CACHE == 'true') && !SID) {
         include(DIR_WS_MODULES . FILENAME_ARTICLES_XSELL);
       } else {
         include(DIR_WS_MODULES . FILENAME_ARTICLES_XSELL);
        }      
    ?>
    </div>
    
    <!--- BEGIN Header Tags SEO Social Bookmarks -->
    <div class="articlePadding" style="padding-bottom:40px;">
    <?php 
    if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS == 'true') {
       include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php'); 
    }
    ?>
    </div>
    <!--- END Header Tags SEO Social Bookmarks -->   
       
      <div class="buttonSet">
        <div class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon glyphicon-chevron-right', tep_href_link(FILENAME_DEFAULT)); ?></div>
      </div>
    </div>
<?php } ?>
<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

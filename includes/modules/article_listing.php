<?php
/*
  $Id: article_listing.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

$listing_split = new splitPageResults($listing_sql, MAX_ARTICLES_PER_PAGE);
  if ($listing_split->number_of_rows > 0) {
    $articles_listing_query = tep_db_query($listing_split->sql_query);
?>
        <div class="main"><?php echo TEXT_ARTICLES; ?></div>
<?php
    while ($articles_listing = tep_db_fetch_array($articles_listing_query)) {
?>
            <div valign="top" class="main" width="75%" style="padding-bottom:10px">
<?php  // osc-help.net: added class=main to the link.
  echo '<a class="main" href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $articles_listing['articles_id']) . '"><b>' . $articles_listing['articles_name'] . '</b></a> ';
  if (DISPLAY_AUTHOR_ARTICLE_LISTING == 'true' && tep_not_null($articles_listing['authors_name'])) {
   echo TEXT_BY . ' ' . '<a href="' . tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $articles_listing['authors_id']) . '"> ' . $articles_listing['authors_name'] . '</a>';
  }
?>
            </div>
<?php
      if (DISPLAY_TOPIC_ARTICLE_LISTING == 'true' && tep_not_null($articles_listing['topics_name'])) {
?>
            <div valign="top" class="main" width="25%" nowrap><?php echo TEXT_TOPIC . '&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLES, 'tPath=' . $articles_listing['topics_id']) . '">' . $articles_listing['topics_name'] . '</a>'; ?></div>
<?php
      }
?>
       
<?php
      if (DISPLAY_ABSTRACT_ARTICLE_LISTING == 'true') {
?>
            <div class="main" style="padding-left:15px"><?php echo clean_html_comments(substr($articles_listing['articles_head_desc_tag'],0, MAX_ARTICLE_ABSTRACT_LENGTH)) . ((strlen($articles_listing['articles_head_desc_tag']) >= MAX_ARTICLE_ABSTRACT_LENGTH) ? '...' : ''); ?></div>
<?php
      }
      if (DISPLAY_DATE_ADDED_ARTICLE_LISTING == 'true') {
?>
            <div class="smallText" style="padding-left:15px"><?php echo TEXT_DATE_ADDED . ' ' . tep_date_long($articles_listing['articles_date_added']); ?></div>
<?php
      }
    } // End of listing loop
  } else {
?>
            <div class="main">
            <?php 
             if ($listing_no_article<>'') {
                  echo $listing_no_article;
             } elseif ($topic_depth == 'articles') {
                  echo TEXT_NO_ARTICLES;
             } elseif (isset($_GET['authors_id'])) {
                  echo TEXT_NO_ARTICLES2;
             } else {
                  echo TEXT_NO_ARTICLES_BLOG;
             }
           ?>
           </div>
<?php
  }
?>
<?php
  if (($listing_split->number_of_rows > 0) && ((ARTICLE_PREV_NEXT_BAR_LOCATION == 'bottom') || (ARTICLE_PREV_NEXT_BAR_LOCATION == 'both'))) {
?>
   <div class="row">
     <div class="col-sm-6 pagenumber hidden-xs">
       <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_ARTICLES); ?>
     </div>
     <div class="col-sm-6">
       <div class="pull-right pagenav"><ul class="pagination"><?php echo $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></ul></div>
       <span class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></span>
     </div>
   </div>            
<?php
  }

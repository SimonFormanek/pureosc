<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_ARTICLES,
    'apps' => array(
      array(
        'code' => FILENAME_ARTICLES,
        'title' => BOX_TOPICS_ARTICLES,
        'link' => tep_href_link(FILENAME_ARTICLES)
      ),
      array(
        'code' => FILENAME_ARTICLES_CONFIG,
        'title' => BOX_ARTICLES_CONFIG,
        'link' => tep_href_link(FILENAME_ARTICLES_CONFIG)
      ),
      array(
        'code' => FILENAME_AUTHORS,
        'title' => BOX_ARTICLES_AUTHORS,
        'link' => tep_href_link(FILENAME_AUTHORS)
      ),
      array(
        'code' => FILENAME_ARTICLES_BLOG_COMMENTS,
        'title' => BOX_ARTICLES_BLOG_COMMENTS,
        'link' => tep_href_link(FILENAME_ARTICLES_BLOG_COMMENTS)
      ),
      array(
        'code' => FILENAME_ARTICLE_REVIEWS,
        'title' => BOX_ARTICLES_REVIEWS,
        'link' => tep_href_link(FILENAME_ARTICLE_REVIEWS)
      ),
      array(
        'code' => FILENAME_ARTICLES_XSELL,
        'title' => BOX_ARTICLES_XSELL,
        'link' => tep_href_link(FILENAME_ARTICLES_XSELL)
      )
    )
  );
?>

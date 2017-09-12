<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_MAIN', '', true);
define('TABLE_HEADING_NEW_ARTICLES', 'New Articles in %s', true);

define('TEXT_NO_ARTICLES', 'There are currently no articles in this topic.', true);
define('TEXT_NO_ARTICLES2', 'There are currently no articles available from this author.', true);
define('TEXT_NO_ARTICLES_BLOG', 'There are currently no blog articles available.', true);

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', 'Articles', true);
  define('TABLE_HEADING_ARTICLES', 'Articles', true);
  define('TABLE_HEADING_AUTHOR', 'Author', true);
  define('TEXT_NUMBER_OF_ARTICLES', 'Number of Articles: ', true);
  define('TEXT_SHOW', 'Display:', true);
  define('TEXT_NOW', '\' now', true);
  define('TEXT_ALL_TOPICS', 'All Topics', true);
  define('TEXT_ALL_AUTHORS', 'All Authors', true);
  define('TEXT_ARTICLES_BY', ' by ', true);
  define('TEXT_ARTICLES', 'Below is a list of articles with the most recent ones listed first.', true);
  define('TEXT_DATE_ADDED', 'Published:', true);
  define('TEXT_AUTHOR', 'Author:', true);
  define('TEXT_TOPIC', 'Topic:', true);
  define('TEXT_BY', 'by', true);
  define('TEXT_READ_MORE', 'Read More...', true);
  define('TEXT_MORE_INFORMATION', 'For more information, please visit this authors <a href="http://%s" target="_blank">web page</a>.', true);
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'All Articles', true);
  define('HEADING_TITLE_BLOG', 'All Blog Articles', true);
  define('TEXT_ALL_ARTICLES', 'Below is a list of all articles with the most recent ones listed first.', true);
  define('TEXT_ARTICLES', 'Below is a list of all articles with the most recent ones listed first.', true);
  define('TEXT_CURRENT_ARTICLES', 'Current Articles', true);
  define('TEXT_UPCOMING_ARTICLES', 'Upcoming Articles', true);
  define('TEXT_NO_ARTICLES', 'There are currently no articles listed.', true);
  define('TEXT_DATE_ADDED', 'Published:', true);
  define('TEXT_DATE_EXPECTED', 'Expected:', true);
  define('TEXT_AUTHOR', 'Author:', true);
  define('TEXT_TOPIC', 'Topic:', true);
  define('TEXT_BY', 'by', true);
  define('TEXT_READ_MORE', 'Read More...', true);
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Articles', true);
}

  define('TEXT_CURRENT_BLOG_ARTICLES', 'Current Blog Articles', true);

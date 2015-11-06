<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce
  
  Released under the GNU General Public License
*/

define('TEXT_MAIN', '',true);
define('TABLE_HEADING_NEW_PRODUCTS', 'New Products For %s',true);
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Upcoming Products',true);
define('TABLE_HEADING_DATE_EXPECTED', 'Date Expected',true);
define('HEADING_TITLE', 'Welcome to ' . STORE_NAME);

define('TEXT_NO_PRODUCTS', 'There are no products available in this category.',true);
define('TEXT_NUMBER_OF_PRODUCTS', 'Number of Products: ',true);
define('TEXT_SHOW', '<strong>Show:</strong>',true);
define('TEXT_BUY', 'Buy 1 \'',true);
define('TEXT_NOW', '\' now',true);
define('TEXT_ALL_CATEGORIES', 'All Categories',true);
define('TEXT_ALL_MANUFACTURERS', 'All Manufacturers',true);

// seo
if ( ($category_depth == 'top') && (!isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('META_SEO_TITLE', 'Index Page Title',true);
  define('META_SEO_DESCRIPTION', 'This is the description of your site to be used in the META Description Element',true);
  /*
  keywords are USELESS unless you are selling into China and want to be listed in Baidu Search Engine
  */
  define('META_SEO_KEYWORDS', 'these, are, the, comma, separated, keywords, used in the META keywords Element',true);
}

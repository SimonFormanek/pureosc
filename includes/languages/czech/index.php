<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce
  
  Released under the GNU General Public License
*/

define('TEXT_MAIN', '',true);
define('TABLE_HEADING_NEW_PRODUCTS', 'Novinky %s',true);
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Připravujeme',true);
define('TABLE_HEADING_DATE_EXPECTED', 'Bude k dispozici',true);
define('HEADING_TITLE', 'Home/Nová kategorie ' . STORE_NAME);

define('TEXT_NO_PRODUCTS', 'V této kategorii není žádné zboží.',true);
define('TEXT_NUMBER_OF_PRODUCTS', 'Počet: ',true);
define('TEXT_SHOW', '<strong>vyberte:</strong>',true);
define('TEXT_BUY', 'Koupit \'',true);
define('TEXT_NOW', '\' nyní',true);
define('TEXT_ALL_CATEGORIES', 'všechny kategorie',true);
define('TEXT_ALL_MANUFACTURERS', 'všichni výrobci',true);

// seo
if ( ($category_depth == 'top') && (!isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('META_SEO_TITLE', 'Index Page Title',true);
  define('META_SEO_DESCRIPTION', 'This is the description of your site to be used in the META Description Element',true);
  /*
  keywords are USELESS unless you are selling into China and want to be listed in Baidu Search Engine
  */
  define('META_SEO_KEYWORDS', 'these, are, the, comma, separated, keywords, used in the META keywords Element',true);
}

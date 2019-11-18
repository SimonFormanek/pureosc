<?php
/*
  $Id: articles_new.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Nové články');
define('HEADING_TITLE', 'Nové články');

define('TEXT_NEW_ARTICLES',
    'Následující články byly přidány v posledních %s dnech.');
define('TEXT_ARTICLES', sprintf(TEXT_NEW_ARTICLES, NEW_ARTICLES_DAYS_DISPLAY));
define('TEXT_NO_NEW_ARTICLES',
    'V posledních dnech %s nebyly přidány žádné nové články.');
define('TEXT_DATE_ADDED', 'Publikováno:');
define('TEXT_AUTHOR', 'Autor:');
define('TEXT_TOPIC', 'Kategorie:');
define('TEXT_BY', 'Autor');
define('TEXT_READ_MORE', 'Více');
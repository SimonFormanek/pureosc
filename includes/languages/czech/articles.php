<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_MAIN', '', true);
define('TABLE_HEADING_NEW_ARTICLES', 'Nové články v %s', true);

define('TEXT_NO_ARTICLES', 'V tomto tématu nejsou momentálně žádné články.', true);
define('TEXT_NO_ARTICLES2', 'Momentálně nejsou k dispozici žádné články od tohoto autora.', true);
define('TEXT_NO_ARTICLES_BLOG', 'V současné době nejsou k dispozici žádné blogové články.', true);

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', 'Články', true);
  define('TABLE_HEADING_ARTICLES', 'Články', true);
  define('TABLE_HEADING_AUTHOR', 'Autor', true);
  define('TEXT_NUMBER_OF_ARTICLES', 'Počet článků: ', true);
  define('TEXT_SHOW', 'Zobrazit:', true);
  define('TEXT_NOW', '\' nyní', true);
  define('TEXT_ALL_TOPICS', 'Všechny kategorie', true);
  define('TEXT_ALL_AUTHORS', 'Všichni autoři', true);
  define('TEXT_ARTICLES_BY', ' podle ', true);
  define('TEXT_ARTICLES', 'Níže je seznam nejnovějších článků.', true);
  define('TEXT_DATE_ADDED', 'Publikováno:', true);
  define('TEXT_AUTHOR', 'Autor:', true);
  define('TEXT_TOPIC', 'Kategorie:', true);
  define('TEXT_BY', 'podle', true);
  define('TEXT_READ_MORE', 'Číst další...', true);
  define('TEXT_MORE_INFORMATION', 'Pro další informace navštivte tyto autory <a href="http://%s" target="_blank">web stránka</a>.', true);
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'Všechny články', true);
  define('HEADING_TITLE_BLOG', 'Všechny blogy', true);
  define('TEXT_ALL_ARTICLES', 'Níže je seznam všech článků, nejnovější jsou uvedeny jako první.', true);
  define('TEXT_ARTICLES', 'Níže je seznam všech článků, nejnovější jsou uvedeny jako první.', true);
  define('TEXT_CURRENT_ARTICLES', 'Aktuální články', true);
  define('TEXT_UPCOMING_ARTICLES', 'Připravované čláky', true);
  define('TEXT_NO_ARTICLES', 'V současné době nejsou uvedeny žádné články.', true);
  define('TEXT_DATE_ADDED', 'Publikováno:', true);
  define('TEXT_DATE_EXPECTED', 'Očekávaný:', true);
  define('TEXT_AUTHOR', 'Autor:', true);
  define('TEXT_TOPIC', 'Kategorie:', true);
  define('TEXT_BY', 'podle', true);
  define('TEXT_READ_MORE', 'Číst dále...', true);
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Články', true);
}

  define('TEXT_CURRENT_BLOG_ARTICLES', 'Aktuální Blogy', true);

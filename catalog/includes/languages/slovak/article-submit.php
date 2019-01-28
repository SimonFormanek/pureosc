<?php
/*
  $Id: article-submit.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

define('HEADING_ARTICLE_SUBMIT', 'Odešlete článek');
define('TEXT_ARTICLE_SUBMIT',
    'Odešlete svůj článek zde. Bude zhodnocen, a pokud bude schválen, bude do 48 hodin publikován.');
define('TEXT_MAIN', '');
define('TEXT_ARTICLE_NAME', 'Název článku:');
define('TEXT_ARTICLE_PLACEMENT', 'Umístění:');
define('TEXT_ARTICLE_SUBMITTED',
    'Blahopřejeme! Váš příspěvek byl úspěšně odeslán.');
define('TEXT_ARTICLE_TEXT', 'Článek: (níže)');
define('TEXT_ARTICLE_UPLOAD_IMAGE', 'Nahrajte obrázek:');

define('TEXT_SHORT_DESCRIPTION', 'Krátký popis:');
define('TEXT_SELECT_TOPIC', 'Vyberte kategorii');

define('TEXT_AUTHORS_NAME', 'Jméno autora:');
define('TEXT_AUTHORS_IMAGE', 'Fotografie autora:');
define('TEXT_AUTHORS_INFO', 'Informace o autorovi:');

define('IMAGE_BUTTON_SUBMIT', 'Odeslat');

define('ARTICLES_EMAIL_TEXT_BODY',
    'Článek byl odeslán %s s názvem %s v %s kategorii.');
define('ARTICLES_EMAIL_TEXT_SUBJECT', 'Článek byl odeslán na %s');

define('ERROR_ARTICLE_META_DESC', 'Vyplňte krátký popis.');
define('ERROR_ARTICLE_NAME', 'Vyplňte název článku.');
define('ERROR_ARTICLE_TEXT', 'Vyplňte vlastní text článku.');
define('ERROR_AUTHORS_NAME', 'Vyplňte jméno autora.');
define('ERROR_INVALID_TOPIC', 'Musí být vybrána kategorie.');
define('ERROR_FAILED_IMAGE_UPLOAD', 'Obrázek se nenahrál.');
define('ERROR_FAILED_IMAGE_INVALID',
    'Špatný typ obrázku. Pouze gif\'s, jpg\'s a png\ je správně.');
?>

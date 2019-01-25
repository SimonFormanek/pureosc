<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
define('HEADING_TITLE_AUTHOR', 'by Jack York from <a href="http://www.oscommerce-solution.com/" target="_blank"><span style="font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px;">oscommerce-solution.com</span></a>');
define('HEADING_TITLE_SUPPORT_THREAD', '<a href="http://forums.oscommerce.com/topic/68866-article-manager-v1-0/" target="_blank"><span style="color: sienna;">(visit the support thread)</span></a>');
define('TEXT_MISSING_VERSION_CHECKER', 'Version Checker není instalován. See <a href="http://addons.oscommerce.com/info/7148" target="_blank">here</a> for details.');

define('HEADING_TITLE', 'Kategorie&nbsp;/&nbsp;Články');
define('HEADING_TITLE_SEARCH', 'Hledat:');
define('HEADING_TITLE_GOTO', 'Jít na:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_TOPICS_ARTICLES', 'Kategorie / Články');
define('TABLE_HEADING_ACTION', 'Akce');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_BLOG_STATUS', 'Blog Status');
define('TABLE_HEADING_SORT_ORDER', 'Třídění');

define('TEXT_ARTICLES_CURRENT', 'Current:');

define('TEXT_NEW_ARTICLE', 'Nový článek v &quot;%s&quot;');
define('TEXT_EDIT_ARTICLE', 'Editovat článek v &quot;%s&quot;');
define('TEXT_TOPICS', 'Kategorie:');
define('TEXT_SUBTOPICS', 'Podkategorie:');
define('TEXT_ARTICLES', 'Články:');
define('TEXT_ARTICLES_AVERAGE_RATING', 'Průměrné hodnocení:');
define('TEXT_ARTICLES_HEAD_TITLE_TAG', 'HTML stránka název:');
define('TEXT_ARTICLES_HEAD_DESC_TAG', 'Meta Description:<br><small>(Article Abstract =<br>první %s písmena)</small>');
define('TEXT_ARTICLES_HEAD_KEYWORDS_TAG', 'Meta Keywords:');
define('TEXT_ARTICLES_IMAGE', 'Obrázek');
define('TEXT_DATE_ADDED', 'Datum přidání:');
define('TEXT_DATE_AVAILABLE', 'Datum očekávání:');
define('TEXT_LAST_MODIFIED', 'Poslední změna:');
define('TEXT_NO_CHILD_TOPICS_OR_ARTICLES', 'Vložte novou kategorii nebo článek v této úrovni.');
define('TEXT_ARTICLE_MORE_INFORMATION', 'Pro další informace navštivte články <a href="http://%s" target="blank"><u>web stránka</u></a>.');
define('TEXT_ARTICLE_DATE_ADDED', 'Tento článek byl přidán do našeho webu %s.');
define('TEXT_ARTICLE_DATE_AVAILABLE', 'Tento článekje očekáván na %s.');

define('TEXT_EDIT_INTRO', 'Udělejte potřebné změny');
define('TEXT_EDIT_TOPICS_ID', 'Kategorie ID:');
define('TEXT_EDIT_TOPICS_NAME', 'Kategorie název:');
define('TEXT_EDIT_SORT_ORDER', 'Třídění:');

define('TEXT_INFO_COPY_TO_INTRO', 'Zvolte novou kategorii do které chcete článek zkopírovat');
define('TEXT_INFO_CURRENT_TOPICS', 'Hlavní kategorie:');

define('TEXT_INFO_HEADING_NEW_TOPIC', 'Nová kategorie');
define('TEXT_INFO_HEADING_EDIT_TOPIC', 'Editovat kategorii');
define('TEXT_INFO_HEADING_DELETE_TOPIC', 'Smazat kategorii');
define('TEXT_INFO_HEADING_MOVE_TOPIC', 'Přesun kategorie');
define('TEXT_INFO_HEADING_DELETE_ARTICLE', 'Smazat článek');
define('TEXT_INFO_HEADING_MOVE_ARTICLE', 'Přesun článku');
define('TEXT_INFO_HEADING_COPY_TO', 'Zkopírovat do');

define('TEXT_DELETE_TOPIC_INTRO', 'Jste připraveni smazat tuto kategorii?');
define('TEXT_DELETE_ARTICLE_INTRO', 'Chcete úplně smazat tento článek?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>pozor:</b> Tyto %s podřízené kategorie jsou svázány s touto kategorií!');
define('TEXT_DELETE_WARNING_ARTICLES', '<b>pozor:</b> Články %s jsou linkovány s touto kategorií!');

define('TEXT_MOVE_ARTICLES_INTRO', 'Vyberte kategorii ve které chcete být <b>%s</b> uvnitř');
define('TEXT_MOVE_TOPICS_INTRO', 'Vyberte kategorii ve které chcete být <b>%s</b> uvnitř');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_TOPIC_INTRO', 'Vyplňte prosím následující informace pro novou kategorii');
define('TEXT_TOPICS_NAME', 'Kategorie název:');
define('TEXT_SORT_ORDER', 'Třídění:');

define('TEXT_EDIT_TOPICS_HEADING_TITLE', 'Kategorie Heading Název:');
define('TEXT_EDIT_TOPICS_DESCRIPTION', 'Kategorie popis:');

define('TEXT_ARTICLES_STATUS', 'Článek status:');
define('TEXT_ARTICLES_DATE_AVAILABLE', 'Datum očekávání:');
define('TEXT_ARTICLE_AVAILABLE', 'Publikován');
define('TEXT_ARTICLE_NOT_AVAILABLE', 'Návrh - Draft');
define('TEXT_ARTICLE_BLOG_NO', 'Ne');
define('TEXT_ARTICLE_BLOG_YES', 'Ano');
define('TEXT_ARTICLES_BLOG_STATUS', 'Blog - článek');
define('TEXT_ARTICLES_AUTHOR', 'Autor:');
define('TEXT_ARTICLES_NAME', 'Název článku:');
define('TEXT_ARTICLES_DESCRIPTION', 'Obsah článku:');
define('TEXT_ARTICLES_URL', 'Článek URL:');
define('TEXT_ARTICLES_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');

define('EMPTY_TOPIC', 'Prázdná kategorie');

define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK', 'Linkuj článek');
define('TEXT_COPY_AS_DUPLICATE', 'Duplikovat článek');

define('ERROR_CANNOT_LINK_TO_SAME_TOPIC', 'Chyba: nelze linkovat články v té samé kategorii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: adresář na obrázky neí zapisovatelný: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: adresář na obrázky neexistuje: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_TOPIC_TO_PARENT', 'Chyba: Kategorii nelze přesunout do podřízené kategorie.');

?>

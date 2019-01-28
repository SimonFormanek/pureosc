<?php
/*
  $Id: categories.php,v 1.26 2003/07/11 14:40:28 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kategórie / Produkty');
define('HEADING_TITLE_SEARCH', 'Vyhľadávanie:');
define('HEADING_TITLE_GOTO', 'Ísť na:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategórie / Produkty');
define('TABLE_HEADING_ACTION', 'Akcia');
define('TABLE_HEADING_STATUS', 'Stav');

define('TEXT_NEW_PRODUCT', 'Nový produkt v &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategórie:');
define('TEXT_SUBCATEGORIES', 'Podkategórie:');
define('TEXT_PRODUCTS', 'Produkty:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Cena:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Daňová skupina:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Priemerné hodnotenie:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Počet:');
define('TEXT_DATE_ADDED', 'Pridaný dňa:');
define('TEXT_DATE_AVAILABLE', 'K dispozícii od:');
define('TEXT_LAST_MODIFIED', 'Posledná úprava:');
define('TEXT_IMAGE_NONEXISTENT', 'OBRÁZOK NEEXISTUJE');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Pridajte prosím novú kategóriu, alebo produkt v tejto úrovni.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Pre viac informácií navštívte <a href="http://%s" target="blank"><u>web stránku</u></a> tohoto produktu.');
define('TEXT_PRODUCT_DATE_ADDED', 'Tento produkt bol pridaný do katalógu dňa %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Tento produkt bude na sklade od %s.');

define('TEXT_EDIT_INTRO', 'Spravte prosím potrebné zmeny');
define('TEXT_EDIT_CATEGORIES_ID', 'ID kategórie:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Názov kategórie:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Obrázok kategórie:');
define('TEXT_EDIT_SORT_ORDER', 'Triedenie:');

define('TEXT_INFO_COPY_TO_INTRO', 'Vyberte prosím novú kategóriu do ktorej chcete produkt prekopírovať');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuálna kategória:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nová kategória');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Opraviť kategóriu');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Odstrániť kategóriu');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Presunúť kategóriu');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Odstrániť produkt');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Presunúť produkt');
define('TEXT_INFO_HEADING_COPY_TO', 'Prekopírovať do');

define('TEXT_DELETE_CATEGORY_INTRO', 'Naozaj chcete odstrániť túto kategóriu?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Naozaj chcete natrvalo odstrániť tento produkt?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>UPOZORNENIE:</b> S kategóriou %s sú spojené ďalšie podkategórie!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>UPOZORNENIE:</b> S touto kategóriou sú spojené produkty %s!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Vyberte kategóriu do ktorej chcete vsunúť <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Vyberte kategóriu do ktorej chcete vsunúť <b>%s</b>');
define('TEXT_MOVE', 'Presunúť <b>%s</b> do:');

define('TEXT_NEW_CATEGORY_INTRO', 'Vyplňte prosím následujúce informácie pre novú kategóriu');
define('TEXT_CATEGORIES_NAME', 'Názov kategórie:');
define('TEXT_CATEGORIES_IMAGE', 'Obrázok kategórie:');
define('TEXT_SORT_ORDER', 'Triedenie:');

define('TEXT_PRODUCTS_STATUS', 'Stav produktov:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'K dispozícii od:');
define('TEXT_PRODUCT_AVAILABLE', 'Na sklade');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Vypredaný');
define('TEXT_PRODUCTS_MANUFACTURER', 'Výrobca produktu:');
define('TEXT_PRODUCTS_NAME', 'Názov produktu:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Popis produktu:');
define('TEXT_PRODUCTS_QUANTITY', 'Množstvo produktu:');
define('TEXT_PRODUCTS_MODEL', 'Typ produktu:');
define('TEXT_PRODUCTS_IMAGE', 'Obrázok produktu:');
define('TEXT_PRODUCTS_MAIN_IMAGE', 'Hlavný obrázok');
define('TEXT_PRODUCTS_LARGE_IMAGE', 'Veľký obrázok');
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'HTML obsah (popup)');
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Pridať Veľký obrázok');
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Zmazať Veľký obrázok produktu?');
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Potvrďte odstránenie veľkého obrázku produktu.');
define('TEXT_PRODUCTS_URL', 'URL produktu:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Cena produktu (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena produktu (Brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Váha produktu:');

define('EMPTY_CATEGORY', 'Prázdna kategória');

define('TEXT_HOW_TO_COPY', 'Spôsob kopírovania:');
define('TEXT_COPY_AS_LINK', 'Spojiť produkt');
define('TEXT_COPY_AS_DUPLICATE', 'Duplikovať výrobok');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Chyba: Nemožno spojiť produkty v tej istej kategórii.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Chyba: Nie je možné zapisovať do priečinka obrázkov katalógu: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Chyba: Priečinok s obrázkami katalógu neexistuje: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Chyba: Kategória nemôže byť presunutá do priečinka jej potomka.');
?>

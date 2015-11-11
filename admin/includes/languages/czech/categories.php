<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categories / Products',true);
define('HEADING_TITLE_SEARCH', 'Search:',true);
define('HEADING_TITLE_GOTO', 'Go To:',true);

define('TABLE_HEADING_ID', 'ID',true);
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products',true);
define('TABLE_HEADING_ACTION', 'Action',true);
define('TABLE_HEADING_STATUS', 'Status',true);

define('TEXT_NEW_PRODUCT', 'New Product in &quot;%s&quot;',true);
define('TEXT_CATEGORIES', 'Categories:',true);
define('TEXT_SUBCATEGORIES', 'Subcategories:',true);
define('TEXT_PRODUCTS', 'Products:',true);
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:',true);
define('TEXT_PRODUCTS_TAX_CLASS', 'Sazba DPH:',true);
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Average Rating:',true);
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantity:',true);
define('TEXT_DATE_ADDED', 'Datum přidání do katalogu:',true);
define('TEXT_DATE_AVAILABLE', 'Datum uvedení do prodeje:',true);
define('TEXT_LAST_MODIFIED', 'Last Modified:',true);
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST',true);
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please insert a new category or product in this level.',true);
define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank"><u>webpage</u></a>.',true);
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.',true);
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.',true);

define('TEXT_EDIT_INTRO', 'Please make any necessary changes',true);
define('TEXT_EDIT_CATEGORIES_ID', 'Category ID:',true);
define('TEXT_EDIT_CATEGORIES_NAME', 'Jméno kategorie/článku:',true);
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Obrázek:',true);
define('TEXT_EDIT_SORT_ORDER', 'Pořadí:',true);

define('TEXT_INFO_COPY_TO_INTRO', 'Vyberte kategorii do které se produkt zkopíruje',true);
define('TEXT_INFO_CURRENT_CATEGORIES', 'Aktuální kategorie:',true);

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nová kategorie/článek',true);
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Upravit kategorii/článek',true);
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Smazat kategorii/článek',true);
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Přesunout kategorii/článek',true);
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Smazat produkt',true);
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Přesunout produkt',true);
define('TEXT_INFO_HEADING_COPY_TO', 'Kopírovat do',true);

define('TEXT_DELETE_CATEGORY_INTRO', 'Opravdu smazat kategorii/článek?',true);
define('TEXT_DELETE_PRODUCT_INTRO', 'Opravdu smazat produkt?',true);

define('TEXT_DELETE_WARNING_CHILDS', '<strong>POZOR:</strong> Existuje %s vnořených kategoriií!',true);
define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>POZOR:</strong> Existuje %s produktů v této kategorii a jejích podkategoriích!',true);

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select which category you wish <strong>%s</strong> to reside in',true);
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <strong>%s</strong> to reside in',true);
define('TEXT_MOVE', 'Move <strong>%s</strong> to:',true);

define('TEXT_NEW_CATEGORY_INTRO', 'Vyplňte údaje pro novou kategorii/článek',true);
define('TEXT_CATEGORIES_NAME', 'Jméno:',true);
define('TEXT_CATEGORIES_IMAGE', 'Obrázek:',true);
define('TEXT_SORT_ORDER', 'Pořadí:',true);

define('TEXT_PRODUCTS_STATUS', 'Status:',true);
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Datum uvedení do prodeje:',true);
define('TEXT_PRODUCTS_CUSTOM_DATE','Datum (pro třídění):',true);
define('TEXT_PRODUCTS_SORT_ORDER','Pořadí:',true);
define('TEXT_PRODUCT_AVAILABLE', 'Aktivní',true);
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Neaktivní',true);
define('TEXT_PRODUCTS_MANUFACTURER', 'Výrobce:',true);
define('TEXT_PRODUCTS_NAME', 'Název produktu:',true);
define('TEXT_PRODUCTS_DESCRIPTION', 'Popis produktu:',true);
define('TEXT_PRODUCTS_QUANTITY', 'Kusů skladem:',true);
define('TEXT_PRODUCTS_MODEL', 'Model:',true);
define('TEXT_PRODUCTS_IMAGE', 'Obrázek:',true);
define('TEXT_PRODUCTS_MAIN_IMAGE', 'Základní obrázek',true);
define('TEXT_PRODUCTS_LARGE_IMAGE', 'Velký obrázek',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'Popiska obrázku',true);
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Přidat velký obrázek',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Smazat velký obrázek?',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Potvrďte smazání velkého obrázku.',true);
define('TEXT_PRODUCTS_URL', 'URL adresa produktu:',true);
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(bez http://)</small>',true);
define('TEXT_PRODUCTS_PRICE_NET', 'Cena bez DPH:',true);
define('TEXT_PRODUCTS_PRICE_GROSS', 'Cena s DPH:',true);
define('TEXT_PRODUCTS_WEIGHT', 'Hmotnost produktu <br />(POZOR: nejedná-li se o produkt ke stažení nesmí být 0):',true);

define('EMPTY_CATEGORY', 'Empty Category',true);

define('TEXT_HOW_TO_COPY', 'Copy Method:',true);
define('TEXT_COPY_AS_LINK', 'Link product',true);
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate product',true);

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: Can not link products in the same category.',true);
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.',true);
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Definition for SEO Header Tags Reloaded
  define('TEXT_CATEGORIES_DESCRIPTION', 'Popis kategorie/text článku',true);
  define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Upravit popis kategorie/text článku:',true);
  define('TEXT_PRODUCTS_SEO_TITLE', 'Titulek pro SEO (META TITLE):<br><small>Rozvedený název produktu, <br />nevyplněno - použije se název.<br />Nejdůježitější SEO prvek!</small>',true);
  define('TEXT_CATEGORIES_SEO_TITLE', 'Titulek kategorie pro META hlavičku dokumentu:<br><small><br />nevypněno - použije se název kategorie.</small>',true);
  define('TEXT_EDIT_CATEGORIES_SEO_TITLE', 'Upravit titulek kategorie pro META hlavičku:',true);
  define('TEXT_CATEGORIES_SEO_DESCRIPTION', 'Popis kategorie/článku pro META hlavičku dokumentu (SEO, vyhledávání):',true);
  define('TEXT_EDIT_CATEGORIES_SEO_DESCRIPTION', 'Upravit popis kategorie/článku pro META hlavičku:',true);
  define('TEXT_CATEGORIES_SEO_KEYWORDS', 'Klíčová slova pro kategorii/článek:<br><small>Slova oddělujte čárkou.</small>',true);
  define('TEXT_EDIT_CATEGORIES_SEO_KEYWORDS', 'Upravit klíčová slova pro kategorii/článek:<br><small>Slova oddělujte čárkou.</small>',true);
  define('TEXT_PRODUCTS_SEO_DESCRIPTION', 'Popis produktu pro META hlavičku dokumentu (SEO, vyhledávání):',true);
  define('TEXT_PRODUCTS_SEO_KEYWORDS', 'Meta klíčová slova (SEO, vyhledávání):<small><br />Slova oddělujte čárkou.</small>',true);
  define('TEXT_PRODUCTS_MINI_DESCRIPTION', 'Stručný popis produktu:<small>Pro výpis kategorie</small>',true);

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kategorien / Artikel');
define('HEADING_TITLE_SEARCH', 'Suche: ');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Neuer Artikel in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'durchschnittl. Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Anzahl:');
define('TEXT_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_LAST_MODIFIED', 'letzte änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'BILD EXISTIERT NICHT');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder einen Artikel ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen, besuchen Sie bitte die <a href="http://%s" target="blank"><u>Homepage</u></a> des Herstellers.');
define('TEXT_PRODUCT_DATE_ADDED', 'Diesen Artikel haben wir am %s in unseren Katalog aufgenommen.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist erhältlich ab %s.');

define('TEXT_EDIT_INTRO', 'Bitte führen Sie alle notwendigen änderungen durch.');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategorie Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategorie Bild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie eine neue Kategorie aus, in die Sie den Artikel kopieren möchten:');
define('TEXT_INFO_CURRENT_CATEGORIES', 'aktuelle Kategorien:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen möchten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNUNG:</b> Es existieren noch %s (Unter-)Kategorien, die mit dieser Kategorie verbunden sind!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNNG:</b> Es existieren noch %s Artikel, die mit dieser Kategorie verbunden sind!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie die übergordnete Kategorie, in die Sie <b>%s</b> verschieben möchten');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie die übergordnete Kategorie, in die Sie <b>%s</b> verschieben möchten');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte geben Sie die neue Kategorie mit allen relevanten Daten ein.');
define('TEXT_CATEGORIES_NAME', 'Kategorie Name:');
define('TEXT_CATEGORIES_IMAGE', 'Kategorie Bild:');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_STATUS', 'Produktstatus:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCTS_CUSTOM_DATE','Custom date:');
define('TEXT_PRODUCTS_SORT_ORDER','Sort order:');
define('TEXT_PRODUCT_AVAILABLE', 'auf Lager');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'nicht vorrätig');
define('TEXT_PRODUCTS_MANUFACTURER', 'Artikel-Hersteller:');
define('TEXT_PRODUCTS_NAME', 'Artikelname:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikelbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Artikelanzahl:');
define('TEXT_PRODUCTS_MODEL', 'Artikel-Nr.:');
define('TEXT_PRODUCTS_IMAGE', 'Artikelbild:');
define('TEXT_PRODUCTS_MAIN_IMAGE','Artikelhauptbild');
define('TEXT_PRODUCTS_LARGE_IMAGE','grosses Artikelbild');
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT','Bildbeschreibung');
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE','weitere grosse Artikelbilder');
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Entfernen großes Produkt-Foto?');
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Bitte bestätigen Sie das Entfernen des großes Produkt-Foto.');

define('TEXT_PRODUCTS_URL', 'Herstellerlink:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne führendes http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Artikelpreis (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Artikelpreis (Brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Artikelgewicht:');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Produkt verlinken');
define('TEXT_COPY_AS_DUPLICATE', 'Produkt duplizieren');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Produkte können nicht in der gleichen Kategorie verlinkt werden.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Verzeichnis \'images\' im Katalogverzeichnis ist schreibgeschützt: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Verzeichnis \'images\' im Katalogverzeichnis ist nicht vorhanden: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Kategorie kann nicht in Unterkategorie verschoben werden.');
?>

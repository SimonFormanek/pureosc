<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
//setlocale(LC_TIME, 'de_DE.ISO_8859-1');
setlocale(LC_ALL, array('de_DE.UTF8', 'de_DE.UTF-8', 'deu_deu' ));
define('DATE_FORMAT_SHORT', '%d/%m/%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y',true); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', '',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', 'Administration',true);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration',true);
define('HEADER_TITLE_SUPPORT_SITE', 'Supportseite',true);
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Katalog',true);
define('HEADER_TITLE_ADMINISTRATION', 'Administration',true);

// text for gender
define('MALE', 'Herr',true);
define('FEMALE', 'Frau',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/jjjj',true);

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfiguration',true);
define('BOX_CONFIGURATION_MYSTORE', 'Mein Shop',true);
define('BOX_CONFIGURATION_LOGGING', 'Login',true);
define('BOX_CONFIGURATION_CACHE', 'Cache',true);
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administratoren',true);
define('BOX_CONFIGURATION_STORE_LOGO', 'Shop Logo',true);

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module',true);
//define('BOX_MODULES_PAYMENT', 'Zahlungsweise',true);
//define('BOX_MODULES_SHIPPING', 'Versandart',true);
//define('BOX_MODULES_ORDER_TOTAL', 'Zusammenfassung',true);

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien / Artikel',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Produktmerkmale',true);
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller',true);
define('BOX_CATALOG_REVIEWS', 'Produktbewertungen',true);
define('BOX_CATALOG_SPECIALS', 'Sonderangebote',true);
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'erwartete Artikel',true);

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden',true);
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden',true);
// define('BOX_CUSTOMERS_ORDERS', 'Bestellungen',true);

// orders box text in includes/boxes/orders.php
define('BOX_HEADING_ORDERS', 'Bestellungen',true);
define('BOX_ORDERS_ORDERS', 'Bestellungen',true);

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Land / Steuer',true);
define('BOX_TAXES_COUNTRIES', 'Land',true);
define('BOX_TAXES_ZONES', 'Bundesländer',true);
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen',true);
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen',true);
define('BOX_TAXES_TAX_RATES', 'Steuersätze',true);

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Berichte',true);
define('BOX_REPORTS_PRODUCTS_VIEWED', 'besuchte Artikel',true);
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'gekaufte Artikel',true);
define('BOX_REPORTS_ORDERS_TOTAL', 'Kunden-Bestellstatistik',true);

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Hilfsprogramme',true);
define('BOX_TOOLS_ACTION_RECORDER', 'Action Recorder',true);
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung',true);
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager',true);
define('BOX_TOOLS_CACHE', 'Cache Steuerung',true);
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen definieren',true);

define('BOX_TOOLS_MAIL', 'eMail versenden',true);
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Rundschreiben Manager',true);
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Verzeichnis Sicherheit/Lesezugriffsrecht',true);
define('BOX_TOOLS_SERVER_INFO', 'Server Info',true);
define('BOX_TOOLS_VERSION_CHECK', 'Versions Checker',true);
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online',true);

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Sprachen/Währungen',true);
define('BOX_LOCALIZATION_CURRENCIES', 'Währungen',true);
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen',true);
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus',true);

// javascript messages
define('JS_ERROR', 'Während der Eingabe sind Fehler aufgetreten!\nBitte korrigieren Sie folgendes:\n\n',true);

define('JS_OPTIONS_VALUE_PRICE', '* Sie müssen diesem Wert einen Preis zuordnen\n',true);
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Sie müssen ein Vorzeichen für den Preis angeben (+/-)\n',true);

define('JS_PRODUCTS_NAME', '* Der neue Artikel muss einen Namen haben\n',true);
define('JS_PRODUCTS_DESCRIPTION', '* Der neue Artikel muss eine Beschreibung haben\n',true);
define('JS_PRODUCTS_PRICE', '* Der neue Artikel muss einen Preis haben\n',true);
define('JS_PRODUCTS_WEIGHT', '* Der neue Artikel muss eine Gewichtsangabe haben\n',true);
define('JS_PRODUCTS_QUANTITY', '* Sie müssen dem neuen Artikel eine verfügbare Anzahl zuordnen\n',true);
define('JS_PRODUCTS_MODEL', '* Sie müssen dem neuen Artikel eine Artikel-Nr. zuordnen\n',true);
define('JS_PRODUCTS_IMAGE', '* Sie müssen dem Artikel ein Bild zuordnen\n',true);

define('JS_SPECIALS_PRODUCTS_PRICE', '* Es muss ein neuer Preis für diesen Artikel festgelegt werden\n',true);

define('JS_GENDER', '* Die \'Anrede\' muss ausgewählt werden.\n',true);
define('JS_FIRST_NAME', '* Der \'Vorname\' muss mindestens aus ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens aus ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_DOB', '* Das \'Geburtsdatum\' muss folgendes Format haben: xx.xx.xxxx (Tag/Jahr/Monat).\n',true);
define('JS_EMAIL_ADDRESS', '* Die \'eMail-Adresse\' muss mindestens aus ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_ADDRESS', '* Die \'Strasse\' muss mindestens aus ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens aus ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_CITY', '* Die \'Stadt\' muss mindestens aus ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_STATE', '* Das \'Bundesland\' muss ausgewählt werden.\n',true);
define('JS_STATE_SELECT', '-- Wählen Sie oberhalb --',true);
define('JS_ZONE', '* Das \'Bundesland\' muss aus der Liste für dieses Land ausgewählt werden.',true);
define('JS_COUNTRY', '* Das \'Land\' muss ausgewählt werden.\n',true);
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.\n',true);
define('JS_PASSWORD', '* Das \'Passwort\' sowie die \'Passwortbestätigung\' müssen übereinstimmen und aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.\n',true);

define('JS_ORDER_DOES_NOT_EXIST', 'Auftragsnummer %s existiert nicht!',true);

define('CATEGORY_PERSONAL', 'Persönliche Daten',true);
define('CATEGORY_ADDRESS', 'Adresse',true);
define('CATEGORY_CONTACT', 'Kontakt',true);
define('CATEGORY_COMPANY', 'Firma',true);
define('CATEGORY_OPTIONS', 'Optionen',true);

define('ENTRY_GENDER', 'Anrede:',true);
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</span>',true);
define('ENTRY_FIRST_NAME', 'Vorname:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Buchstaben</span>',true);
define('ENTRY_LAST_NAME', 'Nachname:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Buchstaben</span>',true);
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(z.B. 21/05/1970)</span>',true);
define('ENTRY_EMAIL_ADDRESS', 'eMail Adresse:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Buchstaben</span>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">ungültige eMail-Adresse!</span>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Diese eMail-Adresse existiert schon!</span>',true);
define('ENTRY_STREET_ADDRESS', 'Strasse:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Buchstaben</span>',true);
define('ENTRY_SUBURB', 'weitere Anschrift:',true);
define('ENTRY_POST_CODE', 'Postleitzahl:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zahlen</span>',true);
define('ENTRY_CITY', 'Stadt:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Buchstaben</span>',true);
define('ENTRY_STATE', 'Bundesland:',true);
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</font></small>',true);
define('ENTRY_COUNTRY', 'Land:',true);
define('ENTRY_COUNTRY_ERROR', '',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zahlen</span>',true);
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:',true);
define('ENTRY_NEWSLETTER', 'Rundschreiben:',true);
define('ENTRY_NEWSLETTER_YES', 'abonniert',true);
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert',true);

// images
define('IMAGE_ANI_SEND_EMAIL', 'eMail versenden',true);
define('IMAGE_BACK', 'Zurück',true);
define('IMAGE_BACKUP', 'Datensicherung',true);
define('IMAGE_CANCEL', 'Abbruch',true);
define('IMAGE_CONFIRM', 'Bestätigen',true);
define('IMAGE_COPY', 'Kopieren',true);
define('IMAGE_COPY_TO', 'Kopieren nach',true);
define('IMAGE_DETAILS', 'Details',true);
define('IMAGE_DELETE', 'Löschen',true);
define('IMAGE_EDIT', 'Bearbeiten',true);
define('IMAGE_EMAIL', 'eMail versenden',true);
define('IMAGE_EXPORT', 'Export',true);
define('IMAGE_ICON_STATUS_GREEN', 'aktiv',true);
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'aktivieren',true);
define('IMAGE_ICON_STATUS_RED', 'inaktiv',true);
define('IMAGE_ICON_STATUS_RED_LIGHT', 'deaktivieren',true);
define('IMAGE_ICON_INFO', 'Information',true);
define('IMAGE_INSERT', 'Einfügen',true);
define('IMAGE_LOCK', 'Sperren',true);
define('IMAGE_MODULE_INSTALL', 'Module Installieren',true);
define('IMAGE_MODULE_REMOVE', 'Module Entfernen',true);
define('IMAGE_MOVE', 'Verschieben',true);
define('IMAGE_NEW_BANNER', 'Neuen Banner aufnehmen',true);
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie erstellen',true);
define('IMAGE_NEW_COUNTRY', 'Neues Land aufnehmen',true);
define('IMAGE_NEW_CURRENCY', 'Neue Währung einfügen',true);
define('IMAGE_NEW_FILE', 'Neue Datei',true);
define('IMAGE_NEW_FOLDER', 'Neues Verzeichnis',true);
define('IMAGE_NEW_LANGUAGE', 'Neue Sprache anlegen',true);
define('IMAGE_NEW_NEWSLETTER', 'Neues Rundschreiben',true);
define('IMAGE_NEW_PRODUCT', 'Neuen Artikel aufnehmen',true);
define('IMAGE_NEW_TAX_CLASS', 'Neue Steuerklasse erstellen',true);
define('IMAGE_NEW_TAX_RATE', 'Neuen Steuersatz anlegen',true);
define('IMAGE_NEW_TAX_ZONE', 'Neue Steuerzone erstellen',true);
define('IMAGE_NEW_ZONE', 'Neues Bundesland einfügen',true);
define('IMAGE_ORDERS', 'Bestellungen',true);
define('IMAGE_ORDERS_INVOICE', 'Rechnung',true);
define('IMAGE_ORDERS_PACKINGSLIP', 'Lieferschein',true);
define('IMAGE_PREVIEW', 'Vorschau',true);
define('IMAGE_RESET', 'Zurücksetzen',true);
define('IMAGE_RESTORE', 'Zurücksichern',true);
define('IMAGE_SAVE', 'Speichern',true);
define('IMAGE_SEARCH', 'Suchen',true);
define('IMAGE_SELECT', 'Auswählen',true);
define('IMAGE_SEND', 'Versenden',true);
define('IMAGE_SEND_EMAIL', 'eMail versenden',true);
define('IMAGE_UNLOCK', 'Entsperren',true);
define('IMAGE_UPDATE', 'Aktualisieren',true);
define('IMAGE_UPDATE_CURRENCIES', 'Wechselkurse aktualisieren',true);
define('IMAGE_UPLOAD', 'Hochladen',true);

define('ICON_CROSS', 'Falsch',true);
define('ICON_CURRENT_FOLDER', 'aktueller Ordner',true);
define('ICON_DELETE', 'Löschen',true);
define('ICON_ERROR', 'Fehler',true);
define('ICON_FILE', 'Datei',true);
define('ICON_FILE_DOWNLOAD', 'Herunterladen',true);
define('ICON_FOLDER', 'Ordner',true);
define('ICON_LOCKED', 'Gesperrt',true);
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene',true);
define('ICON_PREVIEW', 'Vorschau',true);
define('ICON_STATISTICS', 'Statistik',true);
define('ICON_SUCCESS', 'Erfolg',true);
define('ICON_TICK', 'Wahr',true);
define('ICON_UNLOCKED', 'Entsperrt',true);
define('ICON_WARNING', 'Warnung',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d',true);
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bannern)',true);
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Ländern)',true);
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Kunden)',true);
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Währungen)',true);
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES','Angezeigt werden %d bis %d (von insgesamt %d Einträgen)',true);
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sprachen)',true);
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Herstellern)',true);
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Rundschreiben)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellungen)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellstatus)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> erwarteten Artikeln)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bewertungen)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sonderangeboten)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerklassen)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerzonen)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuersätzen)',true);
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bundesländern)',true);

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;',true);
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;',true);

define('TEXT_DEFAULT', 'Standard',true);
define('TEXT_SET_DEFAULT', 'als Standard definieren',true);
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* erforderlich</span>',true);

define('TEXT_CACHE_CATEGORIES', 'Kategorien Box',true);
define('TEXT_CACHE_MANUFACTURERS', 'Hersteller Box',true);
define('TEXT_CACHE_ALSO_PURCHASED', 'Modul für ebenfalls gekaufte Artikel',true);

define('TEXT_NONE', '--keine--',true);
define('TEXT_TOP', 'Top',true);

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination existiert nicht.',true);
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination nicht beschreibbar.',true);
define('ERROR_FILE_NOT_SAVED', 'Error: File upload nicht gespeichert.',true);
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload typ nicht erlaubt.',true);
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload erfolgreich gespeichert.',true);
define('WARNING_NO_FILE_UPLOADED', 'Warning: kein File uploaded.',true);
//VAT number
define('ENTRY_COMPANY_NUMBER', 'Company Number:',true);
/**** BEGIN ARTICLE MANAGER ****/
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_BLOG_COMMENTS', 'Blog Comments');
define('BOX_ARTICLES_REVIEWS', 'Reviews');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');
/**** END ARTICLE MANAGER ****/

/*** Begin Header Tags SEO ***/
// header_tags_seo text in includes/boxes/header_tags_seo.php
define('BOX_HEADING_HEADER_TAGS_SEO', 'Header Tags SEO');
define('BOX_HEADER_TAGS_ADD_A_PAGE', 'Page Control');
define('BOX_HEADER_TAGS_FILL_TAGS', 'Fill Tags');
define('BOX_HEADER_TAGS_KEYWORDS', 'Keywords');
define('BOX_HEADER_TAGS_SILO', 'Silo Control');
define('BOX_HEADER_TAGS_SOCIAL', 'Social');
define('BOX_HEADER_TAGS_TEST', 'Test');
/*** End Header Tags SEO ***/



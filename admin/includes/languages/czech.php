<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Database Check 1.4 added -- http://addons.oscommerce.com/info/9087
  Manual Order Maker added -- http://addons.oscommerce.com/info/8334
  Alternative Administration System added -- http://addons.oscommerce.com/info/9135
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020  
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23
  
  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_ALL, array('en_US.UTF-8', 'en_US.UTF8', 'enu_usa'));
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'mm/dd/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate

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
define('HTML_PARAMS','dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'osCommerce Online Merchant Administration Tool');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrátor');
define('HEADER_TITLE_SUPPORT_SITE', 'Support Site');
define('HEADER_TITLE_ONLINE_CATALOG', 'Obchod');
define('HEADER_TITLE_ADMINISTRATION', 'Administrace');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurace');
define('BOX_CONFIGURATION_MYSTORE', 'Můj obchod');
define('BOX_CONFIGURATION_LOGGING', 'Přihlášení');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrátoři');
define('BOX_CONFIGURATION_STORE_LOGO', 'Logo Vašeho obchodu');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Zboží');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Vlastnosti zboží');
define('BOX_CATALOG_MANUFACTURERS', 'Výrobci/značky');
define('BOX_CATALOG_REVIEWS', 'Hodnocení');
define('BOX_CATALOG_SPECIALS', 'Slevy');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Očekávané zboží');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Zákazníci');
define('BOX_CUSTOMERS_CUSTOMERS', 'Zákazníci');

// orders box text in includes/boxes/orders.php
define('BOX_HEADING_ORDERS', 'Objednávky');
define('BOX_ORDERS_ORDERS', 'Objednávky');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Daně a oblasti');
define('BOX_TAXES_COUNTRIES', 'Země');
define('BOX_TAXES_ZONES', 'Kraje');
define('BOX_TAXES_GEO_ZONES', 'Daně - geogr. oblasti');
define('BOX_TAXES_TAX_CLASSES', 'Daňové skupiny');
define('BOX_TAXES_TAX_RATES', 'Hodnoty daní');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Zprávy');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Přehled zboží');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Prodané zboží');
define('BOX_REPORTS_ORDERS_TOTAL', 'Celkové prodeje dle zákazníků');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Nástroje');
define('BOX_TOOLS_ACTION_RECORDER', 'Nahrát akce');
define('BOX_TOOLS_BACKUP', 'Záloha databáze');
define('BOX_TOOLS_BANNER_MANAGER', 'Obsluha rekl. bannerů');
define('BOX_TOOLS_CACHE', 'Cache - správa');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definice jazyka');
define('BOX_TOOLS_MAIL', 'Zaslat Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Správa novinek');
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Security - práva na adresáře');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_VERSION_CHECK', 'Version Checker');
define('BOX_TOOLS_WHOS_ONLINE', 'Kdo je online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizace');
define('BOX_LOCALIZATION_CURRENCIES', 'Měny');
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyky');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Objednávky - status');

// javascript messages
define('JS_ERROR', 'Formulář obsahuje chyby!\nProsíme opravte:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Zadejte cenu nového zboží.\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Zboží potřebuje cenový prefix\n');

define('JS_PRODUCTS_NAME', '* Nové zboží nemá název.\n');
define('JS_PRODUCTS_DESCRIPTION', '* Nové zboží by mělo mít popis.\n');
define('JS_PRODUCTS_PRICE', '* Nové zboží nemá uvedenou cenu.\n');
define('JS_PRODUCTS_WEIGHT', '* Nové zboží nemá uvedenu váhu.\n');
define('JS_PRODUCTS_QUANTITY', '* Nové zboží nemá uvedené množství.\n');
define('JS_PRODUCTS_MODEL', '* Nové zboží nemá zadaný typ-model.\n');
define('JS_PRODUCTS_IMAGE', '* Zde má být vybrán obrázek.\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Novou cenu tohoto zboží je třeba nastavit.\n');

define('JS_GENDER', '* \'Pohlaví\' vyberte z variant.\n');
define('JS_FIRST_NAME', '* \'Jméno\' musí mít minimálně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' písmen.\n');
define('JS_LAST_NAME', '* \'Přijmení\' musí mít minimálně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' písmen.\n');
define('JS_DOB', '* \'Datum narození\' ve formátu: xx/xx/xxxx (den/měsíc/rok).\n');
define('JS_EMAIL_ADDRESS', '* \'E-Mail Adresa\' musí mít minimálně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' písmen.\n');
define('JS_ADDRESS', '* \'Ulice a číslo\' musí mít minimálně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' písmen.\n');
define('JS_POST_CODE', '* \'Směrovací číslo\' musí mít minimálně ' . ENTRY_POSTCODE_MIN_LENGTH . ' písmen.\n');
define('JS_CITY', '* \'Město\' musí mít minimálně ' . ENTRY_CITY_MIN_LENGTH . ' písmen.\n');
define('JS_STATE', '* \'Stát\' musí být vybrán.\n');
define('JS_STATE_SELECT', '-- Vyberte --');
define('JS_ZONE', '* \'Stát\' musí být vybrán z nabídky pro tuto zemi.');
define('JS_COUNTRY', '* \'Země\' hodnota musí být vybrána.\n');
define('JS_TELEPHONE', '* \'Telefonní číslo\' musí mít minimálně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' písmen.\n');
define('JS_PASSWORD', '* \'Heslo\' a \'Potvrzení\' musí mít minimálně ' . ENTRY_PASSWORD_MIN_LENGTH . ' písmen.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'číslo objednávky %s neexistuje!');

define('CATEGORY_PERSONAL', 'Osobní');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_COMPANY', 'Společnost');
define('CATEGORY_OPTIONS', 'Nastavení');

define('ENTRY_GENDER', 'Pohlaví:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">vyplňte</span>');
define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků</span>');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresa:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Email není správně!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Email již existuje!</span>');
define('ENTRY_COMPANY', 'Jméno společnosti:');
define('ENTRY_STREET_ADDRESS', 'Ulice:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků</span>');
define('ENTRY_SUBURB', 'Číslo:');
define('ENTRY_POST_CODE', 'Směrovací číslo:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_CITY_MIN_LENGTH . ' znaků</span>');
define('ENTRY_STATE', 'Stát:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">vyplnit</span>');
define('ENTRY_COUNTRY', 'Země:');
define('ENTRY_COUNTRY_ERROR', 'Vyberte z menu zemi.');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslo:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků</span>');
define('ENTRY_FAX_NUMBER', 'Faxové číslo:');
define('ENTRY_NEWSLETTER', 'Novinky - newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Objednat');
define('ENTRY_NEWSLETTER_NO', 'Zrušit');

// images
define('IMAGE_ANI_SEND_EMAIL', 'zasílání e-mailu');
define('IMAGE_BACK', 'Zpět');
define('IMAGE_BACKUP', 'Záloha');
define('IMAGE_CANCEL', 'Zrušit');
define('IMAGE_CONFIRM', 'Potvrdit');
define('IMAGE_COPY', 'Kopírovat');
define('IMAGE_COPY_TO', 'Kopírovat do');
define('IMAGE_DETAILS', 'Detaily');
define('IMAGE_DELETE', 'Smazat');
define('IMAGE_EDIT', 'Editovat');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_EXPORT', 'Export');
define('IMAGE_ICON_STATUS_GREEN', 'Activní');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Nastavit aktivní');
define('IMAGE_ICON_STATUS_RED', 'Neaktivní');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Nastavit neaktivní');
define('IMAGE_ICON_INFO', 'Informace');
define('IMAGE_INSERT', 'Vložit');
define('IMAGE_LOCK', 'Zamknout');
define('IMAGE_MODULE_INSTALL', 'Instalace modulu');
define('IMAGE_MODULE_REMOVE', 'Smazat modul');
define('IMAGE_MOVE', 'Přesunout');
define('IMAGE_NEW_BANNER', 'Nový banner');
define('IMAGE_NEW_CATEGORY', 'Nová kategorie');
define('IMAGE_NEW_COUNTRY', 'Nová země');
define('IMAGE_NEW_CURRENCY', 'Nová měna');
define('IMAGE_NEW_FILE', 'Nový soubor - file');
define('IMAGE_NEW_FOLDER', 'Nový adresář - složka');
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk');
define('IMAGE_NEW_NEWSLETTER', 'Nové novinky - newsletter');
define('IMAGE_NEW_PRODUCT', 'Nové zboží');
define('IMAGE_NEW_TAX_CLASS', 'Nová skupina daně');
define('IMAGE_NEW_TAX_RATE', 'Hodnota daně');
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová zóna');
define('IMAGE_NEW_ZONE', 'Nová zóna');
define('IMAGE_ORDERS', 'Objednávky');
define('IMAGE_ORDERS_INVOICE', 'Faktury');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Zobrazení');
define('IMAGE_RESTORE', 'Obnovit');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Uložit');
define('IMAGE_SEARCH', 'Hledat');
define('IMAGE_SELECT', 'Vybrat');
define('IMAGE_SEND', 'Zaslat');
define('IMAGE_SEND_EMAIL', 'Zaslat E-mail');
define('IMAGE_UNLOCK', 'Odemknout');
define('IMAGE_UPDATE', 'Změnit');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'Vypnuto');
define('ICON_CURRENT_FOLDER', 'Hlavní adresář');
define('ICON_DELETE', 'Smazat');
define('ICON_ERROR', 'Chyba');
define('ICON_FILE', 'Soubor');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Složka');
define('ICON_LOCKED', 'Zamknuto');
define('ICON_PREVIOUS_LEVEL', 'Předchozí úroveň');
define('ICON_PREVIEW', 'Zobrazit');
define('ICON_STATISTICS', 'Statistika');
define('ICON_SUCCESS', 'Povedlo se');
define('ICON_TICK', 'Zapnuto');
define('ICON_UNLOCKED', 'Odemknout');
define('ICON_WARNING', 'Upozornění');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Stránka %s z %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> banerů)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zemí)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zákazníku)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> měn)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Zobrazit <strong>%d</strong> od <strong>%d</strong> (do <strong>%d</strong> záznamů)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> jazyků)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> výrobců)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> @-novinek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> stavů objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží v akci)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových skupin)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových oblastí)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daní)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zón)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'základní - default');
define('TEXT_SET_DEFAULT', 'nastavit jako základní');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('TEXT_CACHE_CATEGORIES', 'kategorie');
define('TEXT_CACHE_MANUFACTURERS', 'výrobci - značky');
define('TEXT_CACHE_ALSO_PURCHASED', 'také koupili -modul');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Cíl není definován.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: Cíl není zapisovatelný.');
define('ERROR_FILE_NOT_SAVED', 'Chyba: Soubor se neuložil.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: tento typ souboru není povolen.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Povedlo se: soubor se správně nahrál.');
define('WARNING_NO_FILE_UPLOADED', 'Chyba: No file uploaded.');

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION', '<p>Content Width can be 12 or less per column per row.</p><p>12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.</p><p>Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on).</p>');
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Definition for SEO Header Tags Reloaded
  define('BOX_CUSTOMERS_ORDERS', 'Objednávky');
  define('PLACEHOLDER_COMMA_SEPARATION', 'Must, Be, Comma, Separated');
// BOF Order Maker
  define('IMAGE_CREATE_ORDER', 'Vytvořit');
  define('BOX_CUSTOMERS_CREATE_ORDER', 'Vytvořit objednávku');
  define('IMAGE_DETAIL', 'Details');
  define('TEXT_INFO_CUSTOMER_SERVICE_ID', 'Vytvořeno:');
  
// Alternative Administration System
  define('BOX_HEADING_AAS','A.A.S.'); 
  define('BOX_AAS_ACCESS_AAS','Access AAS'); 
  define('BOX_AAS_SUPPORT','Support');
  define('BOX_AAS_DISCUSSION_BOARD','Discussion Board'); 
  define('BOX_AAS_DONATIONS','Make a Donation');  
// Database Check Tool
  define('BOX_TOOLS_DATABASE_CHECK', 'Database Check');
// CCGV
  define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons');
  define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue');
  define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher');
  define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent');
  define('BOX_COUPON_ADMIN','Kupon Admin');
  define('IMAGE_RELEASE', 'Redeem Gift Voucher');
  define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> gift vouchers)');
  define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> coupons)');
  define('TEXT_VALID_PRODUCTS_LIST', 'Zboží - seznam');
  define('TEXT_VALID_PRODUCTS_ID', 'Zboží ID');
  define('TEXT_VALID_PRODUCTS_NAME', 'Název zboží');
  define('TEXT_VALID_PRODUCTS_MODEL', 'Zboží - model Products Model');
  define('TEXT_VALID_CATEGORIES_LIST', 'Kategorie - seznam');
  define('TEXT_VALID_CATEGORIES_ID', 'Kategorie ID');
  define('TEXT_VALID_CATEGORIES_NAME', 'Kategorie název');  
// Mail Manager
  define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager');
  define('BOX_MM_BULKMAIL', 'BulkMail Manager');
  define('BOX_MM_TEMPLATES', 'Template Manager');
  define('BOX_MM_EMAIL', 'zaslat e-mail');
  define('BOX_MM_RESPONSEMAIL', 'Response Mail');
  define('BOX_TOOLS_MAIL_MANAGER', 'Mail Manager');

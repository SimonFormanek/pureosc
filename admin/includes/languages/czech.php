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
//setlocale(LC_ALL, array('en_US.UTF-8', 'en_US.UTF8', 'enu_usa')); //pure:todo LC_ALL error?
@setlocale(LC_ALL, 'cs_CZ.UTF-8');
define('DATE_FORMAT_SHORT', '%d.%m.%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y',true); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', 'cs',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization pure:todo
define('JQUERY_DATEPICKER_FORMAT', 'mm.dd.yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate




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
define('HTML_PARAMS','dir="ltr" lang="cs"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', 'osCommerce Online Merchant Administration Tool',true);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrátor',true);
define('HEADER_TITLE_SUPPORT_SITE', 'Support Site',true);
define('HEADER_TITLE_ONLINE_CATALOG', 'Obchod',true);
define('HEADER_TITLE_ADMINISTRATION', 'Administrace',true);

// text for gender
define('MALE', 'Muž',true);
define('FEMALE', 'Žena',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy',true);

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurace',true);
define('BOX_CONFIGURATION_MYSTORE', 'Můj obchod',true);
define('BOX_CONFIGURATION_LOGGING', 'Přihlášení',true);
define('BOX_CONFIGURATION_CACHE', 'Cache',true);
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrátoři',true);
define('BOX_CONFIGURATION_STORE_LOGO', 'Logo Vašeho obchodu',true);

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly',true);

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorie/Zboží',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Vlastnosti zboží',true);
define('BOX_CATALOG_MANUFACTURERS', 'Výrobci/značky',true);
define('BOX_CATALOG_REVIEWS', 'Hodnocení',true);
define('BOX_CATALOG_SPECIALS', 'Slevy',true);
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Očekávané zboží',true);

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Zákazníci',true);
define('BOX_CUSTOMERS_CUSTOMERS', 'Zákazníci',true);

// orders box text in includes/boxes/orders.php
define('BOX_HEADING_ORDERS', 'Objednávky',true);
define('BOX_ORDERS_ORDERS', 'Objednávky',true);

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Daně a oblasti',true);
define('BOX_TAXES_COUNTRIES', 'Země',true);
define('BOX_TAXES_ZONES', 'Kraje',true);
define('BOX_TAXES_GEO_ZONES', 'Daně - geogr. oblasti',true);
define('BOX_TAXES_TAX_CLASSES', 'Daňové skupiny',true);
define('BOX_TAXES_TAX_RATES', 'Hodnoty daní',true);

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Zprávy',true);
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Přehled zboží',true);
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Prodané zboží',true);
define('BOX_REPORTS_ORDERS_TOTAL', 'Celkové prodeje dle zákazníků',true);

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Nástroje',true);
define('BOX_TOOLS_ACTION_RECORDER', 'Nahrát akce',true);
define('BOX_TOOLS_BACKUP', 'Záloha databáze',true);
define('BOX_TOOLS_BANNER_MANAGER', 'Obsluha rekl. bannerů',true);
define('BOX_TOOLS_CACHE', 'Cache - správa',true);
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definice jazyka',true);
define('BOX_TOOLS_MAIL', 'Zaslat Email',true);
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Správa novinek',true);
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Security - práva na adresáře',true);
define('BOX_TOOLS_SERVER_INFO', 'Server Info',true);
define('BOX_TOOLS_VERSION_CHECK', 'Version Checker',true);
define('BOX_TOOLS_WHOS_ONLINE', 'Kdo je online',true);

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizace',true);
define('BOX_LOCALIZATION_CURRENCIES', 'Měny',true);
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyky',true);
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Objednávky - status',true);

// BOF: Information Pages Unlimited
// localizaion box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Info manager');
// EOF: Information Pages Unlimited

// javascript messages
define('JS_ERROR', 'Formulář obsahuje chyby!\nProsíme opravte:\n\n',true);

define('JS_OPTIONS_VALUE_PRICE', '* Zadejte cenu nového zboží.\n',true);
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Zboží potřebuje cenový prefix\n',true);

define('JS_PRODUCTS_NAME', '* Nové zboží nemá název.\n',true);
define('JS_PRODUCTS_DESCRIPTION', '* Nové zboží by mělo mít popis.\n',true);
define('JS_PRODUCTS_PRICE', '* Nové zboží nemá uvedenou cenu.\n',true);
define('JS_PRODUCTS_WEIGHT', '* Nové zboží nemá uvedenu váhu.\n',true);
define('JS_PRODUCTS_QUANTITY', '* Nové zboží nemá uvedené množství.\n',true);
define('JS_PRODUCTS_MODEL', '* Nové zboží nemá zadaný typ-model.\n',true);
define('JS_PRODUCTS_IMAGE', '* Zde má být vybrán obrázek.\n',true);

define('JS_SPECIALS_PRODUCTS_PRICE', '* Novou cenu tohoto zboží je třeba nastavit.\n',true);

define('JS_GENDER', '* \'Pohlaví\' vyberte z variant.\n',true);
define('JS_FIRST_NAME', '* \'Jméno\' musí mít minimálně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' písmen.\n',true);
define('JS_LAST_NAME', '* \'Přijmení\' musí mít minimálně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' písmen.\n',true);
define('JS_DOB', '* \'Datum narození\' ve formátu: xx/xx/xxxx (den/měsíc/rok).\n',true);
define('JS_EMAIL_ADDRESS', '* \'E-Mail Adresa\' musí mít minimálně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' písmen.\n',true);
define('JS_ADDRESS', '* \'Ulice a číslo\' musí mít minimálně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' písmen.\n',true);
define('JS_POST_CODE', '* \'Směrovací číslo\' musí mít minimálně ' . ENTRY_POSTCODE_MIN_LENGTH . ' písmen.\n',true);
define('JS_CITY', '* \'Město\' musí mít minimálně ' . ENTRY_CITY_MIN_LENGTH . ' písmen.\n',true);
define('JS_STATE', '* \'Stát\' musí být vybrán.\n',true);
define('JS_STATE_SELECT', '-- Vyberte --',true);
define('JS_ZONE', '* \'Stát\' musí být vybrán z nabídky pro tuto zemi.',true);
define('JS_COUNTRY', '* \'Země\' hodnota musí být vybrána.\n',true);
define('JS_TELEPHONE', '* \'Telefonní číslo\' musí mít minimálně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' písmen.\n',true);
define('JS_PASSWORD', '* \'Heslo\' a \'Potvrzení\' musí mít minimálně ' . ENTRY_PASSWORD_MIN_LENGTH . ' písmen.\n',true);

define('JS_ORDER_DOES_NOT_EXIST', 'číslo objednávky %s neexistuje!',true);

define('CATEGORY_PERSONAL', 'Osobní',true);
define('CATEGORY_ADDRESS', 'Adresa',true);
define('CATEGORY_CONTACT', 'Kontakt',true);
define('CATEGORY_COMPANY', 'Společnost',true);
define('CATEGORY_OPTIONS', 'Nastavení',true);

define('ENTRY_GENDER', 'Pohlaví:',true);
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">vyplňte</span>',true);
define('ENTRY_FIRST_NAME', 'Jméno:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_LAST_NAME', 'Příjmení:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>',true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresa:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Email není správně!</span>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Email již existuje!</span>',true);
define('ENTRY_COMPANY', 'Jméno společnosti:',true);
define('ENTRY_STREET_ADDRESS', 'Ulice:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_SUBURB', 'Číslo:',true);
define('ENTRY_POST_CODE', 'Směrovací číslo:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_CITY', 'Město:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_CITY_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_STATE', 'Stát:',true);
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">vyplnit</span>',true);
define('ENTRY_COUNTRY', 'Země:',true);
define('ENTRY_COUNTRY_ERROR', 'Vyberte z menu zemi.',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telefonní číslo:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min. ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků</span>',true);
define('ENTRY_FAX_NUMBER', 'Faxové číslo:',true);
define('ENTRY_NEWSLETTER', 'Novinky - newsletter:',true);
define('ENTRY_NEWSLETTER_YES', 'Objednat',true);
define('ENTRY_NEWSLETTER_NO', 'Zrušit',true);

// images
define('IMAGE_ANI_SEND_EMAIL', 'zasílání e-mailu',true);
define('IMAGE_BACK', 'Zpět',true);
define('IMAGE_BACKUP', 'Záloha',true);
define('IMAGE_CANCEL', 'Zrušit',true);
define('IMAGE_CONFIRM', 'Potvrdit',true);
define('IMAGE_COPY', 'Kopírovat',true);
define('IMAGE_COPY_TO', 'Kopírovat do',true);
define('IMAGE_DETAILS', 'Detaily',true);
define('IMAGE_DELETE', 'Smazat',true);
define('IMAGE_EDIT', 'Editovat',true);
define('IMAGE_EMAIL', 'Email',true);
define('IMAGE_EXPORT', 'Export',true);
define('IMAGE_ICON_STATUS_GREEN', 'Activní',true);
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Nastavit aktivní',true);
define('IMAGE_ICON_STATUS_RED', 'Neaktivní',true);
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Nastavit neaktivní',true);
define('IMAGE_ICON_INFO', 'Informace',true);
define('IMAGE_INSERT', 'Vložit',true);
define('IMAGE_LOCK', 'Zamknout',true);
define('IMAGE_MODULE_INSTALL', 'Instalace modulu',true);
define('IMAGE_MODULE_REMOVE', 'Smazat modul',true);
define('IMAGE_MOVE', 'Přesunout',true);
define('IMAGE_NEW_BANNER', 'Nový banner',true);
define('IMAGE_NEW_CATEGORY', 'Nová kategorie',true);
define('IMAGE_NEW_COUNTRY', 'Nová země',true);
define('IMAGE_NEW_CURRENCY', 'Nová měna',true);
define('IMAGE_NEW_FILE', 'Nový soubor - file',true);
define('IMAGE_NEW_FOLDER', 'Nový adresář - složka',true);
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk',true);
define('IMAGE_NEW_NEWSLETTER', 'Nové novinky - newsletter',true);
define('IMAGE_NEW_PRODUCT', 'Nové zboží',true);
define('IMAGE_NEW_TAX_CLASS', 'Nová skupina daně',true);
define('IMAGE_NEW_TAX_RATE', 'Hodnota daně',true);
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová zóna',true);
define('IMAGE_NEW_ZONE', 'Nová zóna',true);
define('IMAGE_ORDERS', 'Objednávky',true);
define('IMAGE_ORDERS_INVOICE', 'Faktury',true);
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip',true);
define('IMAGE_PREVIEW', 'Zobrazení',true);
define('IMAGE_RESTORE', 'Obnovit',true);
define('IMAGE_RESET', 'Reset',true);
define('IMAGE_SAVE', 'Uložit',true);
define('IMAGE_SEARCH', 'Hledat',true);
define('IMAGE_SELECT', 'Vybrat',true);
define('IMAGE_SEND', 'Zaslat',true);
define('IMAGE_SEND_EMAIL', 'Zaslat E-mail',true);
define('IMAGE_UNLOCK', 'Odemknout',true);
define('IMAGE_UPDATE', 'Změnit',true);
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate',true);
define('IMAGE_UPLOAD', 'Upload',true);

define('ICON_CROSS', 'Vypnuto',true);
define('ICON_CURRENT_FOLDER', 'Hlavní adresář',true);
define('ICON_DELETE', 'Smazat',true);
define('ICON_ERROR', 'Chyba',true);
define('ICON_FILE', 'Soubor',true);
define('ICON_FILE_DOWNLOAD', 'Download',true);
define('ICON_FOLDER', 'Složka',true);
define('ICON_LOCKED', 'Zamknuto',true);
define('ICON_PREVIOUS_LEVEL', 'Předchozí úroveň',true);
define('ICON_PREVIEW', 'Zobrazit',true);
define('ICON_STATISTICS', 'Statistika',true);
define('ICON_SUCCESS', 'Povedlo se',true);
define('ICON_TICK', 'Zapnuto',true);
define('ICON_UNLOCKED', 'Odemknout',true);
define('ICON_WARNING', 'Upozornění',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Stránka %s z %d',true);
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> banerů)',true);
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zemí)',true);
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zákazníku)',true);
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> měn)',true);
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Zobrazit <strong>%d</strong> od <strong>%d</strong> (do <strong>%d</strong> záznamů)',true);
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> jazyků)',true);
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> výrobců)',true);
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> @-novinek)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> objednávek)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> stavů objednávek)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> products expected)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> product reviews)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zboží v akci)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových skupin)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daňových oblastí)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> daní)',true);
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazit <b>%d</b> - <b>%d</b> (z <b>%d</b> zón)',true);

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;',true);
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;',true);

define('TEXT_DEFAULT', 'základní - default',true);
define('TEXT_SET_DEFAULT', 'nastavit jako základní',true);
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>',true);

define('TEXT_CACHE_CATEGORIES', 'kategorie',true);
define('TEXT_CACHE_MANUFACTURERS', 'výrobci - značky',true);
define('TEXT_CACHE_ALSO_PURCHASED', 'také koupili -modul',true);

define('TEXT_NONE', '--none--',true);
define('TEXT_TOP', 'Top',true);

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Cíl není definován.',true);
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: Cíl není zapisovatelný.',true);
define('ERROR_FILE_NOT_SAVED', 'Chyba: Soubor se neuložil.',true);
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: tento typ souboru není povolen.',true);
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Povedlo se: soubor se správně nahrál.',true);
define('WARNING_NO_FILE_UPLOADED', 'Chyba: No file uploaded.',true);

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION', '<p>Content Width can be 12 or less per column per row.</p><p>12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.</p><p>Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on).</p>',true);
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Definition for SEO Header Tags Reloaded
  define('BOX_CUSTOMERS_ORDERS', 'Objednávky',true);
  define('PLACEHOLDER_COMMA_SEPARATION', 'Must, Be, Comma, Separated',true);
// BOF Order Maker
  define('IMAGE_CREATE_ORDER', 'Vytvořit',true);
  define('BOX_CUSTOMERS_CREATE_ORDER', 'Vytvořit objednávku',true);
  define('IMAGE_DETAIL', 'Details',true);
  define('TEXT_INFO_CUSTOMER_SERVICE_ID', 'Vytvořeno:',true);
  
// Alternative Administration System
  define('BOX_HEADING_AAS','A.A.S.',true); 
  define('BOX_AAS_ACCESS_AAS','Access AAS',true); 
  define('BOX_AAS_SUPPORT','Support',true);
  define('BOX_AAS_DISCUSSION_BOARD','Discussion Board',true); 
  define('BOX_AAS_DONATIONS','Make a Donation',true);  
// Database Check Tool
  define('BOX_TOOLS_DATABASE_CHECK', 'Database Check',true);
// CCGV
  define('BOX_HEADING_GV_ADMIN', 'Vouchers/Coupons',true);
  define('BOX_GV_ADMIN_QUEUE', 'Gift Voucher Queue',true);
  define('BOX_GV_ADMIN_MAIL', 'Mail Gift Voucher',true);
  define('BOX_GV_ADMIN_SENT', 'Gift Vouchers sent',true);
  define('BOX_COUPON_ADMIN','Kupon Admin',true);
  define('IMAGE_RELEASE', 'Redeem Gift Voucher',true);
  define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> gift vouchers)',true);
  define('TEXT_DISPLAY_NUMBER_OF_COUPONS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> coupons)',true);
  define('TEXT_VALID_PRODUCTS_LIST', 'Zboží - seznam',true);
  define('TEXT_VALID_PRODUCTS_ID', 'Zboží ID',true);
  define('TEXT_VALID_PRODUCTS_NAME', 'Název zboží',true);
  define('TEXT_VALID_PRODUCTS_MODEL', 'Zboží - model Products Model',true);
  define('TEXT_VALID_CATEGORIES_LIST', 'Kategorie - seznam',true);
  define('TEXT_VALID_CATEGORIES_ID', 'Kategorie ID',true);
  define('TEXT_VALID_CATEGORIES_NAME', 'Kategorie název',true);  
// Mail Manager
  define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager',true);
  define('BOX_MM_BULKMAIL', 'BulkMail Manager',true);
  define('BOX_MM_TEMPLATES', 'Template Manager',true);
  define('BOX_MM_EMAIL', 'zaslat e-mail',true);
  define('BOX_MM_RESPONSEMAIL', 'Response Mail',true);
  define('BOX_TOOLS_MAIL_MANAGER', 'Mail Manager',true);
// BOF Order Maker
define('TABLE_HEADING_EDIT_ORDERS', 'To modify the order',true);
define('TEXT_IMAGE_CREATE','Create Order',true);
define('TEXT_INFO_CUSTOMER_SERVICE_ID','Entered by:',true);
define('IMAGE_CREATE_ORDER', 'Create New Order',true);
define('BOX_CUSTOMERS_CREATE_ORDER', 'Create Order',true);
// EOF Order Maker
// BOF Create Account 
define('BOX_CUSTOMERS_CREATE_ACCOUNT', 'Create Customer',true);
define('IMAGE_CONTINUE', 'Continue',true);
// EOF Create Account
//VAT number
define('ENTRY_VAT_NUMBER', 'DIČ:',true);

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

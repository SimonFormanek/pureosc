<?php
/*
  $Id: english.php,v 1.106 2003/06/20 00:18:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_ALL, 'Slovak_Slovak.1250');
define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%d. %m. %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

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
define('HTML_PARAMS','dir="ltr" lang="sk"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrácia');
define('HEADER_TITLE_SUPPORT_SITE', 'Stránka podpory');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online katalóg');
define('HEADER_TITLE_ADMINISTRATION', 'Administrácia');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd.mm.rrrr');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfigurácia');
define('BOX_CONFIGURATION_MYSTORE', 'Môj obchod');
define('BOX_CONFIGURATION_LOGGING', 'Logovanie');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administrátori');
define('BOX_CONFIGURATION_STORE_LOGO', 'Obchod Logo');


// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduly');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalóg');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategórie/Produkty');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atribúty produktov');
define('BOX_CATALOG_MANUFACTURERS', 'Výrobcovia');
define('BOX_CATALOG_REVIEWS', 'Komentáre');
define('BOX_CATALOG_SPECIALS', 'Zľavy');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Očakávané produkty');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Zákazníci');
define('BOX_CUSTOMERS_CUSTOMERS', 'Zákazníci');

// 2.3.4 changes bof 
//define('BOX_CUSTOMERS_ORDERS', 'Objednávky');

// orders box text in includes/boxes/orders.php 
define('BOX_HEADING_ORDERS', 'Objednávky'); 
define('BOX_ORDERS_ORDERS', 'Objednávky'); 
// 2.3.4 changes eof 

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Oblasti / Dane');
define('BOX_TAXES_COUNTRIES', 'Štáty');
define('BOX_TAXES_ZONES', 'Zóny');
define('BOX_TAXES_GEO_ZONES', 'Daňové zóny');
define('BOX_TAXES_TAX_CLASSES', 'Daňové skupiny');
define('BOX_TAXES_TAX_RATES', 'Daňové hodnoty');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Zápisy');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Zobrazené produkty');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Kúpené produkty');
define('BOX_REPORTS_ORDERS_TOTAL', 'Všetky objednávky zákazníkov');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Nástroje');
define('BOX_TOOLS_ACTION_RECORDER', 'Záznamník akcií');
define('BOX_TOOLS_BACKUP', 'Záloha databázy');
define('BOX_TOOLS_BANNER_MANAGER', 'Manažér bannerov');
define('BOX_TOOLS_CACHE', 'Správa Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Výber jazykov');
define('BOX_TOOLS_MAIL', 'Poslať e-mail');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Manažér noviniek');
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Bezpečnosť Oprávnenie pre adresár');
define('BOX_TOOLS_SERVER_INFO', 'Info o serveri');
define('BOX_TOOLS_VERSION_CHECK', 'Verzia Checker');
define('BOX_TOOLS_WHOS_ONLINE', 'Kto je Online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalizácia');
define('BOX_LOCALIZATION_CURRENCIES', 'Meny');
define('BOX_LOCALIZATION_LANGUAGES', 'Jazyky');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Stav objednávok');

// javascript messages
define('JS_ERROR', 'Pri spracovaní vášho formulára nastali chyby!\nSpravte prosím nasledovné opravy:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Atribút nového produktu vyžaduje hodnotu\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Atribút nového produktu vyžaduje cenové označenie\n');

define('JS_PRODUCTS_NAME', '* Nový produkt musí mať názov\n');
define('JS_PRODUCTS_DESCRIPTION', '* Nový produkt musí mať popis\n');
define('JS_PRODUCTS_PRICE', '* Nový produkt musí mať cenovú hodnotu\n');
define('JS_PRODUCTS_WEIGHT', '* Nový produkt musí mať hmotnostnú hodnotu\n');
define('JS_PRODUCTS_QUANTITY', '* Nový produkt musí mať udané množstvo\n');
define('JS_PRODUCTS_MODEL', '* Nový produkt musí mať udaný typ\n');
define('JS_PRODUCTS_IMAGE', '* Nový produkt musí mať obrázok\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Pre tento produkt musí byť udaná nová cena\n');

define('JS_GENDER', '* \'Pohlavie\' musí byť vybrané.\n');
define('JS_FIRST_NAME', '* \'Krstné meno\' musí mať minimálne ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znakov.\n');
define('JS_LAST_NAME', '* \'Priezvisko\' musí mať minimálne ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znakov.\n');
define('JS_DOB', '* \'Dátum narodenia\' musí byť v tvare: xx.xx.xxxx (deň.mesiac.rok).\n');
define('JS_EMAIL_ADDRESS', '* \'E-Mailová adresa\' musí mať minimálne ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znakov.\n');
define('JS_ADDRESS', '* \'Ulica\' musí mať minimálne ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znakov.\n');
define('JS_POST_CODE', '* \'PSČ\' musí mať minimálne ' . ENTRY_POSTCODE_MIN_LENGTH . ' znakov.\n');
define('JS_CITY', '* \'Mesto\' musí mať minimálne ' . ENTRY_CITY_MIN_LENGTH . ' znakov.\n');
define('JS_STATE', '* \'Štát\' musí byť vybraný.\n');
define('JS_STATE_SELECT', '-- Vyberte si --');
define('JS_ZONE', '* \'Štát\' musí byť vybraný zo zoznamu pre túto krajinu.');
define('JS_COUNTRY', '* \'Krajina\' musí byť vybraná.\n');
define('JS_TELEPHONE', '* \'Telefónne číslo\' musí mať minimálne ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znakov.\n');
define('JS_PASSWORD', '* \'Heslo\' a \'Potvrdenie hesla\' musia mať minimálne ' . ENTRY_PASSWORD_MIN_LENGTH . ' znakov.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Číslo objednávky %s neexistuje!');

define('CATEGORY_PERSONAL', 'Vlastná');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Možnosti');

define('ENTRY_GENDER', 'Pohlavie:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">vyžadované</span>');
define('ENTRY_FIRST_NAME', 'Krstné Meno:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znakov</span>');
define('ENTRY_LAST_NAME', 'Priezvisko:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znakov</span>');
define('ENTRY_DATE_OF_BIRTH', 'Dátum narodenia:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(napr. 21.05.1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail adresa:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znakov</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Emailová adresa nemá správny tvar!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Tento e-mail už existuje!</span>');
define('ENTRY_COMPANY', 'Názov firmy:');
define('ENTRY_STREET_ADDRESS', 'Ulica:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znakov</span>');
define('ENTRY_SUBURB', 'Predmestie:');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znakov</span>');
define('ENTRY_CITY', 'Mesto:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' znakov</span>');
define('ENTRY_STATE', 'Štát:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">vyžadované</span>');
define('ENTRY_COUNTRY', 'Štát:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefónne číslo:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znakov</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_NEWSLETTER', 'Odber správ:');
define('ENTRY_NEWSLETTER_YES', 'Prihlásený');
define('ENTRY_NEWSLETTER_NO', 'Odhlásený');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Posielam e-mail');
define('IMAGE_BACK', 'Späť');
define('IMAGE_BACKUP', 'Zálohovanie');
define('IMAGE_CANCEL', 'Zrušiť');
define('IMAGE_CONFIRM', 'Potvrdiť');
define('IMAGE_COPY', 'Kopírovať');
define('IMAGE_COPY_TO', 'Kopírovať do');
define('IMAGE_DETAILS', 'Detaily');
define('IMAGE_DELETE', 'Odstrániť');
define('IMAGE_EDIT', 'Upraviť');
define('IMAGE_EMAIL', 'E-mail');
define('IMAGE_EXPORT', 'Export');
define('IMAGE_ICON_STATUS_GREEN', 'Aktívny');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Nastaviť ako Aktívny');
define('IMAGE_ICON_STATUS_RED', 'Neaktívny');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Aktivovať');
define('IMAGE_ICON_INFO', 'Informácie');
define('IMAGE_INSERT', 'Vložiť');
define('IMAGE_LOCK', 'Uzamknúť');
define('IMAGE_MODULE_INSTALL', 'Inštalovať modul');
define('IMAGE_MODULE_REMOVE', 'Odstrániť modul');
define('IMAGE_MOVE', 'Premiestniť');
define('IMAGE_NEW_BANNER', 'Nový Banner');
define('IMAGE_NEW_CATEGORY', 'Nová kategória');
define('IMAGE_NEW_COUNTRY', 'Nová krajina');
define('IMAGE_NEW_CURRENCY', 'Nová mena');
define('IMAGE_NEW_FILE', 'Nový súbor');
define('IMAGE_NEW_FOLDER', 'Nový priečinok');
define('IMAGE_NEW_LANGUAGE', 'Nový jazyk');
define('IMAGE_NEW_NEWSLETTER', 'Nový e-mail pre odber správ');
define('IMAGE_NEW_PRODUCT', 'Nový produkt');
define('IMAGE_NEW_TAX_CLASS', 'Nová daňová trieda');
define('IMAGE_NEW_TAX_RATE', 'Nová daňová hodnota');
define('IMAGE_NEW_TAX_ZONE', 'Nová daňová zóna');
define('IMAGE_NEW_ZONE', 'Nová zóna');
define('IMAGE_ORDERS', 'Objednávky');
define('IMAGE_ORDERS_INVOICE', 'Účet');
define('IMAGE_ORDERS_PACKINGSLIP', 'Dodací list');
define('IMAGE_PREVIEW', 'Náhľad');
define('IMAGE_RESTORE', 'Obnoviť');
define('IMAGE_RESET', 'Zmazať');
define('IMAGE_SAVE', 'Uložiť');
define('IMAGE_SEARCH', 'Vyhľadať');
define('IMAGE_SELECT', 'Vybrať');
define('IMAGE_SEND', 'Poslať');
define('IMAGE_SEND_EMAIL', 'Poslať Email');
define('IMAGE_UNLOCK', 'Odomknúť');
define('IMAGE_UPDATE', 'Aktualizovať');
define('IMAGE_UPDATE_CURRENCIES', 'Aktualizovať kurz');
define('IMAGE_UPLOAD', 'Poslať');

define('ICON_CROSS', 'Neplatný');
define('ICON_CURRENT_FOLDER', 'Tento priečinok');
define('ICON_DELETE', 'Odstrániť');
define('ICON_ERROR', 'Chyba');
define('ICON_FILE', 'Súbor');
define('ICON_FILE_DOWNLOAD', 'Stiahnúť');
define('ICON_FOLDER', 'Priečinok');
define('ICON_LOCKED', 'Uzamknutý');
define('ICON_PREVIOUS_LEVEL', 'Predchádzajúca úroveň');
define('ICON_PREVIEW', 'Náhľad');
define('ICON_STATISTICS', 'Štatistiky');
define('ICON_SUCCESS', 'Úspešne');
define('ICON_TICK', 'Platný');
define('ICON_UNLOCKED', 'Odomknutý');
define('ICON_WARNING', 'Upozornenie');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Strana %s z %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> bannerov)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> krajín)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> zákazníkov)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> men)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Zobrazujem <strong>%d</strong> do <strong>%d</strong> (of <strong>%d</strong> záznamy)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> jazykov)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> výrobcov)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> odberov správ)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> objednávok)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> stavov objednávok)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> produktov)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> očakávaných produktov)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> komentárov)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> zliav)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> daňových skupín)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> daňových zón)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> daňových sadzieb)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Zobrazujem <b>%d</b> do <b>%d</b> (z <b>%d</b> zón)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'predvolený');
define('TEXT_SET_DEFAULT', 'Nastaviť ako predvolený');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Vyžadované</span>');


define('TEXT_CACHE_CATEGORIES', 'Box Kategórie');
define('TEXT_CACHE_MANUFACTURERS', 'Box Výrobcovia');
define('TEXT_CACHE_ALSO_PURCHASED', 'Tiež zakúpený modul');

define('TEXT_NONE', '--žiadny--');
define('TEXT_TOP', 'Domov');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Chyba: Cesta neexistuje.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Chyba: Cesta sa nedá zapísať.');
define('ERROR_FILE_NOT_SAVED', 'Chyba: Poslaný súbor nebol uložený.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Chyba: Typ poslaného súboru nie je povolený.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Súbor bol úspešne uložený.');
define('WARNING_NO_FILE_UPLOADED', 'Upozornenie: Žiadny súbor nebol poslaný.');
?>

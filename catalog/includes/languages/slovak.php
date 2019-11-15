<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
//@setlocale(LC_ALL, 'Slovak_Slovak.1250');
@setlocale(LC_ALL, 'sk_SK.UTF-8');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%d. %m. %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
//define('LANGUAGE_CURRENCY', 'SKK');
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="sk"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Vytvoriť účet');
define('HEADER_TITLE_MY_ACCOUNT', 'Môj účet');
define('HEADER_TITLE_CART_CONTENTS', 'Obsah košíka');
define('HEADER_TITLE_CHECKOUT', 'Pokladňa');
define('HEADER_TITLE_TOP', 'Domov');
define('HEADER_TITLE_CATALOG', 'Katalóg');
define('HEADER_TITLE_LOGOFF', 'Odhlásiť sa');
define('HEADER_TITLE_LOGIN', 'Prihlásiť sa');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'prístupov od');

// text for gender
define('MALE', 'Muž');
define('FEMALE', 'Žena');
define('MALE_ADDRESS', 'pán');
define('FEMALE_ADDRESS', 'pani');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd.mm.rrrr');
// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Informácie o dodávke');
define('CHECKOUT_BAR_PAYMENT', 'Informácie o platbe');
define('CHECKOUT_BAR_CONFIRMATION', 'Potvrdenie');
define('CHECKOUT_BAR_FINISHED', 'Dokončenie objednávky');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Vyberte si');
define('TYPE_BELOW', 'Napíšte');

// javascript messages
define('JS_ERROR', 'Vyskytly sa chyby pri spracovávaní vášho formulára.\n\nOpravte následujúce položky:\n\n');

define('JS_REVIEW_TEXT', '* \'Text komentára\' musí mať minimálne ' . REVIEW_TEXT_MIN_LENGTH . ' znakov.\n');
define('JS_REVIEW_RATING', '* Musíte produkt ohodnotiť.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Prosím vyberte spôsob platby pre vašu objednávku.\n');

define('JS_ERROR_SUBMITTED', 'Tento formulár už bol odoslaný. Stlačte Ok a počkajte na dokončenie procesu.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Prosím vyberte spôsob platby pre vašu objednávku.');

define('CATEGORY_COMPANY', 'Údaje o firme');
define('CATEGORY_PERSONAL', 'Vaše osobné údaje');
define('CATEGORY_ADDRESS', 'Vaša adresa');
define('CATEGORY_CONTACT', 'Vaše kontaktné informácie');
define('CATEGORY_OPTIONS', 'Možnosti');
define('CATEGORY_PASSWORD', 'Vaše heslo');

define('ENTRY_COMPANY', 'Meno firmy:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Pohlavie:');
define('ENTRY_GENDER_ERROR', 'Výber pohlavia.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Krstné meno:');
define('ENTRY_FIRST_NAME_ERROR', 'Krstné meno musí mať minimálne ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znakov.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Priezvisko:');
define('ENTRY_LAST_NAME_ERROR', 'Priezvisko musí mať minimálne ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znakov.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Dátum narodenia:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Dátum narodenia musí byť vo formáte: DD.MM.RRRR (napr. 21.05.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (napr. 21.05.1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Mail musí mať minimálne ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znakov.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Tvar vašej e-mailovej adresy je nesprávny. Opravte si ju prosím.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Vašu e-mailovú adresu už máme zaregistrovanú. Prihláste sa s ňou, alebo sa zaregistrujte s inou e-mailovou adresou.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Ulica:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Ulica musí mať minimálne ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znakov.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Predmestie:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', 'PSČ musí mať minimálne ' . ENTRY_POSTCODE_MIN_LENGTH . ' znakov.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Mesto:');
define('ENTRY_CITY_ERROR', 'Mesto musí mať minimálne ' . ENTRY_CITY_MIN_LENGTH . ' znakov.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Štát:');
define('ENTRY_STATE_ERROR', 'Štát musí mať minimálne ' . ENTRY_STATE_MIN_LENGTH . ' znakov.');
define('ENTRY_STATE_ERROR_SELECT', 'Vyberte prosím štát z rozbalovacieho menu.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Krajina:');
define('ENTRY_COUNTRY_ERROR', 'Vyberte prosím krajinu z rozbalovacieho menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefón:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefon musí mať minimálne ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znakov.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Novinky e-mailom:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Prihlásený');
define('ENTRY_NEWSLETTER_NO', 'Odhlásený');
define('ENTRY_PASSWORD', 'Heslo:');
define('ENTRY_PASSWORD_ERROR', 'Heslo musí mať minimálne ' . ENTRY_PASSWORD_MIN_LENGTH . ' znakov.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Potvrdenie hesla musí byť zhodné s vašim heslom.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Potvrdenie hesla:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuálne heslo:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Heslo musí mať minimálne ' . ENTRY_PASSWORD_MIN_LENGTH . ' znakov.');
define('ENTRY_PASSWORD_NEW', 'Nové heslo:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Nové heslo musí mať minimálne ' . ENTRY_PASSWORD_MIN_LENGTH . ' znakov.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Potvrdenie hesla musí byť zhodné s vašim novým heslom.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Povinné údaje');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Stránky:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazujem <b>%d</b> až <b>%d</b> (z <b>%d</b> produktov)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazujem <b>%d</b> až <b>%d</b> (z <b>%d</b> objednávok)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazujem <b>%d</b> až <b>%d</b> (z <b>%d</b> komentárov)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zobrazujem <b>%d</b> až <b>%d</b> (z <b>%d</b> nových produktov)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazujem <b>%d</b> až <b>%d</b> (z <b>%d</b> zliav)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Prvá strana');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Predošlá strana');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Následujúca strana');
define('PREVNEXT_TITLE_LAST_PAGE', 'Posledná strana');
define('PREVNEXT_TITLE_PAGE_NO', 'Strana %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Predošlá sada %d stránok');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Následujúca sada %d stránok');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRVÁ');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Predošlá]');
define('PREVNEXT_BUTTON_NEXT', '[Následujúca&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'POSLEDNÁ&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Pridať adresu');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresár');
define('IMAGE_BUTTON_BACK', 'Späť');
define('IMAGE_BUTTON_BUY_NOW', 'Kúpiť');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Zmena adresy');
define('IMAGE_BUTTON_CHECKOUT', 'Pokladňa');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Potvrdiť objednávku');
define('IMAGE_BUTTON_CONTINUE', 'Pokračovať');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Pokračovať v nákupe');
define('IMAGE_BUTTON_DELETE', 'Odstrániť');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Upraviť užívateľský účet');
define('IMAGE_BUTTON_HISTORY', 'História objednávok');
define('IMAGE_BUTTON_LOGIN', 'Prihlásiť sa');
define('IMAGE_BUTTON_IN_CART', 'Pridať do košíka');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Upozornenie');
define('IMAGE_BUTTON_QUICK_FIND', 'Rýchle hľadanie');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Odstrániť oznmámenia');
define('IMAGE_BUTTON_REVIEWS', 'Komentáre');
define('IMAGE_BUTTON_SEARCH', 'Hľadanie');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Možnosti dopravy');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Upozorniť priateľa');
define('IMAGE_BUTTON_UPDATE', 'Aktualizovať');
define('IMAGE_BUTTON_UPDATE_CART', 'Aktualizovať obsah košíka');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Napísať komentár');

define('SMALL_IMAGE_BUTTON_DELETE', 'Odstrániť');
define('SMALL_IMAGE_BUTTON_EDIT', 'Upraviť');
define('SMALL_IMAGE_BUTTON_VIEW', 'Zobraziť');

define('ICON_ARROW_RIGHT', 'viac');
define('ICON_CART', 'Do košíka');
define('ICON_ERROR', 'Chyba');
define('ICON_SUCCESS', 'Úspešne');
define('ICON_WARNING', 'Varovanie');

define('TEXT_GREETING_PERSONAL', 'Vitajte späť <span class="greetUser">%s</span>, zaujímajú vás <a href="%s"><u>naše novinky</u></a> v predaji?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Pokiaľ nie ste %s, <a href="%s"><u>prihláste sa prosím</u></a> pomocou vašich prihlasovacích údajov.</small>');
define('TEXT_GREETING_GUEST', 'Vitajte <span class="greetUser">Hosť!</span>, chcete sa <a href="%s"><u>zaregistrovať</u></a>? alebo si chcete <a href="%s"><u>vytvoriť účet</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Triediť produkty ');
define('TEXT_DESCENDINGLY', 'zostupne');
define('TEXT_ASCENDINGLY', 'vzostupne');
define('TEXT_BY', ' podľa ');

define('TEXT_REVIEW_BY', 'podľa %s');
define('TEXT_REVIEW_WORD_COUNT', '%s slov');
define('TEXT_REVIEW_RATING', 'Hodnotenie: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Dátum vloženia: %s');
define('TEXT_NO_REVIEWS', 'Momentálne tu nie sú žiadne komentáre.');

define('TEXT_NO_NEW_PRODUCTS', 'Momentálne tu nie sú žiadne produkty.');

define('TEXT_UNKNOWN_TAX_RATE', 'Nezistená daň');

define('TEXT_REQUIRED', '<span class="errorText">Vyžadované</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP CHYBA:</small> Nemožno zaslať mail cez špecifikovaný SMTP server. Prosím skontrolujte vaše nastavenia v php.ini a ak je nevýhnutné opravte nastavenia SMTP servera.</b></font>');
define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Dátum expirácie kreditnej karty je neplatný.<br>Skontrolujte ho a skúste to znova.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Zadané číslo kreditnej karty je neplatné.<br>Skontrolujte ho a skúste to znova.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Prvé štvorčíslie zadaného čísla kreditnej karty je: %s<br>Pokiaľ je toto číslo správne, tento typ kreditných kariet neprijímame.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br />Powered by <a href="http://www.shopwebshop.eu/osc_shop/catalog/" target="_blank">shopwebshop.eu</a>');
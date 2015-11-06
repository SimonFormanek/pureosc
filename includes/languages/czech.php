<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  SEO Header Tags Reloaded added -- http://addons.oscommerce.com/info/8864
  Credit Class, Gift Vouchers & Discount Coupons osC2.3.3.4 (CCGV) added -- http://addons.oscommerce.com/info/9020
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23
  
  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
@setlocale(LC_TIME, 'cs_CZ.UTF-8');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization pure:todo
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

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'CZK');

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="cs"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Založit účet');
define('HEADER_TITLE_MY_ACCOUNT', 'můj účet');
define('HEADER_TITLE_CART_CONTENTS', 'košík');
define('HEADER_TITLE_CHECKOUT', 'pokladna');
define('HEADER_TITLE_TOP', '<i class="glyphicon glyphicon-home"><span class="sr-only">shop-name.domain</span></i>');
define('HEADER_TITLE_CATALOG', 'Home');
define('HEADER_TITLE_LOGOFF', 'Odhlásit');
define('HEADER_TITLE_LOGIN', 'Přihlásit');

// text for gender
define('MALE', 'M<span class="hidden-xs">už</span>');
define('FEMALE', 'Ž<span class="hidden-xs">ena</span>');
define('MALE_ADDRESS', 'Pan');
define('FEMALE_ADDRESS', 'Paní');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Dodací podmínky');
define('CHECKOUT_BAR_PAYMENT', 'Fakturační adresa');
define('CHECKOUT_BAR_CONFIRMATION', 'Potvrdit');
define('CHECKOUT_BAR_FINISHED', 'Dokončeno!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'vyberte');
define('TYPE_BELOW', 'Napsat níže');

// javascript messages
define('JS_ERROR', 'Ve formuláři je chyba.\n\nOpravte následující:\n\n');

define('JS_REVIEW_TEXT', '* The \'Review Text\' musí mít nejméně ' . REVIEW_TEXT_MIN_LENGTH . ' znaků.\n');
define('JS_REVIEW_RATING', '* Přepočítat zboží\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Prosíme vyberte typ platby.\n');

define('JS_ERROR_SUBMITTED', 'Formulář může být odeslán. Zmáčkněte Ok a vyčkejte.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Vyberte způsob platby Vaší objednávky.');

define('CATEGORY_COMPANY', 'Společnost');
define('CATEGORY_PERSONAL', 'Osobní');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_OPTIONS', 'Nastavení');
define('CATEGORY_PASSWORD', 'Heslo');

define('ENTRY_COMPANY', 'Společnost:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Pohlaví:');
define('ENTRY_GENDER_ERROR', 'Vyberte pohlaví');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Jméno:');
define('ENTRY_FIRST_NAME_ERROR', 'Vaše jméno musí mít nejméně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Příjmení:');
define('ENTRY_LAST_NAME_ERROR', 'Vaše příjmení musí mít nejméně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Datum narození ve tvaru: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (např. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Mail musí mít nejméně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-Mail je špatně, opravte jej.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Váš E-Mail je již v databázi.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Ulice:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Ulice musí mít nejméně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'číslo:');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'PSČ:');
define('ENTRY_POST_CODE_ERROR', 'PSČ musí mít nejméně ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Město:');
define('ENTRY_CITY_ERROR', 'Město musí mít nejméně ' . ENTRY_CITY_MIN_LENGTH . ' znaků.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Stát:');
define('ENTRY_STATE_ERROR', 'Stát musí mít nejméně ' . ENTRY_STATE_MIN_LENGTH . ' znaků.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Země:');
define('ENTRY_COUNTRY_ERROR', 'Vyberte zemi v menu.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefonní číslo musí mít nejméně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Novinky:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Přihlásit k zasílání');
define('ENTRY_NEWSLETTER_NO', 'Odhlásit zasílání');
define('ENTRY_PASSWORD', 'Heslo:');
define('ENTRY_PASSWORD_ERROR', 'Vaše heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Hesla nejsou stejná.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Heslo znovu:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Původní heslo:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Vaše heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.');
define('ENTRY_PASSWORD_NEW', 'Nové heslo:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Vaše nové heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Hesla nejsou stejná.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Celkem stránek:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> produktů)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> objednávek)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> hodnocení)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> novinek)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> slev)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'První stránka');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Předchozí stránka');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Další stránka');
define('PREVNEXT_TITLE_LAST_PAGE', 'Poslední stránka');
define('PREVNEXT_TITLE_PAGE_NO', 'Stránka %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Předcházejících %d stránek');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Dalších %d stránek');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;první');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;předchozí]');
define('PREVNEXT_BUTTON_NEXT', '[další&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'poslední&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Přidat adresu');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresář');
define('IMAGE_BUTTON_BACK', 'Zpět');
define('IMAGE_BUTTON_BUY_NOW', 'objednat');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Změnit adresu');
define('IMAGE_BUTTON_CHECKOUT', 'Pokladna');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Potvrdit objednávku');
define('IMAGE_BUTTON_CONTINUE', 'pokračovat');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Pokračovat v nákupu');
define('IMAGE_BUTTON_DELETE', 'Smazat');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Upravit účet');
define('IMAGE_BUTTON_HISTORY', 'Historie objednávek');
define('IMAGE_BUTTON_LOGIN', 'přihlásit');
define('IMAGE_BUTTON_IN_CART', 'přidat do košíku');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Zpráva');
define('IMAGE_BUTTON_QUICK_FIND', 'Rychlé hledání');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Smazat zprávu');
define('IMAGE_BUTTON_REVIEWS', 'Hodnocení');
define('IMAGE_BUTTON_SEARCH', 'Hledat');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Doprava');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dejte vědět příteli');
define('IMAGE_BUTTON_UPDATE', 'obnovit');
define('IMAGE_BUTTON_UPDATE_CART', 'Obnovit košík');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Zapsat hodnocení');

define('SMALL_IMAGE_BUTTON_DELETE', 'Smazat');
define('SMALL_IMAGE_BUTTON_EDIT', 'Upravit');
define('SMALL_IMAGE_BUTTON_VIEW', 'Zobrazit');
define('SMALL_IMAGE_BUTTON_BUY', 'Koupit');

define('ICON_ARROW_RIGHT', 'dále');
define('ICON_CART', 'v košíku');
define('ICON_ERROR', 'chyba');
define('ICON_SUCCESS', 'správně');
define('ICON_WARNING', 'Pozor');

define('TEXT_GREETING_PERSONAL', 'Vítejte zpět <span class="greetUser">%s!</span> Chcete se podívat jaké máme <a href="%s"><u>novinky</u></a> od Vašeho posledního nákupu?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Pokud ne, %s, prosíme <a href="%s"><u>přihlaste se</u></a> na váš účet.</small>');
define('TEXT_GREETING_GUEST', 'Vítejte <span class="greetUser">Neznámý!</span> Chcete se  <a href="%s"><u>přihlásit</u></a>? nebo teprve <a href="%s"><u>zaregistrovat</u></a>?');

define('TEXT_SORT_PRODUCTS', 'seřadit');
define('TEXT_DESCENDINGLY', 'sestupně');
define('TEXT_ASCENDINGLY', 'vzestupně');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'od %s');
define('TEXT_REVIEW_WORD_COUNT', '%s slov');
define('TEXT_REVIEW_RATING', 'hodnocení: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'přidáno: %s');
define('TEXT_NO_REVIEWS', 'žádná nová hodnocení.');

define('TEXT_NO_NEW_PRODUCTS', 'žádné nové produkty.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate');

define('TEXT_REQUIRED', '<span class="errorText">je nutné</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.');

// category views
define('TEXT_VIEW', 'Zobrazit: ');
define('TEXT_VIEW_LIST', ' Seznam');
define('TEXT_VIEW_GRID', ' Grid');

// search placeholder
define('TEXT_SEARCH_PLACEHOLDER','Vyhledávání');

// message for required inputs
define('FORM_REQUIRED_INFORMATION', '<span class="glyphicon glyphicon-asterisk inputRequirement"></span> Důležité údaje');
define('FORM_REQUIRED_INPUT', '<span><span class="glyphicon glyphicon-asterisk form-control-feedback inputRequirement"></span></span>');

// reviews
define('REVIEWS_TEXT_RATED', 'Hodnoceno %s s <cite title="%s" itemprop="recenzent">%s</cite>');
define('REVIEWS_TEXT_AVERAGE', 'Hodnocení <span itemprop="počet">%s</span> recenzí %s');
define('REVIEWS_TEXT_TITLE', 'Co říkají naši zákazníci...');

// grid/list
define('TEXT_SORT_BY', 'Třídit podle ');
// moved from index
define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Název zboží');
define('TABLE_HEADING_MANUFACTURER', 'Výrobce');
define('TABLE_HEADING_QUANTITY', 'Množství');
define('TABLE_HEADING_PRICE', 'Cena');
define('TABLE_HEADING_WEIGHT', 'Váha');
define('TABLE_HEADING_BUY_NOW', 'Koupit');
//pure: removed define('TABLE_HEADING_LATEST_ADDED', 'Poslední zboží');
define('TABLE_HEADING_DATE_AVAILABLE','Nejnovější zboží');
define('TABLE_HEADING_CUSTOM_DATE','Podle data');
define('TABLE_HEADING_SORT_ORDER','Pořadí');

// product notifications
define('PRODUCT_SUBSCRIBED', '%s bylo přidána do vašeho seznamu');
define('PRODUCT_UNSUBSCRIBED', '%s bylo odebráno z vašeho seznamu');
define('PRODUCT_ADDED', '%s přidáno do vašeho košíku');
define('PRODUCT_REMOVED', '%s odebráno z vašeho košíku');

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION', '');

// sorting product_listing module
define('TEXT_SORT_BY', 'Třídit podle ');

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// SEO Header Tags Reloaded
  //header titles
define('HEADER_CART_CONTENTS', '<i class="glyphicon glyphicon-shopping-cart"></i> %s item(s) <span class="caret"></span>');
define('HEADER_CART_NO_CONTENTS', '<i class="glyphicon glyphicon-shopping-cart"></i> 0 items');
define('HEADER_ACCOUNT_LOGGED_OUT', '<i class="glyphicon glyphicon-user"></i><span class="hidden-sm"> Můj účet</span> <span class="caret"></span>');
define('HEADER_ACCOUNT_LOGGED_IN', '<i class="glyphicon glyphicon-user"></i> %s <span class="caret"></span>');
define('HEADER_SITE_SETTINGS', '<i class="glyphicon glyphicon-cog"></i><span class="hidden-sm"> Site Settings</span> <span class="caret"></span>');
define('HEADER_TOGGLE_NAV', 'Toggle Navigation');
define('HEADER_HOME', '<i class="glyphicon glyphicon-home"></i><span class="hidden-sm"> Home</span>');
define('HEADER_WHATS_NEW', '<i class="glyphicon glyphicon-certificate"></i><span class="hidden-sm">  Nové zboží</span>');
define('HEADER_SPECIALS', '<i class="glyphicon glyphicon-fire"></i><span class="hidden-sm"> Speciální nabídky</span>');
define('HEADER_REVIEWS', '<i class="glyphicon glyphicon-comment"></i><span class="hidden-sm"> Hodnocení</span>');
// header dropdowns
define('HEADER_ACCOUNT_LOGIN', '<i class="glyphicon glyphicon-log-in"></i> Přihlásit');
define('HEADER_ACCOUNT_LOGOFF', '<i class="glyphicon glyphicon-log-out"></i> Odhlásit');
define('HEADER_ACCOUNT', 'Můj účet');
define('HEADER_ACCOUNT_HISTORY', 'Moje objednávky');
define('HEADER_ACCOUNT_EDIT', 'Moje údaje');
define('HEADER_ACCOUNT_ADDRESS_BOOK', 'Můj Adresář');
define('HEADER_ACCOUNT_PASSWORD', 'Heslo');
define('HEADER_ACCOUNT_REGISTER', '<i class="glyphicon glyphicon-pencil"></i> Registrace');
define('HEADER_CART_HAS_CONTENTS', '%s item(s), %s');
define('HEADER_CART_VIEW_CART', 'Košík');
define('HEADER_CART_CHECKOUT', '<i class="glyphicon glyphicon-chevron-right"></i> Pokladna');
define('USER_LOCALIZATION', '<abbr title="Vybraný jazyk">L:</abbr> %s <abbr title="Vybraná měna">C:</abbr> %s');

// CCGV
  define('VOUCHER_BALANCE', 'Voucher Balance');
  define('BOX_HEADING_GIFT_VOUCHER', 'Dárkový poukaz účet');
  define('GV_FAQ', 'Gift Voucher FAQ');
  define('IMAGE_REDEEM_VOUCHER', 'Redeem');
  define('ERROR_REDEEMED_AMOUNT', 'Congratulations, you have redeemed ');
  define('ERROR_NO_REDEEM_CODE', 'You did not enter a redeem code.');
  define('ERROR_NO_INVALID_REDEEM_GV', 'nesprávný kód');
  define('TABLE_HEADING_CREDIT', 'Discount Coupon');
  define('GV_HAS_VOUCHERA', 'Máte finanční prostředky na vašem účtu dárkového poukazu. If you want <br>                           you can send those funds by <a class="pageResults" href="');
  define('GV_HAS_VOUCHERB', '"><b>email</b></a> to someone');
  define('ENTRY_AMOUNT_CHECK_ERROR', 'Nemáte dostatek finančních prostředků.');
  define('BOX_SEND_TO_FRIEND', 'Zaslat dárkový poukaz');
  define('VOUCHER_REDEEMED', 'Voucher Redeemed');
  define('CART_COUPON', 'Kupon :');
  define('CART_COUPON_INFO', 'další info');
// MailManager
  define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager');
  define('BOX_MM_BULKMAIL', 'BulkMail Manager');
  define('BOX_MM_TEMPLATES', 'Template Manager');
  define('BOX_MM_EMAIL', 'Zaslat e-mail');
  define('BOX_MM_RESPONSEMAIL', 'Response Mail');
//pure:new link to advanced search
  define('IMAGE_BUTTON_ADVANCED_SEARCH_LINK','podrobné');

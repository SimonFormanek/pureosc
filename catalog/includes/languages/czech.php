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

@setlocale(LC_ALL, array('cs_CZ.utf8', 'cs_CZ.UTF-8'));

define('DATE_FORMAT_SHORT', '%d.%m.%Y', true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y', true); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y', true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT.' %H:%M:%S', true);
define('JQUERY_DATEPICKER_I18N_CODE', 'cs', true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization pure:todo
define('JQUERY_DATEPICKER_FORMAT', 'mm.dd.yy', true); // see http://docs.jquery.com/UI/Datepicker/formatDate

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
define('LANGUAGE_CURRENCY', 'CZK',true);

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="cs"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Založit účet',true);
define('HEADER_TITLE_MY_ACCOUNT', 'můj účet',true);
define('HEADER_TITLE_CART_CONTENTS', 'košík',true);
define('HEADER_TITLE_CHECKOUT', 'pokladna',true);
define('HEADER_TITLE_TOP', '<i class="glyphicon glyphicon-home"><span class="sr-only">shop-name.domain</span></i>',true);
define('HEADER_TITLE_CATALOG', 'Home',true);
define('HEADER_TITLE_LOGOFF', 'Odhlásit',true);
define('HEADER_TITLE_LOGIN', 'Přihlásit',true);

// text for gender
define('MALE', 'M<span class="hidden-xs">už</span>',true);
define('FEMALE', 'Ž<span class="hidden-xs">ena</span>',true);
define('MALE_ADDRESS', 'Pan',true);
define('FEMALE_ADDRESS', 'Paní',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy',true);

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Dodání',true);
define('CHECKOUT_BAR_PAYMENT', 'Platba',true);
define('CHECKOUT_BAR_CONFIRMATION', 'Potvrdit',true);
define('CHECKOUT_BAR_FINISHED', 'Dokončeno!',true);

// pull down default text
define('PULL_DOWN_DEFAULT', 'vyberte',true);
define('TYPE_BELOW', 'Napsat níže',true);

// javascript messages
define('JS_ERROR', 'Ve formuláři je chyba.\n\nOpravte následující:\n\n',true);

define('JS_REVIEW_TEXT', '* The \'Review Text\' musí mít nejméně ' . REVIEW_TEXT_MIN_LENGTH . ' znaků.\n',true);
define('JS_REVIEW_RATING', '* Přepočítat zboží\n',true);

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Prosíme vyberte typ platby.\n',true);

define('JS_ERROR_SUBMITTED', 'Formulář může být odeslán. Zmáčkněte Ok a vyčkejte.',true);

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Vyberte způsob platby Vaší objednávky.',true);

define('CATEGORY_COMPANY', 'Společnost',true);
define('CATEGORY_PERSONAL', 'Osobní',true);
define('CATEGORY_ADDRESS', 'Adresa',true);
define('CATEGORY_CONTACT', 'Kontakt',true);
define('CATEGORY_OPTIONS', 'Nastavení',true);
define('CATEGORY_PASSWORD', 'Heslo',true);

define('ENTRY_COMPANY', 'Společnost:',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Pohlaví:',true);
define('ENTRY_GENDER_ERROR', 'Vyberte pohlaví',true);
define('ENTRY_GENDER_TEXT', '',true);
define('ENTRY_FIRST_NAME', 'Jméno:',true);
define('ENTRY_FIRST_NAME_ERROR', 'Vaše jméno musí mít nejméně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.',true);
define('ENTRY_FIRST_NAME_TEXT', '',true);
define('ENTRY_LAST_NAME', 'Příjmení:',true);
define('ENTRY_LAST_NAME_ERROR', 'Vaše příjmení musí mít nejméně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.',true);
define('ENTRY_LAST_NAME_TEXT', '',true);
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Datum narození ve tvaru: MM/DD/YYYY (eg 05/21/1970)',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (např. 05/21/1970)',true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', 'E-Mail musí mít nejméně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'E-Mail je špatně, opravte jej.',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Váš E-Mail je již v databázi.',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '',true);
define('ENTRY_STREET_ADDRESS', 'Ulice:',true);
define('ENTRY_STREET_ADDRESS_ERROR', 'Ulice musí mít nejméně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.',true);
define('ENTRY_STREET_ADDRESS_TEXT', '',true);
define('ENTRY_SUBURB', 'Čtvrť:',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'PSČ:',true);
define('ENTRY_POST_CODE_ERROR', 'PSČ musí mít nejméně ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.',true);
define('ENTRY_POST_CODE_TEXT', '',true);
define('ENTRY_CITY', 'Město:',true);
define('ENTRY_CITY_ERROR', 'Město musí mít nejméně ' . ENTRY_CITY_MIN_LENGTH . ' znaků.',true);
define('ENTRY_CITY_TEXT', '',true);
define('ENTRY_STATE', 'Stát:',true);
define('ENTRY_STATE_ERROR', 'Stát musí mít nejméně ' . ENTRY_STATE_MIN_LENGTH . ' znaků.',true);
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.',true);
define('ENTRY_STATE_TEXT', '',true);
define('ENTRY_COUNTRY', 'Země:',true);
define('ENTRY_COUNTRY_ERROR', 'Vyberte zemi v menu.',true);
define('ENTRY_COUNTRY_TEXT', '',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telefon:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Telefonní číslo musí mít nejméně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '',true);
define('ENTRY_FAX_NUMBER', 'Fax:',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Novinky:',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'Přihlásit k zasílání',true);
define('ENTRY_NEWSLETTER_NO', 'Odhlásit zasílání',true);
define('ENTRY_PASSWORD', 'Heslo:',true);
define('ENTRY_PASSWORD_ERROR', 'Vaše heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.',true);
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Hesla nejsou stejná.',true);
define('ENTRY_PASSWORD_TEXT', '',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Heslo znovu:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT', 'Původní heslo:',true);
define('ENTRY_PASSWORD_CURRENT_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Vaše heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.',true);
define('ENTRY_PASSWORD_NEW', 'Nové heslo:',true);
define('ENTRY_PASSWORD_NEW_TEXT', '',true);
define('ENTRY_PASSWORD_NEW_ERROR', 'Vaše nové heslo musí mít nejméně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.',true);
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Hesla nejsou stejná.',true);
define('PASSWORD_HIDDEN', '--HIDDEN--',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Celkem stránek:',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> produktů)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> objednávek)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> hodnocení)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> novinek)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Zobrazeno <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> slev)',true);

define('PREVNEXT_TITLE_FIRST_PAGE', 'První stránka',true);
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Předchozí stránka',true);
define('PREVNEXT_TITLE_NEXT_PAGE', 'Další stránka',true);
define('PREVNEXT_TITLE_LAST_PAGE', 'Poslední stránka',true);
define('PREVNEXT_TITLE_PAGE_NO', 'Stránka %d',true);
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Předcházejících %d stránek',true);
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Dalších %d stránek',true);
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;první',true);
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;předchozí]',true);
define('PREVNEXT_BUTTON_NEXT', '[další&nbsp;&gt;&gt;]',true);
define('PREVNEXT_BUTTON_LAST', 'poslední&gt;&gt;',true);

define('IMAGE_BUTTON_ADD_ADDRESS', 'Přidat adresu',true);
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adresář',true);
define('IMAGE_BUTTON_BACK', 'Zpět',true);
define('IMAGE_BUTTON_BUY_NOW', 'objednat',true);
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Změnit adresu',true);
define('IMAGE_BUTTON_CHECKOUT', 'Pokladna',true);
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Potvrdit objednávku',true);
define('IMAGE_BUTTON_CONTINUE', 'pokračovat',true);
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Pokračovat v nákupu',true);
define('IMAGE_BUTTON_DELETE', 'Smazat',true);
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Upravit účet',true);
define('IMAGE_BUTTON_HISTORY', 'Historie objednávek',true);
define('IMAGE_BUTTON_LOGIN', 'přihlásit',true);
define('IMAGE_BUTTON_IN_CART', 'Koupit',true);
define('IMAGE_BUTTON_NOTIFICATIONS', 'Zpráva',true);
define('IMAGE_BUTTON_QUICK_FIND', 'Rychlé hledání',true);
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Smazat zprávu',true);
define('IMAGE_BUTTON_REVIEWS', 'Hodnocení',true);
define('IMAGE_BUTTON_SEARCH', 'Vyhledat',true);
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Doprava',true);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dejte vědět příteli',true);
define('IMAGE_BUTTON_UPDATE', 'obnovit',true);
define('IMAGE_BUTTON_UPDATE_CART', 'Obnovit košík',true);
define('IMAGE_BUTTON_WRITE_REVIEW', 'Zapsat hodnocení',true);

define('SMALL_IMAGE_BUTTON_DELETE', 'Smazat',true);
define('SMALL_IMAGE_BUTTON_EDIT', 'Upravit',true);
define('SMALL_IMAGE_BUTTON_VIEW', 'Zobrazit',true);
define('SMALL_IMAGE_BUTTON_BUY', 'Koupit',true);

define('ICON_ARROW_RIGHT', 'dále',true);
define('ICON_CART', 'v košíku',true);
define('ICON_ERROR', 'chyba',true);
define('ICON_SUCCESS', 'správně',true);
define('ICON_WARNING', 'Pozor',true);

define('TEXT_GREETING_PERSONAL', 'Vítejte zpět <span class="greetUser">%s!</span> Chcete se podívat jaké máme <a href="%s"><u>novinky</u></a> od Vašeho posledního nákupu?',true);
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Pokud ne, %s, prosíme <a href="%s"><u>přihlaste se</u></a> na váš účet.</small>',true);
define('TEXT_GREETING_GUEST', 'Vítejte <span class="greetUser">návštěvníku!</span> Chcete se  <a href="%s"><u>přihlásit</u></a>? nebo teprve <a href="%s"><u>zaregistrovat</u></a>?',true); 

define('TEXT_SORT_PRODUCTS', 'seřadit',true);
define('TEXT_DESCENDINGLY', 'sestupně',true);
define('TEXT_ASCENDINGLY', 'vzestupně',true);
define('TEXT_BY', ' by ',true);

define('TEXT_REVIEW_BY', 'od %s',true);
define('TEXT_REVIEW_WORD_COUNT', '%s slov',true);
define('TEXT_REVIEW_RATING', 'hodnocení: %s [%s]',true);
define('TEXT_REVIEW_DATE_ADDED', 'přidáno: %s',true);
define('TEXT_NO_REVIEWS', 'žádná nová hodnocení.',true);

define('TEXT_NO_NEW_PRODUCTS', 'žádné nové produkty.',true);

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate',true);

define('TEXT_REQUIRED', '<span class="errorText">je nutné</span>',true);

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</strong></font>',true);

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.',true);
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.',true);
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.',true);

// category views
define('TEXT_VIEW', 'Zobrazit: ',true);
define('TEXT_VIEW_LIST', ' Seznam',true);
define('TEXT_VIEW_GRID', ' Mřížka',true);

// search placeholder
define('TEXT_SEARCH_PLACEHOLDER','Vyhledávání',true);

// message for required inputs
define('FORM_REQUIRED_INFORMATION', '<span class="glyphicon glyphicon-asterisk inputRequirement"></span> Nutno vyplnit',true);
define('FORM_REQUIRED_INPUT', '<span><span class="glyphicon glyphicon-asterisk form-control-feedback inputRequirement"></span></span>',true);

// reviews
define('REVIEWS_TEXT_RATED', 'Hodnoceno %s s <cite title="%s" itemprop="recenzent">%s</cite>',true);
define('REVIEWS_TEXT_AVERAGE', 'Hodnocení <span itemprop="počet">%s</span> recenzí %s',true);
define('REVIEWS_TEXT_TITLE', 'Co říkají naši zákazníci...',true);

// grid/list

// moved from index
define('TABLE_HEADING_IMAGE', '',true);
define('TABLE_HEADING_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Název zboží',true);
define('TABLE_HEADING_MANUFACTURER', 'Výrobce',true);
define('TABLE_HEADING_QUANTITY', 'Množství',true);
define('TABLE_HEADING_PRICE', 'Cena',true);
define('TABLE_HEADING_WEIGHT', 'Váha',true);
define('TABLE_HEADING_BUY_NOW', 'Koupit',true);
//pure: removed define('TABLE_HEADING_LATEST_ADDED', 'Poslední zboží',true);
define('TABLE_HEADING_DATE_AVAILABLE','Nejnovější zboží',true);
define('TABLE_HEADING_CUSTOM_DATE','Podle data',true);
define('TABLE_HEADING_SORT_ORDER','Pořadí',true);

// product notifications
define('PRODUCT_SUBSCRIBED', '%s bylo přidána do vašeho seznamu',true);
define('PRODUCT_UNSUBSCRIBED', '%s bylo odebráno z vašeho seznamu',true);
define('PRODUCT_ADDED', '%s přidáno do vašeho košíku',true);
define('PRODUCT_REMOVED', '%s odebráno z vašeho košíku',true);

// bootstrap helper
define('MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION', '',true);

// sorting product_listing module

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// SEO Header Tags Reloaded
  //header titles
define('HEADER_CART_CONTENTS', '<i class="glyphicon fa-shopping-cart"></i> %s kusů<span class="caret"></span>',true);
define('HEADER_CART_NO_CONTENTS', '<i class="glyphicon fa-shopping-cart"></i><span class="hidden-lg hidden-md hidden-sm"> košík</span><span class="caret"></span>',true); //pure:static version needed clickable statc cart if you go back to generated page - no idea about cart contents
define('HEADER_ACCOUNT_LOGGED_OUT', '<span class="hidden-sm"> přihlásit se/registrace</span> <span class="caret"></span>',true);
define('HEADER_ACCOUNT_LOGGED_IN', '<i class="glyphicon glyphicon-user"></i> %s <span class="caret"></span>',true);
define('HEADER_SITE_SETTINGS', '<i class="glyphicon glyphicon-cog"></i><span class="hidden-sm"> Site Settings</span> <span class="caret"></span>',true);
define('HEADER_TOGGLE_NAV', 'Toggle Navigation',true);
define('HEADER_HOME', '<i class="glyphicon glyphicon-home"></i><span class="hidden-sm"> Home</span>',true);
define('HEADER_WHATS_NEW', '<i class="glyphicon glyphicon-certificate"></i><span class="hidden-sm">  Nové zboží</span>',true);
define('HEADER_SPECIALS', '<i class="glyphicon glyphicon-fire"></i><span class="hidden-sm"> Speciální nabídky</span>',true);
define('HEADER_REVIEWS', '<i class="glyphicon glyphicon-comment"></i><span class="hidden-sm"> Hodnocení</span>',true);
// header dropdowns
define('HEADER_ACCOUNT_LOGIN', '<i class="glyphicon glyphicon-log-in"></i> Přihlásit',true);
define('HEADER_ACCOUNT_LOGOFF', '<i class="glyphicon glyphicon-log-out"></i> Odhlásit',true);
define('HEADER_ACCOUNT', 'Můj účet',true);
define('HEADER_ACCOUNT_HISTORY', 'Moje objednávky',true);
define('HEADER_ACCOUNT_EDIT', 'Moje údaje',true);
define('HEADER_ACCOUNT_ADDRESS_BOOK', 'Můj Adresář',true);
define('HEADER_ACCOUNT_PASSWORD', 'Heslo',true);
define('HEADER_ACCOUNT_REGISTER', '<i class="glyphicon glyphicon-pencil"></i> Registrace',true);
define('HEADER_CART_HAS_CONTENTS', '%s item(s), %s',true);
define('HEADER_CART_VIEW_CART', 'Košík',true);
define('HEADER_CART_CHECKOUT', '<i class="glyphicon glyphicon-chevron-right"></i> Pokladna',true);
define('USER_LOCALIZATION', '<abbr title="Vybraný jazyk">L:</abbr> %s <abbr title="Vybraná měna">C:</abbr> %s',true);

// CCGV
  define('VOUCHER_BALANCE', 'Voucher Balance',true);
  define('BOX_HEADING_GIFT_VOUCHER', 'Dárkový poukaz účet',true);
  define('GV_FAQ', 'Gift Voucher FAQ',true);
  define('IMAGE_REDEEM_VOUCHER', 'Redeem',true);
  define('ERROR_REDEEMED_AMOUNT', 'Congratulations, you have redeemed ',true);
  define('ERROR_NO_REDEEM_CODE', 'You did not enter a redeem code.',true);
  define('ERROR_NO_INVALID_REDEEM_GV', 'nesprávný kód',true);
  define('TABLE_HEADING_CREDIT', 'Discount Coupon',true);
  define('GV_HAS_VOUCHERA', 'Máte finanční prostředky na vašem účtu dárkového poukazu. If you want <br>                           you can send those funds by <a class="pageResults" href="',true);
  define('GV_HAS_VOUCHERB', '"><b>email</b></a> to someone',true);
  define('ENTRY_AMOUNT_CHECK_ERROR', 'Nemáte dostatek finančních prostředků.',true);
  define('BOX_SEND_TO_FRIEND', 'Zaslat dárkový poukaz',true);
  define('VOUCHER_REDEEMED', 'Voucher Redeemed',true);
  define('CART_COUPON', 'Kupon :',true);
  define('CART_COUPON_INFO', 'další info',true);
// MailManager
  define('BOX_HEADING_MAIL_MANAGER', 'Mail Manager',true);
  define('BOX_MM_BULKMAIL', 'BulkMail Manager',true);
  define('BOX_MM_TEMPLATES', 'Template Manager',true);
  define('BOX_MM_EMAIL', 'Zaslat e-mail',true);
  define('BOX_MM_RESPONSEMAIL', 'Response Mail',true);
//pure:new link to advanced search
  define('IMAGE_BUTTON_ADVANCED_SEARCH_LINK','podrobné',true);
//VAT numbber
define('ENTRY_VAT_NUMBER_TEXT_2', '',true);
define('ENTRY_COMPANY_NUMBER_TEXT_2', '',true);

/**** BEGIN ARTICLE MANAGER ****/
define('BOX_HEADING_ARTICLES', 'Články');
define('BOX_ALL_ARTICLES', 'Všechny články');
define('BOX_ALL_BLOG_ARTICLES', 'Všechny blogy');
define('BOX_ARTICLE_SUBMIT', 'Odeslat článek');
define('BOX_ARTICLE_TOPICS', 'Všechny kategorie');
define('BOX_NEW_ARTICLES', 'Nový článek');
define('TEXT_ARTICLE_SEARCH', 'Vyhledávání v článcích');
define('TEXT_ARTICLE_SEARCH_STRING', 'hledat článek');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Zobrazuji <b>%d</b> až <b>%d</b> (z <b>%d</b> článků)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Zobrazuji <b>%d</b> až <b>%d</b> (z <b>%d</b> nových článků)');
define('TEXT_ARTICLES', 'Níže je seznam všech článků od nejnovějších k nejstarším.');
define('TABLE_HEADING_AUTHOR', 'Autor');
define('TABLE_HEADING_ABSTRACT', 'Shrnutí');
define('TEXT_PXSELL_ARTICLES', 'Příbuzné články');
define('BOX_HEADING_AUTHORS', 'Články podle autora');
define('BOX_ARTICLES_BLOG_COMMENTS', 'Diskuse k článkům');
define('NAVBAR_TITLE_DEFAULT', 'Články');
define('BOX_RSS_ARTICLES', 'RSS Feed k článkům');
define('BOX_UPCOMING_ARTICLES', 'Připravované články');
define('BOX_HEADING_TELL_A_FRIEND', 'Poslat na e-mail');
/**** END ARTICLE MANAGER ****/

/*** Begin Header Tags SEO ***/
define('BOX_HEADING_HEADERTAGS_TAGCLOUD', 'Populární vyhledávání');
define('TEXT_SEE_MORE', 'více');
define('TEXT_SEE_MORE_FULL', 'více o %s');
define('HTS_OG_AVAILABLE_STOCK', 'Dostupnost skladem');
define('HTS_OG_PRICE', 'Cena');
/*** End Header Tags SEO ***/

//oik
define('HEADER_AUTHORS','AUTOŘI');
define('HEADER_NEWS','AKTUALITY');
define('HEADER_ABOUT_US','O NÁS');
define('XHEADER_CONTACT_US','KONTAKTY');
define('HEADER_ADVANCED_SEARCH','podrobné vyhledávání');

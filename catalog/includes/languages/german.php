<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/
// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
//@setlocale(LC_TIME, 'de_DE.ISO_8859-1');
@setlocale(LC_ALL, array('de_DE.UTF-8', 'de_DE.UTF8', 'deu_deu'));

define('DATE_FORMAT_SHORT', '%d/%m/%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', '',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate

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
define('LANGUAGE_CURRENCY', 'EUR',true);

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="ltr" lang="de"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Neues Konto',true);
define('HEADER_TITLE_MY_ACCOUNT', 'Ihr Konto',true);
define('HEADER_TITLE_CART_CONTENTS', 'Warenkorb',true);
define('HEADER_TITLE_CHECKOUT', 'Kasse',true);
define('HEADER_TITLE_TOP', 'Startseite',true);
define('HEADER_TITLE_CATALOG', 'Katalog',true);
define('HEADER_TITLE_LOGOFF', 'Abmelden',true);
define('HEADER_TITLE_LOGIN', 'Anmelden',true);

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'Zugriffe seit',true);

// text for gender
define('MALE', 'Herr',true);
define('FEMALE', 'Frau',true);
define('MALE_ADDRESS', 'Herr',true);
define('FEMALE_ADDRESS', 'Frau',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/jjjj',true);

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Versandinformationen',true);
define('CHECKOUT_BAR_PAYMENT', 'Zahlungsweise',true);
define('CHECKOUT_BAR_CONFIRMATION', 'Bestätigung',true);
define('CHECKOUT_BAR_FINISHED', 'Fertig!',true);

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte wählen',true);
define('TYPE_BELOW', 'bitte unten eingeben',true);

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\nBitte richtig ausfüllen.\n\n’',true);

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n',true);
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n',true);

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.\n',true);

define('JS_ERROR_SUBMITTED', 'Diese Seite wurde bereits bestätigt. Betätigen Sie bitte OK und warten bis der Prozess durchgeführt wurde.',true);

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.',true);

define('CATEGORY_COMPANY', 'Firmendaten',true);
define('CATEGORY_PERSONAL', 'Ihre persönlichen Daten',true);
define('CATEGORY_ADDRESS', 'Ihre Adresse',true);
define('CATEGORY_CONTACT', 'Ihre Kontaktinformationen',true);
define('CATEGORY_OPTIONS', 'Optionen',true);
define('CATEGORY_PASSWORD', 'Ihr Passwort',true);

define('ENTRY_COMPANY', 'Firmenname:',true);
//define('ENTRY_COMPANY_ERROR', '',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Anrede:',true);
define('ENTRY_GENDER_ERROR', 'Bitte das Geschlecht angeben.',true);
define('ENTRY_GENDER_TEXT', '',true);
define('ENTRY_FIRST_NAME', 'Vorname:',true);
define('ENTRY_FIRST_NAME_ERROR', 'Der Vorname sollte mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_FIRST_NAME_TEXT', '',true);
define('ENTRY_LAST_NAME', 'Nachname:',true);
define('ENTRY_LAST_NAME_ERROR', 'Der Nachname sollte mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_LAST_NAME_TEXT', '',true);
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Bitte geben Sie Ihr Geburtsdatum in folgendem Format ein: TT/MM/JJJJ (z.B. 21/05/1970)',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (z.B. 21/05/1970)',true);
define('ENTRY_EMAIL_ADDRESS', 'eMail-Adresse:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Die eMail Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Die eMail Adresse scheint nicht gültig zu sein - bitte korrigieren.',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Die eMail Adresse ist bereits gespeichert - bitte melden Sie sich mit dieser Adresse an oder eröffnen Sie ein neues Konto mit einer anderen Adresse.',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '',true);
define('ENTRY_STREET_ADDRESS', 'Strasse/Hausnr.:',true);
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Strassenadresse sollte mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_STREET_ADDRESS_TEXT', '',true);
define('ENTRY_SUBURB', 'Stadtteil:',true);
define('ENTRY_SUBURB_ERROR', '',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'Postleitzahl:',true);
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl sollte mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_POST_CODE_TEXT', '',true);
define('ENTRY_CITY', 'Ort:',true);
define('ENTRY_CITY_ERROR', 'Die Stadt sollte mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_CITY_TEXT', '',true);
define('ENTRY_STATE', 'Bundesland:',true);
define('ENTRY_STATE_ERROR', 'Das Bundesland sollte mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_STATE_ERROR_SELECT', 'Bitte wählen Sie ein Bundesland aus der Liste.',true);
define('ENTRY_STATE_TEXT', '',true);
define('ENTRY_COUNTRY', 'Land:',true);
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus der Liste.',true);
define('ENTRY_COUNTRY_TEXT', '',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer sollte mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '',true);
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:',true);
define('ENTRY_FAX_NUMBER_ERROR', '',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Newsletter:',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'abonniert',true);
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert',true);
define('ENTRY_NEWSLETTER_ERROR', '',true);
define('ENTRY_PASSWORD', 'Passwort:',true);
define('ENTRY_PASSWORD_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Beide eingegebenen Passwörter müssen identisch sein.',true);
define('ENTRY_PASSWORD_TEXT', '',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Bestätigung:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:',true);
define('ENTRY_PASSWORD_CURRENT_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:',true);
define('ENTRY_PASSWORD_NEW_TEXT', '',true);
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.',true);
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwort-Bestätigung muss mit Ihrem neuen Passwort übereinstimmen.',true);
define('PASSWORD_HIDDEN', '--VERSTECKT--',true);

define('FORM_REQUIRED_INFORMATION', '* Notwendige Eingabe',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'angezeigte Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'angezeigte Bestellungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'angezeigte Meinungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'angezeigte neue Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'angezeigte Angebote <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)',true);

define('PREVNEXT_TITLE_FIRST_PAGE', 'erste Seite',true);
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'vorherige Seite',true);
define('PREVNEXT_TITLE_NEXT_PAGE', 'nächste Seite',true);
define('PREVNEXT_TITLE_LAST_PAGE', 'letzte Seite',true);
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d',true);
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorhergehende %d Seiten',true);
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Nächste %d Seiten',true);
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;ERSTE',true);
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;vorherige]',true);
define('PREVNEXT_BUTTON_NEXT', '[nächste&nbsp;&gt;&gt;]',true);
define('PREVNEXT_BUTTON_LAST', 'LETZTE&gt;&gt;',true);

define('IMAGE_BUTTON_ADD_ADDRESS', 'Neue Adresse',true);
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adressbuch',true);
define('IMAGE_BUTTON_BACK', 'Zurück',true);
define('IMAGE_BUTTON_BUY_NOW', 'In den Warenkorb',true);
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresse ändern',true);
define('IMAGE_BUTTON_CHECKOUT', 'Kasse',true);
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bestellung bestätigen',true);
define('IMAGE_BUTTON_CONTINUE', 'Weiter',true);
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Einkauf fortsetzen',true);
define('IMAGE_BUTTON_DELETE', 'Löschen',true);
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Daten ändern',true);
define('IMAGE_BUTTON_HISTORY', 'Bestellübersicht',true);
define('IMAGE_BUTTON_LOGIN', 'Anmelden',true);
define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb',true);
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen',true);
define('IMAGE_BUTTON_QUICK_FIND', 'Schnellsuche',true);
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen löschen',true);
define('IMAGE_BUTTON_REVIEWS', 'Bewertungen',true);
define('IMAGE_BUTTON_SEARCH', 'Suchen',true);
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Versandoptionen',true);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Weiterempfehlen',true);
define('IMAGE_BUTTON_UPDATE', 'Aktualisieren',true);
define('IMAGE_BUTTON_UPDATE_CART', 'Warenkorb aktualisieren',true);
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung schreiben',true);

define('SMALL_IMAGE_BUTTON_DELETE', 'Löschen',true);
define('SMALL_IMAGE_BUTTON_EDIT', 'Bearbeiten',true);
define('SMALL_IMAGE_BUTTON_VIEW', 'Ansicht',true);

define('ICON_ARROW_RIGHT', 'Zeige mehr',true);
define('ICON_CART', 'In den Warenkorb',true);
define('ICON_ERROR', 'Fehler',true);
define('ICON_SUCCESS', 'Erfolg',true);
define('ICON_WARNING', 'Warnung',true);

define('TEXT_GREETING_PERSONAL', 'Schön, dass Sie wieder da sind <span class="greetUser">%s!</span> Möchten Sie die <a href="%s"><u>neuen Produkte</u></a> ansehen?',true);
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Wenn Sie nicht %s sind, melden Sie sich bitte <a href="%s"><u>hier</u></a> mit Ihrem Kundenkonto an.</small>',true);
define('TEXT_GREETING_GUEST','',true); //Herzlich willkommen <span class="greetUser">Gast!</span> Möchten Sie sich <a href="%s"><u>anmelden</u></a>? Oder wollen Sie ein <a href="%s"><u>Kundenkonto</u></a> eröffnen?

define('TEXT_SORT_PRODUCTS', 'Sortierung der Artikel ist ',true);
define('TEXT_DESCENDINGLY', 'absteigend',true);
define('TEXT_ASCENDINGLY', 'aufsteigend',true);
define('TEXT_BY', ' nach ',true);

define('TEXT_REVIEW_BY', 'von %s',true);
define('TEXT_REVIEW_WORD_COUNT', '%s Worte',true);
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]',true);
define('TEXT_REVIEW_DATE_ADDED', 'Datum hinzugefügt: %s',true);
define('TEXT_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.',true);

define('TEXT_NO_NEW_PRODUCTS', 'Zur Zeit gibt es keine neuen Produkte.',true);

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz',true);

define('TEXT_REQUIRED', '<span class="errorText">erforderlich</span>',true);

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>Fehler:</small> Die eMail kann nicht über den angegebenen SMTP-Server verschickt werden. Bitte kontrollieren Sie die Einstellungen in der php.ini Datei und führen Sie notwendige Korrekturen durch!</b></font>',true);

/*
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Bitte löschen Sie das Verzeichnis aus Gründen der Sicherheit!',true);
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: osC kann in die Konfigurationsdatei schreiben: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Das stellt ein mögliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!',true);
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für die Sessions existiert nicht: ' . tep_session_save_path() . '. Die Sessions werden nicht funktionieren bis das Verzeichnis erstellt wurde!',true);
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: osC kann nicht in das Sessions Verzeichnis schreiben: ' . tep_session_save_path() . '. Die Sessions werden nicht funktionieren bis die richtigen Benutzerberechtigungen gesetzt wurden!',true);
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist enabled - Bitte disablen Sie dieses PHP Feature in der php.ini und starten Sie den WEB-Server neu!',true);
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Diese Funktion wird nicht funktionieren bis das Verzeichnis erstellt wurde!',true);
*/
define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das "Gültig bis" Datum ist ungültig. Bitte korrigieren Sie Ihre Angaben.',true);
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die "KreditkarteNummer", die Sie angegeben haben, ist ungültig. Bitte korrigieren Sie Ihre Angaben.',true);
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte sind: %s. Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert. Bitte korrigieren Sie Ihre Angaben gegebenfalls.',true);

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>Powered by <a href="http://www.oscommerce.com" target="_blank">osCommerce</a>',true);
//pure:new link to advanced search
  define('IMAGE_BUTTON_ADVANCED_SEARCH_LINK','podrobné',true);

define('TABLE_HEADING_DATE_AVAILABLE','Latest Products',true);
define('TABLE_HEADING_CUSTOM_DATE','Evet\'s Date',true);
define('TABLE_HEADING_SORT_ORDER','Sort Order',true);
//VAT numbber
define('ENTRY_VAT_NUMBER_TEXT_2', '',true);
define('ENTRY_COMPANY_NUMBER', 'COMPANY ID:',true);
define('ENTRY_COMPANY_NUMBER_TEXT_2', '',true);

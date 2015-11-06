<?php
/*
  $Id: create_order.php,v 1 2003/08/17 23:21:34 frankl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
*/

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte wählen',true);
define('TYPE_BELOW', 'Unten eingeben',true);

define('JS_ERROR', 'Es sind Fehler aufgetreten!\nBitte nehmen Sie folgende Änderungen vor :\n\n',true);

define('JS_GENDER', '* \'Geschlecht\' muss ausgewählt sein.\n',true);
define('JS_FIRST_NAME', '* Der \'Vorname\' muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_DOB', '* Das \'Geburtsdatum\' muss folgendes Format haben: xx/xx/xxxx (Monat/Tag/Jahr).\n',true);
define('JS_EMAIL_ADDRESS', '* Die \'E-Mail Adresse\' muss mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_ADDRESS', '* Der \'Straßenname\' muss mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_CITY', '* Der \'Stadtteil\' muss mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_STATE', '* Das \'Bundesland\' muss ausgewählt werden.\n',true);
define('JS_STATE_SELECT', '-- oben auswählen --',true);
define('JS_ZONE', '* Das \'Bundesland\' muss aus der Liste ausgewählt werden.\n',true);
define('JS_COUNTRY', '* Das \'Land\' muss aus der Liste ausgewählt werden.\n',true);
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen lang sein.\n',true);
define('JS_PASSWORD', '* Das \'Passwort\' muss mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen lang sein.\n',true);

define('CATEGORY_COMPANY', 'Firmendetails',true);
define('CATEGORY_PERSONAL', 'persönliche Details',true);
define('CATEGORY_ADDRESS', 'Adresse',true);
define('CATEGORY_CONTACT', 'Kontaktinformationen',true);
define('CATEGORY_OPTIONS', 'Optionen',true);
define('CATEGORY_PASSWORD', 'Passwort',true);
define('CATEGORY_CORRECT', 'Wenn das der gewünschte Kunde ist klicken Sie bestätigen.',true);
define('ENTRY_CUSTOMERS_ID', 'Kunden-ID:',true);
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;',true);
define('ENTRY_COMPANY', 'Firmenname:',true);
define('ENTRY_COMPANY_ERROR', '',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Geschlecht:',true);
define('ENTRY_GENDER_FEMALE', 'weiblich:',true);
define('ENTRY_GENDER_MALE', 'männlich:',true);
define('ENTRY_GENDER_ERROR', '&nbsp;',true);
define('ENTRY_GENDER_TEXT', '&nbsp;',true);
define('ENTRY_FIRST_NAME', 'Vorname:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_LAST_NAME', 'Nachname:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_LAST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(z.B. 05/21/1970|Monat/Tag/Jahr)</font></small>',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(z.B. 05/21/1970) ',true);
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Adresse:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Die E-Mail Adresse scheint nicht gültig zu sein!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">Die E-Mail Adresse ist bereits vorhanden!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_STREET_ADDRESS', 'Straße:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_SUBURB', 'Stadtteil:',true);
define('ENTRY_SUBURB_ERROR', '',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'Postleitzahl:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_POST_CODE_TEXT', '&nbsp;',true);
define('ENTRY_CITY', 'Stadt:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_CITY_TEXT', '&nbsp;',true);
define('ENTRY_STATE', 'Bundesland:',true);
define('ENTRY_STATE_ERROR', '&nbsp;',true);
define('ENTRY_STATE_TEXT', '&nbsp;',true);
define('ENTRY_COUNTRY', 'Land:',true);
define('ENTRY_COUNTRY_ERROR', '',true);
define('ENTRY_COUNTRY_TEXT', '&nbsp;',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;',true);
define('ENTRY_FAX_NUMBER', 'Faxnummer:',true);
define('ENTRY_FAX_NUMBER_ERROR', '',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Newsletter(Neuigkeiten per Email):',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'abonnieren',true);
define('ENTRY_NEWSLETTER_NO', 'Deabonnieren',true);
define('ENTRY_NEWSLETTER_ERROR', '',true);
define('ENTRY_PASSWORD', 'Passwort:',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwort bestätigung:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;',true);
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen</font></small>',true);
define('ENTRY_PASSWORD_TEXT', '&nbsp;',true);
define('PASSWORD_HIDDEN', '--AUSGEBLENDET--',true);

define('CREATE_ORDER_TEXT_EXISTING_CUST', 'bestehendes Kundenkonto',true);
define('CREATE_ORDER_TEXT_NEW_CUST', 'neues Kundenkonto',true);
define('CREATE_ORDER_TEXT_NO_CUST', 'ohne Kundenkonto',true);

define('HEADING_TITLE', 'neue Bestellung',true);
define('TEXT_SELECT_CUST', '- wählen Sie einen Kunden -',true); 
define('TEXT_SELECT_CURRENCY', '- wählen Sie eine Währung -',true);
define('TEXT_SELECT_CURRENCY_TITLE', 'wählen Sie eine Währung',true);
define('BUTTON_TEXT_SELECT_CUST', 'wählen Sie einen Kunden:',true); 
define('TEXT_OR_BY', 'oder wählen Sie ihn über die Kunde-ID aus:',true); 
define('TEXT_STEP_1', 'Schritt 1 - Wählen Sie einen bestehenden Kunden aus um die Felder automatisch auszufüllen.',true);
define('TEXT_STEP_2', 'Schritt 2 - Bestätigen Sie die Daten oder Änderungen.',true);
define('BUTTON_SUBMIT', 'auswählen',true);
define('ENTRY_CURRENCY','Währung: ',true);
define('ENTRY_ADMIN','Bestellung eingeben von:',true);
define('TEXT_CS','Kundenservice',true);

define('ACCOUNT_EXTRAS','Kontoextras',true);
define('ENTRY_ACCOUNT_PASSWORD','Passwort',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE','Newsletter(Neuigkeiten per Email)',true);
define('ENTRY_ACCOUNT_PASSWORD_TEXT','',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE_TEXT','1 = abonniert, oder 0 (NULL) = nicht abonniert.',true);


?>
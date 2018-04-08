<?php
/*
  $Id: create_order.php,v 1 2003/08/17 23:21:34 frankl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
  
*/

// pull down default text
define('PULL_DOWN_DEFAULT', 'Prosím vyberte',true);
define('TYPE_BELOW', 'Napište níže',true);

define('JS_ERROR', 'Během zpracování formuláře dosšlo k chybám!\nProsím proveďte následující opravy:\n\n',true);

define('JS_GENDER', '* \'Pohlaví\' musí být vybráno.\n',true);
define('JS_FIRST_NAME', '* \'Křestní jméno\' musí mít minimálně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků.\n',true);
define('JS_LAST_NAME', '* \'Příjmení\' musí mít minimálně ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků.\n',true);
define('JS_DOB', '* \'Datum narození\' musí mít formát: mm/dd/yyyy (měsíc/den/rok).\n',true);
define('JS_EMAIL_ADDRESS', '* \'Email\' musí mít minimálně ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků.\n',true);
define('JS_ADDRESS', '* \'Ulice\' musí mít minimálně ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků.\n',true);
define('JS_POST_CODE', '* The \'Post Code\' musí mít minimálně ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků.\n',true);
define('JS_CITY', '* The \'Čtvrť\' musí mít minimálně ' . ENTRY_CITY_MIN_LENGTH . ' znaků.\n',true);
define('JS_STATE', '* \'Kraj\' musí být uveden.\n',true);
define('JS_STATE_SELECT', '-- Vybrat dále --',true);
define('JS_ZONE', '* \'Kraj/region\' Musí být vybrán ze seznamu pro danou zemi.\n',true);
define('JS_COUNTRY', '* \'Země\' musí být uvedena.\n',true);
define('JS_TELEPHONE', '* \'Telefoní číslo\' musí mít minimálně ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků.\n',true);
define('JS_PASSWORD', '* The \'Password\' musí mít minimálně ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků.\n',true);

define('CATEGORY_COMPANY', 'Více o firmě',true);
define('CATEGORY_PERSONAL', 'Více o osobě',true);
define('CATEGORY_ADDRESS', 'Addresy',true);
define('CATEGORY_CONTACT', 'Kontaktní Informace',true);
define('CATEGORY_OPTIONS', 'Možnosti',true);
define('CATEGORY_PASSWORD', 'Heslo',true);
define('CATEGORY_CORRECT', 'Pokud je to ten správný zákazník klikněte na tlačítko Potvrdit',true);
define('ENTRY_CUSTOMERS_ID', 'Zákaznické ID:',true);
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;',true);
define('ENTRY_COMPANY_ERROR', '',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Pohlaví:',true);
define('ENTRY_GENDER_FEMALE', 'Žena',true);
define('ENTRY_GENDER_MALE', 'Muž',true);
define('ENTRY_GENDER_ERROR', '&nbsp;',true);
define('ENTRY_GENDER_TEXT', '&nbsp;',true);
define('ENTRY_FIRST_NAME', 'Křestní jméno:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">nejméně ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_LAST_NAME', 'Příjmení:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_LAST_NAME_TEXT', '&nbsp;',true);
define('ENTRY_DATE_OF_BIRTH', 'Datum narození:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(např. 05/21/1970)</font></small>',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(např. 05/21/1970) ',true);
define('ENTRY_EMAIL_ADDRESS', 'Email:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Zdá se, že emailová adresa není formálně v pořádku!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">emailová addresa již existuje v databázi!</font></small>',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_STREET_ADDRESS', 'Street Address:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;',true);
define('ENTRY_SUBURB', 'Suburb:',true);
define('ENTRY_SUBURB_ERROR', '',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'Post Code:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_POST_CODE_TEXT', '&nbsp;',true);
define('ENTRY_CITY', 'Suburb:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_CITY_TEXT', '&nbsp;',true);
define('ENTRY_STATE', 'Stát/kraj:',true);
define('ENTRY_STATE_ERROR', '&nbsp;',true);
define('ENTRY_STATE_TEXT', '&nbsp;',true);
define('ENTRY_COUNTRY', 'Země:',true);
define('ENTRY_COUNTRY_ERROR', '',true);
define('ENTRY_COUNTRY_TEXT', '&nbsp;',true);
define('ENTRY_TELEPHONE_NUMBER', 'Telfon:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;',true);
define('ENTRY_FAX_NUMBER', 'Fax:',true);
define('ENTRY_FAX_NUMBER_ERROR', '',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Novinky na email:',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'zasílat novinky',true);
define('ENTRY_NEWSLETTER_NO', 'nezasílat novinky',true);
define('ENTRY_NEWSLETTER_ERROR', '',true);
define('ENTRY_PASSWORD', 'Heslo:',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Potvrzení hesla:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;',true);
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' znaků</font></small>',true);
define('ENTRY_PASSWORD_TEXT', '&nbsp;',true);
define('PASSWORD_HIDDEN', '--SKRYTÝ TEXT--',true);

define('CREATE_ORDER_TEXT_EXISTING_CUST', 'Existující zákaznický účet',true);
define('CREATE_ORDER_TEXT_NEW_CUST', 'Nový zákaznický účet',true);
define('CREATE_ORDER_TEXT_NO_CUST', 'bez zákaznického účtu',true);

define('HEADING_TITLE', 'Nová objednávka',true);
define('TEXT_SELECT_CUST', '- vybrat zákazníka -',true); 
define('TEXT_SELECT_CURRENCY', '- vybrat měnu -',true);
define('TEXT_SELECT_CURRENCY_TITLE', 'Výběr měny',true);
define('BUTTON_TEXT_SELECT_CUST', 'Vybrat zákazníka:',true); 
define('TEXT_OR_BY', 'nebo vybrat podle zákaznického ID:',true); 
define('TEXT_STEP_1', 'Krok 1 - Vybrat zákazníka pro předvyplnění formuláře nebo zvolte jinou možnost a vložte údaje.',true);
define('TEXT_STEP_2', 'Krok 2 - Potvrďte existující informace o zákazníkově učtu nebo vlozten ové údaje o zákazníkovi/platbě/dopravě.',true);
define('BUTTON_SUBMIT', 'Vybrat',true);
define('ENTRY_CURRENCY','Měna: ',true);
define('ENTRY_ADMIN','Objednávku zpracoval:',true);
define('TEXT_CS','Zákaznický servis',true);

define('ACCOUNT_EXTRAS','Speciální nastavení účtu',true);
define('ENTRY_ACCOUNT_PASSWORD','Heslo',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE','Novinky na email',true);
define('ENTRY_ACCOUNT_PASSWORD_TEXT','',true);
define('ENTRY_NEWSLETTER_SUBSCRIBE_TEXT','1 => Ano, 0 => Ne',true);


?>
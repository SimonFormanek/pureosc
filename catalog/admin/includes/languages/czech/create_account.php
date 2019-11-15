<?php
/*
  $Id: create_account.php,v 1.13 2003/05/19 20:17:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Vytvořit uživatelský účet',true);
define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>WARNING:</b></font></small>>Pokud již máte účet, přihlaste se na stránce <a href="%s"><u><b>Přihlášení</b></u></a>.',true);

define ('ENTRY_FIRST_NAME_TEXT', 'Křestní jméno');
define ('ENTRY_LAST_NAME_TEXT', 'Příjmení');
define ('ENTRY_EMAIL_ADDRESS_TEXT', 'E-mailová adresa');
define ('ENTRY_COMPANY_TEXT', 'Společnost');
define ('ENTRY_COMPANY_NUMBER_TEXT_2', 'IČO');
define ('ENTRY_VAT_NUMBER_TEXT_2', 'DIČ');
define ('ENTRY_STREET_ADDRESS_TEXT', 'Ulice, číslo');
define ('ENTRY_CITY_TEXT', 'Město');
define ('ENTRY_POST_CODE_TEXT', 'PSČ');
define ('ENTRY_COUNTRY_TEXT', 'Země');
define ('ENTRY_TELEPHONE_NUMBER_TEXT', 'Telefonní číslo');
define ('ENTRY_FAX_NUMBER_TEXT', 'Číslo faxu');
define ('ENTRY_NEWSLETTER_TEXT', 'Newsletter');
define ('ENTRY_PASSWORD_TEXT', 'Heslo');
define ('ENTRY_PASSWORD_CONFIRMATION_TEXT', 'Heslo znovu pro kontrolu');
define ('IMAGE_BUTTON_CONTINUE', 'Pokračovat');

define('HEADING_TITLE_CREATE_ACCOUNT', 'Create an new Customer Account',true);
define('PULL_DOWN_DEFAULT', 'Please select',true);

define('HEADING_TITLE_CREATE_ACCOUNT_SUCCESS', 'New Account sucessfully created',true);

define('EMAIL_PASS_1', 'Your password: ',true);
define('EMAIL_PASS_2', "\n" . 'You can change it after login.' . "\n\n");

define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Dear Mr. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Dear Ms. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Dear ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'We welcome you to <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'You can now take part in the <b>various services</b> we have to offer you. Some of these services include:' . "\n\n" . '<li><b>Permanent Cart</b> - Any products added to your online cart remain there until you remove them, or check them out.' . "\n" . '<li><b>Address Book</b> - We can now deliver your products to another address other than yours! This is perfect to send birthday gifts direct to the birthday-person themselves.' . "\n" . '<li><b>Order History</b> - View your history of purchases that you have made with us.' . "\n" . '<li><b>Products Reviews</b> - Share your opinions on products with our other customers.' . "\n\n");
define('EMAIL_CONTACT', 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> This email address was given to us by one of our customers. If you did not signup to be a member, please send an email to ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
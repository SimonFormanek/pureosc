<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Přihlášení');
define('NAVBAR_TITLE_2', 'Zapomenuté heslo');

define('HEADING_TITLE', 'Zapomněl jsem své heslo!');

define('TEXT_MAIN', 'Zapomněl jste heslo? Vložte svou e-mailovou adresu, která byla zadána při registraci a my Vám pošleme nové.');

define('TEXT_PASSWORD_RESET_INITIATED', 'Please check your e-mail for instructions on how to change your password. The instructions contain a link that is valid only for 24 hours or until your password has been updated.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Nezadal jste e-mail nebo je nesprávný, zkuste zadat znovu.');

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME . ' - Nové heslo');
define('EMAIL_PASSWORD_RESET_BODY', 'Heslo bylo vyžádáno z ' . STORE_NAME . '.' . "\n\n" . 'Please follow this personal link to securely change your password:' . "\n\n" . '%s' . "\n\n" . 'This link will be automatically discarded after 24 hours or after your password has been changed.' . "\n\n" . 'For help with any of our online services, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");

define('ERROR_ACTION_RECORDER', 'Error: A password reset link has already been sent. Please try again in %s minutes.');
?>
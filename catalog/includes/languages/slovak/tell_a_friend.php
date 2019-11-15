<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Upozorniť priateľa');

define('HEADING_TITLE', 'Upozornite priateľov o \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Detaily o vás');
define('FORM_TITLE_FRIEND_DETAILS', 'Detaily o vašom priateľovi');
define('FORM_TITLE_FRIEND_MESSAGE', 'Vaša správa');

define('FORM_FIELD_CUSTOMER_NAME', 'Vaše meno:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Váš e-mail:');
define('FORM_FIELD_FRIEND_NAME', 'Meno vášho priateľa:');
define('FORM_FIELD_FRIEND_EMAIL', 'E-mail vášho priateľa:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Váš e-mail o <b>%s</b> bol úspešne odoslaný na adresu <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Váš priateľ %s vám doporučuje tento produkt z %s');
define('TEXT_EMAIL_INTRO', 'Ahoj %s,' . "\n\n" . 'Váš priateľ, %s si myslí, že by vás mohol zaujímať produkt %s z %s.');
define('TEXT_EMAIL_LINK', 'Pre zobrazenie ďalších informácií kliknite na následujúci odkaz alebo skopírujte a vložte tento odkaz do vášho web prehliadača:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'S pozdravom,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Chyba: Meno vášho priateľa nesmie zostať prázdne.');
define('ERROR_TO_ADDRESS', 'Chyba: e-mail vášho priateľa musí byť platný.');
define('ERROR_FROM_NAME', 'Chyba: Vaše meno nesmie zostať prázdne.');
define('ERROR_FROM_ADDRESS', 'Chyba: Váš e-mail musí byť platný.');
define('ERROR_ACTION_RECORDER', 'Chyba: E-mail bol už odoslaný, prosíme skúste znova za% s minút .');
<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Upozorněte přítele');

define('HEADING_TITLE', 'Upozorněte přítele \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vaše údaje');
define('FORM_TITLE_FRIEND_DETAILS', 'Váš přítel');
define('FORM_TITLE_FRIEND_MESSAGE', 'Vaše zpráva');

define('FORM_FIELD_CUSTOMER_NAME', 'Vaše jméno:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Váš e-mail:');
define('FORM_FIELD_FRIEND_NAME', 'jméno Vašeho přítele:');
define('FORM_FIELD_FRIEND_EMAIL', 'e-mail Vašeho přítele:');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Váš e-mail o zboží <strong>%s</strong> byl odeslán an adresu <strong>%s</strong>.');

define('TEXT_EMAIL_SUBJECT', 'Váš přítel %s doporučil zboží z %s');
define('TEXT_EMAIL_INTRO', 'Dobrý den %s!' . "\n\n" . 'Váš přítel, %s, si myslí, že by Vás mohlo zajímat zboží %s z %s.');
define('TEXT_EMAIL_LINK', 'Pro zobrazení zboží klikněte na následující odkaz:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'S pozdravem,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Chyba: jméno Vašeho přítele musí být vyplněno.');
define('ERROR_TO_ADDRESS', 'Chyba: e-mail vašeho přítele je chybný.');
define('ERROR_FROM_NAME', 'Chyba: Vaše jméno musí být vyplněno.');
define('ERROR_FROM_ADDRESS', 'Chyba: Váš e-mail musí být vyplněn.');
define('ERROR_ACTION_RECORDER', 'Chyba: e-mail připraven k odeslání. Prosím zkuste znovu za %s minut.');
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('TEXT_RECOMMEND', 'has recommended');
  define('TEXT_FROM', 'from the');
?>

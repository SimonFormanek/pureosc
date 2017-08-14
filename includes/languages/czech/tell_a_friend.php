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

define('NAVBAR_TITLE', 'Upozorněte přítele',true);

define('HEADING_TITLE', 'Upozorněte přítele \'%s\'',true);

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vaše údaje',true);
define('FORM_TITLE_FRIEND_DETAILS', 'Váš přítel',true);
define('FORM_TITLE_FRIEND_MESSAGE', 'Vaše zpráva',true);

define('FORM_FIELD_CUSTOMER_NAME', 'Vaše jméno:',true);
define('FORM_FIELD_CUSTOMER_EMAIL', 'Váš e-mail:',true);
define('FORM_FIELD_FRIEND_NAME', 'jméno Vašeho přítele:',true);
define('FORM_FIELD_FRIEND_EMAIL', 'e-mail Vašeho přítele:',true);

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Váš e-mail o zboží <strong>%s</strong> byl odeslán an adresu <strong>%s</strong>.',true);

define('TEXT_EMAIL_SUBJECT', 'Váš přítel %s doporučil zboží z %s',true);
define('TEXT_EMAIL_INTRO', 'Dobrý den %s!' . "\n\n" . 'Váš přítel, %s, si myslí, že by Vás mohlo zajímat zboží %s z %s.',true);
define('TEXT_EMAIL_LINK', 'Pro zobrazení zboží klikněte na následující odkaz:' . "\n\n" . '%s',true);
define('TEXT_EMAIL_SIGNATURE', 'S pozdravem,' . "\n\n" . '%s',true);

define('ERROR_TO_NAME', 'Chyba: jméno Vašeho přítele musí být vyplněno.',true);
define('ERROR_TO_ADDRESS', 'Chyba: e-mail vašeho přítele je chybný.',true);
define('ERROR_FROM_NAME', 'Chyba: Vaše jméno musí být vyplněno.',true);
define('ERROR_FROM_ADDRESS', 'Chyba: Váš e-mail musí být vyplněn.',true);
define('ERROR_ACTION_RECORDER', 'Chyba: e-mail je připraven k odeslání. Prosím zkuste znovu za %s minut.',true);
/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('TEXT_RECOMMEND', 'Doporučil',true);
  define('TEXT_FROM', 'od',true);
?>

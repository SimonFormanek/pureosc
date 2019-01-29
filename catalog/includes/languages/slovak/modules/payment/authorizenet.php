<?php
/*
  $Id: authorizenet.php,v 1.13 2003/01/03 17:25:43 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE', 'Authorize.net');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', 'Testovacie informácie kreditnej karty:<br><br>CC#: 4111111111111111<br>Expirácia: žiadna');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', 'Typ kreditnej karty:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', 'Vlastník kreditnej karty:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', 'Číslo kreditnej karty:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', 'Expirácia kreditnej karty:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* Meno vlastníka kreditnej karty musí byť minimálne ' . CC_OWNER_MIN_LENGTH . ' znakov.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* Číslo kreditnej karty musí byť minimálne ' . CC_NUMBER_MIN_LENGTH . ' znakov.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'Nastala chyba pri spracovávaní vašej kreditnej karty. Skúste to znova prosím.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Vaša karta bola odmietnutá. Prosím skúste inú kartu alebo kontaktuje vašu banku pre ďalšie informácie.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Chyba kreditnej karty!');
?>

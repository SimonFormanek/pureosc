<?php
/*
  $Id: ipayment.php,v 1.4 2002/11/01 05:35:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_IPAYMENT_TEXT_TITLE', 'iPayment');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_DESCRIPTION', 'Testovacie informácie kreditnej karty:<br><br>CC#: 4111111111111111<br>Expirácia: žiadna');
  define('IPAYMENT_ERROR_HEADING', 'Nastala chyba pri spracovaní vašej karty');
  define('IPAYMENT_ERROR_MESSAGE', 'Prosím skontrolujte si detaily vašej kreditnej karty!');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_OWNER', 'Vlastník kreditnej karty:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_NUMBER', 'Číslo kreditnej karty:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_EXPIRES', 'Expirácia kreditnej karty:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER', 'Kontrolné číslo kreditnej karty:');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '(nachádza sa na zadnej strane kreditnej karty)');

  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_OWNER', '* Meno vlastníka kreditnej karty musí byť minimálne ' . CC_OWNER_MIN_LENGTH . ' znakov.\n');
  define('MODULE_PAYMENT_IPAYMENT_TEXT_JS_CC_NUMBER', '* Číslo kreditnej karty musí byť minimálne ' . CC_NUMBER_MIN_LENGTH . ' znakov.\n');
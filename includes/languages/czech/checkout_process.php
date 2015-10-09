<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce
    
  Edited by 2014 Newburns Design and Technology
  *************************************************
  ************ New addon definitions **************
  ************        Below          **************
  *************************************************
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23
  Purchase Without Account (PWA) added -- http://addons.oscommerce.com/info/9142
  
  Released under the GNU General Public License
*/

define('EMAIL_TEXT_SUBJECT', 'Vaše objednávka na serveru ' . STORE_NAME);
define('EMAIL_TEXT_ORDER_NUMBER', 'Variabilní symbol:');
define('EMAIL_TEXT_INVOICE_URL', 'Detail faktury:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:');
define('EMAIL_TEXT_PRODUCTS', 'Zboží');
define('EMAIL_TEXT_SUBTOTAL', 'Mezisoučet:');
define('EMAIL_TEXT_TAX', 'Daň:        ');
define('EMAIL_TEXT_SHIPPING', 'Dodání: ');
define('EMAIL_TEXT_TOTAL', 'Celkem:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresa doručení');
define('EMAIL_TEXT_BILLING_ADDRESS', 'fakturační adresa');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Způsob platby');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_TEXT_CONFIRM', 'Nová objednávka z ');
  
// Purchase Without Account
  define('EMAIL_WARNING', 'NOTE: Emailová adresa byla potvrzena návštěvníkem našeho online-obchodu. Pokud nesjte návštěvník, prosíme zašlete zprávu:  ' . STORE_OWNER_EMAIL_ADDRESS . 'Děkujeme za vaši objednávku. Přejeme vám pěkný den.');  
?>
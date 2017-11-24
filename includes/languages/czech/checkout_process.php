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
define('EMAIL_TEXT_ORDER_NUMBER', 'Variabilní symbol:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detail faktury:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:',true);
define('EMAIL_TEXT_PRODUCTS', 'Zboží',true);
define('EMAIL_TEXT_SUBTOTAL', 'Mezisoučet:',true);
define('EMAIL_TEXT_TAX', 'Daň:        ',true);
define('EMAIL_TEXT_SHIPPING', 'Dodání: ',true);
define('EMAIL_TEXT_TOTAL', 'Celkem:    ',true);
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresa doručení',true);
define('EMAIL_TEXT_BILLING_ADDRESS', 'fakturační adresa',true);
define('EMAIL_TEXT_PAYMENT_METHOD', 'Způsob platby',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('TEXT_EMAIL_VIA', 'via',true);

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_TEXT_CONFIRM', 'Nová objednávka z ',true);
  
// Purchase Without Account
  define('EMAIL_WARNING', 'POZNÁMKA: Vaše emailová adresa byla zadána návštěvníkem našeho online obchodu. Pokud jste u nás neobjednával(a), napšte nám prosím na tuto adresu:  ' . STORE_OWNER_EMAIL_ADDRESS',true);
?>
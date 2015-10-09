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
  Purchase Without Account (PWA) -- http://addons.oscommerce.com/info/9142

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Objednávky');
define('HEADING_TITLE_SEARCH', 'ID objednávky:');
define('HEADING_TITLE_STATUS', 'Stav:');

define('TABLE_HEADING_COMMENTS', 'Poznámky');
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');
define('TABLE_HEADING_ORDER_TOTAL', 'Celkem objednáno');
define('TABLE_HEADING_DATE_PURCHASED', 'Datum nákupu');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Provést');
define('TABLE_HEADING_QUANTITY', 'Množství');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Zboží');
define('TABLE_HEADING_TAX', 'DPH');
define('TABLE_HEADING_TOTAL', 'Celkem');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (bez DPH)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena (s DPH)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Celkem (bez DPH)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Celkem (s DPH)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Zákaznické informace');
define('TABLE_HEADING_DATE_ADDED', 'Datum přidání');

define('ENTRY_CUSTOMER', 'Zákazník:');
define('ENTRY_SOLD_TO', 'Adresa plátce:');
define('ENTRY_DELIVERY_TO', 'Delivery To:');
define('ENTRY_SHIP_TO', 'Adresa dodání:');
define('ENTRY_SHIPPING_ADDRESS', 'Adresa dodání:');
define('ENTRY_BILLING_ADDRESS', 'Fakturační adresa:');
define('ENTRY_PAYMENT_METHOD', 'Způsob platby:');
define('ENTRY_CREDIT_CARD_TYPE', 'Druh kreditní karty:');
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník karty:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo kreditní karty:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Expirace kreditní karty:');
define('ENTRY_SUB_TOTAL', 'Bez DPH:');
define('ENTRY_TAX', 'DPH:');
define('ENTRY_SHIPPING', 'Dopravné:');
define('ENTRY_TOTAL', 'celkem s DPH:');
define('ENTRY_DATE_PURCHASED', 'Datum prodeje:');
define('ENTRY_STATUS', 'Stav:');
define('ENTRY_DATE_LAST_UPDATED', 'Datum poslední změny:');
define('ENTRY_NOTIFY_CUSTOMER', 'Oznamovat zákazníkovi:');
define('ENTRY_NOTIFY_COMMENTS', 'Zasílat poznámky:');
define('ENTRY_PRINTABLE', 'Tisk objednávky');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Smazat objednávku');
define('TEXT_INFO_DELETE_INTRO', 'Jste připraveni smazat objednávku?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Doskladnit zboží v množství:');
define('TEXT_DATE_ORDER_CREATED', 'Datum vytvoření:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Poslední změna:');
define('TEXT_INFO_PAYMENT_METHOD', 'Způsob platby:');

define('TEXT_ALL_ORDERS', 'Všechny objednávky');
define('TEXT_NO_ORDER_HISTORY', 'V historii nejsou žádné objednávky.');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Změna objednávky');
define('EMAIL_TEXT_ORDER_NUMBER', 'Číslo objednávky:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaily objednávky:');
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Stav vaší objednávky byl změněn.' . "\n\n" . 'Nový stav: %s' . "\n\n" . 'Máte-li otázky odpovězte na tento e-mail.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Poznámky k vaší objednávce' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Chyba: Objednávka neexistuje.');
define('SUCCESS_ORDER_UPDATED', 'Povedlo se: objednávka byla změněna.');
define('WARNING_ORDER_NOT_UPDATED', 'Pozor: Nebyla provedena žádná změna. Objednávka nezměněna.');

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_HTML_STATUS_UPDATE','Your order has been updated to: ');
  
// Purchase Without Account
  define('GUEST', 'Guest');  
?>

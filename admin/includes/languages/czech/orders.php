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

define('HEADING_TITLE', 'Objednávky',true);
define('HEADING_TITLE_SEARCH', 'ID objednávky:',true);
define('HEADING_TITLE_STATUS', 'Stav:',true);

define('TABLE_HEADING_COMMENTS', 'Poznámky',true);
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci',true);
define('TABLE_HEADING_ORDER_TOTAL', 'Celkem objednáno',true);
define('TABLE_HEADING_DATE_PURCHASED', 'Datum nákupu',true);
define('TABLE_HEADING_STATUS', 'Stav',true);
define('TABLE_HEADING_ACTION', 'Provést',true);
define('TABLE_HEADING_QUANTITY', 'Množství',true);
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model',true);
define('TABLE_HEADING_PRODUCTS', 'Zboží',true);
define('TABLE_HEADING_TAX', 'DPH',true);
define('TABLE_HEADING_TOTAL', 'Celkem',true);
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (bez DPH)',true);
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena (s DPH)',true);
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Celkem (bez DPH)',true);
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Celkem (s DPH)',true);

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Zákaznické informace',true);
define('TABLE_HEADING_DATE_ADDED', 'Datum přidání',true);

define('ENTRY_CUSTOMER', 'Zákazník:',true);
define('ENTRY_SOLD_TO', 'Adresa plátce:',true);
define('ENTRY_DELIVERY_TO', 'Delivery To:',true);
define('ENTRY_SHIP_TO', 'Adresa dodání:',true);
define('ENTRY_SHIPPING_ADDRESS', 'Adresa dodání:',true);
define('ENTRY_BILLING_ADDRESS', 'Fakturační adresa:',true);
define('ENTRY_PAYMENT_METHOD', 'Způsob platby:',true);
define('ENTRY_CREDIT_CARD_TYPE', 'Druh kreditní karty:',true);
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník karty:',true);
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo kreditní karty:',true);
define('ENTRY_CREDIT_CARD_EXPIRES', 'Expirace kreditní karty:',true);
define('ENTRY_SUB_TOTAL', 'Bez DPH:',true);
define('ENTRY_TAX', 'DPH:',true);
define('ENTRY_SHIPPING', 'Dopravné:',true);
define('ENTRY_TOTAL', 'celkem s DPH:',true);
define('ENTRY_DATE_PURCHASED', 'Datum prodeje:',true);
define('ENTRY_STATUS', 'Stav:',true);
define('ENTRY_DATE_LAST_UPDATED', 'Datum poslední změny:',true);
define('ENTRY_NOTIFY_CUSTOMER', 'Oznamovat zákazníkovi:',true);
define('ENTRY_NOTIFY_COMMENTS', 'Zasílat poznámky:',true);
define('ENTRY_PRINTABLE', 'Tisk objednávky',true);

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Smazat objednávku',true);
define('TEXT_INFO_DELETE_INTRO', 'Jste připraveni smazat objednávku?',true);
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Doskladnit zboží v množství:',true);
define('TEXT_DATE_ORDER_CREATED', 'Datum vytvoření:',true);
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Poslední změna:',true);
define('TEXT_INFO_PAYMENT_METHOD', 'Způsob platby:',true);

define('TEXT_ALL_ORDERS', 'Všechny objednávky',true);
define('TEXT_NO_ORDER_HISTORY', 'V historii nejsou žádné objednávky.',true);

define('EMAIL_SEPARATOR', '------------------------------------------------------',true);
define('EMAIL_TEXT_SUBJECT', 'Změna objednávky',true);
define('EMAIL_TEXT_ORDER_NUMBER', 'Číslo objednávky:',true);
define('EMAIL_TEXT_INVOICE_URL', 'Detaily objednávky:',true);
define('EMAIL_TEXT_DATE_ORDERED', 'Datum objednávky:',true);
define('EMAIL_TEXT_STATUS_UPDATE', 'Stav vaší objednávky byl změněn.' . "\n\n" . 'Nový stav: %s' . "\n\n" . 'Máte-li otázky odpovězte na tento e-mail.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Poznámky k vaší objednávce' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Chyba: Objednávka neexistuje.',true);
define('SUCCESS_ORDER_UPDATED', 'Povedlo se: objednávka byla změněna.',true);
define('WARNING_ORDER_NOT_UPDATED', 'Pozor: Nebyla provedena žádná změna. Objednávka nezměněna.',true);

/*
************************************************************************
************** Custom Filenames can be defined below here **************
**************               Raymond Burns                **************
************************************************************************
*/
// Mail Manager
  define('EMAIL_HTML_STATUS_UPDATE','Your order has been updated to: ',true);
  
// Purchase Without Account
  define('GUEST', 'Guest',true);  
?>

<?php
/*
  $Id: orders.php,v 1.25 2003/06/20 00:28:44 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Objednávky');
define('HEADING_TITLE_SEARCH', 'ID objednávky:');
define('HEADING_TITLE_STATUS', 'Stav:');

define('TABLE_HEADING_COMMENTS', 'Komentáre');
define('TABLE_HEADING_CUSTOMERS', 'Zákazníci');
define('TABLE_HEADING_ORDER_TOTAL', 'Objednávky');
define('TABLE_HEADING_DATE_PURCHASED', 'Dátum nákupu');
define('TABLE_HEADING_STATUS', 'Stav');
define('TABLE_HEADING_ACTION', 'Akcia');
define('TABLE_HEADING_QUANTITY', 'Množstvo');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Produkt');
define('TABLE_HEADING_TAX', 'Daň');
define('TABLE_HEADING_TOTAL', 'Celkom');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Cena (bez Dane)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Cena (s Daňou)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Celkom (bez Dane)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Celkom (s Daňou)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Zákazník Upovedomený');
define('TABLE_HEADING_DATE_ADDED', 'Pridané Dňa');

define('ENTRY_CUSTOMER', 'Zákazník:');
define('ENTRY_SOLD_TO', 'PLATITEĽ:');
define('ENTRY_DELIVERY_TO', 'Dodávka:');
define('ENTRY_SHIP_TO', 'ODBERATEĽ:');
define('ENTRY_SHIPPING_ADDRESS', 'Dodacia adresa:');
define('ENTRY_BILLING_ADDRESS', 'Platobná adresa:');
define('ENTRY_PAYMENT_METHOD', 'Spôsob platby:');
define('ENTRY_CREDIT_CARD_TYPE', 'Typ kreditnej karty:');
define('ENTRY_CREDIT_CARD_OWNER', 'Vlastník kreditnej karty:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Číslo kreditnej karty:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Expirácia kreditnej karty:');
define('ENTRY_SUB_TOTAL', 'Medzisúčet:');
define('ENTRY_TAX', 'Daň:');
define('ENTRY_SHIPPING', 'Doprava:');
define('ENTRY_TOTAL', 'Celkom:');
define('ENTRY_DATE_PURCHASED', 'Dátum nákupu:');
define('ENTRY_STATUS', 'Stav:');
define('ENTRY_DATE_LAST_UPDATED', 'Dátum poslednej úpravy:');
define('ENTRY_NOTIFY_CUSTOMER', 'Upovedomiť zákazníka:');
define('ENTRY_NOTIFY_COMMENTS', 'Pridať komentár:');
define('ENTRY_PRINTABLE', 'Vytlačiť účet');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Odstrániť objednávku');
define('TEXT_INFO_DELETE_INTRO', 'Naozaj chcete odstrániť túto objednávku?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Obnoviť množstvo produktu na sklade');
define('TEXT_DATE_ORDER_CREATED', 'Dátum vytvorenia:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Posledná úprava:');
define('TEXT_INFO_PAYMENT_METHOD', 'Spôsob platby:');

define('TEXT_ALL_ORDERS', 'Všetky objednávky');
define('TEXT_NO_ORDER_HISTORY', 'História objednávok nie je dostupná');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Aktualizácia objednávky');
define('EMAIL_TEXT_ORDER_NUMBER', 'Číslo objednávky:');
define('EMAIL_TEXT_INVOICE_URL', 'Účet:');
define('EMAIL_TEXT_DATE_ORDERED', 'Dátum objednávky:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Vaša objednávka bola aktualizovaná do následujúceho stavu.' . "\n\n" . 'Nový stav: %s' . "\n\n" . 'Ak máte akékoľvek otázky, napíšte nám na tento mail.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Komentár pre vašu objednávku je' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Chyba: Objednávka neexistuje.');
define('SUCCESS_ORDER_UPDATED', 'Objednávka bola úspešne aktualizovaná.');
define('WARNING_ORDER_NOT_UPDATED', 'Upozornenie: Žiadna zmena, objednávka nebola aktualizovaná.');
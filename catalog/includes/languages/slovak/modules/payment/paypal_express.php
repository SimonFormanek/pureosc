<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_TITLE', 'PayPal Express Checkout');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_PUBLIC_TITLE', 'PayPal (vrátane kreditných a debetných kariet)');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_DESCRIPTION', '<img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&paypal&oscom23&express_checkout" target="_blank" style="text-decoration: underline; font-weight: bold;">Zobraziť prihlásený dokumentácie</a><br /><br /><img src="images/icon_popup.gif" border="0" />&nbsp;<a href="https://www.paypal.com" target="_blank" style="text-decoration: underline; font-weight: bold;">Navštívte PayPal webové stránky</a>');

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_ERROR_ADMIN_CURL', 'Tento modul vyžaduje cURL, ktoré majú byť povolený, PHP a nenačíta, kým to bolo povolené na tomto serveri.');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_ERROR_ADMIN_CONFIGURATION', 'Tento modul nenačíta, dokiaľ predávajúci účet alebo API poverenia boli nakonfigurované parametre. Prosím, upravovať a konfigurovať nastavenia tohto modulu.');

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_BUTTON', 'Pozrite sa na PayPal');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_COMMENTS', 'Komentáre:');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_EMAIL_PASSWORD', 'Účet sa automaticky vytvorený pre vás nasledujúcu e-mailovú adresu a heslo:' . "\n\n" . 'Obchod účtu E-mailová adresa: %s' . "\n" . 'Obchod Účet: Heslo: %s' . "\n\n");

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_BUTTON', 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_checkout_pp_142x27.png');
//  define('MODULE_PAYMENT_PAYPAL_EXPRESS_LANGUAGE_LOCALE', 'sk_SK');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_LANGUAGE_LOCALE', 'US');

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_LINK_TITLE', 'Test pripojenia API servera');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_TITLE', 'Pripojenie API Server test');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_GENERAL_TEXT', 'Testovanie pripojenia k serveru ..');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_BUTTON_CLOSE', 'Zavrieť');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_TIME', 'Pripojenie Čas:');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_SUCCESS', 'Úspech!');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_FAILED', 'Nepodarilo! Prečítajte si prosím overte, nastavenie SSL certifikát a skúste to znova.');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_DIALOG_CONNECTION_ERROR', 'Došlo k chybe. Prosím aktualizujte stránku, skontrolujte nastavenia a skúste to znova.');

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_ERROR_NO_SHIPPING_AVAILABLE_TO_SHIPPING_ADDRESS', 'Námorná doprava je v súčasnej dobe k dispozícii pre vybrané doručovaciu adresu. Prosím, vyberte alebo vytvorte novú dodaciu adresu pre použitie s nákupom.');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_WARNING_LOCAL_LOGIN_REQUIRED', 'Prosím, prihláste sa k svojmu účtu na overenie objednávky.');
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_NOTICE_CHECKOUT_CONFIRMATION', 'Prosím skontrolujte a potvrďte objednávku nižšie. Vaša objednávka nebudú spracované, kým to bolo potvrdené.');
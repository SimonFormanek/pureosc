<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_CONTENT_PAYPAL_LOGIN_TITLE', 'Prihlásiť sa cez PayPal');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DESCRIPTION', 'Povolenie sa prihlásiť pomocou PayPal s bezproblémovú pokladne pre PayPal Express Checkout platieb
<br /><br /><img src="images/icon_info.gif" border="0" />&nbsp;<a href="http://library.oscommerce.com/Package&en&paypal&oscom23&log_in" target="_blank" style="text-decoration: underline; font-weight: bold;">Zobraziť prihlásený dokumentácie</a><br /><br /><img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.paypal.com" target="_blank" style="text-decoration: underline; font-weight: bold;">Navštívte PayPal webové stránky</a>');

  define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_TITLE', 'Prihlásiť sa cez PayPal');
  define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_CONTENT', 'Máte účet PayPal? Bezpečne prihlásiť PayPal nakupovať ešte rýchlejšie!');
  define('MODULE_CONTENT_PAYPAL_LOGIN_TEMPLATE_SANDBOX', 'Testovací režim: Sandbox Server je aktuálne vybraný.');

  define('MODULE_CONTENT_PAYPAL_LOGIN_ERROR_ADMIN_CURL', 'Tento modul vyžaduje cURL, ktoré majú byť povolený, PHP a nenačíta, kým to bolo povolené na tomto serveri.');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ERROR_ADMIN_CONFIGURATION', 'Tento modul nenačíta, kým boli nakonfigurované ID klienta a tajné parametre. Prosím, upravovať a konfigurovať nastavenia tohto modulu. ');

  define('MODULE_CONTENT_PAYPAL_LOGIN_LANGUAGE_LOCALE', 'sk_SK');

  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_personal', 'Osobné údaje');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_address', 'Adresa informácií');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_account', 'Informácie o účte');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_GROUP_checkout', 'Pokladňa Express');

  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_full_name', 'Meno a priezvisko');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_date_of_birth', 'Dátum narodenia');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_age_range', 'Vekové rozpätie');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_gender', 'Rod');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_email_address', 'E-mailová adresa');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_street_address', 'Ulice');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_city', 'Mesto');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_state', 'štát');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_country', 'Krajiny');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_zip_code', 'PSČ');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_phone', 'Telefón');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_status', 'Stav účtu (bez overenia)');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_type', 'Typ Konta');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_account_creation_date', 'Vytvorenie účtu Dátum');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_time_zone', 'časové pásmo');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_locale', 'národné');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_language', 'jazyk');
  define('MODULE_CONTENT_PAYPAL_LOGIN_ATTR_seamless_checkout', 'Bezšvíkové Pokladňa');

  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_LINK_TITLE', 'Test pripojenia API servera');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_TITLE', 'Pripojenie API Server test');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_GENERAL_TEXT', 'Testovanie pripojenia k serveru ..');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_BUTTON_CLOSE', 'Zavrieť');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_TIME', 'Pripojenie Čas:');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_SUCCESS', 'Úspech!');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_FAILED', 'Nepodarilo! Prečítajte si prosím overte, nastavenie SSL certifikát a skúste to znova.');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_CONNECTION_ERROR', 'Došlo k chybe. Prosím aktualizujte stránku, skontrolujte nastavenia a skúste to znova.');

  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_LINK_TITLE', 'Zobraziť PayPal aplikácie URL');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_TITLE', 'PayPal použitie adresy URL');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_RETURN_TEXT', 'Presmerovanie/Return URL:');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_PRIVACY_TEXT', 'Zásady ochrany osobných údajov URL:');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_TERMS_TEXT', 'Dohoda Užívateľ URL:');
  define('MODULE_CONTENT_PAYPAL_LOGIN_DIALOG_URLS_BUTTON_CLOSE', 'Zavrieť');
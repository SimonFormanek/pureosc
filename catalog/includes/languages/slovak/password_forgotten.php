<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Prihlásenie');
define('NAVBAR_TITLE_2', 'Heslo Zabudli');

define('HEADING_TITLE', 'Zabudol som svoje heslo !');

define('TEXT_MAIN', 'Ak ste zabudli svoje heslo , zadajte nižšie svoju e - mailovú adresu a my vám bude posielať inštrukcie, ako bezpečne zmeniť heslo .');

define('TEXT_PASSWORD_RESET_INITIATED', 'Skontrolujte prosím Váš e - mail pre inštrukcie o tom , ako zmeniť heslo Pokyny obsahujú odkaz , ktorý je platný iba po dobu 24 hodín alebo kým bol aktualizovaný heslo ');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Chyba : . E - mailová adresa nebola nájdená v našich záznamoch , skúste to prosím znova');

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME . ' - Nové heslo');
define('EMAIL_PASSWORD_RESET_BODY', 'bolo vyžiadané nové heslo pre Váš účet na ' . STORE_NAME . '.' . "\n\n" . 'Prosím , postupujte podľa tohto osobného odkaz bezpečne zmeniť svoje heslo : ' . "\n\n" . '%s' . "\n\n" . 'Tento odkaz bude automaticky vyradené po 24 hodinách alebo po vykonaní zmeny hesla .' . "\n\n" . 'Pre pomoc s niektorou z našich on - line .. služby , prosím , napíšte na obchod - majiteľ : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");

define('ERROR_ACTION_RECORDER', 'Chyba : link Password Reset je už odoslaný , prosíme skúste znova za %s minút.');
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Přihlášení',true);
define('NAVBAR_TITLE_2', 'Zapomenuté heslo',true);

define('HEADING_TITLE', 'Zapomněl jsem své heslo!',true);

define('TEXT_MAIN', 'Zapomněl jste heslo? Vložte svou e-mailovou adresu, která byla zadána při registraci a my Vám pošleme nové.',true);

define('TEXT_PASSWORD_RESET_INITIATED', 'Zkontrolujte, prosím, e-mail, kde naleznete pokyny, jak změnit heslo. Pokyny obsahují odkaz, který je platný pouze po dobu 24 hodin nebo dokud nebude vaše heslo aktualizováno.',true);

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Nezadal jste e-mail nebo je nesprávný, zkuste zadat znovu.',true);

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME . ' - Nové heslo',true);
define('EMAIL_PASSWORD_RESET_BODY', 'Heslo bylo vyžádáno z ' . STORE_NAME . '.' . "\n\n" . 'Pro bezpečnou změnu hesla postupujte podle tohoto osobního odkazu:' . "\n\n" . '%s' . "\n\n" . 'Tento odkaz bude automaticky vyřazen po 24 hodinách nebo po změně hesla.' . "\n\n" . 'Chcete-li nám pomoci s některou z našich služeb online, zašlete e-mail majiteli obchodu: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");

define('ERROR_ACTION_RECORDER', 'Chyba: Odkaz na obnovení hesla již byl odeslán. Zkuste to prosím znovu po % minutách.',true);
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2012 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE_1', 'Přihlášení', true);
define('NAVBAR_TITLE_2', 'Zapomenuté heslo', true);

define('HEADING_TITLE', 'Zapomněl jsem své heslo!', true);

define('TEXT_MAIN',
    'Zapomněl(a) jste heslo? Vložte svou e-mailovou adresu, která byla zadána při registraci a my Vám pošleme nové.',
    true);

define('TEXT_PASSWORD_RESET_INITIATED',
    'Ve vaší e-mailové schránce naleznete pokyny, jak změnit heslo. V mailu naleznete odkaz, který je platný pouze po dobu 24 hodin nebo dokud nebude vaše heslo aktualizováno.',
    true);

define('TEXT_NO_EMAIL_ADDRESS_FOUND',
    'Nezadal jste e-mail nebo je nesprávný, zkuste zadat znovu.', true);

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME.' - Nové heslo', true);
define('EMAIL_PASSWORD_RESET_BODY',
    'Heslo bylo vyžádáno z '.STORE_NAME.'.'."\n\n".'Pro bezpečnou změnu hesla klikněte na tento odkaz:'."\n\n".'%s'."\n\n".'Tento jednorázový odkaz má platnost 24 hodin.'."\n\n".'Pokud potřebujete pomoc, napište mám: '.STORE_OWNER_EMAIL_ADDRESS.'.'."\n\n");

define('ERROR_ACTION_RECORDER',
    'Chyba: Odkaz na obnovení hesla již byl odeslán. Zkuste to prosím znovu po % minutách.',
    true);
?>

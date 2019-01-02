<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE_1', 'Anmelden', true);
define('NAVBAR_TITLE_2', 'Passwort vergessen', true);

define('HEADING_TITLE', 'Ich habe mein Passwort vergessen!', true);

define('TEXT_MAIN',
    'Wenn Sie Ihr Passwort vergessen haben, geben Sie Ihre E-Mail-Adresse ein und wir senden Ihnen Anweisungen, wie sicher Ihr Passwort ändern.',
    true);

define('TEXT_PASSWORD_RESET_INITIATED',
    ' überprüfen Sie Ihre E-Mail-Anweisungen, wie Sie Ihr Passwort zu &aml;ndern. Es enth&aml;lt einen Link, der für 24 Stunden oder bis das Passwort wurde aktualisiert funktioniert.',
    true);

define('TEXT_NO_EMAIL_ADDRESS_FOUND',
    'Fehler: Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.',
    true);

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME.' - Neues Passwort', true);
define('EMAIL_PASSWORD_RESET_BODY',
    'Ein neues Passwort für Ihr Konto wurde angefordert '.STORE_NAME.'.'."\n\n".'Folgen Sie diesem Link, um pers&oml;nliche sicher Ihr Passwort &aml;ndern:'."\n\n".'%s'."\n\n".'Dieser Link wird automatisch nach 24 Stunden oder nach Ihrem Passwort wurde ge&aml;ndert verworfen.'."\n\n".'Wenn Sie Hilfe mit einem unserer Online-Dienste ben&oml;tigen, mailen Sie an den Shopbetreiber: '.STORE_OWNER_EMAIL_ADDRESS.'.'."\n\n");

define('ERROR_ACTION_RECORDER',
    ' Fehler: Ein Link zum Zurücksetzen des Passworts wurde bereits gesendet. Versuchen Sie es in %s Minuten.',
    true);
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

define('NAVBAR_TITLE', 'Konto erstellen', true);

define('HEADING_TITLE', 'Informationen zu Ihrem Kundenkonto', true);

define('TEXT_ORIGIN_LOGIN',
    '<font color="#FF0000"><small><b>ACHTUNG:</b></font></small> Wenn Sie bereits ein Konto besitzen, so melden Sie sich bitte <a href="%s"><u><b>hier</b></u></a> an.',
    true);

define('EMAIL_SUBJECT', 'Willkommen bei'.STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,'."\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,'."\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrte/r %s'."\n\n");
//define('EMAIL_GREET_NONE', 'Sehr geehrte ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME',
    'Willkommen bei <strong>'.STORE_NAME.'</strong>.'."\n\n");
define('EMAIL_TEXT',
    'Sie können jetzt unseren <strong>Online-Service</strong> nutzen. Der Service bietet unter anderem:'."\n\n".'<li><strong>Kundenwarenkorb</strong> - Jeder Artikel bleibt registriert bis Sie zur Kasse gehen, oder die Produkte aus dem Warenkorb entfernen.'."\n".'<li><strong>Adressbuch</strong> - Wir können jetzt die Produkte zu der von Ihnen ausgesuchten Adresse senden. Der perfekte Weg ein Geburtstagsgeschenk zu versenden.'."\n".'<li><strong>Vorherige Bestellungen</strong> - Sie können jederzeit Ihre vorherigen Bestellungen überprüfen.'."\n".'<li><strong>Meinungen über Produkte</strong> - Teilen Sie Ihre Meinung zu unseren Produkten mit anderen Kunden.'."\n\n");
define('EMAIL_CONTACT',
    'Falls Sie Fragen zu unserem Kunden-Service haben, wenden Sie sich bitte an den Vertrieb: '.STORE_OWNER_EMAIL_ADDRESS.'.'."\n\n");
define('EMAIL_WARNING',
    '<strong>Achtung:</strong> Diese eMail-Adresse wurde uns von einem Kunden bekannt gegeben. Falls Sie sich nicht angemeldet haben, senden Sie bitte eine eMail an '.STORE_OWNER_EMAIL_ADDRESS.'.'."\n");
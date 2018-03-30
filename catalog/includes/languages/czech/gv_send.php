<?php
/*
  $Id: gv_send.php,v 1.1.2.1 2003/04/18 17:25:44 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Odeslat dárkový poukaz',true);
define('NAVBAR_TITLE', 'Odeslat dárkový poukaz',true);
define('EMAIL_SUBJECT', 'Poptávka z ' . STORE_NAME);
define('HEADING_TEXT','<br>Vyžádejte si podrobnosti o dárkovém poukazu, který chcete poslat. Další informace naleznete na našich stránkách <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a><br>',true);
define('ENTRY_NAME', 'Jméno příjemce:',true);
define('ENTRY_EMAIL', 'Emailová adresa příjemce:',true);
define('ENTRY_MESSAGE', 'Zpráva příjemcům:',true);
define('ENTRY_AMOUNT', 'Výše dárkového poukazu:',true);
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Neplatná částka</span>',true);
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Neplatná emailová adresa</span>',true);
define('MAIN_MESSAGE', 'Nyní můžete zaslat dárkový poukaz % na % tuto emailovou adresu %<br><br>Doplněný text<br><br>Vážený, Vážená %<br><br>
                        Bude vám zaslán dárkový poukaz % dle %');

define('PERSONAL_MESSAGE', '%s říká',true);
define('TEXT_SUCCESS', 'Blahopřejeme, Váš dárkový poukaz byl úspěšně odeslán.',true);


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------',true);
define('EMAIL_GV_TEXT_HEADER', 'Gratulujeme, obdrželi jste dárkový poukaz %',true);
define('EMAIL_GV_TEXT_SUBJECT', 'Dárek od %',true);
define('EMAIL_GV_FROM', 'Byl vám zaslán tento dárkový poukaz %',true);
define('EMAIL_GV_MESSAGE', 'S obsahem ',true);
define('EMAIL_GV_SEND_TO', 'Dobrý den, %',true);
define('EMAIL_GV_REDEEM', 'Chcete-li uplatnit tento dárkový poukaz, klikněte na níže uvedený odkaz. Napište prosím i kód nákupu, který je %. V případě, že máte problémy,',true);
define('EMAIL_GV_LINK', 'K uplatnění poukazu klikněte prosím ',true);
define('EMAIL_GV_VISIT', ' nebo navštivte ',true);
define('EMAIL_GV_ENTER', ' a vložte kód ',true);
define('EMAIL_GV_FIXED_FOOTER', 'Pokud máte problémy s uplatněním dárkového poukazu pomocí automatického odkazu výše, ' . "\n" . 
                                'můžete také vložit kód dárkového poukazu během procesu platby v našem obchodě.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '',true);
?>

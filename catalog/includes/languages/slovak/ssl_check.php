<?php
/*
  $Id: ssl_check.php,v 1.1 2003/03/10 23:32:20 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Test bezpečnosti');
define('HEADING_TITLE', 'Test bezpečnosti');

define('TEXT_INFORMATION', 'Zistili sme, že váš prehliadač vygeneroval iné SSL session ID použité na našich zabezpečených stránkach.<br><br>Z bezpečnostných dôvodov sa budete musieť znovu prihlásiť k svojmu účtu pre pokračovanie v nákupe.<br><br>Niektoré prehliadače nemajú možnosť generovať SSL Session ID automaticky pokiaľ je treba. Pokiaľ je to váš prípad, použite prosím iný prehliadač.');

define('BOX_INFORMATION_HEADING', 'Súkromie a zabezpečenie');
define('BOX_INFORMATION', 'Overujeme SSL Session ID automaticky generované vašim prehliadačom u každej vašej SSL požiadavky smerovanej na tento server.<br><br>Táto validácia zaručuje že ste to vy, kto prehliada naše stránky s použitím vášho účtu.');
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', 'Platba bankovním převodem (Check/Money Order)',true);
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', 'Číslo účtu:&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br /><br />Ve prospěch:<br />' . STORE_NAME . '<br />' . nl2br(STORE_ADDRESS) . '<br /><br />' . 'Vaše objednávka bude expedována po připsání platby na náš účet.',true);
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "Číslo účtu: ". MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\nVe prospěch:\n" . STORE_NAME . "\n" . STORE_ADDRESS . "\n\n" . 'Vaše objednávka bude expedována po připsání platby na náš účet.',true);
?>

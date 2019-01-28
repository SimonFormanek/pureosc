<?php
/*
$Id: eubanktransfer.php,v 1.5 2006/01/16 14:36:04 i2paq Exp $

Thanks Onkel Flo for creating its basic.

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2002 osCommerce

Released under the GNU General Public License
BER 2013 translated from swedish to slovakian
*/

define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_TITLE', 'EÚ bankový prevod');
define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_DESCRIPTION', '' .
'Preveďte celkovú sumu na uvedený bankový účet. Nezabudnite uviesť svoje meno a číslo objednávky ako odosielateľa.<br />' .
'<br />účet: ' . MODULE_PAYMENT_EU_ACCOUNT_HOLDER .
'<br />účet IBAN: ' . MODULE_PAYMENT_EU_IBAN .
'<br />BIC/SWIFT-kód: ' . MODULE_PAYMENT_EU_BIC .
'<br />Banka: ' . MODULE_PAYMENT_EU_BANKNAME .
'<br /><br /><b>Poznámka:</b> Rozhodli ste sa zaplatiť bankovým prevodom, uistite sa, že platba je v náš bankový účet do 7 dní, inak bude vaša objednávka vymazané.<br />Máme loď, ak platba bola zapísaná v náš bankový účet!<br />');

define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_EMAIL_FOOTER', 'Preveďte celkovú sumu na uvedený bankový účet. Zadajte svoje meno a číslo objednávky ako odosielateľa.' . "\n" .
"účet: " . MODULE_PAYMENT_EU_ACCOUNT_HOLDER . "\n" .
"účet IBAN: " . MODULE_PAYMENT_EU_IBAN . "\n" .
"BIC/SWIFT-kód: " . MODULE_PAYMENT_EU_BIC . "\n" . 
"Banka: " . MODULE_PAYMENT_EU_BANKNAME . "\n\n" . 
'Poznámka: Rozhodli ste sa zaplatiť bankovým prevodom, uistite sa, že platba je v náš bankový účet do 7 dní, inak bude vaša objednávka vymazané.'. "\n" .
'Máme loď, ak platba bola zapísaná v náš bankový účet!');
?>

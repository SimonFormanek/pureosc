<?php
/*
$Id: eubanktransfer.php,v 1.4 2006/01/16 14:36:04 i2paq Exp $

Thanks Onkel Flo for creating its basic.

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2013 osCommerce

Released under the GNU General Public License
*/

define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_TITLE', 'Transferencia por Banco Europeo');
define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_DESCRIPTION', '' .
'<br />Favor de transferir el total a la siguiente cuenta bancaria. Escriba su nombre y su número de factura en el campo de asunto.<br />' .
'<br />Cuenta: ' . MODULE_PAYMENT_EU_ACCOUNT_HOLDER .
'<br />Número IBAN: ' . MODULE_PAYMENT_EU_IBAN .
'<br />Código BIC / SWIFT: ' . MODULE_PAYMENT_EU_BIC .
'<br />Banco: ' . MODULE_PAYMENT_EU_BANKNAME .
'<br /><br /><b>Atenci&oacute;n:</b> Ha elegido el pago por transferencia bancaria, aseg&uacute;rese de que recibamos su pago antes de 7 d&iacute;as o su orden ser&aacute; cancelada.<br />Su &oacute;rden no ser&aacute; enviada hasta que recibamos su pago!<br />');

define('MODULE_PAYMENT_EU_BANKTRANSFER_TEXT_EMAIL_FOOTER', 'Favor de transferir el total a la siguiente cuenta bancaria. Escriba su nombre y su numero de factura en el campo de asunto.' . "\n\n" .
"Cuenta: " . MODULE_PAYMENT_EU_ACCOUNT_HOLDER . "\n\n" .
"N&uacute;mero IBAN: " . MODULE_PAYMENT_EU_IBAN . "\n\n" .
"C&oacute;digo BIC / SWIFT: " . MODULE_PAYMENT_EU_BIC . "\n\n" . 
"Banco: " . MODULE_PAYMENT_EU_BANKNAME . "\n\n" . 
'Atenci&oacute;n:</b> Ha elegido el pago por transferencia bancaria, aseg&uacute;rese de que recibamos su pago antes de 7 dias o su orden ser&aacute; cancelada.'. "\n\n" .
'Su orden no ser&aacute; enviada hasta que recibamos su pago!');
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

  $paypal_express_ping_button = '';
  if (defined('MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS')) {
    $paypal_express_ping_button = '<p><img src="images/icons/locked.gif" border="0">&nbsp;<a href=' . tep_href_link('ext/modules/payment/paypal/paypal_express.php', 'action=test', 'SSL') . ' target="_blank" style="text-decoration: underline; font-weight: bold;">Test API Credentials</a></p>';
  }

  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_TITLE', 'Pago Exprés de PayPal',true);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_PUBLIC_TITLE', 'PayPal (incluye tarjetas de crédito y de débito)',true);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_DESCRIPTION', '<img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.paypal.com/mrb/pal=PS2X9Q773CKG4" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit PayPal Website</a>&nbsp;<a href="javascript:toggleDivBlock(\'paypalExpressInfo\',true);">(info)</a><span id="paypalExpressInfo" style="display: none;"><br /><i>Usando el enlace de arriba para registrarse en Paypal subvenciona osCommerce con un pequeño bono financiero por referir a un cliente.</i></span>' . $paypal_express_ping_button);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_BUTTON', 'Pagar con PayPal',true);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_TEXT_COMMENTS', 'Comentarios:',true);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_EMAIL_PASSWORD', 'Una cuenta ha sido creada autom&aacute;ticamente para usted con la siguiente direcci&oacute;n de correo electr&oacute;nico y su contrase&ntilde;a:' . "\n\n" . 'Direcci&oacute;n de Correo Electr&oacute;nico de la Cuenta: %s' . "\n" . 'Contrase&ntilde;a de la cuenta: %s' . "\n\n");
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_BUTTON', 'https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif',true);
  define('MODULE_PAYMENT_PAYPAL_EXPRESS_LANGUAGE_LOCALE', 'es_ES',true);

  unset($paypal_express_ping_button);
?>

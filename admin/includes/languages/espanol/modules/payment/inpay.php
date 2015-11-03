<?php
/*
 $Id: inpay.php VER: 1.0.3443 $
 osCommerce, Open Source E-Commerce Solutions
 http://www.oscommerce.com
 Copyright (c) 2008 osCommerce
 Released under the GNU General Public License
 */

  define('MODULE_PAYMENT_INPAY_TEXT_TITLE', 'Inpay - Transferencias instant&aacute;neas en banca en l&iacute;nea');
  define('MODULE_PAYMENT_INPAY_TEXT_PUBLIC_TITLE', 'Pague con su banco en l&iacute;nea - instant&aacute;neo y 100% seguro');
  define('MODULE_PAYMENT_INPAY_TEXT_PUBLIC_HTML', '<img src="https://resources.inpay.com/images/oscommerce/inpay_checkout.png" alt="Pagos seguros mediante inpay" /><br /><br />
  <table cellspacing="5">
  	  <tr><td><img src="https://resources.inpay.com/images/oscommerce/inpay_check.png" alt="100% pagos seguros a trav&eacute;s inpay" /></td><td class="main">100% pagos seguros a trav&eacute;s inpay <span style="color: #666;">- nuestro nivel de seguridad coincide con la seguridad de su banco en l&iacute;nea.</span></td></tr>
  	  <tr><td><img src="https://resources.inpay.com/images/oscommerce/inpay_check.png" alt="Pagos instant&aacute;neos utilizando inpay" /></td><td class="main">Pagos instant&aacute;neos utilizando inpay <span style="color: #666;">- nuestro sistema se asegura de que usted reciba su pedido tan pronto como sea posible.</span></td></tr>
  	  <tr><td><img src="https://resources.inpay.com/images/oscommerce/inpay_check.png" alt="Pagos An&aacute;nimos mediante inpay" /></td><td class="main">Pagos An&oacute;nimos mediante inpay <span style="color: #666;">- no hay necesidad de compartir su n&uacute;mero de tarjeta de cr&eacute;dito o cualquier otra informaci&oacute;n personal.</span></td></tr>
  </table><a href="http://inpay.com/shoppers" style="text-decoration: underline;" target="_blank" class="main">Haga clic aqu&iacute; para leer m&aacute;s sobre inpay</a><br />');
  define('MODULE_PAYMENT_INPAY_TEXT_DESCRIPTION', '<strong>Que es inpay ?</strong><br />
  	  inpay es una opci&oacute;n de pago adicional para tiendas web, que permite a los clientes pagar con su banco en l&iacute;nea - al instante y en todo el mundo.<br />
  	  <br />
  	  <strong>Incremente sus beneficios</strong><br />
	Al permitir a los compradores a pagar con su banco en l&iacute;nea, ahora se puede vender a los clientes que de otro modo no pueden o no quieren pagar hoy.<br />
<br />
<strong>Incremente el tama&ntilde;o del mercado</strong><br />
Al ofrecer a sus clientes la opci&oacute;n de pago inpay aumenta su cuota de mercado no solamente a los titulares de las tarjetas de cr&eacute;dito y d&eacute;bito, sino tambi&eacute;n a los usuarios de la banca en l&iacute;nea de todo el mundo.<br />
<br />
<strong>No hay riesgo</strong><br />
Con inpay no hay riesgo de fraude de tarjetas de cr&eacute;dito o cualquier tipo de devoluci&oacute;n de cargo. Esto significa que cuando a usted le pagan se queda con el pago! Con inpay incluso se puede vender a los clientes de \'alto riesgo\' las regiones incluyen las partes de Asia y Europa del Este.<br /><br />
  <a href="http://inpay.com/" style="text-decoration: underline;" target="_blank">Leer m&aacute;s o reg&iacute;strese en inpay.com</a><br />');
  // ------------- e-mail settings ---------------------------------
  define('EMAIL_TEXT_SUBJECT', 'Pago confirmado por inpay');
  define('EMAIL_TEXT_ORDER_NUMBER', 'N&uacute;mero de Pedido:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detalle de la Factura:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Fecha de pedido:');
  define('EMAIL_TEXT_PRODUCTS', 'Productos');
  define('EMAIL_TEXT_SUBTOTAL', 'SubTotal:');
  define('EMAIL_TEXT_TAX', 'Impuesto:        ');
  define('EMAIL_TEXT_SHIPPING', 'Env&iacute;o: ');
  define('EMAIL_TEXT_TOTAL', 'Total:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Direcci&oacute;n de entrega');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Direcci&oacute;n de facturaci&oacute;n');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'M&eacute;todo de pago');
  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'v&iacute;a');
  
?>
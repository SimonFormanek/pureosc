<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $moneybookers_ping_button = '';
  if (defined('MODULE_PAYMENT_MONEYBOOKERS_STATUS') && tep_not_null(MODULE_PAYMENT_MONEYBOOKERS_SECRET_WORD)) {
    $moneybookers_ping_button = '<p><img src="images/icons/locked.gif" border="0">&nbsp;<a href=' . tep_href_link('ext/modules/payment/moneybookers/activation.php', 'action=testSecretWord', 'SSL') . ' style="text-decoration: underline; font-weight: bold;">Prueba de Palabra Secreta</a></p>';
  }

  define('MODULE_PAYMENT_MONEYBOOKERS_TEXT_TITLE', 'Moneybookers - Core Module',true);
  define('MODULE_PAYMENT_MONEYBOOKERS_TEXT_PUBLIC_TITLE', 'Moneybookers eWallet',true);
  define('MODULE_PAYMENT_MONEYBOOKERS_TEXT_DESCRIPTION', '<img src="images/icon_popup.gif" border="0">&nbsp;<a href="http://www.moneybookers.com/partners/oscommerce" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit Moneybookers Website</a>' . $moneybookers_ping_button);
  define('MODULE_PAYMENT_MONEYBOOKERS_RETURN_TEXT', 'Continuar y regresar a ' . STORE_NAME);
  define('MODULE_PAYMENT_MONEYBOOKERS_LANGUAGE_CODE', 'ES',true);

  define('MB_ACTIVATION_TITLE', 'Activaci&oacute;n de la Cuenta Moneybookers',true);
  define('MB_ACTIVATION_ACCOUNT_TITLE', 'Verificar Cuenta',true);
  define('MB_ACTIVATION_ACCOUNT_TEXT', 'Activando Quick Checkout Moneybookers le permite recibir pagos directos de las Tarjetas de Cr&eacute;dito, Tarjetas de D&eacute;bito y m&aacute;s de 60 opciones de pago en locales en m&aacute;s de 200 pa&iacute;ses, as&iacute; como las eWallet Moneybookers.<br /><br />Para tener acceso a la red internacional de pagos de Moneybookers <a href="http://www.moneybookers.com/partners/oscommerce" target="_blank">por favor reg&iacute;strese aqu&iacute;</a> para obtener una cuenta gratuita si usted no tiene uno a&uacute;n.',true);
  define('MB_ACTIVATION_EMAIL_ADDRESS', 'Direcci&oacute;n de Correo Electr&oacute;nico de la Cuenta Moneybookers:',true);
  define('MB_ACTIVATION_ACTIVATE_TITLE', 'Activaci&oacute;n de la Cuenta',true);
  define('MB_ACTIVATION_ACTIVATE_TEXT', 'Una solicitud de activaci&oacute;n ha sido enviada a Moneybookers. Tenga en cuenta que el proceso de verificaci&oacute;n para usar Quick Checkout Moneybookers puede tardar hasta 72 horas. <strong>Usted ser&aacute; contactado por Moneybookers cuando el proceso de verificaci&oacute;n se haya completado.</strong><br /><br /><i>Despu&eacute;s de la activaci&oacute;n de Moneybookers se le proporcionar&aacute; acceso a una nueva secci&oacute;n en su cuenta de Moneybookers denominado "Herramientas de Venta". Por favor, elija una palabra secreta (no usar su contrase&ntilde;a para esto) e introducir en la secci&oacute;n de herramientas de comerciante y en la configuraci&oacute;n del m&oacute;dulo de pago en la p&aacute;gina siguiente.</i>',true);
  define('MB_ACTIVATION_NONEXISTING_ACCOUNT_TITLE', 'Error en la Cuenta',true);
  define('MB_ACTIVATION_NONEXISTING_ACCOUNT_TEXT', 'La direcci&oacute;n de Correo Electr&oacute;nico no esta registrado en Moneybookers. Por favor <a href="http://www.moneybookers.com/partners/oscommerce" target="_blank">reg&iacute;strese aqu&iacute;</a> para empezar a vender con Moneybookers.',true);
  define('MB_ACTIVATION_SECRET_WORD_TITLE', 'Prueba de Palabra Secreta',true);
  define('MB_ACTIVATION_SECRET_WORD_SUCCESS_TEXT', 'La palabra secreta ha sido configurado <strong>correctamente</strong>! Las transacciones pueden ahora ser verificados de forma segura con la pasarela de pago.',true);
  define('MB_ACTIVATION_SECRET_WORD_FAIL_TEXT', 'La palabra secreta ha sido configurado <strong>incorrectamente</strong>! Por favor revise la palabra secreta en sus "Herramientas de venta" de la cuenta de Moneybookers y la configuraci&oacute;n del m&oacute;dulo de pago.',true);
  define('MB_ACTIVATION_SECRET_WORD_ERROR_TITLE', 'Error',true);
  define('MB_ACTIVATION_SECRET_WORD_ERROR_EXCEEDED', 'El n&uacute;mero m&aacute;ximo de intentos se ha excedido. Por favor, vuelva a intentarlo en una hora.',true);
  define('MB_ACTIVATION_CORE_REQUIRED_TITLE', 'Modulo Principal de pago  (Core Module), Moneybookers es necesario',true);
  define('MB_ACTIVATION_CORE_REQUIRED_TEXT', 'El m&oacute;dulo principal de pago Moneybookers es necesario para soportar las opciones de pago de Moneybookers Quick Checkout. Por favor, continue para instalar y configurar el m&oacute;dulo de pago principal.',true);
  define('MB_ACTIVATION_VERIFY_ACCOUNT_BUTTON', 'Verificar cuenta',true);
  define('MB_ACTIVATION_CONTINUE_BUTTON', 'Continue y configure el m&oacute;dulo de pago',true);
  define('MB_ACTIVATION_SUPPORT_TITLE', 'Soporte',true);
  define('MB_ACTIVATION_SUPPORT_TEXT', 'Tiene preguntas ? Contacte a Moneybookers por Correo Electr&oacute;nico a <a href="mailto:ecommerce@moneybookers.com">ecommerce@moneybookers.com</a> o por tel&eacute;fono +44 (0) 870 383 0762. Su pregunta tambi&eacute;n puede ser contestada en el <a href="http://forums.oscommerce.com/forum/78-moneybookers/" target="_blank">Foro de soporte de la Comunidad osCommerce</a>.',true);
?>

<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
//@setlocale(LC_TIME, 'es_ES.ISO_8859-1');
@setlocale(LC_ALL, 'es_ES.UTF-8');

define('DATE_FORMAT_SHORT', '%d/%m/%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', '',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
//function tep_date_raw($date, $reverse = false) {
//  if ($reverse) {
//    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
//  } else {
//    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
//  }
//}
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}
// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR',true);

// Global entries for the <html> tag
define('HTML_PARAMS', 'dir="LTR" lang="es"',true);

// charset for web pages and emails
//define('CHARSET', 'iso-8859-1',true);
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crear una Cuenta',true);
define('HEADER_TITLE_MY_ACCOUNT', 'Mi Cuenta',true);
define('HEADER_TITLE_CART_CONTENTS', 'Ver Cesta',true);
define('HEADER_TITLE_CHECKOUT', 'Realizar Pedido',true);
define('HEADER_TITLE_TOP', 'Inicio',true);
define('HEADER_TITLE_CATALOG', 'Cat&aacute;logo',true);
define('HEADER_TITLE_LOGOFF', 'Salir',true);
define('HEADER_TITLE_LOGIN', 'Ingresar',true);

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'peticiones desde',true);

// text for gender
define('MALE', 'Hombre',true);
define('FEMALE', 'Mujer',true);
define('MALE_ADDRESS', 'Sr.',true);
define('FEMALE_ADDRESS', 'Sra.',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa',true);

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Informaci&oacute;n de la Entrega',true);
define('CHECKOUT_BAR_PAYMENT', 'Condiciones de la Venta',true);
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmaci&oacute;n',true);
define('CHECKOUT_BAR_FINISHED', 'Finalizado!',true);

// pull down default text
define('PULL_DOWN_DEFAULT', 'Seleccionar',true);
define('TYPE_BELOW', 'Escriba Debajo',true);

// javascript messages
define('JS_ERROR', 'Los errores se han producido durante el proceso de su formulario.\n\nPor favor realice las siguientes correcciones:\n\n',true);

define('JS_REVIEW_TEXT', '* Su \'Comentario\' debe tener al menos ' . REVIEW_TEXT_MIN_LENGTH . ' caracteres.\n',true);
define('JS_REVIEW_RATING', '* Debe evaluar el producto sobre el que opina.\n',true);

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor seleccione un m&eacute;todo de pago para su pedido.\n',true);

define('JS_ERROR_SUBMITTED', 'Ya se ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.',true);

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor seleccione un m&eacute;todo de pago para su pedido.',true);

define('CATEGORY_COMPANY', 'Datos de la Empresa',true);
define('CATEGORY_PERSONAL', 'Datos personales',true);
define('CATEGORY_ADDRESS', 'Direcci&oacute;n',true);
define('CATEGORY_CONTACT', 'Informaci&oacute;n de Contacto',true);
define('CATEGORY_OPTIONS', 'Opciones',true);
define('CATEGORY_PASSWORD', 'Contrase&ntilde;a',true);

define('ENTRY_COMPANY', 'Nombre de la Empresa',true);
define('ENTRY_COMPANY_TEXT', '',true);
define('ENTRY_GENDER', 'Sexo:',true);
define('ENTRY_GENDER_ERROR', 'Por favor seleccione su Sexo.',true);
define('ENTRY_GENDER_TEXT', '',true);
define('ENTRY_FIRST_NAME', 'Nombre:',true);
define('ENTRY_FIRST_NAME_ERROR', 'Su Nombre debe contener un mínimo de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_FIRST_NAME_TEXT', '',true);
define('ENTRY_LAST_NAME', 'Apellido:',true);
define('ENTRY_LAST_NAME_ERROR', 'Su Apellido debe contener un m&iacute;nimo de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_LAST_NAME_TEXT', '',true);
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Su fecha de nacimiento debe estar en este formato : DD/MM/YYYY (ej 21/05/1970)',true);
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (ej. 21/05/1970)',true);
define('ENTRY_EMAIL_ADDRESS', 'Correo Electr&oacute;nico:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Su direcci&oacute;n de Correo Electr&oacute;nico debe contener un m&iacute;nimo de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Su Correo Electr&oacute;nico no parece ser v&aacute;lido - por favor realice los cambios necesarios.',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Su direcci&oacute;n de correo electr&oacute;nico ya existe en nuestros registros - Por favor, inicie sesi&oacute;n con la direcci&oacute;n de correo electr&oacute;nico o cree una cuenta con una direcci&oacute;n de correo diferente.',true);
define('ENTRY_EMAIL_ADDRESS_TEXT', '',true);
define('ENTRY_STREET_ADDRESS', 'Direcci&oacute;n:',true);
define('ENTRY_STREET_ADDRESS_ERROR', 'Su direcci&oacute;n debe contener un m&iacute;nimo de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_STREET_ADDRESS_TEXT', '',true);
define('ENTRY_SUBURB', 'Suburbio:',true);
define('ENTRY_SUBURB_TEXT', '',true);
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:',true);
define('ENTRY_POST_CODE_ERROR', 'Su C&oacute;digo postal debe contener un m&iacute;nimo de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_POST_CODE_TEXT', '',true);
define('ENTRY_CITY', 'Ciudad:',true);
define('ENTRY_CITY_ERROR', 'Su Ciudad debe contener un m&iacute;nimo de ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_CITY_TEXT', '',true);
define('ENTRY_STATE', 'Estado/Provincia:',true);
define('ENTRY_STATE_ERROR', 'Su Estado/provincia debe contener un m&iacute;nimo de ' . ENTRY_STATE_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_STATE_ERROR_SELECT', 'Por favor, elija un estado/provincia de los Estados en el men&uacute; desplegable.',true);
define('ENTRY_STATE_TEXT', '',true);
define('ENTRY_COUNTRY', 'Pa&iacute;s:',true);
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un pa&iacute;s de la lista de Pa&iacute;ses del men&uacute; desplegable.',true);
define('ENTRY_COUNTRY_TEXT', '',true);
define('ENTRY_TELEPHONE_NUMBER', 'N&uacute;mero de Tel&eacute;fono:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Su n&uacute;mero de tel&eacute;fono debe contener un m&iacute;nimo de ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_TELEPHONE_NUMBER_TEXT', '',true);
define('ENTRY_FAX_NUMBER', 'N&uacute;mero de Fax:',true);
define('ENTRY_FAX_NUMBER_TEXT', '',true);
define('ENTRY_NEWSLETTER', 'Bolet&iacute;n:',true);
define('ENTRY_NEWSLETTER_TEXT', '',true);
define('ENTRY_NEWSLETTER_YES', 'Suscribir',true);
define('ENTRY_NEWSLETTER_NO', 'Dar de baja',true);
define('ENTRY_PASSWORD', 'Contrase&ntilde;a:',true);
define('ENTRY_PASSWORD_ERROR', 'Su contrase&ntilde;a debe contener un m&iacute;nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La confirmaci&oacute;n de la contrase&ntilde;a debe ser igual a su contrase&ntilde;a.',true);
define('ENTRY_PASSWORD_TEXT', '',true);
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmaci&oacute;n de Contrase&ntilde;a:',true);
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT', 'Contrase&ntilde;a Actual:',true);
define('ENTRY_PASSWORD_CURRENT_TEXT', '',true);
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Su contrase&ntilde;a debe contener un m&iacute;nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_PASSWORD_NEW', 'Nueva Contrase&ntilde;a:',true);
define('ENTRY_PASSWORD_NEW_TEXT', '',true);
define('ENTRY_PASSWORD_NEW_ERROR', 'Su nueva contrase&ntilde;a debe contener un m&iacute;nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.',true);
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La confirmaci&oacute;n de la contrase&ntilde;a debe ser igual a su nueva contrase&ntilde;a.',true);
define('PASSWORD_HIDDEN', '--OCULTO--',true);

define('FORM_REQUIRED_INFORMATION', '* Informaci&oacute;n obligatoria',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P&aacute;ginas de resultado:',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pedidos)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> comentarios)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos nuevos)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> ofertas)',true);

define('PREVNEXT_TITLE_FIRST_PAGE', 'Primera p&aacute;gina',true);
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'P&aacute;gina Anterior',true);
define('PREVNEXT_TITLE_NEXT_PAGE', 'Siguiente P&aacute;gina',true);
define('PREVNEXT_TITLE_LAST_PAGE', 'Ultima p&aacute;gina',true);
define('PREVNEXT_TITLE_PAGE_NO', 'P&aacute;gina %d',true);
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Grupo anterior de P&aacute;ginas %d',true);
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Grupo siguiente de P&aacute;ginas %d',true);
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRINCIPIO',true);
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Anterior]',true);
define('PREVNEXT_BUTTON_NEXT', '[Siguiente&nbsp;&gt;&gt;]',true);
define('PREVNEXT_BUTTON_LAST', 'FINAL&gt;&gt;',true);

define('IMAGE_BUTTON_ADD_ADDRESS', 'Adicionar Direcci&oacute;n',true);
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Libreta de direcciones',true);
define('IMAGE_BUTTON_BACK', 'Atr&aacute;s',true);
define('IMAGE_BUTTON_BUY_NOW', 'Comprar Ahora',true);
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambiar Direcci&oacute;n',true);
define('IMAGE_BUTTON_CHECKOUT', 'Realizar Pedido',true);
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar Pedido',true);
define('IMAGE_BUTTON_CONTINUE', 'Continuar',true);
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Seguir Comprando',true);
define('IMAGE_BUTTON_DELETE', 'Eliminar',true);
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Cuenta',true);
define('IMAGE_BUTTON_HISTORY', 'Historial de Pedidos',true);
define('IMAGE_BUTTON_LOGIN', 'Iniciar Sesi&oacute;n',true);
define('IMAGE_BUTTON_IN_CART', 'A&ntilde;adir a la Cesta',true);
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaciones',true);
define('IMAGE_BUTTON_QUICK_FIND', 'B&uacute;squeda R&aacute;pida',true);
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Quitar Notificaciones',true);
define('IMAGE_BUTTON_REVIEWS', 'Comentarios',true);
define('IMAGE_BUTTON_SEARCH', 'Buscar',true);
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opciones de Env&iacute;o',true);
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Recomendar a un Amigo',true);
define('IMAGE_BUTTON_UPDATE', 'Actualizar',true);
define('IMAGE_BUTTON_UPDATE_CART', 'Actualizar Cesta',true);
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escribir Comentario',true);

define('SMALL_IMAGE_BUTTON_DELETE', 'Eliminar',true);
define('SMALL_IMAGE_BUTTON_EDIT', 'Editar',true);
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver',true);

define('ICON_ARROW_RIGHT', 'm&aacute;s',true);
define('ICON_CART', 'En Cesta',true);
define('ICON_ERROR', 'Error',true);
define('ICON_SUCCESS', 'Exito',true);
define('ICON_WARNING', 'Advertencia',true);

define('TEXT_GREETING_PERSONAL', 'Bienvenido de nuevo <span class="greetUser">%s!</span> Le gustar&iacute;a ver que <a href="%s"><u>nuevos productos</u></a> hay disponibles para comprar ?',true);
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Si no es %s, por favor <a href="%s"><u>ingrese aqu&iacute;</u></a> con su cuenta e introduzca sus datos.</small>',true);
define('TEXT_GREETING_GUEST','',true); //Bienvenido <span class="greetUser">Invitado!</span> Le gustar&iacute;a <a href="%s"><u>ingresar en su cuenta</u></a> o preferir&iacute;a <a href="%s"><u>crear una nueva cuenta</u></a>?

define('TEXT_SORT_PRODUCTS', 'Ordenar Productos ',true);
define('TEXT_DESCENDINGLY', 'descendentemente',true);
define('TEXT_ASCENDINGLY', 'ascendentemente',true);
define('TEXT_BY', ' por ',true);

define('TEXT_REVIEW_BY', 'por %s',true);
define('TEXT_REVIEW_WORD_COUNT', '%s palabras',true);
define('TEXT_REVIEW_RATING', 'Valoraci&oacute;n: %s [%s]',true);
define('TEXT_REVIEW_DATE_ADDED', 'Fecha de Alta: %s',true);
define('TEXT_NO_REVIEWS', 'En este momento no hay ning&uacute;n comentario.',true);

define('TEXT_NO_NEW_PRODUCTS', 'Actualmente no hay productos.',true);

define('TEXT_UNKNOWN_TAX_RATE', 'Tasa de impuesto desconocido',true);

define('TEXT_REQUIRED', '<span class="errorText">Obligatorio</span>',true);

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><strong><small>TEP ERROR:</small> No se puede enviar el correo electr&oacute;nico a trav&eacute;s del servidor SMTP especificado. Por favor, compruebe la configuraci&oacute;n del archivo php.ini y corregir el servidor SMTP si es necesario.</strong></font>',true);

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de caducidad de la tarjeta de cr&eacute;dito no es v&aacute;lida. Por favor, compruebe la fecha y vuelva a intentarlo.',true);
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El n&uacute;mero de tarjeta de cr&eacute;dito no es v&aacute;lida. Por favor, compruebe el n&uacute;mero y vuelva a intentarlo.',true);
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los primeros cuatro d&iacute;gitos del n&uacute;mero de introducir son: %s. Si ese n&uacute;mero es correcto, no aceptamos este tipo de tarjetas de cr&eacute;dito. Si es incorrecto, por favor, int&eacute;ntelo de nuevo.',true);
define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br />Powered by <a href="http://www.oscommerce.com" target="_blank">osCommerce</a>',true);

define('TABLE_HEADING_DATE_AVAILABLE','Latest Products',true);
define('TABLE_HEADING_CUSTOM_DATE','Evet\'s Date',true);
define('TABLE_HEADING_SORT_ORDER','Sort Order',true);
//VAT numbber
define('ENTRY_VAT_NUMBER_TEXT_2', '',true);

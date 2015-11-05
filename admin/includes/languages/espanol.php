<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'es_ES'
// on FreeBSD 4.0 I use 'es_ES.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'es_ES.utf-8');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="es"');

// charset for web pages and emails
define('CHARSET', 'utf-8');

// page title
define('TITLE', 'Herramienta de Administración de osCommerce Online Merchant');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administración');
define('HEADER_TITLE_SUPPORT_SITE', 'Soporte');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catálogo');
define('HEADER_TITLE_ADMINISTRATION', 'Administración');

// text for gender
define('MALE', 'Hombre');
define('FEMALE', 'Mujer');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuraci&oacute;n');
define('BOX_CONFIGURATION_MYSTORE', 'Mi Tienda');
define('BOX_CONFIGURATION_LOGGING', 'Inicio de sesi&oacute;n');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administradores');
define('BOX_CONFIGURATION_STORE_LOGO', 'Logo Tienda');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M&oacute;dulos');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Cat&aacute;logo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categor&iacute;as/Productos');
//define('BOX_CATALOG_CATEGORIES_PRODUCTS_OPTIONS', 'Opciones del Producto');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos del Producto');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentarios');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Pr&oacute;ximamente');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Zonas / Impuestos');
define('BOX_TAXES_COUNTRIES', 'Pa&iacute;ses');
define('BOX_TAXES_ZONES', 'Provincias');
define('BOX_TAXES_GEO_ZONES', 'Zonas de Impuestos');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Impuesto');
define('BOX_TAXES_TAX_RATES', 'Porcentajes');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Informes');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Productos M&aacute;s Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Productos M&aacute;s Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total Pedidos por Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Herramientas');
define('BOX_TOOLS_ACTION_RECORDER', 'Grabar Acci&oacute;n');
define('BOX_TOOLS_BACKUP', 'Copia de Seguridad de la Base de Datos');
define('BOX_TOOLS_BANNER_MANAGER', 'Administrador de Banners');
define('BOX_TOOLS_CACHE', 'Control de Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Idiomas');

define('BOX_TOOLS_MAIL', 'Enviar Correo Electr&oacute;nico');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Administrador de Boletines');
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Permisos de Seguridad del Directorio');
define('BOX_TOOLS_SERVER_INFO', 'Informaci&oacute;n del Servidor');
define('BOX_TOOLS_VERSION_CHECK', 'Verificador de Versi&oacute;n');
define('BOX_TOOLS_WHOS_ONLINE', 'Usuarios conectados');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizaci&oacute;n');
define('BOX_LOCALIZATION_CURRENCIES', 'Monedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estado Pedidos');

// javascript messages
define('JS_ERROR', '¡Ha habido errores procesando su formulario!\nPor favor, haga las siguiente modificaciones:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* El atributo necesita un precio\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* El atributo necesita un prefijo para el precio\n');

define('JS_PRODUCTS_NAME', '* El producto necesita un nombre\n');
define('JS_PRODUCTS_DESCRIPTION', '* El producto necesita una descripci&oacute;n\n');
define('JS_PRODUCTS_PRICE', '* El producto necesita un precio\n');
define('JS_PRODUCTS_WEIGHT', '* Debe especificar el peso del producto\n');
define('JS_PRODUCTS_QUANTITY', '* Debe especificar la cantidad\n');
define('JS_PRODUCTS_MODEL', '* Debe especificar el modelo\n');
define('JS_PRODUCTS_IMAGE', '* Debe suministrar una imagen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Debe asignar el precio del producto\n');

define('JS_GENDER', '* Debe elegir un \'Sexo\'.\n');
define('JS_FIRST_NAME', '* El \'Nombre\' debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* El \'Apellido\' debe tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_DOB', '* La \'Fecha de Nacimiento\' debe tener el formato: xx/xx/xxxx (d&iacute;a/mes/a&ntilde;o).\n');
define('JS_EMAIL_ADDRESS', '* El \'Correo Electr&oacute;nico\' debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* El \'Domicilio\' debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* El \'C&oacute;digo Postal\' debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* La \'Ciudad\' debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n');
define('JS_STATE', '* Debe indicar la \'Provincia\'.\n');
define('JS_STATE_SELECT', '-- Seleccione Arriba --');
define('JS_ZONE', '* La \'Provincia\' se debe seleccionar de la lista para este pa&iacute;s.');
define('JS_COUNTRY', '* Debe seleccionar un \'Pa&iacute;s\'.\n');
define('JS_TELEPHONE', '* El \'Tel&eacute;fono\' debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n');
define('JS_PASSWORD', '* La \'Contrase&ntilde;a\' y \'Confirmaci&oacute;n\' deben ser iguales y tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', '* El pedido n&uacute;mero %s no existe!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Direcci&oacute;n');
define('CATEGORY_CONTACT', 'Contacto');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Opciones');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">Obligatorio</span>');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_LAST_NAME', 'Apellidos:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ej. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Correo Electr&oacute;nico:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">El correo electr&oacute;nico no es v&aacute;lido !</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">El correo electr&oacute;nico ya existe!</span>');
define('ENTRY_COMPANY', 'Nombre empresa:');
define('ENTRY_STREET_ADDRESS', 'Direcci&oacute;n:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_SUBURB', '');
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_CITY', 'Poblaci&oacute;n:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STATE', 'Provincia:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">Obligatorio</span>');
define('ENTRY_COUNTRY', 'Pa&iacute;s:');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un Pa&iacute;s del Men&uacute; Pa&iacute;ses.');
define('ENTRY_TELEPHONE_NUMBER', 'Tel&eacute;fono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_NEWSLETTER', 'Bolet&iacute;n:');
define('ENTRY_NEWSLETTER_YES', 'Inscrito');
define('ENTRY_NEWSLETTER_NO', 'No Inscrito');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando Correo Electr&oacute;nico');
define('IMAGE_BACK', 'Atr&aacute;s');
define('IMAGE_BACKUP', 'Resguardo');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar A');
define('IMAGE_DETAILS', 'Detalles');
define('IMAGE_DELETE', 'Eliminar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'Correo Electr&oacute;nico');
define('IMAGE_FILE_MANAGER', 'Gestore di file');
//define('IMAGE_EXPORT', 'Exportar');
define('IMAGE_ICON_STATUS_GREEN', 'Activo');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activar');
define('IMAGE_ICON_STATUS_RED', 'Inactivo');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Desactivar');
define('IMAGE_ICON_INFO', 'Informaci&oacute;n');
define('IMAGE_INSERT', 'Insertar');
define('IMAGE_LOCK', 'Bloqueado');
define('IMAGE_MODULE_INSTALL', 'Instalar M&oacute;dulo');
define('IMAGE_MODULE_REMOVE', 'Quitar M&oacute;dulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Nuevo Banner');
define('IMAGE_NEW_CATEGORY', 'Nueva Categor&iacute;a');
define('IMAGE_NEW_COUNTRY', 'Nuevo Pa&iacute;s');
define('IMAGE_NEW_CURRENCY', 'Nueva Moneda');
define('IMAGE_NEW_FILE', 'Nuevo Fichero');
define('IMAGE_NEW_FOLDER', 'Nueva Carpeta');
define('IMAGE_NEW_LANGUAGE', 'Nuevo Idioma');
define('IMAGE_NEW_NEWSLETTER', 'Nuevo Bolet&iacute;n');
define('IMAGE_NEW_PRODUCT', 'Nuevo Producto');
define('IMAGE_NEW_TAX_CLASS', 'Nuevo Tipo de Impuesto');
define('IMAGE_NEW_TAX_RATE', 'Nuevo Porcentaje de Impuesto');
define('IMAGE_NEW_TAX_ZONE', 'Nueva Zona de Impuesto');
define('IMAGE_NEW_ZONE', 'Nueva Zona');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_ORDERS_INVOICE', 'Factura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Hoja de Embalaje');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_RESET', 'Inicializar');
define('IMAGE_SAVE', 'Grabar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Seleccionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Enviar Correo Electr&iacute;nico');
define('IMAGE_UNLOCK', 'Desbloqueado');
define('IMAGE_UPDATE', 'Actualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Actualizar Cambio de Moneda');
define('IMAGE_UPLOAD', 'Subir');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Directorio Actual');
define('ICON_DELETE', 'Eliminar');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'Fichero');
define('ICON_FILE_DOWNLOAD', 'Descargar');
define('ICON_FOLDER', 'Carpeta');
define('ICON_LOCKED', 'Bloqueado');
define('ICON_PREVIOUS_LEVEL', 'Nivel Anterior');
define('ICON_PREVIEW', 'Ver');
define('ICON_STATISTICS', 'Estad&iacute;sticas');
define('ICON_SUCCESS', 'Exito');
define('ICON_TICK', 'Verdadero');
define('ICON_UNLOCKED', 'Desbloqueado');
define('ICON_WARNING', 'Advertencia');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P&aacute;gina %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pa&iacute;ses)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> monedas)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> entradas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> boletines)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> estados de pedido)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> tipos de impuesto)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> zonas de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> porcentajes de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> zonas)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'predeterminado/a');
define('TEXT_SET_DEFAULT', 'Establecer como predeterminado/a');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obligatorio</span>');

define('TEXT_CACHE_CATEGORIES', 'Categor&iacute;as');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Tambi&eacute;n han Comprado');

define('TEXT_NONE', '--Ninguno--');
define('TEXT_TOP', 'Inicio');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destino NO existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destino no tiene permisos de escritura.');
define('ERROR_FILE_NOT_SAVED', 'Error: Archivo subido no guardado.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: Tipo de archivo subido no permitido.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Exito: Archivo subido guardado exitosamente.');
define('WARNING_NO_FILE_UPLOADED', 'Advertencia: Ning&uacute;n archivo subido.');
?>

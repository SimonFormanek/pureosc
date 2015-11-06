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
define('DATE_FORMAT_SHORT', '%d/%m/%Y',true);  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y',true); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y',true);  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s',true); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S',true);
define('JQUERY_DATEPICKER_I18N_CODE', '',true); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy',true); // see http://docs.jquery.com/UI/Datepicker/formatDate

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
define('HTML_PARAMS','dir="ltr" lang="es"',true);

// charset for web pages and emails
define('CHARSET', 'utf-8',true);

// page title
define('TITLE', 'Herramienta de Administración de osCommerce Online Merchant',true);

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administración',true);
define('HEADER_TITLE_SUPPORT_SITE', 'Soporte',true);
define('HEADER_TITLE_ONLINE_CATALOG', 'Catálogo',true);
define('HEADER_TITLE_ADMINISTRATION', 'Administración',true);

// text for gender
define('MALE', 'Hombre',true);
define('FEMALE', 'Mujer',true);

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa',true);

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuraci&oacute;n',true);
define('BOX_CONFIGURATION_MYSTORE', 'Mi Tienda',true);
define('BOX_CONFIGURATION_LOGGING', 'Inicio de sesi&oacute;n',true);
define('BOX_CONFIGURATION_CACHE', 'Cache',true);
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Administradores',true);
define('BOX_CONFIGURATION_STORE_LOGO', 'Logo Tienda',true);

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M&oacute;dulos',true);

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Cat&aacute;logo',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categor&iacute;as/Productos',true);
//define('BOX_CATALOG_CATEGORIES_PRODUCTS_OPTIONS', 'Opciones del Producto',true);
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos del Producto',true);
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes',true);
define('BOX_CATALOG_REVIEWS', 'Comentarios',true);
define('BOX_CATALOG_SPECIALS', 'Ofertas',true);
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Pr&oacute;ximamente',true);

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes',true);
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes',true);
define('BOX_CUSTOMERS_ORDERS', 'Pedidos',true);

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Zonas / Impuestos',true);
define('BOX_TAXES_COUNTRIES', 'Pa&iacute;ses',true);
define('BOX_TAXES_ZONES', 'Provincias',true);
define('BOX_TAXES_GEO_ZONES', 'Zonas de Impuestos',true);
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Impuesto',true);
define('BOX_TAXES_TAX_RATES', 'Porcentajes',true);

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Informes',true);
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Productos M&aacute;s Vistos',true);
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Productos M&aacute;s Comprados',true);
define('BOX_REPORTS_ORDERS_TOTAL', 'Total Pedidos por Cliente',true);

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Herramientas',true);
define('BOX_TOOLS_ACTION_RECORDER', 'Grabar Acci&oacute;n',true);
define('BOX_TOOLS_BACKUP', 'Copia de Seguridad de la Base de Datos',true);
define('BOX_TOOLS_BANNER_MANAGER', 'Administrador de Banners',true);
define('BOX_TOOLS_CACHE', 'Control de Cache',true);
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Idiomas',true);

define('BOX_TOOLS_MAIL', 'Enviar Correo Electr&oacute;nico',true);
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Administrador de Boletines',true);
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Permisos de Seguridad del Directorio',true);
define('BOX_TOOLS_SERVER_INFO', 'Informaci&oacute;n del Servidor',true);
define('BOX_TOOLS_VERSION_CHECK', 'Verificador de Versi&oacute;n',true);
define('BOX_TOOLS_WHOS_ONLINE', 'Usuarios conectados',true);

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizaci&oacute;n',true);
define('BOX_LOCALIZATION_CURRENCIES', 'Monedas',true);
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas',true);
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estado Pedidos',true);

// javascript messages
define('JS_ERROR', '¡Ha habido errores procesando su formulario!\nPor favor, haga las siguiente modificaciones:\n\n',true);

define('JS_OPTIONS_VALUE_PRICE', '* El atributo necesita un precio\n',true);
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* El atributo necesita un prefijo para el precio\n',true);

define('JS_PRODUCTS_NAME', '* El producto necesita un nombre\n',true);
define('JS_PRODUCTS_DESCRIPTION', '* El producto necesita una descripci&oacute;n\n',true);
define('JS_PRODUCTS_PRICE', '* El producto necesita un precio\n',true);
define('JS_PRODUCTS_WEIGHT', '* Debe especificar el peso del producto\n',true);
define('JS_PRODUCTS_QUANTITY', '* Debe especificar la cantidad\n',true);
define('JS_PRODUCTS_MODEL', '* Debe especificar el modelo\n',true);
define('JS_PRODUCTS_IMAGE', '* Debe suministrar una imagen\n',true);

define('JS_SPECIALS_PRODUCTS_PRICE', '* Debe asignar el precio del producto\n',true);

define('JS_GENDER', '* Debe elegir un \'Sexo\'.\n',true);
define('JS_FIRST_NAME', '* El \'Nombre\' debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n',true);
define('JS_LAST_NAME', '* El \'Apellido\' debe tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n',true);
define('JS_DOB', '* La \'Fecha de Nacimiento\' debe tener el formato: xx/xx/xxxx (d&iacute;a/mes/a&ntilde;o).\n',true);
define('JS_EMAIL_ADDRESS', '* El \'Correo Electr&oacute;nico\' debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n',true);
define('JS_ADDRESS', '* El \'Domicilio\' debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n',true);
define('JS_POST_CODE', '* El \'C&oacute;digo Postal\' debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n',true);
define('JS_CITY', '* La \'Ciudad\' debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n',true);
define('JS_STATE', '* Debe indicar la \'Provincia\'.\n',true);
define('JS_STATE_SELECT', '-- Seleccione Arriba --',true);
define('JS_ZONE', '* La \'Provincia\' se debe seleccionar de la lista para este pa&iacute;s.',true);
define('JS_COUNTRY', '* Debe seleccionar un \'Pa&iacute;s\'.\n',true);
define('JS_TELEPHONE', '* El \'Tel&eacute;fono\' debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n',true);
define('JS_PASSWORD', '* La \'Contrase&ntilde;a\' y \'Confirmaci&oacute;n\' deben ser iguales y tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n',true);

define('JS_ORDER_DOES_NOT_EXIST', '* El pedido n&uacute;mero %s no existe!',true);

define('CATEGORY_PERSONAL', 'Personal',true);
define('CATEGORY_ADDRESS', 'Direcci&oacute;n',true);
define('CATEGORY_CONTACT', 'Contacto',true);
define('CATEGORY_COMPANY', 'Empresa',true);
define('CATEGORY_OPTIONS', 'Opciones',true);

define('ENTRY_GENDER', 'Sexo:',true);
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">Obligatorio</span>',true);
define('ENTRY_FIRST_NAME', 'Nombre:',true);
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_LAST_NAME', 'Apellidos:',true);
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:',true);
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ej. 05/21/1970)</span>',true);
define('ENTRY_EMAIL_ADDRESS', 'Correo Electr&oacute;nico:',true);
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">El correo electr&oacute;nico no es v&aacute;lido !</span>',true);
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">El correo electr&oacute;nico ya existe!</span>',true);
define('ENTRY_COMPANY', 'Nombre empresa:',true);
define('ENTRY_STREET_ADDRESS', 'Direcci&oacute;n:',true);
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_SUBURB', '',true);
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:',true);
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_CITY', 'Poblaci&oacute;n:',true);
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_STATE', 'Provincia:',true);
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">Obligatorio</span>',true);
define('ENTRY_COUNTRY', 'Pa&iacute;s:',true);
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un Pa&iacute;s del Men&uacute; Pa&iacute;ses.',true);
define('ENTRY_TELEPHONE_NUMBER', 'Tel&eacute;fono:',true);
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>',true);
define('ENTRY_FAX_NUMBER', 'Fax:',true);
define('ENTRY_NEWSLETTER', 'Bolet&iacute;n:',true);
define('ENTRY_NEWSLETTER_YES', 'Inscrito',true);
define('ENTRY_NEWSLETTER_NO', 'No Inscrito',true);

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando Correo Electr&oacute;nico',true);
define('IMAGE_BACK', 'Atr&aacute;s',true);
define('IMAGE_BACKUP', 'Resguardo',true);
define('IMAGE_CANCEL', 'Cancelar',true);
define('IMAGE_CONFIRM', 'Confirmar',true);
define('IMAGE_COPY', 'Copiar',true);
define('IMAGE_COPY_TO', 'Copiar A',true);
define('IMAGE_DETAILS', 'Detalles',true);
define('IMAGE_DELETE', 'Eliminar',true);
define('IMAGE_EDIT', 'Editar',true);
define('IMAGE_EMAIL', 'Correo Electr&oacute;nico',true);
define('IMAGE_FILE_MANAGER', 'Gestore di file',true);
//define('IMAGE_EXPORT', 'Exportar',true);
define('IMAGE_ICON_STATUS_GREEN', 'Activo',true);
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activar',true);
define('IMAGE_ICON_STATUS_RED', 'Inactivo',true);
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Desactivar',true);
define('IMAGE_ICON_INFO', 'Informaci&oacute;n',true);
define('IMAGE_INSERT', 'Insertar',true);
define('IMAGE_LOCK', 'Bloqueado',true);
define('IMAGE_MODULE_INSTALL', 'Instalar M&oacute;dulo',true);
define('IMAGE_MODULE_REMOVE', 'Quitar M&oacute;dulo',true);
define('IMAGE_MOVE', 'Mover',true);
define('IMAGE_NEW_BANNER', 'Nuevo Banner',true);
define('IMAGE_NEW_CATEGORY', 'Nueva Categor&iacute;a',true);
define('IMAGE_NEW_COUNTRY', 'Nuevo Pa&iacute;s',true);
define('IMAGE_NEW_CURRENCY', 'Nueva Moneda',true);
define('IMAGE_NEW_FILE', 'Nuevo Fichero',true);
define('IMAGE_NEW_FOLDER', 'Nueva Carpeta',true);
define('IMAGE_NEW_LANGUAGE', 'Nuevo Idioma',true);
define('IMAGE_NEW_NEWSLETTER', 'Nuevo Bolet&iacute;n',true);
define('IMAGE_NEW_PRODUCT', 'Nuevo Producto',true);
define('IMAGE_NEW_TAX_CLASS', 'Nuevo Tipo de Impuesto',true);
define('IMAGE_NEW_TAX_RATE', 'Nuevo Porcentaje de Impuesto',true);
define('IMAGE_NEW_TAX_ZONE', 'Nueva Zona de Impuesto',true);
define('IMAGE_NEW_ZONE', 'Nueva Zona',true);
define('IMAGE_ORDERS', 'Pedidos',true);
define('IMAGE_ORDERS_INVOICE', 'Factura',true);
define('IMAGE_ORDERS_PACKINGSLIP', 'Hoja de Embalaje',true);
define('IMAGE_PREVIEW', 'Ver',true);
define('IMAGE_RESTORE', 'Restaurar',true);
define('IMAGE_RESET', 'Inicializar',true);
define('IMAGE_SAVE', 'Grabar',true);
define('IMAGE_SEARCH', 'Buscar',true);
define('IMAGE_SELECT', 'Seleccionar',true);
define('IMAGE_SEND', 'Enviar',true);
define('IMAGE_SEND_EMAIL', 'Enviar Correo Electr&iacute;nico',true);
define('IMAGE_UNLOCK', 'Desbloqueado',true);
define('IMAGE_UPDATE', 'Actualizar',true);
define('IMAGE_UPDATE_CURRENCIES', 'Actualizar Cambio de Moneda',true);
define('IMAGE_UPLOAD', 'Subir',true);

define('ICON_CROSS', 'Falso',true);
define('ICON_CURRENT_FOLDER', 'Directorio Actual',true);
define('ICON_DELETE', 'Eliminar',true);
define('ICON_ERROR', 'Error',true);
define('ICON_FILE', 'Fichero',true);
define('ICON_FILE_DOWNLOAD', 'Descargar',true);
define('ICON_FOLDER', 'Carpeta',true);
define('ICON_LOCKED', 'Bloqueado',true);
define('ICON_PREVIOUS_LEVEL', 'Nivel Anterior',true);
define('ICON_PREVIEW', 'Ver',true);
define('ICON_STATISTICS', 'Estad&iacute;sticas',true);
define('ICON_SUCCESS', 'Exito',true);
define('ICON_TICK', 'Verdadero',true);
define('ICON_UNLOCKED', 'Desbloqueado',true);
define('ICON_WARNING', 'Advertencia',true);

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P&aacute;gina %s de %d',true);
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> banners)',true);
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pa&iacute;ses)',true);
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> clientes)',true);
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> monedas)',true);
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> entradas)',true);
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> idiomas)',true);
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> fabricantes)',true);
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> boletines)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> pedidos)',true);
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> estados de pedido)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos)',true);
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> productos esperados)',true);
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> comentarios)',true);
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> ofertas)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> tipos de impuesto)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> zonas de impuestos)',true);
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> porcentajes de impuestos)',true);
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Viendo del <strong>%d</strong> al <strong>%d</strong> (de <strong>%d</strong> zonas)',true);

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;',true);
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;',true);

define('TEXT_DEFAULT', 'predeterminado/a',true);
define('TEXT_SET_DEFAULT', 'Establecer como predeterminado/a',true);
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obligatorio</span>',true);

define('TEXT_CACHE_CATEGORIES', 'Categor&iacute;as',true);
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes',true);
define('TEXT_CACHE_ALSO_PURCHASED', 'Tambi&eacute;n han Comprado',true);

define('TEXT_NONE', '--Ninguno--',true);
define('TEXT_TOP', 'Inicio',true);

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destino NO existe.',true);
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destino no tiene permisos de escritura.',true);
define('ERROR_FILE_NOT_SAVED', 'Error: Archivo subido no guardado.',true);
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: Tipo de archivo subido no permitido.',true);
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Exito: Archivo subido guardado exitosamente.',true);
define('WARNING_NO_FILE_UPLOADED', 'Advertencia: Ning&uacute;n archivo subido.',true);
?>

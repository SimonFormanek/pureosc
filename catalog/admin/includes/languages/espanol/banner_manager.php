<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de Banners',true);

define('TABLE_HEADING_BANNERS', 'Banners',true);
define('TABLE_HEADING_GROUPS', 'Grupos',true);
define('TABLE_HEADING_STATISTICS', 'Vistas / Clicks',true);
define('TABLE_HEADING_STATUS', 'Estado',true);
define('TABLE_HEADING_ACTION', 'Acción',true);

define('TEXT_BANNERS_TITLE', 'Título del Banner:',true);
define('TEXT_BANNERS_URL', 'URL del Banner:',true);
define('TEXT_BANNERS_GROUP', 'Grupo del Banner:',true);
define('TEXT_BANNERS_NEW_GROUP', ', o introduzca un grupo nuevo',true);
define('TEXT_BANNERS_IMAGE', 'Imagen:',true);
define('TEXT_BANNERS_IMAGE_LOCAL', ', o introduzca un fichero local',true);
define('TEXT_BANNERS_IMAGE_TARGET', 'Destino de la Imagen (Grabar en):',true);
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML:',true);
define('TEXT_BANNERS_EXPIRES_ON', 'Caduca el:',true);
define('TEXT_BANNERS_OR_AT', ', o  trás',true);
define('TEXT_BANNERS_IMPRESSIONS', 'vistas.',true);
define('TEXT_BANNERS_SCHEDULED_AT', 'Programado el:',true);
define('TEXT_BANNERS_BANNER_NOTE', '<strong>Notas sobre el Banner:</strong><ul><li>Use una imagen o texto HTML para el banner - no ambos.</li><li>Texto HTML tiene prioridad sobre una imagen</li></ul>',true);
define('TEXT_BANNERS_INSERT_NOTE', '<strong>Notas sobre la Imagen:</strong><ul><li>El directorio donde suba la imagen debe de tener configurados los permisos de escritura necesarios!</li><li>No rellene el campo \'Grabar en\' si no va a subir una imagen al servidor (como cuando use una imagen ya existente en el servidor -fichero local).</li><li>El campo \'Grabar en\' debe de ser un directorio que exista y terminado en una barra (por ejemplo: banners/).</li></ul>',true);
define('TEXT_BANNERS_EXPIRCY_NOTE', '<strong>Notas sobre la Caducidad:</strong><ul><li>Solo se debe de rellenar uno de los dos campos</li><li>Si el banner no debe de caducar no rellene ninguno de los campos</li></ul>',true);
define('TEXT_BANNERS_SCHEDULE_NOTE', '<strong>Notas sobre la Programaci&oacute;n:</strong><ul><li>Si se configura una fecha de programaci&oacute;n el banner se activar&aacute; en esa fecha.</li><li>Todos los banners programados se marcan como inactivos hasta que llegue su fecha, cuando se marcan activos.</li></ul>',true);

define('TEXT_BANNERS_DATE_ADDED', 'A&ntilde;adido el:',true);
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado el: <strong>%s</strong>',true);
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Caduca el: <strong>%s</strong>',true);
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Caduca tras: <strong>%s</strong> vistas',true);
define('TEXT_BANNERS_STATUS_CHANGE', 'Cambio Estado: %s',true);

define('TEXT_BANNERS_DATA', 'D<br />A<br />T<br />O<br />S',true);
define('TEXT_BANNERS_LAST_3_DAYS', 'Ultimos 3 días',true);
define('TEXT_BANNERS_BANNER_VIEWS', 'Vistas',true);
define('TEXT_BANNERS_BANNER_CLICKS', 'Clicks',true);

define('TEXT_INFO_DELETE_INTRO', 'Seguro que quiere eliminar este banner ?',true);
define('TEXT_INFO_DELETE_IMAGE', 'Borrar imagen',true);

define('SUCCESS_BANNER_INSERTED', 'Exito: El banner ha sido insertado.',true);
define('SUCCESS_BANNER_UPDATED', 'Exito: El banner ha sido actualizado.',true);
define('SUCCESS_BANNER_REMOVED', 'Exito: El banner ha sido eliminado.',true);
define('SUCCESS_BANNER_STATUS_UPDATED', 'Exito: El estado del banner ha sido actualizado.',true);

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: Se necesita un título para el banner.',true);
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: Se necesita un grupo para el banner.',true);
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: El directorio de destino no existe: %s',true);
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de destino: %s',true);
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: La imagen no existe.',true);
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: La imagen no se puede borrar.',true);
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Estado desconocido.',true);

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: El directorio de gráficos no existe. Por favor, cree un directorio \'graphs\' dentro de \'images\'.',true);
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de gráficos.',true);
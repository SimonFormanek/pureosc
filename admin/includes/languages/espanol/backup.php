<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de Copias de Seguridad de la Base de Datos',true);

define('TABLE_HEADING_TITLE', 'Título',true);
define('TABLE_HEADING_FILE_DATE', 'Fecha',true);
define('TABLE_HEADING_FILE_SIZE', 'Tamaño',true);
define('TABLE_HEADING_ACTION', 'Acción',true);

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nueva Copia De Seguridad',true);
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar Localmente',true);
define('TEXT_INFO_NEW_BACKUP', 'No interrumpa el proceso de copia, que puede durar unos minutos.',true);
define('TEXT_INFO_UNPACK', '<br /><br />(después de descomprimir el archivo)',true);
define('TEXT_INFO_RESTORE', 'No interrumpa el proceso de restauración.<br><br>¡Cuanto mas grande sea la copia de seguridad, mas tardará este proceso!<br><br>Si es posible, use el cliente de mysql.<br><br>Por ejemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s',true);
define('TEXT_INFO_RESTORE_LOCAL', 'No interrumpa el proceso de restauración.<br /><br />* Cuanto mas grande sea la copia de seguridad, mas tardará este proceso!',true);
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'El fichero subido debe ser de texto.',true);
define('TEXT_INFO_DATE', 'Fecha:',true);
define('TEXT_INFO_SIZE', 'Tamaño:',true);
define('TEXT_INFO_COMPRESSION', 'Compresión:',true);
define('TEXT_INFO_USE_GZIP', 'Usar GZIP',true);
define('TEXT_INFO_USE_ZIP', 'Usar ZIP',true);
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sin Compresión (directamente SQL)',true);
define('TEXT_INFO_DOWNLOAD_ONLY', 'Bajar solo (no guardar en el servidor)',true);
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Preferiblemente con una conexion segura',true);
define('TEXT_DELETE_INTRO', 'Seguro que quiere eliminar esta copia?',true);
define('TEXT_NO_EXTENSION', 'Ninguna',true);
define('TEXT_BACKUP_DIRECTORY', 'Directorio para Copias de Seguridad:',true);
define('TEXT_LAST_RESTORATION', 'Ultima Restauración:',true);
define('TEXT_FORGET', '(<u>olvidar</u>)',true);

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de copias de seguridad. Por favor asigne en el archivo configure.php',true);
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: No hay permiso de escritura en el directorio de copias de seguridad.',true);
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: Enlace de Descarga no aceptable.',true);

define('SUCCESS_LAST_RESTORE_CLEARED', 'Exito: La &uacute;ltima fecha de restauración ha sido borrada.',true);
define('SUCCESS_DATABASE_SAVED', 'Exito: La base de datos ha sido grabada.',true);
define('SUCCESS_DATABASE_RESTORED', 'Exito: La base de datos ha sido restaurada.',true);
define('SUCCESS_BACKUP_DELETED', 'Exito: La copia de seguridad ha sido borrada.',true);
?>

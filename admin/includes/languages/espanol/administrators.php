<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administradores');

define('TABLE_HEADING_ADMINISTRATORS', 'Administradores');
define('TABLE_HEADING_HTPASSWD', 'Asegurado por htpasswd');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_INSERT_INTRO', 'Por favor introduce los datos relacionados del nuevo administrador');
define('TEXT_INFO_EDIT_INTRO', 'Por favor realice los cambios necesarios');
define('TEXT_INFO_DELETE_INTRO', '¿Está seguro que desea eliminar este administrador ?');
define('TEXT_INFO_HEADING_NEW_ADMINISTRATOR', 'Nuevo Administrador');
define('TEXT_INFO_USERNAME', 'Nombre Usuario:');
define('TEXT_INFO_NEW_PASSWORD', 'Nueva Contraseña:');
define('TEXT_INFO_PASSWORD', 'Contraseña:');
define('TEXT_INFO_PROTECT_WITH_HTPASSWD', 'Protegido con htaccess/htpasswd');

define('ERROR_ADMINISTRATOR_EXISTS', 'Error: Administrador YA existe.');

define('HTPASSWD_INFO', '<strong>Protecci&oacute;n adicional con htaccess/htpasswd</strong><p>Esta Instalaci&oacute;n de la Herramienta de Administraci&oacute;n osCommerce Online Merchant no esta adicionalmente asegurado a trav&eacute;s de htaccess/htpasswd.</p><p>Habilite la seguridad de la capa htaccess/htpasswd para almacenar autom&aacute;ticamente el nombre de usuario del administrador y su contrase&ntilde;a en un archivo htpasswd la hora de actualizar los registros del administrador de contrase&ntilde;as.</p><p><strong>Por favor, tenga en cuenta</strong>, si esta capa adicional de seguridad est&aacute; habilitado y ya no se puede acceder a la herramienta de administraci&oacute;n, realice los cambios siguientes y consulte a su proveedor de hosting para permitir la protecci&oacute;n de htaccess/htpasswd:</p><p><u><strong>1. Edite este archivo:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htaccess</p><p>Quite las l&iacute;neas siguientes si existen:</p><p><i>%s</i></p><p><u><strong>2. Elimine este archivo:</strong></u><br /><br />' . DIR_FS_ADMIN . '.htpasswd_oscommerce</p>');
define('HTPASSWD_SECURED', '<strong>Protecci&oacute;n adicional con htaccess/htpasswd</strong><p>Esta Instalaci&oacute;n de la Herramienta de Administraci&oacute;n osCommerce Online Merchant no esta adicionalemnte asegurado a trav&eacute;s de  htaccess/htpasswd.</p>');
define('HTPASSWD_PERMISSIONS', '<strong>Protecci&oacute;n adicional con htaccess/htpasswd</strong><p>Esta Instalaci&oacute;n de la Herramienta de Administraci&oacute;n osCommerce Online Merchant no esta adicionalmente asegurado a trav&eacute;s de  htaccess/htpasswd.</p><p>Los siguientes archivos necesitan tener permisos de escritura por el servidor web para activar la capa de seguridad htaccess/htpasswd:</p><ul><li>' . DIR_FS_ADMIN . '.htaccess</li><li>' . DIR_FS_ADMIN . '.htpasswd_oscommerce</li></ul><p>Actualizar esta p&aacute;gina para confirmar si los permisos de los archivos hayan sido configurados correctamente.</p>');
?>

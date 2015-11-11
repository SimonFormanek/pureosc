<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categorías / Productos',true);
define('HEADING_TITLE_SEARCH', 'Buscar:',true);
define('HEADING_TITLE_GOTO', 'Ir a:',true);

define('TABLE_HEADING_ID', 'ID',true);
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorías / Productos',true);
define('TABLE_HEADING_ACTION', 'Acción',true);
define('TABLE_HEADING_STATUS', 'Estado',true);

define('TEXT_NEW_PRODUCT', 'Nuevo Producto en &quot;%s&quot;',true);
define('TEXT_CATEGORIES', 'Categorías:',true);
define('TEXT_SUBCATEGORIES', 'Subcategorías:',true);
define('TEXT_PRODUCTS', 'Productos:',true);
define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:',true);
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo Impuesto:',true);
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Valoración Media:',true);
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Cantidad:',true);
define('TEXT_DATE_ADDED', 'Añadido el:',true);
define('TEXT_DATE_AVAILABLE', 'Fecha Disponibilidad:',true);
define('TEXT_LAST_MODIFIED', 'Modificado el:',true);
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN',true);
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserte una nueva categoría o producto en este nivel',true);
define('TEXT_PRODUCT_MORE_INFORMATION', 'Si quiere mas información, visite la <a href="http://%s" target="blank"><u>página</u></a> de este producto.',true);
define('TEXT_PRODUCT_DATE_ADDED', 'Este producto fue añadido a nuestro catálogo el %s.',true);
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estará disponible el %s.',true);

define('TEXT_EDIT_INTRO', 'Por favor realice los cambios necesarios',true);
define('TEXT_EDIT_CATEGORIES_ID', 'ID Categoría:',true);
define('TEXT_EDIT_CATEGORIES_NAME', 'Nombre Categoría:',true);
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagen Categoría:',true);
define('TEXT_EDIT_SORT_ORDER', 'Orden:',true);

define('TEXT_INFO_COPY_TO_INTRO', 'Elija la categoría hacia donde quiera copiar este producto',true);
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorías:',true);

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nueva Categoría',true);
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoría',true);
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar Categoría',true);
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoría',true);
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar Producto',true);
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Producto',true);
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar A',true);

define('TEXT_DELETE_CATEGORY_INTRO', 'Seguro que desea eliminar esta categoría ?',true);
define('TEXT_DELETE_PRODUCT_INTRO', '¿Está usted seguro que desea suprimir permanentemente este producto ?',true);

define('TEXT_DELETE_WARNING_CHILDS', '<strong>ADVERTENCIA:</strong> Hay %s categorías que pertenecen a esta categoría!',true);
define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>ADVERTENCIA:</strong> Hay %s productos en esta categoría!',true);
define('TEXT_MOVE_PRODUCTS_INTRO', 'Elija la categoría hacia donde quiera mover <strong>%s</strong>',true);
define('TEXT_MOVE_CATEGORIES_INTRO', 'Elija la categoría hacia donde quiera mover <strong>%s</strong>',true);
define('TEXT_MOVE', 'Mover <strong>%s</strong> a:',true);

define('TEXT_NEW_CATEGORY_INTRO', 'Rellene la siguiente información para la nueva categoría',true);
define('TEXT_CATEGORIES_NAME', 'Nombre categoría:',true);
define('TEXT_CATEGORIES_IMAGE', 'Imagen categoría:',true);
define('TEXT_SORT_ORDER', 'Orden:',true);

define('TEXT_PRODUCTS_STATUS', 'Estado de los Productos:',true);
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Fecha Disponibilidad:',true);
define('TEXT_PRODUCTS_CUSTOM_DATE','Custom date:',true);
define('TEXT_PRODUCTS_SORT_ORDER','Sort order:',true);
define('TEXT_PRODUCT_AVAILABLE', 'Disponible',true);
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Agotado',true);
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante del producto:',true);
define('TEXT_PRODUCTS_NAME', 'Nombre del Producto:',true);
define('TEXT_PRODUCTS_DESCRIPTION', 'Descripción del producto:',true);
define('TEXT_PRODUCTS_QUANTITY', 'Cantidad:',true);
define('TEXT_PRODUCTS_MODEL', 'Modelo:',true);
define('TEXT_PRODUCTS_IMAGE', 'Imagen:',true);
define('TEXT_PRODUCTS_MAIN_IMAGE', 'Imagen Principal',true);
define('TEXT_PRODUCTS_LARGE_IMAGE', 'Imagen Grande',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'Contenido HTML (para la ventana popup)',true);
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Adicionar Imagen Grande',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Eliminar Imagen Grande ?',true);
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Por favor confirme la eliminación de la Imagen Grande.',true);
define('TEXT_PRODUCTS_URL', 'URL de los Productos:',true);
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sin http://)</small>',true);
define('TEXT_PRODUCTS_PRICE_NET', 'Precio del Producto (Neto):',true);
define('TEXT_PRODUCTS_PRICE_GROSS', 'Precio del Producto (Bruto):',true);
define('TEXT_PRODUCTS_WEIGHT', 'Peso:',true);

define('EMPTY_CATEGORY', 'Categoría vacía',true);

define('TEXT_HOW_TO_COPY', 'Método de copia:',true);
define('TEXT_COPY_AS_LINK', 'Enlazar producto',true);
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar producto',true);

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden enlazar productos en la misma categoría.',true);
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: La categoría NO puede ser movida dentro de la categoría hijo.',true);
?>
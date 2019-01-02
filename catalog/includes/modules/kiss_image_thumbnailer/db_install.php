<?php
/**
 * KISS Image Thumbnailer
 * Creates image thumbnails where the image size requested differs from the actual image size.
 * Ensures that the browser does not have to resize images resulting in far greater loading speeds.
 * Once thumbnails have been created the system has been designed to use very minimal resources.
 *  
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
 * @package KISS Image Thumbnailer
 * @link http://www.fwrmedia.co.uk
 * @copyright Copyright 2008-2009 FWR Media ( Robert Fisher )
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: @raiwa  info@sarplataygemas.com       $:  Author of last commit
 * @lastmod $Date:: 2015-09-24       			     						 $:  Date of last commit
 * @version $Rev:: 21                                       $:  Revision of last commit
 * @Id $Id:: Image.php 14 2015-06-25 @raiwa                 $:  Full Details

 * $Rev:: 21 Added Thumbs Main directory support in line 69-75 by @raiwa
 * $Rev:: 17 Added Reset Thumbs support in line 61-66 by @gergely
 * $Rev:: 14 Added Watermark support in line 44-60 by @oboy

  /**
 * Auto install Configuration entries for KissIT Product Image Thumbs
 *  
 * 
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
 * @author     Rainer Schmied @raiwa info@sarplataygemas.com
 * @version     17 BS
 */
/**
 * Auto install Configuration entries for KissIT Product Watermarked Thumbs
 *  
 * 
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
 * @author     Flemming Aunel @oboy flemmingaunel@gmail.com
 * @version    xx
 */
if (!defined('KISSIT_IMAGE_MODULE')) {
    define('KISSIT_MAIN_PRODUCT_IMAGE_WIDTH', '250');
    define('KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT', '250');

    tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, set_function) VALUES ('KissIT: Version', 'KISSIT_IMAGE_MODULE', '14', 'KISS Image Thumbnailer - Creates image thumbnails where the image size requested differs from the actual image size', '6', '0', NOW(), null), ('KissIT Product Main Image Width', 'KISSIT_MAIN_PRODUCT_IMAGE_WIDTH', '".tep_db_input(KISSIT_MAIN_PRODUCT_IMAGE_WIDTH)."', 'KissIT Product Main Image Width.<br /><br />', '4', '20', NOW(), null), ('KissIT Product Main Image Height', 'KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT', '".tep_db_input(KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT)."', 'KissIT Product Main Image Height.<br /><br />', '4', '21', NOW(), null), ('KissIT Disable Image Upsize', 'KISS_DISABLE_UPSIZE', 'true', 'Keep original image size if the original image is smaller than the requested thumbnail size.', '4', '22', NOW(), '".tep_db_input("tep_cfg_select_option(array('true', 'false'), ")."')");
}

// Added for watermark support
if (KISSIT_IMAGE_MODULE < 14 || !defined('KISSIT_MAIN_PRODUCT_WATERMARK_SIZE')) {
    define('KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '0.6');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', 'watermark.png');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '60');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '60');
    tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, set_function) VALUES 
			('KissIT Product Watermark Size', 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '".tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_SIZE)."', 'KissIT Product Main Watermark size relativ to the image size (1.0=100%, 0.5 = 50%, 0=no watermark).<br /><br />', '4', '23', NOW(), null), 
			('KissIT Watermark File Name', 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', '".tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE)."', 'Name of Watermark image file placed in the folder /images. Remember to use a png file with transparent background.<br /><br />', '4', '24', NOW(), null), 
			('KissIT Watermark position in image', 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT', 'center', 'Position of the watermark in the image reletiv within the image.', '4', '25', NOW(), '".tep_db_input("tep_cfg_select_option(array('top-right', 'top-left', 'center','bottom-right', 'bottom-left'), ")."'), 
			('KissIT min image width to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '".tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH)."', 'The minimum width of thumbnail images to apply the watermark.<br /><br />', '4', '26', NOW(), null), 
			('KissIT min image height to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '".tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT)."', 'The minimum height of thumbnail images to apply the watermark.<br /><br />', '4', '27', NOW(), null)
				");
    tep_db_query("UPDATE `configuration` SET `configuration_value`='14'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
}

if (KISSIT_IMAGE_MODULE < 17 || !defined('KISSIT_RESET_IMAGE_THUMBS')) {
    tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT Reset thumbs', 'KISSIT_RESET_IMAGE_THUMBS', 'false', 'Reset thumbs cache.', '4', '28', NOW(), 'tep_cfg_reset_thumbs_cache', '".tep_db_input("tep_cfg_select_option(array('reset', 'false'), ")."')
				");
    tep_db_query("UPDATE `configuration` SET `configuration_value`='17'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
}

if (KISSIT_IMAGE_MODULE < 21 || !defined('KISSIT_THUMBS_MAIN_DIR')) {
    define('KISSIT_THUMBS_MAIN_DIR', 'thumbs/');
    tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added,set_function) VALUES 
			('KissIT thumb directory', 'KISSIT_THUMBS_MAIN_DIR', '".tep_db_input(KISSIT_THUMBS_MAIN_DIR)."', 'The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Please, reset thumbs if you change it.', '4', '29', NOW(), null)
				");
    tep_db_query("UPDATE `configuration` SET `configuration_value`='21'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
}
?>

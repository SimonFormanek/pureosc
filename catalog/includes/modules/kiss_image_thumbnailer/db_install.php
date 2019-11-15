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
  * @lastdev $Author:: @raiwa  info@oscaddons.com       $:  Author of last commit
  * @lastmod $Date:: 2018-02-22       			     						 $:  Date of last commit
  * @version $Rev:: 28                                       $:  Revision of last commit
  * @Id $Id:: db_installe.php 14 2015-06-25 @raiwa                 $:  Full Details

  * $Rev:: 28 Added link to Pro version. by @raiwa
  * $Rev:: 24 Added Thumbnail sharpening function. by @raiwa
  * $Rev:: 23 Added optional Background. Moved configuration entries from html_output.php. Recuded for more secure updates for all versions. by @raiwa
 * $Rev:: 21 Added Thumbs Main directory support in line 69-75 by @raiwa
 * $Rev:: 17 Added Reset Thumbs support in line 61-66 by @gergely
 * $Rev:: 14 Added Watermark support in line 44-60 by @oboy

  /**
 * Auto install Configuration entries for KissIT Product Image Thumbs
 *  
 * 
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU Public License)
 * @author     Rainer Schmied @raiwa info@sarplataygemas.com
  * @version     24 BS
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
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
		define('KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '0.6');
		define('KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', 'watermark.png');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '60');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '60');
  	define('KISSIT_THUMBS_MAIN_DIR', 'thumbs/');
  	define('KISSIT_DEFAULT_MISSING_IMAGE', 'no_image_available_150_150.gif');
  	define('KISSIT_BACKGROUND_COLOR', '255,255,255');
  	define('KISSIT_JPEG_QUALITY', '75');

		tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
    	('KissIT: Version', 'KISSIT_IMAGE_MODULE', '24', 'KISS Image Thumbnailer - Creates image thumbnails where the image size requested differs from the actual image size', '6', '0', NOW(), null, null), 
    	('KissIT Product Main Image Width', 'KISSIT_MAIN_PRODUCT_IMAGE_WIDTH', '" . tep_db_input(KISSIT_MAIN_PRODUCT_IMAGE_WIDTH) . "', 'KissIT Product Main Image Width.<br /><br />', '4', '20', NOW(), null, null), 
    	('KissIT Product Main Image Height', 'KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT', '" . tep_db_input(KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT) . "', 'KissIT Product Main Image Height.<br /><br />', '4', '21', NOW(), null, null), 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
    	('KissIT Disable Image Upsize', 'KISS_DISABLE_UPSIZE', 'true', 'Keep original image size if the original image is smaller than the requested thumbnail size.', '4', '23', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),  
			('KissIT Product Watermark Size', 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_SIZE) . "', 'KissIT Product Main Watermark size relativ to the image size (1.0=100%, 0.5 = 50%, 0=no watermark).<br>Change requires Thumbs cache reset.', '4', '24', NOW(), null, null), 
			('KissIT Watermark File Name', 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE) . "', 'Name of Watermark image file placed in the folder /images. Remember to use a png file with transparent background.<br>Change requires Thumbs cache reset.', '4', '25', NOW(), null, null), 
			('KissIT Watermark position in image', 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT', 'center', 'Position of the watermark in the image reletiv within the image.<br>Change requires Thumbs cache reset.', '4', '26', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('top-right', 'top-left', 'center','bottom-right', 'bottom-left'), ") . "'), 
			('KissIT min image width to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH) . "', 'The minimum width of thumbnail images to apply the watermark.<br>Change requires Thumbs cache reset.', '4', '27', NOW(), null, null), 
			('KissIT min image height to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT) . "', 'The minimum height of thumbnail images to apply the watermark.<br>Change requires Thumbs cache reset.', '4', '28', NOW(), null, null),
			('KissIT missing image', 'KISSIT_DEFAULT_MISSING_IMAGE', '" . tep_db_input(KISSIT_DEFAULT_MISSING_IMAGE) . "', 'The missing image image shown if no image can be found.', '4', '29', NOW(), null, null),
			('KissIT JPEG Quality', 'KISSIT_JPEG_QUALITY', '" . tep_db_input(KISSIT_JPEG_QUALITY) . "', '    Jpeg quality setting, range 0-100.<br>75 corresponds to Photoshop setting 9.<br>Change requires Thumbs cache reset.', '4', '30', NOW(), null, null),
			('KissIT apply Background', 'KISSIT_APPLY_BACKGROUND', 'true', 'Apply additional Background to fit required proportion and size.<br>Applies to JPEG. PNG/GIF will use transparent Background.<br>Change requires Thumbs cache reset.', '4', '31', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),
			('KissIT Background Color', 'KISSIT_BACKGROUND_COLOR', '" . tep_db_input(KISSIT_BACKGROUND_COLOR) . "', 'RGB color of the added Background.<br><br>Comma separated values:<br>Default: white => 255,255,255.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '33', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('KissIT thumb directory', 'KISSIT_THUMBS_MAIN_DIR', '" . tep_db_input(KISSIT_THUMBS_MAIN_DIR) . "', 'The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Change requires Thumbs cache reset.', '4', '34', NOW(), null, null),
			('KissIT Reset thumbs', 'KISSIT_RESET_IMAGE_THUMBS', 'false', 'Reset thumbs cache.', '4', '35', NOW(), 'tep_cfg_reset_thumbs_cache', '" . tep_db_input("tep_cfg_select_option(array('reset', 'false'), ") . "'),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
	}	elseif ( KISSIT_IMAGE_MODULE < 14 || !defined('KISSIT_MAIN_PRODUCT_WATERMARK_SIZE') ) {
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '0.6');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', 'watermark.png');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '60');
    define('KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '60');
  	define('KISSIT_THUMBS_MAIN_DIR', 'thumbs/');
  	define('KISSIT_DEFAULT_MISSING_IMAGE', 'no_image_available_150_150.gif');
  	define('KISSIT_BACKGROUND_COLOR', '255,255,255');
  	define('KISSIT_JPEG_QUALITY', '75');
		tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
    	('KissIT Disable Image Upsize', 'KISS_DISABLE_UPSIZE', 'true', 'Keep original image size if the original image is smaller than the requested thumbnail size.', '4', '23', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),  
			('KissIT Product Watermark Size', 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_SIZE) . "', 'KissIT Product Main Watermark size relativ to the image size (1.0=100%, 0.5 = 50%, 0=no watermark).<br>Change requires Thumbs cache reset.', '4', '24', NOW(), null, null), 
			('KissIT Watermark File Name', 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE) . "', 'Name of Watermark image file placed in the folder /images. Remember to use a png file with transparent background.<br>Change requires Thumbs cache reset.', '4', '25', NOW(), null, null), 
			('KissIT Watermark position in image', 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT', 'center', 'Position of the watermark in the image reletiv within the image.<br>Change requires Thumbs cache reset.', '4', '26', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('top-right', 'top-left', 'center','bottom-right', 'bottom-left'), ") . "'), 
			('KissIT min image width to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH) . "', 'The minimum width of thumbnail images to apply the watermark.<br>Change requires Thumbs cache reset.', '4', '27', NOW(), null, null), 
			('KissIT min image height to apply Watermark', 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT', '" . tep_db_input(KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT) . "', 'The minimum height of thumbnail images to apply the watermark.<br>Change requires Thumbs cache reset.', '4', '28', NOW(), null, null),
			('KissIT missing image', 'KISSIT_DEFAULT_MISSING_IMAGE', '" . tep_db_input(KISSIT_DEFAULT_MISSING_IMAGE) . "', 'The missing image image shown if no image can be found.', '4', '29', NOW(), null, null),
			('KissIT JPEG Quality', 'KISSIT_JPEG_QUALITY', '" . tep_db_input(KISSIT_JPEG_QUALITY) . "', '    Jpeg quality setting, range 0-100.<br>75 corresponds to Photoshop setting 9.<br>Change requires Thumbs cache reset.', '4', '30', NOW(), null, null),
			('KissIT apply Background', 'KISSIT_APPLY_BACKGROUND', 'true', 'Apply additional Background to fit required proportion and size.<br>Applies to JPEG. PNG/GIF will use transparent Background.<br>Change requires Thumbs cache reset.', '4', '31', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),
			('KissIT Background Color', 'KISSIT_BACKGROUND_COLOR', '" . tep_db_input(KISSIT_BACKGROUND_COLOR) . "', 'RGB color of the added Background.<br><br>Comma separated values:<br>Default: white => 255,255,255.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '33', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('KissIT thumb directory', 'KISSIT_THUMBS_MAIN_DIR', '" . tep_db_input(KISSIT_THUMBS_MAIN_DIR) . "', 'The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Change requires Thumbs cache reset.', '4', '34', NOW(), null, null),
			('KissIT Reset thumbs', 'KISSIT_RESET_IMAGE_THUMBS', 'false', 'Reset thumbs cache.', '4', '35', NOW(), 'tep_cfg_reset_thumbs_cache', '" . tep_db_input("tep_cfg_select_option(array('reset', 'false'), ") . "'),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
		tep_db_query("UPDATE `configuration` SET `configuration_value`='24'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
  } elseif ( KISSIT_IMAGE_MODULE < 17 || !defined('KISSIT_RESET_IMAGE_THUMBS') ) {
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
  	define('KISSIT_THUMBS_MAIN_DIR', 'thumbs/');
  	define('KISSIT_DEFAULT_MISSING_IMAGE', 'no_image_available_150_150.gif');
  	define('KISSIT_BACKGROUND_COLOR', '255,255,255');
  	define('KISSIT_JPEG_QUALITY', '75');
    tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
			('KissIT missing image', 'KISSIT_DEFAULT_MISSING_IMAGE', '" . tep_db_input(KISSIT_DEFAULT_MISSING_IMAGE) . "', 'The missing image image shown if no image can be found.', '4', '29', NOW(), null, null),
			('KissIT JPEG Quality', 'KISSIT_JPEG_QUALITY', '" . tep_db_input(KISSIT_JPEG_QUALITY) . "', '    Jpeg quality setting, range 0-100.<br>75 corresponds to Photoshop setting 9.<br>Change requires Thumbs cache reset.', '4', '30', NOW(), null, null),
			('KissIT apply Background', 'KISSIT_APPLY_BACKGROUND', 'true', 'Apply additional Background to fit required proportion and size.<br>Applies to JPEG. PNG/GIF will use transparent Background.<br>Change requires Thumbs cache reset.', '4', '31', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),
			('KissIT Background Color', 'KISSIT_BACKGROUND_COLOR', '" . tep_db_input(KISSIT_BACKGROUND_COLOR) . "', 'RGB color of the added Background.<br><br>Comma separated values:<br>Default: white => 255,255,255.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '33', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('KissIT thumb directory', 'KISSIT_THUMBS_MAIN_DIR', '" . tep_db_input(KISSIT_THUMBS_MAIN_DIR) . "', 'The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Change requires Thumbs cache reset.', '4', '34', NOW(), null, null),
			('KissIT Reset thumbs', 'KISSIT_RESET_IMAGE_THUMBS', 'false', 'Reset thumbs cache.', '4', '35', NOW(), 'tep_cfg_reset_thumbs_cache', '" . tep_db_input("tep_cfg_select_option(array('reset', 'false'), ") . "'),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
  	tep_db_query("UPDATE `configuration` SET `configuration_value`='24'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='23'  WHERE configuration_key= 'KISS_DISABLE_UPSIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='24'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='25'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='26'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='27'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='28'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT';");
  } elseif ( KISSIT_IMAGE_MODULE < 21 || !defined('KISSIT_THUMBS_MAIN_DIR') ) {
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
    define('KISSIT_THUMBS_MAIN_DIR', 'thumbs/');
  	define('KISSIT_DEFAULT_MISSING_IMAGE', 'no_image_available_150_150.gif');
  	define('KISSIT_BACKGROUND_COLOR', '255,255,255');
  	define('KISSIT_JPEG_QUALITY', '75');
		tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
			('KissIT missing image', 'KISSIT_DEFAULT_MISSING_IMAGE', '" . tep_db_input(KISSIT_DEFAULT_MISSING_IMAGE) . "', 'The missing image image shown if no image can be found.', '4', '29', NOW(), null, null),
			('KissIT JPEG Quality', 'KISSIT_JPEG_QUALITY', '" . tep_db_input(KISSIT_JPEG_QUALITY) . "', '    Jpeg quality setting, range 0-100.<br>75 corresponds to Photoshop setting 9.<br>Change requires Thumbs cache reset.', '4', '30', NOW(), null, null),
			('KissIT apply Background', 'KISSIT_APPLY_BACKGROUND', 'true', 'Apply additional Background to fit required proportion and size.<br>Applies to JPEG. PNG/GIF will use transparent Background.<br>Change requires Thumbs cache reset.', '4', '31', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),
			('KissIT Background Color', 'KISSIT_BACKGROUND_COLOR', '" . tep_db_input(KISSIT_BACKGROUND_COLOR) . "', 'RGB color of the added Background.<br><br>Comma separated values:<br>Default: white => 255,255,255.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '33', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('KissIT thumb directory', 'KISSIT_THUMBS_MAIN_DIR', '" . tep_db_input(KISSIT_THUMBS_MAIN_DIR) . "', 'The name of the thumbs directory inside \"images\".<br>default: \'thumbs\'<br>Change requires Thumbs cache reset.', '4', '34', NOW(), null, null),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
  	tep_db_query("UPDATE `configuration` SET `configuration_value`='24'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='23'  WHERE configuration_key= 'KISS_DISABLE_UPSIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='24'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='25'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='26'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='27'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='28'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='35'  WHERE configuration_key= 'KISSIT_RESET_IMAGE_THUMBS';");
  } elseif ( KISSIT_IMAGE_MODULE < 23 || !defined('KISSIT_APPLY_BACKGROUND') ) {
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
  	define('KISSIT_DEFAULT_MISSING_IMAGE', 'no_image_available_150_150.gif');
  	define('KISSIT_BACKGROUND_COLOR', '255,255,255');
  	define('KISSIT_JPEG_QUALITY', '75');
		tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
			('KissIT missing image', 'KISSIT_DEFAULT_MISSING_IMAGE', '" . tep_db_input(KISSIT_DEFAULT_MISSING_IMAGE) . "', 'The missing image image shown if no image can be found.', '4', '29', NOW(), null, null),
			('KissIT JPEG Quality', 'KISSIT_JPEG_QUALITY', '" . tep_db_input(KISSIT_JPEG_QUALITY) . "', '    Jpeg quality setting, range 0-100.<br>75 corresponds to Photoshop setting 9.<br>Change requires Thumbs cache reset.', '4', '30', NOW(), null, null),
			('KissIT apply Background', 'KISSIT_APPLY_BACKGROUND', 'true', 'Apply additional Background to fit required proportion and size.<br>Applies to JPEG. PNG/GIF will use transparent Background.<br>Change requires Thumbs cache reset.', '4', '31', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('true', 'false'), ") . "'),
			('KissIT Background Color', 'KISSIT_BACKGROUND_COLOR', '" . tep_db_input(KISSIT_BACKGROUND_COLOR) . "', 'RGB color of the added Background.<br><br>Comma separated values:<br>Default: white => 255,255,255.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '33', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
  	tep_db_query("UPDATE `configuration` SET `configuration_value`='24'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='23'  WHERE configuration_key= 'KISS_DISABLE_UPSIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='24'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='25'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='26'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='27'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='28'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='34'  WHERE configuration_key= 'KISSIT_THUMBS_MAIN_DIR';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='35'  WHERE configuration_key= 'KISSIT_RESET_IMAGE_THUMBS';");
  } elseif ( KISSIT_IMAGE_MODULE < 24 || !defined('KISSIT_SHARPEN_THUMBNAIL') ) {
  	define('KISSIT_MIN_IMAGE_SIZE', '25');
		tep_db_query("INSERT INTO configuration (configuration_title,configuration_key,configuration_value,configuration_description,configuration_group_id,sort_order,date_added, use_function, set_function) VALUES 
			('KissIT min image size', 'KISSIT_MIN_IMAGE_SIZE', '" . tep_db_input(KISSIT_MIN_IMAGE_SIZE) . "', 'Minimum image size in px to trigger Thumbnail creation.<br>Recommended range 10-50.<br>Default: 25.', '4', '22', NOW(), null, null),
			('KissIT sharpen Thumbnail', 'KISSIT_SHARPEN_THUMBNAIL', 'medium', 'Apply Sharpening Filter to Thumbnails.<br>Default: medium.<br>Change requires Thumbs cache reset.', '4', '32', NOW(), null, '" . tep_db_input("tep_cfg_select_option(array('none', 'soft', 'medium','strong'), ") . "'),
			('<a target=\"_blank\" href=\"http://www.oscaddons.com/en/commercial-add-ons/kissit-image-thumbnailer-pro-p-63.html\"><strong>Get KissIT Pro</strong></a>', 'KISSIT_PRO', '', 'KissIT Pro introduces support for the html tag \"srcset:\" It allows to indicate the browser that different versions of an image are available to fit the different needs of high resolution/retina devices and smaller devices.', '4', '36', NOW(), null, null)
				");
  	tep_db_query("UPDATE `configuration` SET `configuration_value`='24'  WHERE configuration_key= 'KISSIT_IMAGE_MODULE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='23'  WHERE configuration_key= 'KISS_DISABLE_UPSIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='24'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_SIZE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='25'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_IMAGE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='26'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_PLACEMENT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='27'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_WIDTH';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='28'  WHERE configuration_key= 'KISSIT_MAIN_PRODUCT_WATERMARK_MIN_IMAGE_HEIGHT';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='29'  WHERE configuration_key= 'KISSIT_DEFAULT_MISSING_IMAGE';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='30'  WHERE configuration_key= 'KISSIT_JPEG_QUALITY';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='31'  WHERE configuration_key= 'KISSIT_APPLY_BACKGROUND';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='32'  WHERE configuration_key= 'KISSIT_BACKGROUND_COLOR';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='34'  WHERE configuration_key= 'KISSIT_THUMBS_MAIN_DIR';");
		tep_db_query("UPDATE `configuration` SET `sort_order`='35'  WHERE configuration_key= 'KISSIT_RESET_IMAGE_THUMBS';");
}
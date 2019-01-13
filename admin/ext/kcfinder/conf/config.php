<?php

/** This file is part of KCFinder project
  *
  *      @desc Base configuration file
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */

/* IMPORTANT!!! Do not comment or remove uncommented settings in this file
   even if you are using session configuration.
   See http://kcfinder.sunhater.com/install for setting descriptions */

//pure:new require PURE modified configure.php
require('../../../../oscconfig/admin/configure.php');
// DIR_WS_CATALOG_IMAGES
return array(


// GENERAL SETTINGS

    'disabled' => true, 
    'disabled' => $_SESSION['KCFINDER']['disabled'], //pure:new added for cookies auth

    'uploadURL' => '',
    'uploadDir' => DIR_FS_MASTER_ROOT_DIR,
    'theme' => "default",

    'types' => array(

    // (F)CKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",

    // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),


// IMAGE SETTINGS

    'imageDriversPriority' => "imagick gmagick gd",
    'jpegQuality' => 90,
    'thumbsDir' => "images/.thumbs",

    'maxImageWidth' => 0,
    'maxImageHeight' => 0,

    'thumbWidth' => 100,
    'thumbHeight' => 100,

    'watermark' => "",


// DISABLE / ENABLE SETTINGS

    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,


// PERMISSION SETTINGS

    'dirPerms' => 0755,
    'filePerms' => 0644,

    'access' => array(

        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy'   => true,
            'move'   => true,
            'rename' => true
        ),

        'dirs' => array(
            'create' => false,
            'delete' => false,
            'rename' => false
        )
    ),

    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",


// MISC SETTINGS

    'filenameChangeChars' => array(
        ' ' => "-",
        ':' => "-",
        'Å' => 'A', 'å' => 'a',
	'Ä' => 'Ae', 'ä' => 'a',
	'À' => 'A', 'à' => 'a',
	'Â' => 'A', 'â' => 'a',
	'Æ' => 'AE', 'æ' => 'ae',
	'Á' => 'A', 'á' => 'a',
	'Č' => 'C', 'č' => 'c',
	'Ç' => 'C', 'ç' => 'c',
	'Ď' => 'D', 'ď' => 'd',
	'É' => 'E', 'é' => 'e',
	'Ě' => 'E', 'ě' => 'e',
	'È' => 'E', 'è' => 'e',
	'Ê' => 'E', 'ê' => 'e',
	'Ë' => 'E', 'ë' => 'e',
	'Í' => 'I', 'í' => 'i',
	'Î' => 'I', 'î' => 'i',
	'Ï' => 'I', 'ï' => 'i',
	'Ň' => 'N', 'ň' => 'n',
	'Ó' => 'O', 'ó' => 'o',
	'Ö' => 'Oe', 'ö' =>'oe',
	'Œ' => 'OE','œ' => 'oe',
	'Ô' => 'O','ô' => 'o',
	'Ö' => 'Oe', 'ö' => 'oe',
	'Ř' => 'R', 'ř' => 'r',
	'Š' => 'S', 'š' => 's',
	'ß' => 'sz',
	'Ť' => 'T', 'ť' => 't',
	'Ú' => 'U', 'ú' => 'u',
	'Ů' => 'U', 'ů' => 'U',
	'Ù' => 'U', 'ù' => 'u',
	'Û' => 'U', 'û' => 'u',
	'Ü' => 'U', 'ü' => 'u',
	'Ý' => 'Y', 'ý' => 'y',
	'Ÿ' => 'Y', 'ÿ' =>'y',
	'Ž' => 'Z', 'ž' => 'z'
    ),

    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",

    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',


// THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION SETTINGS

    '_sessionVar' => "KCFINDER",
    '_check4htaccess' => false,
    '_normalizeFilenames' => false,
    '_dropUploadMaxFilesize' => 10485760,
    //'_tinyMCEPath' => "/tiny_mce",
    //'_cssMinCmd' => "java -jar /path/to/yuicompressor.jar --type css {file}",
    //'_jsMinCmd' => "java -jar /path/to/yuicompressor.jar --type js {file}",
);

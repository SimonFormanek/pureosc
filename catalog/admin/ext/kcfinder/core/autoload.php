<?php

/** This file is part of KCFinder project
  *
  *      @desc Autoload Classes
  *   @package KCFinder
  *   @version 3.12
  *    @author Pavel Tzonkov <sunhater@sunhater.com>
  * @copyright 2010-2014 KCFinder Project
  *   @license http://opensource.org/licenses/GPL-3.0 GPLv3
  *   @license http://opensource.org/licenses/LGPL-3.0 LGPLv3
  *      @link http://kcfinder.sunhater.com
  */


// BOF: Added to work with session handling of osCommerce:
$oldPath = getcwd();
//working: 
//    chdir('/home/f/git/pureosc.redmine/osc/admin');
chdir('../../');
require('includes/application_top.php');
chdir($oldPath);
//set_include_path('../../../');
//require('includes/application_top.php');
//set_include_path(dirname(__FILE__));
//restore_include_path();
// EOF: Added to work with session handling of osCommerce:


spl_autoload_register(function($path) {
    $path = explode("\\", $path);

    if (count($path) == 1)
        return;

    list($ns, $class) = $path;

    if ($ns == "kcfinder") {
        if (in_array($class, array("uploader", "browser", "minifier", "session")))
            require "core/class/$class.php";
        elseif (file_exists("core/types/$class.php"))
            require "core/types/$class.php";
        elseif (file_exists("lib/class_$class.php"))
            require "lib/class_$class.php";
        elseif (file_exists("lib/helper_$class.php"))
            require "lib/helper_$class.php";
    }
});

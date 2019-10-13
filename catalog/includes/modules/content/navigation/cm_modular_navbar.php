<?php
/*
  $Id cm_modular_navbar.php v1.0.1 20160321 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */

class cm_modular_navbar
{
    public $version     = '1.0.1';
    public $code        = '';
    public $group       = '';
    public $title       = '';
    public $description = '';
    public $sort_order  = 0;
    public $enabled     = false;

    public function __construct()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       = _('Modular Navigation Bar');
        $this->description = _('Show the Modular Navigation Bar on your site.');

        if (defined('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS')) {
            $this->sort_order = MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS
                == 'True');
        }
    }

    public function execute()
    {
        global $language, $oscTemplate;

        if (defined('MODULE_CONTENT_INSTALLED') && tep_not_null(MODULE_CONTENT_INSTALLED)) {
            $navbar_array = explode(';', MODULE_CONTENT_INSTALLED);

            $navigation_left  = array();
            $navigation_right = array();

            foreach ($navbar_array as $navbar_element) {
                $dir = substr($navbar_element, 0, 6);
                if ($dir === 'navbar') {
                    $class = substr($navbar_element, 7);

                    if (!class_exists($class)) {
                        include_once DIR_WS_LANGUAGES.$language.'/modules/content/navbar/'.$class.'.php';
                        include_once DIR_WS_MODULES.'content/navbar/'.$class.'.php';
                    }

                    $navbar_class = new $class();

                    if ($navbar_class->isEnabled() && $navbar_class->side === 'left') {
                        $navigation_left[] = $navbar_class->getOutput();
                    } elseif ($navbar_class->isEnabled() && $navbar_class->side === 'right') {
                        $navigation_right[] = $navbar_class->getOutput();
                    }
                }
            }

            if (!empty($navigation_left) || !empty($navigation_right)) {

                ob_start();
                include DIR_WS_MODULES.'content/'.$this->group.'/templates/'.basename(__FILE__);
                $template = ob_get_clean();

                $oscTemplate->addContent($template, $this->group);
            }
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return defined('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS');
    }

    public function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION_TITLE', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION', '".$this->version."', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION_DESCRIPTION', '6', '0', 'tep_cfg_disabled(', now() ) ");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS_TITLE', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS', 'True', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS_DESCRIPTION', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED_TITLE', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED', 'True', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED_DESCRIPTION', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER_TITLE', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER', '9000', 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER_DESCRIPTION', '6', '2', now())");
    }

    public function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    public function keys()
    {
        $keys   = array();
        $keys[] = 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_VERSION';
        $keys[] = 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_STATUS';
        $keys[] = 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED';
        $keys[] = 'MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_SORT_ORDER';
        return $keys;
    }
}

// End class
////////////////////////////////////////////////////////////////////////////
//                                                                        //
//  This is the end of the module class.                                  //
//  Everything past this point is an independent function, not a method.  //
//                                                                        //
////////////////////////////////////////////////////////////////////////////
////
// Function to show a disabled entry (Value is shown but cannot be changed)
if (!function_exists('tep_cfg_disabled')) {

    function tep_cfg_disabled($value)
    {
        return tep_draw_input_field('configuration_value', $value, ' disabled');
    }
}

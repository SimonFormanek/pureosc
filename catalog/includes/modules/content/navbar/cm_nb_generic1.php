<?php
/*
  $Id: cm_nb_generic1.php, v1.0.1 20160321 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */

class cm_nb_generic1
{
    public $version     = '1.0.1';
    public $code        = '';
    public $group       = '';
    public $title       = '';
    public $description = '';
    public $sort_order  = 0;
    public $enabled     = false;
    public $side        = 'left';

    function __construct()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       = _('Navbar Generic1');
        $this->description = _('Show the Navbar generic1 icon on your site.');
        $this->description .= '<div class="secWarning">'._('External links in osCommerce are extremely dangerous. Read the warnings in the User\'s Manual concerning external links before adding an external link to this module.').'</div>';

        if (cfg('MODULE_CONTENT_NAVBAR_GENERIC1_STATUS')) {
            $this->sort_order = cfg('MODULE_CONTENT_NAVBAR_GENERIC1_SORT_ORDER');
            $this->enabled    = cfg('MODULE_CONTENT_NAVBAR_GENERIC1_STATUS') == 'True';
            $this->side       = (cfg('MODULE_CONTENT_NAVBAR_GENERIC1_CONTENT_PLACEMENT') === 'left') ? 'left' : 'right';
        }
    }

    public function getOutput()
    {
        if (MODULE_CONTENT_NAVBAR_GENERIC1_LINK_TYPE === 'internal' && MODULE_CONTENT_NAVBAR_GENERIC1_LINK
            !== '') {
            $generic1_link = tep_href_link(MODULE_CONTENT_NAVBAR_GENERIC1_LINK);
        } elseif (MODULE_CONTENT_NAVBAR_GENERIC1_LINK_TYPE === 'external' && MODULE_CONTENT_NAVBAR_GENERIC1_LINK
            !== '') {
            $generic1_link = MODULE_CONTENT_NAVBAR_GENERIC1_LINK;
        }

        ob_start();
        include DIR_WS_MODULES.'content/navbar/templates/'.basename(__FILE__);
        $template = ob_get_clean();

        return $template;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return defined('MODULE_CONTENT_NAVBAR_GENERIC1_STATUS');
    }

    public function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_CONTENT_NAVBAR_GENERIC1_VERSION', '".$this->version."', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Generic Module', 'MODULE_CONTENT_NAVBAR_GENERIC1_STATUS', 'True', 'Should the generic1 link be shown in the navigation bar?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_NAVBAR_GENERIC1_SORT_ORDER', '9190', 'Sort order of display. Lowest is displayed first.', '6', '2', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_CONTENT_NAVBAR_GENERIC1_CONTENT_PLACEMENT', 'left', 'Should the module be loaded on the left or right side of the navbar?', '6', '3', 'tep_cfg_select_option(array(\'left\', \'right\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Link Type', 'MODULE_CONTENT_NAVBAR_GENERIC1_LINK_TYPE', 'internal', 'Is this an internal or external link?', '6', '4', 'tep_cfg_select_option(array(\'internal\', \'external\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Link', 'MODULE_CONTENT_NAVBAR_GENERIC1_LINK', 'index.php', 'The osCommerce filename if internal, otherwise the full URL.', '6', '5', now())");
    }

    public function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    public function keys()
    {
        $keys   = array();
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_VERSION';
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_STATUS';
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_SORT_ORDER';
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_CONTENT_PLACEMENT';
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_LINK_TYPE';
        $keys[] = 'MODULE_CONTENT_NAVBAR_GENERIC1_LINK';

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
<?php
/*
  $Id: cm_fp_text_main.php, v1.2.1 20160322 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
 */

class cm_fp_text_main
{
    public $version = '1.2.1';
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    function __construct()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       = _('Front Page Main Text');
        $this->description = _('Show the main text block on the front page.');
        $this->description .= '<div class="secWarning">'.'<p>'._('Content Width can be 12 or less per column per row').'</p>'.
            '<p>'._('12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.').'</p>'.
            '<p>'._('Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on)').'</p>'.'</div>';

        if (defined('MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS')) {
            $this->sort_order = MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS == 'True');
        }
    }

    public function execute()
    {
        global $oscTemplate;

        if (TEXT_MAIN != '') {
            ob_start();
            include(DIR_WS_MODULES.'content/'.$this->group.'/templates/'.basename(__FILE__));
            $template = ob_get_clean();

            $oscTemplate->addContent($template, $this->group);
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return defined('MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS');
    }

    public function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_VERSION', '".$this->version."', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Main Text Module', 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS', 'True', 'Should the main text block be shown on the front page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_SORT_ORDER', '40', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '3', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
    }

    public function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    public function keys()
    {
        $keys   = array();
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_VERSION';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_STATUS';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_SORT_ORDER';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_TEXT_MAIN_CONTENT_WIDTH';
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

<?php
/*
  $Id: cm_fp_upcoming_products.php, v1.2.1 20160322 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License v2.0 or later
 */

class cm_fp_upcoming_products
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

        $this->title       =  MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_TITLE;
        $this->description = MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_DESCRIPTION;
        $this->description .= '<div class="secWarning">'.MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION.'</div>';

        if (defined('MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS')) {
            $this->sort_order = MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS
                == 'True');
        }
    }

    public function execute()
    {
        global $oscTemplate;

        $upcoming_products_data = $this->get_data();
        if ($upcoming_products_data !== false && count($upcoming_products_data) > 0) {
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
        return defined('MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS');
    }

    public function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Module Version', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_VERSION', '".$this->version."', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Upcoming Products Module', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS', 'True', 'Should the upcoming products block be shown on the front page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Module Sort Order', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_SORT_ORDER', '60', 'Sort order of display of the modules. Lowest is displayed first.', '6', '0', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '3', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Max Products Shown', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_MAX_DISPLAY', '9', 'Maximum number of upcoming products to show on the front page.', '6', '2', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sort Products By', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_FIELD', 'date_expected', 'Field to sort the upcoming products by.', '6', '3','tep_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Sort Direction', 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_DIRECTION', 'desc', 'Sort in ascending or descending order.', '6', '4', 'tep_cfg_select_option(array(\'asc\', \'desc\'), ', now())");
    }

    public function remove()
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    public function keys()
    {
        $keys   = array();
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_VERSION';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_STATUS';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_SORT_ORDER';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_CONTENT_WIDTH';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_MAX_DISPLAY';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_FIELD';
        $keys[] = 'MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_DIRECTION';
        return $keys;
    }

    private function get_data()
    {
        global $languages_id;

        $upcoming_products_query_raw = $this->query_string_products($languages_id);
        $upcoming_products_query     = tep_db_query($upcoming_products_query_raw);
        $num_upcoming_products       = tep_db_num_rows($upcoming_products_query);

        if ($num_upcoming_products > 0) {
            $upcoming_prods_content = array();
            while ($upcoming_products      = tep_db_fetch_array($upcoming_products_query)) {
                $upcoming_prods_content[$upcoming_products['products_id']] = array(
                    'products_id' => $upcoming_products['products_id'],
                    'products_name' => $upcoming_products['products_name'],
                    'date_expected' => $upcoming_products['date_expected']
                );
            }
            return $upcoming_prods_content;
        }
        return false;
    }

    private function query_string_products($languages_id)
    {
        $upcoming_products_query_raw = "
        select 
          p.products_id, 
          pd.products_name, 
          products_date_available as date_expected 
        from 
          products p
          join products_description pd
            on (p.products_id = pd.products_id)
        where 
          to_days(products_date_available) > to_days(now())
          and pd.language_id = '".(int) $languages_id."'
        order by 
          ".MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_FIELD." ".MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_DIRECTION." 
        limit 
          ".MODULE_CONTENT_FRONT_PAGE_UPCOMING_PRODUCTS_MAX_DISPLAY;
        return $upcoming_products_query_raw;
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

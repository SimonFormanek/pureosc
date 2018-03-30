<?php
/*
  $Id: cm_fp_new_products.php, v1.2.1 20160322 Kymation$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License v2.0 or later
*/

  class cm_fp_new_products {
    public $version = '1.2.1';
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_TITLE;
      $this->description = MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_DESCRIPTION;
      $this->description .= '<div class="secWarning">' . MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION . '</div>';

      if ( defined('MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS') ) {
        $this->sort_order = MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS == 'True');
      }
    }

    public function execute() {
      global $oscTemplate, $currencies, $PHP_SELF;

      $new_products_data = $this->get_data();
      if( $new_products_data !== false && count($new_products_data) > 0 ) {
        ob_start();
        include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/' . basename(__FILE__));
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
      }
    }

    public function isEnabled() {
      return $this->enabled;
    }

    public function check() {
      return defined('MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS');
    }

    public function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_VERSION', '" . $this->version . "', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable New Products Module', 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS', 'True', 'Should the new products block be shown on the front page?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_SORT_ORDER', '50', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_CONTENT_WIDTH', '12', 'What width container should the content be shown in?', '6', '3', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Max Products', 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_MAX_DISPLAY_NEW_PRODUCTS', '9', 'Maximum number of new products to show on the front page.', '6', '2', now())");
    }

    public function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    public function keys() {
      $keys = array();
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_VERSION';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_STATUS';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_SORT_ORDER';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_CONTENT_WIDTH';
      $keys[] = 'MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_MAX_DISPLAY_NEW_PRODUCTS';
      return $keys;
    }
    
    private function get_data() {
      global $languages_id, $current_category_id;
    
      if ( (!isset($current_category_id)) || ($current_category_id == '0') ) {
        $new_products_query_raw = $this->query_string_all_products( $languages_id ) ;
      } else {
        $new_products_query_raw = $this->query_string_single_category( $languages_id, $current_category_id ) ;
      }

      $new_products_query = tep_db_query($new_products_query_raw);
      $num_new_products = tep_db_num_rows($new_products_query);

      if ($num_new_products > 0) {
        $new_prods_content = array();
        while ($new_products = tep_db_fetch_array($new_products_query)) {
          $new_prods_content[$new_products['products_id']] = array(
            'products_id' => $new_products['products_id'],
            'products_image' => $new_products['products_image'],
            'products_tax_class_id' => $new_products['products_tax_class_id'],
            'products_name' => $new_products['products_name'],
            'products_price' => $new_products['products_price']
          );
        }
        return $new_prods_content;
      }
      return false;
    }
    
    private function query_string_all_products( $languages_id ) {
      $new_products_query_raw = "
        select 
          p.products_id, 
          p.products_image, 
          p.products_tax_class_id, 
          pd.products_name, 
          if(s.status, s.specials_new_products_price, p.products_price) as products_price 
        from 
          products p
          join products_description pd
            on (p.products_id = pd.products_id)
          left join specials s 
            on (p.products_id = s.products_id)
        where 
          p.products_status = '1' 
          and pd.language_id = '" . (int)$languages_id . "'
           AND (p.products_date_available is NULL OR p.products_date_available ='0000-00-00' OR to_days(p.products_date_available) <= to_days(now()))
        ORDER BY " . NEW_PRODUCTS_SORT_ORDER . "
        limit " . MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_MAX_DISPLAY_NEW_PRODUCTS ;
      return $new_products_query_raw;
    }
    
    private function query_string_single_category( $languages_id, $current_category_id ) {
      $new_products_query_raw = "
        select 
          p.products_id, 
          p.products_image, 
          p.products_tax_class_id, 
          pd.products_name, 
          if(s.status, s.specials_new_products_price, p.products_price) as products_price 
        from 
          products p 
          left join specials s 
            on (p.products_id = s.products_id)
          join products_description pd
            on (p.products_id = pd.products_id)
          join products_to_categories p2c
            on (p.products_id = p2c.products_id)
          join categories c
            on (p2c.categories_id = c.categories_id)
        where
           c.parent_id = '" . (int)$current_category_id . "'
           and p.products_status = '1' 
           and pd.language_id = '" . (int)$languages_id . "'
           AND (p.products_date_available is NULL OR p.products_date_available ='0000-00-00' OR to_days(p.products_date_available) < to_days(now()))
        ORDER BY " . NEW_PRODUCTS_SORT_ORDER . "
          p.products_date_added desc 
        limit " . MODULE_CONTENT_FRONT_PAGE_NEW_PRODUCTS_MAX_DISPLAY_NEW_PRODUCTS ;
      return $new_products_query_raw;
    }
  } // End class


  ////////////////////////////////////////////////////////////////////////////
  //                                                                        //
  //  This is the end of the module class.                                  //
  //  Everything past this point is an independent function, not a method.  //
  //                                                                        //
  ////////////////////////////////////////////////////////////////////////////


  ////
  // Function to show a disabled entry (Value is shown but cannot be changed)
  if( !function_exists( 'tep_cfg_disabled' ) ) {
    function tep_cfg_disabled( $value ) {
      return tep_draw_input_field( 'configuration_value', $value, ' disabled' );
    }
  }

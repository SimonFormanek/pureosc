<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2015 osCommerce

  Released under the GNU General Public License
 */

class cm_header_search {

  public $version = '1.0.1';
  public $code = '';
  public $group = '';
  public $title = '';
  public $description = '';
  public $sort_order = 0;
  public $enabled = false;
  public $side = 'left';

  function __construct() {
    $this->code = get_class($this);
    $this->group = basename(dirname(__FILE__));

    $this->title = _('Header Search Bar');
    $this->description = _('Adds your Header Search Bar into the Navbar Area of your site.');

    if (defined('MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS')) {
      $this->sort_order = MODULE_NAVIGATION_BAR_STORE_SEARCH_SORT_ORDER;
      $this->enabled = (MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS == 'True');
      $this->side = ((MODULE_NAVIGATION_BAR_STORE_SEARCH_PLACEMENT === 'left') ? 'left' : 'right');
    }
  }

  function execute() {
    global $oscTemplate;

    $content_width = (int) MODULE_CONTENT_HEADER_LOGO_CONTENT_WIDTH;
    $search_box = $this->tep_store_search('btn-info',
      (MODULE_NAVIGATION_BAR_STORE_SEARCH_FUNCTIONS == 'Descriptions'));

    // define typeahead scripts
    $script = '<script src="ext/bootstrap-plugins/typeahead/bootstrap3-typeahead.min.js"></script>';
//orig      $script .= '<script src="' . tep_href_link('ext/modules/content/header/store_search/content_searches.min.js', null, $request_type) . '"></script>';
    $script .= '<script src="ext/modules/content/header/store_search/content_searches.min.js"></script>';
    $oscTemplate->addBlock($script, 'footer_scripts');

    ob_start();
    include DIR_WS_MODULES . 'content/header/templates/' . basename(__FILE__);
    $search_box .= ob_get_clean();

    ob_start();
    include(DIR_WS_MODULES . 'content/' . $this->group . '/templates/search.php');
    $template = ob_get_clean();

    $oscTemplate->addContent($template, $this->group);
  }

  public function isEnabled() {
    return $this->enabled;
  }

  public function check() {
    return defined('MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS');
  }

  public function install() {
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Module Version', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_VERSION', '" . $this->version . "', 'The version of this module that you are running.', '6', '0', 'tep_cfg_disabled(', now() ) ");

    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Navbar Search Module', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
    // model or keywords for additional product search
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_PLACEMENT', 'left', 'Should the link be loaded on the left or right side of the navbar?', '6', '3', 'tep_cfg_select_option(array(\'left\', \'right\'), ', now())");
    // image or icon for products
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Extended Store Search Functions', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_FUNCTIONS', 'Standard', 'Do you want to enable search function in descriptions?', '6', '1', 'tep_cfg_select_option(array(\'Standard\', \'Descriptions\'), ', now())");
    // width of product image lg
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Product Image Width Desktop (LG size)', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_LG', '80', 'What image width must be displayed for desktops?', '6', '6', now())");
    // width of product image md
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Product Image Width Tablet+ (MD size)', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_MD', '66', 'What image width must be displayed for tablets+?', '6', '7', now())");
    // width of product image sm
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Product Image Width Tablet (SM size)', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_SM', '50', 'What image width must be displayed for tablets?', '6', '8', now())");
    // width of product image xs
    tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Product Image Width Mobile (XS size)', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_XS', '40', 'What image width must be displayed for mobiles?', '6', '9', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Pages', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGES', '" . implode(';',
        $this->get_default_pages()) . "', 'The pages to add the Store Search\'s results.', '6', '0', 'cm_header_search_show_pages', 'cm_header_search_pages(', now())");
    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_NAVIGATION_BAR_STORE_SEARCH_SORT_ORDER', '520', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
  }

  public function remove() {
    tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '",
        $this->keys()) . "')");
  }

  public function keys() {
    $keys = array();
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_OR_ICON';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_MODEL_OR_KEYWORDS';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_XS';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_SM';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_MD';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_IMAGE_WIDTH_LG';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_VERSION';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_STATUS';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_SORT_ORDER';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_PLACEMENT';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_FUNCTIONS';
    $keys[] = 'MODULE_NAVIGATION_BAR_STORE_SEARCH_PAGES';

    return $keys;
  }

  function get_default_pages() {
    return array('shipping.php',
      'contact_us.php',
      'conditions.php',
      'cookie_usage.php',
      'privacy.php',
      'login.php',
      'address_book.php',
      'create_account.php',
      'account_history.php',
      'advanced_search.php',
      'products_new.php',
      'reviews.php',
      'ssl_check.php',
      'specials.php',
      'shopping_cart.php');
  }

  function tep_store_search($btnclass = 'btn-default', $description = true) {
    global $request_type;

    $search_link = '<div class="searchbox-margin col-sm-12 col-md-6">';
    $search_link .= tep_draw_form('quick_find',
      tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', $request_type, false),
      'get', 'class="form-horizontal"');
    $search_link .= '   <div class="input-group">' .
      tep_draw_input_field('keywords', '',
        'required placeholder="' . _('Site search') . '" id="quick_search" data-provide="typeahead" autocomplete="off" style="margin-right:-2px;"',
        'search') .
      ' 		<span class="input-group-btn"><button type="submit" class="btn btn-submit-search" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;"><i class="fa fa-search"></i></button></span>';
    if (tep_not_null($description) && ($description === true)) {
      $search_link .= tep_draw_hidden_field('search_in_description', '1');
    }
    $search_link .= '   </div>';
    $search_link .= '</div>';
    $search_link .= tep_hide_session_id() . '</form>';

    return $search_link;
  }

  function cm_header_search_show_pages($text) {
    return nl2br(implode("\n", explode(';', $text)));
  }

  function cm_header_search_pages($values, $key) {
    $file_extension = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '.'));
    $files_array = array();
    if ($dir = @dir(DIR_FS_CATALOG)) {
      while ($file = $dir->read()) {
        if (!is_dir(DIR_FS_CATALOG . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension) {
            $files_array[] = $file;
          }
        }
      }
      sort($files_array);
      $dir->close();
    }

    $values_array = explode(';', $values);

    $output = '';
    foreach ($files_array as $file) {
      $output .= tep_draw_checkbox_field('cm_header_search_file[]', $file,
          in_array($file, $values_array)) . '&nbsp;' . tep_output_string($file) . '<br />';
    }

    if (!empty($output)) {
      $output = '<br />' . substr($output, 0, -6);
    }

    $output .= tep_draw_hidden_field('configuration[' . $key . ']', '',
      'id="htrn_files"');

    $output .= '<script>
                function htrn_update_cfg_value() {
                  var htrn_selected_files = \'\';

                  if ($(\'input[name="cm_header_search_file[]"]\').length > 0) {
                    $(\'input[name="cm_header_search_file[]"]:checked\').each(function() {
                      htrn_selected_files += $(this).attr(\'value\') + \';\';
                    });

                    if (htrn_selected_files.length > 0) {
                      htrn_selected_files = htrn_selected_files.substring(0, htrn_selected_files.length - 1);
                    }
                  }

                  $(\'#htrn_files\').val(htrn_selected_files);
                }

                $(function() {
                  htrn_update_cfg_value();

                  if ($(\'input[name="cm_header_search_file[]"]\').length > 0) {
                    $(\'input[name="cm_header_search_file[]"]\').change(function() {
                      htrn_update_cfg_value();
                    });
                  }
                });
                </script>';

    return $output;
  }

}

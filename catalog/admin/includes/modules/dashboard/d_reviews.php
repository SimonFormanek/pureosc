<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class d_reviews {
    var $code = 'd_reviews';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct()
    {
        $this->d_reviews();
    }
    
    function d_reviews() {
      $this->title = _('Reviews');
      $this->description = _('Show the latest reviews');

      if ( defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS') ) {
        $this->sort_order = cfg('MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER');
        $this->enabled = (cfg('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS') == 'True');
      }
    }

    function getOutput() {
      global $languages_id;

      $output = '<table border="0" width="100%" cellspacing="0" cellpadding="4">' .
                '  <tr class="dataTableHeadingRow">' .
                '    <td class="dataTableHeadingContent">' . _('Reviews') . '</td>' .
                '    <td class="dataTableHeadingContent">' . _('Date') . '</td>' .
                '    <td class="dataTableHeadingContent">' . _('Reviewer') . '</td>' .
                '    <td class="dataTableHeadingContent">' . _('Rating') . '</td>' .
                '    <td class="dataTableHeadingContent">' . _('Status') . '</td>' .
                '  </tr>';

      $reviews_query = tep_db_query("select r.reviews_id, r.date_added, pd.products_name, r.customers_name, r.reviews_rating, r.reviews_status from " . TABLE_REVIEWS . " r, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = r.products_id and pd.language_id = '" . (int)$languages_id . "' order by r.date_added desc limit 6");
      while ($reviews = tep_db_fetch_array($reviews_query)) {
        $status_icon = ($reviews['reviews_status'] == '1') ? tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) : tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
        $output .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">' .
                   '    <td class="dataTableContent"><a href="' . tep_href_link(FILENAME_REVIEWS, 'rID=' . (int)$reviews['reviews_id'] . '&action=edit') . '">' . $reviews['products_name'] . '</a></td>' .
                   '    <td class="dataTableContent">' . tep_date_short($reviews['date_added']) . '</td>' .
                   '    <td class="dataTableContent">' . tep_output_string_protected($reviews['customers_name']) . '</td>' .
                   '    <td class="dataTableContent">' . tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'stars_' . $reviews['reviews_rating'] . '.gif') . '</td>' .
                   '    <td class="dataTableContent">' . $status_icon . '</td>' .
                   '  </tr>';
      }

      $output .= '</table>';

      return $output;
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Reviews Module', 'MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'True', 'Do you want to show the latest reviews on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_ADMIN_DASHBOARD_REVIEWS_STATUS', 'MODULE_ADMIN_DASHBOARD_REVIEWS_SORT_ORDER');
    }
  }
  
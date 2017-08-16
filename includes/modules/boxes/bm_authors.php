<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_authors {
    var $code = 'bm_authors';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function bm_authors() {
      $this->title = MODULE_BOXES_AUTHORS_TITLE;
      $this->description = MODULE_BOXES_AUTHORS_DESCRIPTION;

      if ( defined('MODULE_BOXES_AUTHORS_STATUS') ) {
        $this->sort_order = MODULE_BOXES_AUTHORS_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_AUTHORS_STATUS == 'True');

        $this->group = ((MODULE_BOXES_AUTHORS_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate, $languages_id;

      $authors_query = tep_db_query("select authors_id, authors_name from " . TABLE_AUTHORS . " order by authors_name");
      if ($number_of_author_rows = tep_db_num_rows($authors_query)) {
        if ($number_of_author_rows <= MAX_DISPLAY_AUTHORS_IN_A_LIST) {
          // Display a list
          $content = '<ul style="list-style: none; margin: 0; padding: 0;">';
          while ($authors = tep_db_fetch_array($authors_query)) {
            $authors_name = ((strlen($authors['authors_name']) > MAX_DISPLAY_AUTHOR_NAME_LEN) ? substr($authors['authors_name'], 0, MAX_DISPLAY_AUTHOR_NAME_LEN) . '..' : $authors['authors_name']);
            if (isset($_GET['authors_id']) && ($_GET['authors_id'] == $authors['authors_id'])) $authors_name = '<strong>' . $authors_name .'</strong>';
            $content .= '<li><a href="' . tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $authors['authors_id']) . '">' . $authors_name . '</a></li>';
          }
          $content .= '</ul>';
        } else {
          // Display a drop-down
          $authors_array = array();
          if (MAX_AUTHORS_LIST < 2) {
            $authors_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
          }

          while ($authors = tep_db_fetch_array($authors_query)) {
            $authors_name = ((strlen($authors['authors_name']) > MAX_DISPLAY_AUTHOR_NAME_LEN) ? substr($authors['authors_name'], 0, MAX_DISPLAY_AUTHOR_NAME_LEN) . '..' : $authors['authors_name']);
            $authors_array[] = array('id' => $authors['authors_id'],
                                     'text' => $authors_name);
          }

          $content = tep_draw_form('authors', tep_href_link(FILENAME_ARTICLES, '', 'NONSSL', false), 'get') .
                     tep_draw_pull_down_menu('authors_id', $authors_array, (isset($_GET['authors_id']) ? $_GET['authors_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_AUTHORS_LIST . '" style="width: 100%"') . tep_hide_session_id() .
                     '</form>';
        }
      }
 
                
      $data = '<div class="panel panel-default">' .
                '  <div class="panel-heading">' . MODULE_BOXES_AUTHORS_BOX_TITLE . '</div>' .
                '  <div class="panel-body">' . $content . '</div>' .
                '</div>';                

      $oscTemplate->addBlock($data, $this->group);

    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_AUTHORS_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Article Manager Authors Infobox', 'MODULE_BOXES_AUTHORS_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_AUTHORS_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_AUTHORS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_AUTHORS_STATUS', 'MODULE_BOXES_AUTHORS_CONTENT_PLACEMENT', 'MODULE_BOXES_AUTHORS_SORT_ORDER');
    }
  }
?>

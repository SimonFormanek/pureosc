<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class cm_header_search
{
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_header_search()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       =  MODULE_CONTENT_HEADER_SEARCH_TITLE;
        $this->description = MODULE_CONTENT_HEADER_SEARCH_DESCRIPTION;
                $this->description .= '<div class="secWarning">'.'<p>'._('Content Width can be 12 or less per column per row').'</p>'.
            '<p>'._('12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.').'</p>'.
            '<p>'._('Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on)').'</p>'.'</div>';


        if (defined('MODULE_CONTENT_HEADER_SEARCH_STATUS')) {
            $this->sort_order = MODULE_CONTENT_HEADER_SEARCH_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_HEADER_SEARCH_STATUS == 'True');
        }
    }

    function execute()
    {
        global $oscTemplate, $request_type;

        $content_width = MODULE_CONTENT_HEADER_SEARCH_CONTENT_WIDTH;


        $search_box = '<div class="searchbox-margin">';
        $search_box .= tep_draw_form('quick_find',
                tep_href_link('advanced_search_result.php', '', $request_type,
                    false), 'get', 'class="form-horizontal"').tep_draw_hidden_field('search_in_description',
                '1');
        $search_box .= '  <div class="input-group">'.
            tep_draw_input_field('keywords', '',
                'required placeholder="'.TEXT_SEARCH_PLACEHOLDER.'"', 'search').'<span class="input-group-btn">'.tep_draw_button(IMAGE_BUTTON_ADVANCED_SEARCH_LINK,
                '',
                tep_href_link(FILENAME_ADVANCED_SEARCH,
                    tep_get_all_get_params(array('sort', 'page',)), 'NONSSL',
                    true, false)).'<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>'.'</span>'.
            '</div>';
        $search_box .= tep_hide_session_id().'</form>';
        $search_box .= '</div>';

        ob_start();
        include(DIR_WS_MODULES.'content/'.$this->group.'/templates/search.php');
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_CONTENT_HEADER_SEARCH_STATUS');
    }

    function install()
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Search Box Module', 'MODULE_CONTENT_HEADER_SEARCH_STATUS', 'True', 'Do you want to enable the Search Box content module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_HEADER_SEARCH_CONTENT_WIDTH', '4', 'What width container should the content be shown in?', '6', '1', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_HEADER_SEARCH_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_CONTENT_HEADER_SEARCH_STATUS', 'MODULE_CONTENT_HEADER_SEARCH_CONTENT_WIDTH',
            'MODULE_CONTENT_HEADER_SEARCH_SORT_ORDER');
    }
}

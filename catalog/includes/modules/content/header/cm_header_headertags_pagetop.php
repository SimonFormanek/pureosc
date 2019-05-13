<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class cm_header_headertags_pagetop
{
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function cm_header_headertags_pagetop()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       =  MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_TITLE;
        $this->description = MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_DESCRIPTION;
                $this->description .= '<div class="secWarning">'.'<p>'._('Content Width can be 12 or less per column per row').'</p>'.
            '<p>'._('12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.').'</p>'.
            '<p>'._('Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on)').'</p>'.'</div>';


        if (defined('MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_STATUS') && HEADER_TAGS_DISPLAY_PAGE_TOP_TITLE
            == 'true') {
            $this->sort_order = MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_STATUS
                == 'True');
        }
    }

    function execute()
    {
        global $oscTemplate, $header_tags_array;

        $content_width = (int) MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_CONTENT_WIDTH;

        ob_start();
        ?>   
        <div id="hts_page_top"><?php echo $header_tags_array['title']; ?></div>
        <?php
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_STATUS');
    }

    function install()
    {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable HeaderTags Page Top Module', 'MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_STATUS', 'True', 'Do you want to enable the Logo content module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_CONTENT_WIDTH', '4', 'What width container should the content be shown in?', '6', '1', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_STATUS', 'MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_CONTENT_WIDTH',
            'MODULE_CONTENT_HEADER_HEADERTAGS_PAGETOP_SORT_ORDER');
    }
}

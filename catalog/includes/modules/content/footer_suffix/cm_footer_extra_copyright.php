<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class cm_footer_extra_copyright
{
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title = _('Copyright Details');
        $this->description = _('Adds a Copyright Block to the Extra Footer Area of your site');
        $this->description .= '<div class="secWarning">' . '<p>' . _('Content Width can be 12 or less per column per row') . '</p>' .
                '<p>' . _('12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.') . '</p>' .
                '<p>' . _('Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on)') . '</p>' . '</div>';

        if (defined('MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS')) {
            $this->sort_order = MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_SORT_ORDER;
            $this->enabled    = (MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS == 'True');
        }
    }

    function execute()
    {
        global $oscTemplate, $languages_id;

        $content_width = (int) MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_CONTENT_WIDTH;
          $information_query = tep_db_query("select information_title, information_description, information_id from " . TABLE_INFORMATION . " WHERE language_id = '" . (int) $languages_id . "'  AND information_id = '28'");
          $information = tep_db_fetch_array($information_query);
          
          $copyYear = intval(preg_replace('/[^0-9.]/','',$information['information_title'])); 
          $copyTitle = preg_replace('/[0-9.]/','',$information['information_title']); 
        $curYear = date('Y'); // Keeps the second year updated
        $template_content = $copyTitle;
        //if ($curYear != $copyYear) {
        $template_content .= $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
        //} else {
//          $template_content .= $information['information_title'];
  //      }
        $template_content .= ' ' . strip_p($information['information_description']);
        include(DIR_WS_MODULES.'content/'.$this->group.'/templates/'.basename(__FILE__));
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Copyright Details Footer Module', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS', 'True', 'Do you want to enable the Copyright content module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_CONTENT_WIDTH', '6', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_STATUS', 'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_CONTENT_WIDTH',
            'MODULE_CONTENT_FOOTER_EXTRA_COPYRIGHT_SORT_ORDER');
    }
}

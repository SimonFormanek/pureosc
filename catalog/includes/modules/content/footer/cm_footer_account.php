<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class cm_footer_account
{
    var $code;
    var $group;
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct()
    {
        $this->cm_footer_account();
    }

    function cm_footer_account()
    {
        $this->code  = get_class($this);
        $this->group = basename(dirname(__FILE__));

        $this->title       = cfg('MODULE_CONTENT_FOOTER_ACCOUNT_TITLE');
        $this->description = cfg('MODULE_CONTENT_FOOTER_ACCOUNT_DESCRIPTION');
                $this->description .= '<div class="secWarning">'.'<p>'._('Content Width can be 12 or less per column per row').'</p>'.
            '<p>'._('12/12 = 100% width, 6/12 = 50% width, 4/12 = 33% width.').'</p>'.
            '<p>'._('Total of all columns in any one row must equal 12 (eg:  3 boxes of 4 columns each, 1 box of 12 columns and so on)').'</p>'.'</div>';


        if (defined('MODULE_CONTENT_FOOTER_ACCOUNT_STATUS')) {
            $this->sort_order = cfg('MODULE_CONTENT_FOOTER_ACCOUNT_SORT_ORDER');
            $this->enabled    = defined('MODULE_CONTENT_FOOTER_ACCOUNT_STATUS') && (cfg('MODULE_CONTENT_FOOTER_ACCOUNT_STATUS') == 'True');
        }
    }

    function execute()
    {
        global $oscTemplate, $customer_id;

        /*         * * Begin Article Manager *** */
        $aLinks = GetArticleLinsByTopic('Customer Service');

        $content_width = (int) MODULE_CONTENT_FOOTER_ACCOUNT_CONTENT_WIDTH;

        if (tep_session_is_registered('customer_id')) {
            $account_content = '<li><a href="'.tep_href_link('account.php', '',
                    'SSL').'">'.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_ACCOUNT.'</a></li>'.
                '<li><a href="'.tep_href_link('address_book.php', '', 'SSL').'">'.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_ADDRESS_BOOK.'</a></li>'.
                '<li><a href="'.tep_href_link('account_history.php', '', 'SSL').'">'.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_ORDER_HISTORY.'</a></li>'.
                $aLinks.
                '<li><br><a class="btn btn-danger btn-sm btn-block" role="button" href="'.tep_href_link('logoff.php',
                    '', 'SSL').'"><i class="fa fa-sign-out"></i> '.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_LOGOFF.'</a></li>';
        } else {
            $account_content = '<li><a href="'.tep_href_link('create_account.php',
                    '', 'SSL').'">'.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_CREATE_ACCOUNT.'</a></li>'.
                $aLinks.
                '<li><br><a class="btn btn-success btn-sm btn-block" role="button" href="'.tep_href_link('login.php',
                    '', 'SSL').'"><i class="fa fa-sign-in"></i> '.MODULE_CONTENT_FOOTER_ACCOUNT_BOX_LOGIN.'</a></li>';
        }

        /*         * * End Article Manager *** */

        ob_start();
        include(DIR_WS_MODULES.'content/'.$this->group.'/templates/'.basename(__FILE__));
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_CONTENT_FOOTER_ACCOUNT_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Account Footer Module', 'MODULE_CONTENT_FOOTER_ACCOUNT_STATUS', 'True', 'Do you want to enable the Account content module?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Width', 'MODULE_CONTENT_FOOTER_ACCOUNT_CONTENT_WIDTH', '3', 'What width container should the content be shown in? (12 = full width, 6 = half width).', '6', '1', 'tep_cfg_select_option(array(\'12\', \'11\', \'10\', \'9\', \'8\', \'7\', \'6\', \'5\', \'4\', \'3\', \'2\', \'1\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_CONTENT_FOOTER_ACCOUNT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_CONTENT_FOOTER_ACCOUNT_STATUS', 'MODULE_CONTENT_FOOTER_ACCOUNT_CONTENT_WIDTH',
            'MODULE_CONTENT_FOOTER_ACCOUNT_SORT_ORDER');
    }
}

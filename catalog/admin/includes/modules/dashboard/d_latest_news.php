<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

class d_latest_news
{
    var $code    = 'd_latest_news';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    public function __construct()
    {
        $this->d_latest_news();
    }

    function d_latest_news()
    {
        $this->title       =  _('Latest News'); 
        $this->description = _('Show latest Oscommerce News');

        if (defined('MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS')) {
            $this->sort_order = MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER;
            $this->enabled    = (MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS == 'True');
        }
    }

    function getOutput()
    {
        $rss              = new lastRSS();
        $rss->items_limit = 5;
        $rss->cache_dir   = cfg('DIR_FS_CACHE');
        $rss->cache_time  = 86400;
        $feed             = $rss->get('http://feeds.feedburner.com/osCommerceNewsAndBlogs');

        $output = '<table border="0" width="100%" cellspacing="0" cellpadding="4">'.
            '  <tr class="dataTableHeadingRow">'.
            '    <td class="dataTableHeadingContent">'._('Latest News').'</td>'.
            '    <td class="dataTableHeadingContent" align="right">'._('Date').'</td>'.
            '  </tr>';

        if (is_array($feed) && !empty($feed)) {
            foreach ($feed['items'] as $item) {
                $output .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this);" onmouseout="rowOutEffect(this);">'.
                    '    <td class="dataTableContent"><a href="'.$item['link'].'" target="_blank">'.$item['title'].'</a></td>'.
                    '    <td class="dataTableContent" align="right" style="white-space: nowrap;">'.date("F j, Y",
                        strtotime($item['pubDate'])).'</td>'.
                    '  </tr>';
            }
        } else {
            $output .= '  <tr class="dataTableRow">'.
                '    <td class="dataTableContent" colspan="2">'._('Could not connect to the osCommerce News feed. The next attempt will be performed within 24 hours.').'</td>'.
                '  </tr>';
        }

        $output .= '  <tr class="dataTableRow">'.
            '    <td class="dataTableContent" align="right" colspan="2"><a href="http://www.oscommerce.com/Us&News" target="_blank">'.tep_image(DIR_WS_IMAGES.'icon_oscommerce.png',
                _('Read the latest osCommerce News')).'</a>&nbsp;<a href="http://www.oscommerce.com/newsletter/subscribe" target="_blank">'.tep_image(DIR_WS_IMAGES.'icon_newsletter.png',
                _('Sign-Up for the osCommerce Newsletter')).'</a>&nbsp;<a href="http://www.facebook.com/pages/osCommerce/33387373079" target="_blank">'.tep_image(DIR_WS_IMAGES.'icon_facebook.png',
                _('Become an osCommerce Fan on Facebook')).'</a>&nbsp;<a href="http://twitter.com/osCommerce" target="_blank">'.tep_image(DIR_WS_IMAGES.'icon_twitter.png',
                _('Follow osCommerce on Twitter')).'</a>&nbsp;<a href="http://feeds.feedburner.com/osCommerceNewsAndBlogs" target="_blank">'.tep_image(DIR_WS_IMAGES.'icon_rss.png',
                _('Subscribe to the osCommerce News RSS Feed')).'</a></td>'.
            '  </tr>'.
            '</table>';

        return $output;
    }

    function isEnabled()
    {
        return $this->enabled;
    }

    function check()
    {
        return defined('MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS');
    }

    function install()
    {
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Latest News Module', 'MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS', 'True', 'Do you want to show the latest osCommerce News on the dashboard?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
        tep_db_query("insert into ".TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove()
    {
        tep_db_query("delete from ".TABLE_CONFIGURATION." where configuration_key in ('".implode("', '",
                $this->keys())."')");
    }

    function keys()
    {
        return array('MODULE_ADMIN_DASHBOARD_LATEST_NEWS_STATUS', 'MODULE_ADMIN_DASHBOARD_LATEST_NEWS_SORT_ORDER');
    }
}



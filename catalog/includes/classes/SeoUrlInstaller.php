<?php
/**
 * Ultimate SEO URLs Contribution - osCommerce MS-2.2
 *
 * Ultimate SEO URLs offers search engine optimized URLS for osCommerce
 * based applications. Other features include optimized performance and 
 * automatic redirect script.
 * @package Ultimate-SEO-URLs
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 * @filesource
 */

namespace PureOSC;

/**
 * Ultimate SEO URLs Installer and Configuration Class
 *
 * Ultimate SEO URLs installer and configuration class offers a modular 
 * and easy to manage method of configuration.  The class enables the base
 * class to be configured and installed on the fly without the hassle of 
 * calling additional scripts or executing SQL.
 * @package Ultimate-SEO-URLs
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.1
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 */
class SeoUrlInstaller
{
    /**
     * The default_config array has all the default settings which should be all that is needed to make the base class work.
     * @var array
     */
    var $default_config;

    /**
     * Database object
     * @var object
     */
    var $DB;

    /**
     * $attributes array holds information about this instance
     * @var array
     */
    var $attributes;

    /**
     * SEO_URL_INSTALLER class constructor 
     * @author Bobby Easland 
     * @version 1.1
     */
    public function __construct()
    {

        $this->attributes = array();

        $x                                                         = 0;
        $this->default_config                                      = array();
        $this->default_config['SEO_ENABLED']                       = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable SEO URLs?', 'SEO_ENABLED', 'true', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_ADD_CID_TO_PRODUCT_URLS']       = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Add cPath to product URLs?', 'SEO_ADD_CID_TO_PRODUCT_URLS', 'false', 'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_ADD_CPATH_TO_PRODUCT_URLS']     = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Add category parent to product URLs?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'false', 'This setting will append the category parent(s) name to the product URLs (i.e. - parent-some-product-p-1.html).', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_ADD_CAT_PARENT']                = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Add category parent to begining of URLs?', 'SEO_ADD_CAT_PARENT', 'false', 'This setting will add the category parent(s) name to the beginning of the category URLs (i.e. - parent-category-c-1.html).', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_URLS_FILTER_SHORT_WORDS']       = array('DEFAULT' => '3',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting will filter words less than or equal to the value from the URL.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, NULL)");
        $x++;
        $this->default_config['SEO_URLS_USE_W3C_VALID']            = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Output W3C valid URLs (parameter string)?', 'SEO_URLS_USE_W3C_VALID', 'true', 'This setting will output W3C valid URLs.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_GLOBAL']              = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable SEO cache to save queries?', 'USE_SEO_CACHE_GLOBAL', 'true', 'This is a global setting and will turn off caching completely.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_PRODUCTS']            = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable product cache?', 'USE_SEO_CACHE_PRODUCTS', 'true', 'This will turn off caching for the products.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_CATEGORIES']          = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable categories cache?', 'USE_SEO_CACHE_CATEGORIES', 'true', 'This will turn off caching for the categories.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_MANUFACTURERS']       = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable manufacturers cache?', 'USE_SEO_CACHE_MANUFACTURERS', 'true', 'This will turn off caching for the manufacturers.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_ARTICLES']            = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable Articles Manager Articles cache?', 'USE_SEO_CACHE_ARTICLES', 'false', 'This will turn off caching for the Articles Manager articles.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_TOPICS']              = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable Articles Manager Topics cache?', 'USE_SEO_CACHE_TOPICS', 'false', 'This will turn off caching for the Articles Manager topics.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_FAQDESK_CATEGORIES']  = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES ('', 'Enable FAQDesk Categories cache?', 'USE_SEO_CACHE_FAQDESK_CATEGORIES', 'false', 'This will turn off caching for the FAQDesk Category pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_INFO_PAGES']          = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable Information Pages cache?', 'USE_SEO_CACHE_INFO_PAGES', 'false', 'This will turn off caching for Information Pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_LINKS']               = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES ('', 'Enable Links Manager cache?', 'USE_SEO_CACHE_LINKS', 'false', 'This will turn off caching for the Links Manager category pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_NEWSDESK_ARTICLES']   = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES ('', 'Enable NewsDesk Articles cache?', 'USE_SEO_CACHE_NEWSDESK_ARTICLES', 'false', 'This will turn off caching for the NewsDesk Article pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_NEWSDESK_CATEGORIES'] = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES ('', 'Enable NewsDesk Categories cache?', 'USE_SEO_CACHE_NEWSDESK_CATEGORIES', 'false', 'This will turn off caching for the NewsDesk Category pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_POLLBOOTH']           = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES ('', 'Enable Pollbooth cache?', 'USE_SEO_CACHE_POLLBOOTH', 'false', 'This will turn off caching for Pollbooth.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_CACHE_PAGE_EDITOR']         = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable Page Editor cache?', 'USE_SEO_CACHE_PAGE_EDITOR', 'false', 'This will turn off caching for the Page Editor pages.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_REDIRECT']                  = array('DEFAULT' => 'true',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable automatic redirects?', 'USE_SEO_REDIRECT', 'true', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_HEADER_TAGS']               = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable use Header Tags SEO as name?', 'USE_SEO_HEADER_TAGS', 'false', 'This will cause the title set in Header Tags SEO to be used instead of the categories or products name.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['USE_SEO_PERFORMANCE_CHECK']         = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enable performance checker?', 'USE_SEO_PERFORMANCE_CHECK', 'false', 'This will cause the code to track all database queries so that its affect on the speed of the page can be determined. Enabling it will cause a small speed loss.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_REWRITE_TYPE']                  = array('DEFAULT' => 'Rewrite',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Choose URL Rewrite Type', 'SEO_REWRITE_TYPE', 'Rewrite', 'Choose which SEO URL format to use.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''Rewrite''),')");
        $x++;
        $this->default_config['SEO_CHAR_CONVERT_SET']              = array('DEFAULT' => '',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Enter special character conversions', 'SEO_CHAR_CONVERT_SET', '', 'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, NULL)");
        $x++;
        $this->default_config['SEO_REMOVE_ALL_SPEC_CHARS']         = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Remove all non-alphanumeric characters?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')");
        $x++;
        $this->default_config['SEO_URLS_CACHE_RESET']              = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(''reset'', ''false''),')");
        $x++;
        $this->default_config['SEO_URLS_UNINSTALL']                = array('DEFAULT' => 'false',
            'QUERY' => "INSERT INTO `configuration` VALUES (NULL, 'Uninstall Ultimate SEO', 'SEO_URLS_DB_UNINSTALL', 'false', 'This will delete all of the entries in the configuration table for SEO', GROUP_INSERT_ID, ".$x.", NOW(), NOW(), 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(''uninstall'', ''false''),')");
        $this->init();
    }
# end class constructor

    /**
     * Initializer - if there are settings not defined the default config will be used and database settings installed. 
     * @author Bobby Easland 
     * @version 1.1
     */
    function init()
    {
        foreach ($this->default_config as $key => $value) {
            $container[] = defined($key) ? 'true' : 'false';
        } # end foreach
        $this->attributes['IS_DEFINED'] = in_array('false', $container) ? false : true;

        switch (true) {
            case (!$this->attributes['IS_DEFINED'] ):
                $this->eval_defaults();
                $this->DB                         = new SEO_DataBase(DB_SERVER,
                    DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD);
                $sql                              = "SELECT configuration_key, configuration_value  
                                                FROM `configuration` 
                                                WHERE configuration_key LIKE 'SEO%' OR configuration_key LIKE 'USE_SEO%'";
                $result                           = $this->DB->Query($sql);
                $num_rows                         = $this->DB->NumRows($result);
                $this->DB->Free($result);
                $this->attributes['IS_INSTALLED'] = (sizeof($container) == $num_rows)
                        ? true : false;
                if (!$this->attributes['IS_INSTALLED']) {
                    $this->install_settings();
                }
                break;
            default:
                $this->attributes['IS_INSTALLED'] = true;
                break;
        } # end switch
    }
# end function

    /**
     * This function evaluates the default serrings into defined constants 
     * @author Bobby Easland 
     * @version 1.0
     */
    function eval_defaults()
    {
        foreach ($this->default_config as $key => $value) {
            if (!defined($key)) define($key, $value['DEFAULT']);
        } # end foreach
    }
# end function

    /**
     * This function removes the database settings (configuration and cache)
     * @author Bobby Easland
     * @version 1.0
     */
    function uninstall_settings()
    {
        $cfgId_query = "SELECT configuration_group_id as ID FROM `configuration_group` WHERE configuration_group_title = 'SEO URLs'";
        $cfgID       = $this->DB->FetchArray($this->DB->Query($cfgId_query));
        $this->DB->Query("DELETE FROM `configuration_group` WHERE `configuration_group_title` = 'SEO URLs'");
        $this->DB->Query("DELETE FROM `configuration` WHERE configuration_group_id = '".$cfgID['ID']."' OR configuration_key LIKE 'SEO_%' OR configuration_key LIKE 'USE_SEO_%'");
        $this->DB->Query("DROP TABLE IF EXISTS `cache`");
    }
# end function

    /**
     * This function installs the database settings
     * @author Bobby Easland 
     * @version 1.0
     */
    function install_settings()
    {
        $this->uninstall_settings();
        $sort_order_query = "SELECT MAX(sort_order) as max_sort FROM `configuration_group`";
        $sort             = $this->DB->FetchArray($this->DB->Query($sort_order_query));
        $next_sort        = $sort['max_sort'] + 1;
        $insert_group     = "INSERT INTO `configuration_group` VALUES (NULL, 'SEO URLs', 'Options for Ultimate SEO URLs by Chemo', '".$next_sort."', '1')";
        $this->DB->Query($insert_group);
        $group_id         = $this->DB->InsertID();

        foreach ($this->default_config as $key => $value) {
            $sql = str_replace('GROUP_INSERT_ID', $group_id, $value['QUERY']);
            $this->DB->Query($sql);
        }

        $insert_cache_table = "CREATE TABLE `cache` (
                  `cache_id` varchar(32) NOT NULL default '',
                  `cache_language_id` tinyint(1) NOT NULL default '0',
                  `cache_name` varchar(255) NOT NULL default '',
                  `cache_data` mediumtext NOT NULL,
                  `cache_global` tinyint(1) NOT NULL default '1',
                  `cache_gzip` tinyint(1) NOT NULL default '1',
                  `cache_method` varchar(20) NOT NULL default 'RETURN',
                  `cache_date` datetime NOT NULL,
                  `cache_expires` datetime NOT NULL,
                  PRIMARY KEY  (`cache_id`,`cache_language_id`),
                  KEY `cache_id` (`cache_id`),
                  KEY `cache_language_id` (`cache_language_id`),
                  KEY `cache_global` (`cache_global`)
                ) ;";
        $this->DB->Query($insert_cache_table);
    }
# end function        
}

# end class

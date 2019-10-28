<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  Database Check 1.4 added -- http://addons.oscommerce.com/info/9087
  Mail Manager added -- http://addons.oscommerce.com/info/9133/v,23

  Released under the GNU General Public License
 */

$cl_box_groups[] = [
    'heading' => __('BOX_HEADING_TOOLS', _('Tools')),
    'apps' => [
        [
            'code' => cfg('FILENAME_ACTION_RECORDER'),
            'title' => __('BOX_TOOLS_ACTION_RECORDER',_('Action recorder')),
            'link' => tep_href_link(FILENAME_ACTION_RECORDER)
        ],
        [
            'code' => cfg('FILENAME_BACKUP'),
            'title' =>  __('BOX_TOOLS_BACKUP',_('Backup')),
            'link' => tep_href_link(FILENAME_BACKUP)
        ],
        [
            'code' => 'database_optimizer.php',
            'title' =>  __('BOX_TOOLS_DATABASE_OPTIMIZER',_('Database optimizer')),
            'link' => tep_href_link('database_optimizer.php')
        ],
        [
            'code' => cfg('FILENAME_BANNER_MANAGER'),
            'title' =>  __('BOX_TOOLS_BANNER_MANAGER',_('Banner manager')),
            'link' => tep_href_link(FILENAME_BANNER_MANAGER)
        ],
        [
            'code' => cfg('FILENAME_CACHE'),
            'title' =>  __('BOX_TOOLS_CACHE',_('Cache')),
            'link' => tep_href_link(FILENAME_CACHE)
        ],
        [
            'code' => cfg('FILENAME_DEFINE_LANGUAGE'),
            'title' =>  __('BOX_TOOLS_DEFINE_LANGUAGE',_('Define language')),
            'link' => tep_href_link(FILENAME_DEFINE_LANGUAGE)
        ],
        [
            'code' => cfg('FILENAME_MAIL'),
            'title' =>  __('BOX_TOOLS_MAIL',_('Tools Mail')),
            'link' => tep_href_link(FILENAME_MAIL)
        ],
        [
            'code' => cfg('FILENAME_NEWSLETTERS'),
            'title' =>  __('BOX_TOOLS_NEWSLETTER_MANAGER',_('Newsletter nanager')),
            'link' => tep_href_link(FILENAME_NEWSLETTERS)
        ],
        [
            'code' => cfg('FILENAME_SEC_DIR_PERMISSIONS'),
            'title' =>  __('BOX_TOOLS_SEC_DIR_PERMISSIONS',_('Dir permissions')),
            'link' => tep_href_link(FILENAME_SEC_DIR_PERMISSIONS)
        ],
        [
            'code' => cfg('FILENAME_SERVER_INFO'),
            'title' =>  __('BOX_TOOLS_SERVER_INFO',_('Server Info')),
            'link' => tep_href_link(FILENAME_SERVER_INFO)
        ],
        [
            'code' => cfg('FILENAME_VERSION_CHECK'),
            'title' =>  __('BOX_TOOLS_VERSION_CHECK',_('Version check')),
            'link' => tep_href_link(FILENAME_VERSION_CHECK)
        ],
        /*         * * Altered for Database Check 1.4 ** */
        [
            'code' => cfg('FILENAME_DATABASE_CHECK'),
            'title' =>  __('BOX_TOOLS_DATABASE_CHECK',_('Database Checks')),
            'link' => tep_href_link(FILENAME_DATABASE_CHECK)
        ],
        /*         * * EOF alteration for Database Check 1.4 ** */
        /*         * * Altered for Mail Manager ** */
        [
            'code' => cfg('FILENAME_MM_MAIL_MANAGER'),
            'title' =>  __('BOX_TOOLS_MAIL_MANAGER',_('Mail Manager')),
            'link' => tep_href_link(FILENAME_MM_MAIL_MANAGER)
        ],
        /*         * * EOF alterations for Mail Manager ** */
        [
            'code' => cfg('FILENAME_WHOS_ONLINE'),
            'title' =>  __('BOX_TOOLS_WHOS_ONLINE',_('Whois Online')),
            'link' => tep_href_link(FILENAME_WHOS_ONLINE)
        ],
        [
            'code' => cfg('FILENAME_FLEXIBEE_SYNC'),
            'title' =>  __('BOX_TOOLS_FLEXIBEE_SYNC',_('FlexiBee sync')),
            'link' => tep_href_link(FILENAME_FLEXIBEE_SYNC)
        ],
        [
            'code' => 'userlog.php',
            'title' => _('UserLog'),
            'link' => tep_href_link('userlog.php')
        ]
    ]
];


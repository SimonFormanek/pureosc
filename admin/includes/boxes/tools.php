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
    'heading' => BOX_HEADING_TOOLS,
    'apps' => [
        [
            'code' => FILENAME_ACTION_RECORDER,
            'title' => BOX_TOOLS_ACTION_RECORDER,
            'link' => tep_href_link(FILENAME_ACTION_RECORDER)
        ],
        [
            'code' => FILENAME_BACKUP,
            'title' => BOX_TOOLS_BACKUP,
            'link' => tep_href_link(FILENAME_BACKUP)
        ],
        [
            'code' => FILENAME_BANNER_MANAGER,
            'title' => BOX_TOOLS_BANNER_MANAGER,
            'link' => tep_href_link(FILENAME_BANNER_MANAGER)
        ],
        [
            'code' => FILENAME_CACHE,
            'title' => BOX_TOOLS_CACHE,
            'link' => tep_href_link(FILENAME_CACHE)
        ],
        [
            'code' => FILENAME_DEFINE_LANGUAGE,
            'title' => BOX_TOOLS_DEFINE_LANGUAGE,
            'link' => tep_href_link(FILENAME_DEFINE_LANGUAGE)
        ],
        [
            'code' => FILENAME_MAIL,
            'title' => BOX_TOOLS_MAIL,
            'link' => tep_href_link(FILENAME_MAIL)
        ],
        [
            'code' => FILENAME_NEWSLETTERS,
            'title' => BOX_TOOLS_NEWSLETTER_MANAGER,
            'link' => tep_href_link(FILENAME_NEWSLETTERS)
        ],
        [
            'code' => FILENAME_SEC_DIR_PERMISSIONS,
            'title' => BOX_TOOLS_SEC_DIR_PERMISSIONS,
            'link' => tep_href_link(FILENAME_SEC_DIR_PERMISSIONS)
        ],
        [
            'code' => FILENAME_SERVER_INFO,
            'title' => BOX_TOOLS_SERVER_INFO,
            'link' => tep_href_link(FILENAME_SERVER_INFO)
        ],
        [
            'code' => FILENAME_VERSION_CHECK,
            'title' => BOX_TOOLS_VERSION_CHECK,
            'link' => tep_href_link(FILENAME_VERSION_CHECK)
        ],
        /*         * * Altered for Database Check 1.4 ** */
        [
            'code' => FILENAME_DATABASE_CHECK,
            'title' => BOX_TOOLS_DATABASE_CHECK,
            'link' => tep_href_link(FILENAME_DATABASE_CHECK)
        ],
        /*         * * EOF alteration for Database Check 1.4 ** */
        /*         * * Altered for Mail Manager ** */
        [
            'code' => FILENAME_MM_MAIL_MANAGER,
            'title' => BOX_TOOLS_MAIL_MANAGER,
            'link' => tep_href_link(FILENAME_MM_MAIL_MANAGER)
        ],
        /*         * * EOF alterations for Mail Manager ** */
        [
            'code' => FILENAME_WHOS_ONLINE,
            'title' => BOX_TOOLS_WHOS_ONLINE,
            'link' => tep_href_link(FILENAME_WHOS_ONLINE)
        ],
        [
            'code' => FILENAME_FLEXIBEE_SYNC,
            'title' => BOX_TOOLS_FLEXIBEE_SYNC,
            'link' => tep_href_link(FILENAME_FLEXIBEE_SYNC)
        ]
    ]
];


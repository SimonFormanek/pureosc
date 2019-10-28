<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

foreach ($cl_box_groups as &$group) {
    if ($group['heading'] == __('BOX_HEADING_TOOLS', _('Tools'))) {
        $group['apps'][] = array('code' => 'database_tables.php',
            'title' => __('MODULES_ADMIN_MENU_TOOLS_DATABASE_TABLES', _('Database Tables')),
            'link' => tep_href_link('database_tables.php'));

        break;
    }
}

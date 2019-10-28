<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

foreach ($cl_box_groups as &$group) {
    if ($group['heading'] == __('BOX_HEADING_MODULES',_('Modules'))) {
        $group['apps'][] = array('code' => 'modules_content.php',
            'title' => __('MODULES_ADMIN_MENU_MODULES_CONTENT',_('Content')),
            'link' => tep_href_link('modules_content.php'));

        break;
    }
}


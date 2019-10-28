<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
 */

foreach ($cl_box_groups as &$group) {
    if ($group['heading'] == __('BOX_HEADING_TOOLS',_('Tools'))) {
        $group['apps'][] = array('code' => 'security_checks.php',
            'title' => __('MODULES_ADMIN_MENU_TOOLS_SECURITY_CHECKS',_('Security Checks')),
            'link' => tep_href_link('security_checks.php'));

        break;
    }
}

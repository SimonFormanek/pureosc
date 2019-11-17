<?php

namespace PureOSC\Admin;

use Ease\Html\SpanTag;

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

if ($messageStack->size > 0) {
    echo $messageStack->output();
}


$pageTop = new \Ease\TWB\Navbar('topmenu', new \Ease\Html\ImgTag(DIR_WS_IMAGES . 'store_logo.png', _('Store logo'), ['height' => 20]), ['class' => 'navbar-inverse']);

$pageTop->addMenuItem(new \Ease\TWB\LinkButton(tep_href_link(cfg('FILENAME_DEFAULT')), __('HEADER_TITLE_ADMINISTRATION', _('Administration')), 'inverse'));

$pageTop->addMenuItem(new \Ease\TWB\LinkButton(tep_catalog_href_link(), __('HEADER_TITLE_ONLINE_CATALOG', _('Catalog')), 'inverse'));

$pageTop->addMenuItem(new \Ease\TWB\LinkButton(tep_href_link(cfg('FILENAME_STATIC_GENERATOR_RESET')), _('Static generator reset'), 'inverse'));

if (tep_session_is_registered('admin')) {

    if (defined('USE_FLEXIBEE') && cfg('USE_FLEXIBEE') == 'true') {
        $pageTop->addMenuItem(new \FlexiPeeHP\ui\TWB\StatusInfoBox(), 'right');
    }

    $pageTop->addDropDownMenu(sprintf(_('Logged in as: %s'), $_SESSION['admin']['username']), [cfg('FILENAME_LOGIN') . '?action=logoff' => _('Logoff')], 'right');
}


$pageTop->finalize();





echo $pageTop;

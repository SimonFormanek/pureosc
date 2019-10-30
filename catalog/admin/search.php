<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2019 PureHTML

  Released under the GNU General Public License
 */

namespace PureOSC\Admin;

use Ease\Html\ATag;
use Ease\Html\LiTag;
use Ease\TWB\Badge;
use Ease\TWB\Container;
use Ease\WebPage;
use PureOSC\Admin\ui\Searcher;

include_once './includes/init.php';

$search = WebPage::getRequestValue('navsearch');

$searcher = new Searcher($search);

$oPage->container->addItem(new \Ease\Html\H1Tag(sprintf(_('Serch for %s in'), $search) . ':'));

$oPage->container->addItem(new \Ease\Html\H2Tag(_('Products')));

foreach ($searcher->getFluentPDO()->from('products_description')->where('products_model', "$search")->fetchAll() as $result) {
    $oPage->container->addItem(new LiTag(new ATag('categories.php?pID=' . $result['products_id'], $result['products_model'])));
}

$oPage->container->addItem(new \Ease\Html\H2Tag(_('Categories')));
foreach ($searcher->getFluentPDO()->from('categories_description')->where('categories_name', "$search")->fetchAll() as $result) {
    $oPage->container->addItem(new LiTag(new ATag('categories.php?cID=' . $result['categories_id'], $result['categories_name'])));
}

$oPage->container->addItem(new \Ease\Html\H2Tag(_('Customers')));

foreach ($searcher->getFluentPDO()->from('address_book')->where('entray_company', "$search")->fetchAll() as $result) {
    $oPage->container->addItem(new LiTag(new ATag('address_book.php?pID=' . $result['addressbook_id'], $result['entry_lastname'] . ' ' . $result['entry_firstname'])));
}


$oPage->finalize();
echo $oPage->draw();

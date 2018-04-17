<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
 */

require('includes/application_top.php');


require(DIR_WS_INCLUDES.'template_top.php');

$invoice = new \FlexiPeeHP\FakturaVydana('ext:osc:' . $_GET['oID'], ['detail' => 'id']);
echo 'invoice saved to: '.$invoice->downloadInFormat('pdf', '/tmp/',
    'fakturaKB$$SUM_BEZ_QR')."\n";
echo 'post money order saved to: '.$invoice->downloadInFormat($format, '/tmp/', 'slozenkaA$$SUM')."\n";


require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');


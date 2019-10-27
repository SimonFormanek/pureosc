<?php

/*
  PureHTML, Open Source E-Commerce Solutions
  https://purehtml.cz/

  Copyright (c) 2019 PureHTML

 */

require_once('includes/application_top.php');

\PureOSC\CustomerLog::singleton()->logPaymentEvent($_POST, $customer_id , _('Payment Initiated') ,'ext:orders:'.$_GET['id']);



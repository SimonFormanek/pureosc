<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */

$oscTemplate->buildBlocks();

if (!$oscTemplate->hasBlocks('boxes_column_left')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
}

if (!$oscTemplate->hasBlocks('boxes_column_right')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
}
?>
<!DOCTYPE html>
<html <?php echo cfg('HTML_PARAMS'); ?>>
    <head>
        <meta charset="<?php echo cfg('CHARSET'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo tep_output_string_protected($oscTemplate->getTitle()); ?></title>
        <base href="<?php echo (($request_type == 'SSL') ? cfg('HTTPS_SERVER') : cfg('HTTP_SERVER')) . cfg('DIR_WS_CATALOG'); ?>">
        <?php
        if (cfg('DIR_FS_MASTER_ROOT_DIR') && file_exists(cfg('DIR_FS_MASTER_ROOT_DIR') . cfg('BOOTSTRAP_LESS_DIR'))) {
            $bootstrap_extension = 'css';
        } else {
            $bootstrap_extension = 'min.css';
        }
        ?>
        <link href="ext/bootstrap/css/bootstrap.<?php echo $bootstrap_extension; ?>" rel="stylesheet">
        <!-- font awesome -->
        <link rel="stylesheet" href="ext/font-awesome-4.4.0/css/font-awesome.min.css">

        <link href="custom.css" rel="stylesheet">
        <link href="user.css" rel="stylesheet">

        <!--[if lt IE 9]>
           <script src="ext/js/html5shiv.js"></script>
           <script src="ext/js/respond.min.js"></script>
           <script src="ext/js/excanvas.min.js"></script>
        <![endif]-->

        <script src="ext/jquery/jquery-1.11.1.min.js" ></script>

        <?php echo $oscTemplate->getBlocks('header_tags'); ?>
    </head>
    <body>

        <?php echo $oscTemplate->getContent('navigation'); ?>

        <div id="bodyWrapper" class="<?php echo cfg('BOOTSTRAP_CONTAINER'); ?>">
            <div class="row">

                <?php
                require(cfg('DIR_WS_INCLUDES') . 'header.php');
                ?>

                <div id="bodyContent" class="col-md-<?php echo $oscTemplate->getGridContentWidth(); ?> <?php
                     echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'col-md-push-' . $oscTemplate->getGridColumnWidth() : '');
                     ?>">

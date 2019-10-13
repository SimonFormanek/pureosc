<?php
use PureOSC\ui\Head;
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
 */
$oPage = new \PureOSC\ui\WebPage();

$oscTemplate->buildBlocks();

if (!$oscTemplate->hasBlocks('boxes_column_left')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
}

if (!$oscTemplate->hasBlocks('boxes_column_right')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
}
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
        <?php
    $oPage->head->addItem('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
    $oPage->head->addItem('<title>'.tep_output_string_protected($oscTemplate->getTitle()).'</title>');
    $oPage->includeCss('ext/font-awesome-4.4.0/css/font-awesome.min.css');

    $oPage->includeCss('custom.css');
    $oPage->includeCss('user.css');

    $oPage->head->addItem('
        <!--[if lt IE 9]>
           <script src="ext/js/html5shiv.js"></script>
           <script src="ext/js/respond.min.js"></script>
           <script src="ext/js/excanvas.min.js"></script>
        <![endif]-->
');

    if (PureOSC\ui\WebPage::singleton()->cascadeStyles) {
        $oPage->head->addItem(\Ease\Html\HeadTag::getStylesRendered(PureOSC\ui\WebPage::singleton()->cascadeStyles));
    }

    $oPage->head->addItem($oscTemplate->getBlocks('header_tags'));
    $oPage->finalize();
    echo $oPage->head;
    ?>
    <body>

    <?php
    $navigation = $oscTemplate->getContent('navigation');

    echo $navigation;
    ?>

        <div id="bodyWrapper" class="<?php echo BOOTSTRAP_CONTAINER; ?>">
            <div class="row">

                <?php require(DIR_WS_INCLUDES.'header.php'); ?>

                <div id="bodyContent" class="col-md-<?php echo $oscTemplate->getGridContentWidth(); ?> <?php
                     echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'col-md-push-'.$oscTemplate->getGridColumnWidth()
                             : '');
                     ?>">

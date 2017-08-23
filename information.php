<?php
/*
  $Id$
  Module: Information Pages Unlimited
          File date: 2007/02/17
          Based on the FAQ script of adgrafics
          Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands
          Modified by SLiCK_303@hotmail.com for OSC v2.3.1

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  // Added for information pages
  if (!isset($_GET['info_id']) || !tep_not_null($_GET['info_id']) || !is_numeric($_GET['info_id'])) {
    $title = 'Sorry. Page Not Found.';
    $breadcrumb->add($INFO_TITLE, tep_href_link(FILENAME_INFORMATION, 'info_id=' . $_GET['info_id'], 'NONSSL'));
  } else {
    $info_id = intval($_GET['info_id']);
    $information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE visible='1' AND information_id='" . $info_id . "' AND language_id='" . (int)$languages_id ."'");
    $information = tep_db_fetch_array($information_query);
    $title = stripslashes($information['information_title']);
    $page_description = stripslashes($information['information_description']);

    // Added as noticed by infopages module
    if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $page_description)) {
      $page_description = str_replace("\r\n", "<br>\r\n", $page_description);
    }
    $breadcrumb->add($title, tep_href_link(FILENAME_INFORMATION, 'info_id=' . $_GET['info_id'], 'NONSSL'));
  }

  require(DIR_WS_INCLUDES . 'template_top.php');
?>

<h1><?php echo $title; ?></h1>

<div class="contentContainer">
  <div class="contentText">
    <?php echo $page_description; ?>
  </div>

  <div class="buttonSet">
    <span class="buttonAction"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', tep_href_link(FILENAME_DEFAULT)); ?></span>
  </div>
</div>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
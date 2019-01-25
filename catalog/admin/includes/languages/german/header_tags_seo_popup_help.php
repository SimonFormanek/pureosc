<?php
/*
  $Id: header_tags_seo_popup_help.php,v 1.0 2009/03/13 
   
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com
  
  Released under the GNU General Public License
*/
require('includes/languages/' . $_GET['language'] . '/header_tags_seo.php');
$height = 10;
$errorArray = array(array('errID' => ERROR_HEADING_COUNT_MISMATCH, 'errText' => ERROR_EXPLAIN_COUNT_MISMATCH),
                    array('errID' => ERROR_HEADING_DATABASE, 'errText'  => ERROR_EXPLAIN_DATABASE),
                    array('errID' => ERROR_HEADING_DESCRIPTION_LENGTH, 'errText'  => ERROR_EXPLAIN_DESCRIPTION_LENGTH),
                    array('errID' => ERROR_HEADING_DEFAULT_ROOT_TEXT_PRESENT, 'errText'  => ERROR_EXPLAIN_DEFAULT_ROOT_TEXT_PRESENT),
                    array('errID' => ERROR_HEADING_DUPLICATE_TITLE, 'errText'  => ERROR_EXPLAIN_DUPLICATE_TITLE),
                    array('errID' => ERROR_HEADING_DUPLICATE_META_DESCRIPTION, 'errText'  => ERROR_EXPLAIN_DUPLICATE_META_DESCRIPTION),
                    array('errID' => ERROR_HEADING_EXTRA_FILE, 'errText'  => ERROR_EXPLAIN_EXTRA_FILE),
                    array('errID' => ERROR_HEADING_INVALID_FILENAME, 'errText'  => ERROR_EXPLAIN_INVALID_FILENAME),
                    array('errID' => ERROR_HEADING_LANGUAGE_MISMATCH, 'errText'  => ERROR_EXPLAIN_LANGUAGE_MISMATCH),
                    array('errID' => ERROR_HEADING_MISSING_CODE, 'errText'  => ERROR_EXPLAIN_MISSING_CODE),
                    array('errID' => ERROR_HEADING_MISSING_FILE, 'errText'  => ERROR_EXPLAIN_MISSING_FILE),
                    array('errID' => ERROR_HEADING_MISSING_PSEUDO, 'errText'  => ERROR_EXPLAIN_MISSING_PSEUDO),
                    array('errID' => ERROR_HEADING_MISSING_TAGS, 'errText'  => ERROR_EXPLAIN_MISSING_TAGS),
                    array('errID' => ERROR_HEADING_PERMISSIONS, 'errText'  => ERROR_EXPLAIN_PERMISSIONS),
                    array('errID' => ERROR_HEADING_SEARCH_ENGINE_OPTION, 'errText'  => ERROR_EXPLAIN_SEARCH_ENGINE_OPTION),
                    array('errID' => ERROR_HEADING_STS, 'errText'  => ERROR_EXPLAIN_STS),
                    array('errID' => ERROR_HEADING_TEMPLATE, 'errText'  => ERROR_EXPLAIN_TEMPLATE),
                    array('errID' => ERROR_HEADING_META_DATA_EXPLAIN, 'errText'  => ERROR_EXPLAIN_META_DATA),
                    array('errID' => ERROR_HEADING_TITLE_LENGTH, 'errText'  => ERROR_EXPLAIN_TITLE_LENGTH)
                    );
?>
<style type="text/css">
.popupText {color: #000; font-size: 12px; } 
</style>

<table border="0" cellpadding="0" cellspacing="0" class="popupText">
 <tr>
  <td style="color: sienna; font-size: 18px; font-weight: bold;"><?php echo HEADING_TITLE; ?></td>
 </tr> 
 <tr>
  <td height="<?php echo $height; ?>"></td>
 </tr>  
</table>

<table border="0" cellpadding="0" cellspacing="0" class="popupText">
<?php foreach($errorArray as $err) { ?>
 <tr>
  <td><?php echo $err['errID']; ?></td>
 </tr>
 <tr>
  <td><?php echo $err['errText']; ?></td>
 </tr> 
 <tr>
  <td height="<?php echo $height; ?>"></td>
 </tr> 
<?php } ?>
</table>
<A href="javascript: self.close ()"><?php echo TEXT_CLOSE_POPUP; ?></A> 
 
<?php
/*
  $Id: header_tags_seo_fill_tags_popup_help.php,v 1.0 2009/03/13 

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/
 require('includes/application_top.php');
 require('includes/languages/' . $language . '/header_tags_fill_tags_popup_help.php');
 $show = tep_db_prepare_input($_GET['show']);
?>
<table border="0" cellpadding="0" cellspacing="0" class="popupText">
 <tr>
  <td style="text-align:center; color:sienna; font-size:18px; font-weight:bold;"><?php echo HEADING_TITLE; ?></td>
 </tr> 
 <tr>
  <td height="10"></td>
 </tr>  

 <?php 
  foreach ($showArray as $key => $text) {
    $bold = (($key == $show) ? 'bold' : '');
    echo '<tr><td><div class="smallText" style="font-weight:' . $bold . '">';
    echo tep_black_line();
    echo $text;
    echo '</div></td></tr>';
  };
?>

</table>

<table border="0" cellpadding="0" cellspacing="0" class="popupText">
</table>
<A href="javascript: self.close ()"><?php echo TEXT_CLOSE_POPUP; ?></A> 

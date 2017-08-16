<?php
/*
  $Id: header_tags_seo_popup_help.php,v 1.0 2009/03/13 13:45:11 devosc Exp $
  produced by Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
 
  require("includes/application_top.php");
 
  if (isset($_POST['action']) && $_POST['action'] == 'add_logotext')
  {
    $logotext_1 = isset($_POST['extra_logo_1']) ? $_POST['extra_logo_1'] : '';
    $logotext_2 = isset($_POST['extra_logo_2']) ? $_POST['extra_logo_2'] : '';
    $logotext_3 = isset($_POST['extra_logo_3']) ? $_POST['extra_logo_3'] : '';
    $logotext_4 = isset($_POST['extra_logo_4']) ? $_POST['extra_logo_4'] : '';
    
    $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $_POST['pagename'] . "' and language_id = '" . (int)$_POST['languageid'] . "'");
    $pageTags = tep_db_fetch_array($pageTags_query);
    
    if (tep_db_num_rows($pageTags_query))
    {
       tep_db_query("update " . TABLE_HEADERTAGS . " set page_logo_1 = '" . $logotext_1 . "', page_logo_2 = '" . $logotext_2 . "', page_logo_3 = '" . $logotext_3 . "', page_logo_4 = '" . $logotext_4 . "' where page_name like '" . $_POST['pagename'] . "' and language_id = '" . (int)$_POST['languageid'] . "'"); 
    }
  }
  else
  {
    $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $_GET['pagename'] . "' and language_id = '" . (int)$_GET['languageid'] . "' LIMIT 1");
    $pageTags = tep_db_fetch_array($pageTags_query);
  }

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
 <table border="0" width="100%" cellspacing="3" cellpadding="3">
 <?php echo tep_draw_form('header_tags_logotext', 'header_tags_seo_popup_logotext.php', '', 'post') . tep_draw_hidden_field('action', 'add_logotext'); ?>
  <tr>
   <td class="pageHeading" align="center"><?php echo HEADING_POPUP_LOGOTEXT; ?></td>
  </tr>
  <tr>
   <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
  <tr>
   <td class="pageHeading" align="center"><?php echo TEXT_INFORMATION; ?></td>
  </tr>
  <tr>
   <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>  
  <tr>
   <td><table border="0" width="100%">
    <tr>
     <td class="main" width="200"><?php echo TEXT_LOGO_1; ?></td>
     <td><?php echo tep_draw_input_field('extra_logo_1', tep_not_null($pageTags['page_logo_1']) ? $pageTags['page_logo_1'] : '', 'maxlength="255" size="72"', false); ?></td>
    </tr>
    <tr>
     <td class="main"><?php echo TEXT_LOGO_2; ?></td>
     <td><?php echo tep_draw_input_field('extra_logo_2', tep_not_null($pageTags['page_logo_2']) ? $pageTags['page_logo_2'] : '', 'maxlength="255" size="72"', false); ?></td>
    </tr>
    <tr>
     <td class="main"><?php echo TEXT_LOGO_3; ?></td>
     <td><?php echo tep_draw_input_field('extra_logo_3', tep_not_null($pageTags['page_logo_3']) ? $pageTags['page_logo_3'] : '', 'maxlength="255" size="72"', false); ?></td>
    </tr>
    <tr>
     <td class="main"><?php echo TEXT_LOGO_4; ?></td>
     <td><?php echo tep_draw_input_field('extra_logo_4', tep_not_null($pageTags['page_logo_4']) ? $pageTags['page_logo_4'] : '', 'maxlength="255" size="72"', false); ?></td>
    </tr>
   </table></td> 
  <tr>
   <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
  <tr>
   <td align="center"><table border="0" width="50%">
    <tr>
     <?php echo  tep_draw_hidden_field('pagename',   $_GET['pagename']) . tep_draw_hidden_field('languageid', $_GET['languageid']); ?> 
     <td class="smallText" align="center"><INPUT type="image" src="<?php echo DIR_WS_LANGUAGES . $language . '/images/buttons/button_update.gif'; ?>" NAME="extra_logotext"></td>
     <td class="smallText" align="center"><input type="button" value="Close Window" onClick="window.close()"></td>
    </tr>
   </table></td>  
  </tr>  
 </form> 
 
 </table>
</body>
</html>

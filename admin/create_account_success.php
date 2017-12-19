<?php
/*
  $Id: create_account_success.php,v 1 2003/08/24 23:21:26 frankl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  Admin Create Accont
  (Step-By-Step Manual Order Entry Verion 1.0)
  (Customer Entry through Admin)
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

  require(DIR_WS_INCLUDES . 'template_top.php');
?>

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" class="main"><div align="center" class="pageHeading"><?php echo HEADING_TITLE_CREATE_ACCOUNT_SUCCESS; ?></div><br /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link(FILENAME_CUSTOMERS, tep_get_all_get_params(array('action'))), 'primary'); ?></td>
      </tr>
    </table></td>
  </tr>
</table>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
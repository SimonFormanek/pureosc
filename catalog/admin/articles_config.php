<?php
/*
  $Id: articles_config.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

// Set configuration ID
require('includes/application_top.php');

$cfg_group_query = tep_db_query("select configuration_group_id as id from ".TABLE_CONFIGURATION_GROUP." where configuration_group_title = 'Article Manager' limit 1");
$cfg_group       = tep_db_fetch_array($cfg_group_query);
$gID             = $cfg_group['id'];


if (isset($_GET['action']) && $_GET['action']) {
    switch ($_GET['action']) {
        case 'save':
            $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
            $cID                 = tep_db_prepare_input($_GET['cID']);

            tep_db_query("update ".TABLE_CONFIGURATION." set configuration_value = '".tep_db_input($configuration_value)."', last_modified = now() where configuration_id = '".tep_db_input($cID)."'");
            tep_redirect(tep_href_link(FILENAME_CONFIGURATION,
                    'gID='.$gID.'&cID='.$cID));
            break;
    }
}

$cfg_group_query     = tep_db_query("select configuration_group_title from ".TABLE_CONFIGURATION_GROUP." where configuration_group_id = '".$gID."'");
$cfg_group           = tep_db_fetch_array($cfg_group_query);
require(DIR_WS_INCLUDES.'template_top.php');
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                                <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif',
    HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
?></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                                        <tr class="dataTableHeadingRow">
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                                            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                                            <td class="dataTableHeadingContent" align="right"><?php echo _('Action'); ?>&nbsp;</td>
                                        </tr>
                                        <?php
                                        $configuration_query = tep_db_query("select configuration_id, configuration_title, configuration_value, use_function from ".TABLE_CONFIGURATION." where configuration_group_id = '".$gID."' order by sort_order");
                                        while ($configuration       = tep_db_fetch_array($configuration_query)) {
                                            if (tep_not_null($configuration['use_function'])) {
                                                $use_function = $configuration['use_function'];
                                                if (preg_match('/->/',
                                                        $use_function)) {
                                                    $class_method = explode('->',
                                                        $use_function);
                                                    if (!is_object(${$class_method[0]})) {
                                                        ${$class_method[0]} = new $class_method[0]();
                                                    }
                                                    $cfgValue = tep_call_function($class_method[1],
                                                        $configuration['configuration_value'],
                                                        ${$class_method[0]});
                                                } else {
                                                    $cfgValue = tep_call_function($use_function,
                                                        $configuration['configuration_value']);
                                                }
                                            } else {
                                                $cfgValue = $configuration['configuration_value'];
                                            }

                                            $cInfo = '';
                                            if (isset($_GET['cID']) && (((!$_GET['cID'])
                                                || (@$_GET['cID'] == $configuration['configuration_id']))
                                                && (!$cInfo) && (substr($_GET['action'],
                                                    0, 3) != 'new'))) {
                                                $cfg_extra_query = tep_db_query("select configuration_key, configuration_description, date_added, last_modified, use_function, set_function from ".TABLE_CONFIGURATION." where configuration_id = '".$configuration['configuration_id']."'");
                                                $cfg_extra       = tep_db_fetch_array($cfg_extra_query);

                                                $cInfo_array = array_merge($configuration,
                                                    $cfg_extra);
                                                $cInfo       = new objectInfo($cInfo_array);
                                            }

                                            if ((is_object($cInfo)) && ($configuration['configuration_id']
                                                == $cInfo->configuration_id)) {
                                                echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\''.tep_href_link(FILENAME_CONFIGURATION,
                                                    'gID='.$gID.'&cID='.$cInfo->configuration_id.'&action=edit').'\'">'."\n";
                                            } else {
                                                echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\''.tep_href_link(FILENAME_CONFIGURATION,
                                                    'gID='.$gID.'&cID='.$configuration['configuration_id']).'\'">'."\n";
                                            }
                                            ?>
                                            <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                                            <td class="dataTableContent"><?php echo htmlspecialchars($cfgValue); ?></td>
                                            <td class="dataTableContent" align="right"><?php
                                                if ((is_object($cInfo)) && ($configuration['configuration_id']
                                                    == $cInfo->configuration_id)) {
                                                    echo tep_image(DIR_WS_IMAGES.'icon_arrow_right.gif',
                                                        '');
                                                } else {
                                                    echo '<a href="'.tep_href_link(FILENAME_CONFIGURATION,
                                                        'gID='.$gID.'&cID='.$configuration['configuration_id']).'">'.tep_image(DIR_WS_IMAGES.'icon_info.gif',
                                                        IMAGE_ICON_INFO).'</a>';
                                                }
                                                ?>&nbsp;</td>
                                </tr>
                        <?php
                    }
                    ?>
                        </table></td>
                    <?php
                    $heading  = array();
                    $contents = array();
                    if (isset($_GET['action'])) {
                        switch ($_GET['action']) {
                            case 'edit':
                                $heading[] = array('text' => '<b>'.$cInfo->configuration_title.'</b>');

                                if ($cInfo->set_function) {
                                    eval('$value_field = '.$cInfo->set_function.'"'.htmlspecialchars($cInfo->configuration_value).'");');
                                } else {
                                    $value_field = tep_draw_input_field('configuration_value',
                                        $cInfo->configuration_value);
                                }

                                $contents   = array('form' => tep_draw_form('configuration',
                                        FILENAME_CONFIGURATION,
                                        'gID='.$gID.'&cID='.$cInfo->configuration_id.'&action=save'));
                                $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
                                $contents[] = array('text' => '<br><b>'.$cInfo->configuration_title.'</b><br>'.$cInfo->configuration_description.'<br>'.$value_field);
                                $contents[] = array('align' => 'center', 'text' => '<br>'.tep_image_submit('button_update.gif',
                                        IMAGE_UPDATE).'&nbsp;<a href="'.tep_href_link(FILENAME_CONFIGURATION,
                                        'gID='.$gID.'&cID='.$cInfo->configuration_id).'">'.tep_image_button('button_cancel.gif',
                                        IMAGE_CANCEL).'</a>');
                                break;
                            default:
                                if (is_object($cInfo)) {
                                    $heading[] = array('text' => '<b>'.$cInfo->configuration_title.'</b>');

                                    $contents[] = array('align' => 'center', 'text' => '<a href="'.tep_href_link(FILENAME_CONFIGURATION,
                                            'gID='.$gID.'&cID='.$cInfo->configuration_id.'&action=edit').'">'.tep_image_button('button_edit.gif',
                                            IMAGE_EDIT).'</a>');
                                    $contents[] = array('text' => '<br>'.$cInfo->configuration_description);
                                    $contents[] = array('text' => '<br>'.TEXT_INFO_DATE_ADDED.' '.tep_date_short($cInfo->date_added));
                                    if (tep_not_null($cInfo->last_modified))
                                            $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED.' '.tep_date_short($cInfo->last_modified));
                                }
                                break;
                        }

                        if ((tep_not_null($heading)) && (tep_not_null($contents))) {
                            echo '            <td width="25%" valign="top">'."\n";

                            $box = new box;
                            echo $box->infoBox($heading, $contents);

                            echo '            </td>'."\n";
                        }
                    }
                    ?>
                </tr>
            </table></td>
    </tr>
</table></td>
</tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>

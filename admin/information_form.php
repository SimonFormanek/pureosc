<?php
/*
  Module: Information Pages Unlimited
  File date: 2007/02/17
  Based on the FAQ script of adgrafics
  Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands
  Modified by SLiCK_303@hotmail.com for OSC v2.3.1

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
 */
?>
<tr>
    <td class="pageHeading"><?php echo $title; ?></td>
</tr>
<tr>
    <td><table border="0" cellpadding="0" cellspacing="2" width="100%">
            <?php
            if (!strstr($info_group['locked'], 'visible')) {
                ?>
                <tr>
                    <td class="main"><?php echo ENTRY_STATUS; ?></td>
                    <td class="main"><?php
                        echo tep_draw_radio_field('visible', '1', true,
                            $edit['visible']).'&nbsp;&nbsp;'.STATUS_ACTIVE.'&nbsp;&nbsp;'.tep_draw_radio_field('visible',
                            '0', false, $edit['visible']).'&nbsp;&nbsp;'.STATUS_INACTIVE;
                        ?></td>
                </tr>
                <tr>
                    <td colspan="2" height="10">&nbsp;</td>
                </tr>
                <?php
            }

            if (!strstr($info_group['locked'], 'parent_id')) {
                ?>
                <tr>
                    <td class="main"><?php echo ENTRY_PARENT_PAGE; ?></td>
                    <td class="main">
                        <?php
                        if ((sizeof($data) > 0)) {
                            $options = '<option value="0">-</option>';
                            reset($data);
                            while (list($key, $val) = each($data)) {
                                $selected = ($val['information_id'] == $edit['parent_id'])
                                        ? 'selected="selected"' : '';
                                $options  .= '<option value="'.$val['information_id'].'" '.$selected.'>'.$val['information_title'].'</option>';
                            }
                            echo '<select name="parent_id">'.$options.'</select>';
                        } else {
                            echo '<span class="messageStackError">'.WARNING_PARENT_PAGE.'</span>';
                        }
                        ?></td>
                </tr>
                <tr>
                    <td colspan="2" height="10">&nbsp;</td>
                </tr>
                <?php
            }

            if (!strstr($info_group['locked'], 'sort_order')) {
                ?>
                <tr>
                    <td class="main"><?php echo ENTRY_SORT_ORDER; ?></td>
                    <td><?php
                        if ($edit['sort_order']) {
                            $no = $edit['sort_order'];
                        }
                        echo tep_draw_input_field('sort_order', "$no",
                            'size=3 maxlength=4');
                        ?></td>
                </tr>
                <tr>
                    <td colspan="2" height="10">&nbsp;</td>
                </tr>
                <?php
            }

            if (!strstr($info_group['locked'], 'information_title')) {
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    ?>
                    <tr>
                        <td class="main"><?php if ($i == 0) echo ENTRY_TITLE; ?><br /></td>
                        <td><?php
                            echo tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('information_title['.$languages[$i]['id'].']',
                                (($languages[$i]['id'] == $languages_id) ? stripslashes($edit[information_title])
                                        : tep_get_information_entry($information_id,
                                        $languages[$i]['id'],
                                        'information_title')), 'maxlength=255');
                            ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" height="10">&nbsp;</td>
                    </tr>
                    <?php
                }
            }

            if (!strstr($info_group['locked'], 'information_description')) {
                for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
                    ?>
                    <tr>
                        <td valign="top" class="main" width="100" colspan="2"><?php if ($i
                        == 0) echo ENTRY_DESCRIPTION;
                    ?><br />
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                    $languages[$i]['name']);
                    ?>&nbsp;</td>
                                    <td class="main" width="100%"><?php
                                        //PURE:new use editor?
                                        $format_query = tep_db_query("SELECT format FROM ".TABLE_INFORMATION_GROUP." WHERE information_group_id = ".$_GET['gID']);
                                        $format       = tep_db_fetch_array($format_query);
//                if (($_GET['gID'] == 2 && $_GET['information_id'] < 9) || ($_GET['gID'] == 1)) {
                                        if ($format['format'] == 'html') {
                                            echo tep_draw_textarea_field_ckeditor('information_description['.$languages[$i]['id'].']',
                                                '', '100', '20',
                                                (($languages[$i]['id'] == $languages_id)
                                                        ? stripslashes($edit[information_description])
                                                        : tep_get_information_entry($information_id,
                                                        $languages[$i]['id'],
                                                        'information_description')));
                                        } else {
                                            echo tep_draw_textarea_field('information_description['.$languages[$i]['id'].']',
                                                '', '100', '20',
                                                (($languages[$i]['id'] == $languages_id)
                                                        ? stripslashes($edit[information_description])
                                                        : tep_get_information_entry($information_id,
                                                        $languages[$i]['id'],
                                                        'information_description')));
                                        }
                                        ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                            <?php
                        }
                    }
                    ?>
            <tr>
                <td colspan="2" align="left"><br /><?php
// Decide when to show the buttons (Determine or 'locked' is active)
                    if ((empty($info_group['locked'])) || ($_GET['information_action']
                        == 'Edit')) {
                        echo tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary');
                    } else {
                        echo tep_draw_button(IMAGE_INSERT, 'plus', null,
                            'primary');
                    }
                    echo tep_draw_button(IMAGE_CANCEL, 'close',
                        tep_href_link(FILENAME_INFORMATION_MANAGER, 'gID='.$gID));
                    ?></td>
            </tr>
        </table></td>
</tr>
</form>
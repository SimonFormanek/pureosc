<?php
/*
  $Id: header_tags_seo_silo.php,v 1.2 2009/10/10
  header_tags_seo_silo Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once('includes/functions/header_tags.php');

$filename  = DIR_FS_CATALOG.DIR_WS_INCLUDES.'header_tags.php';
$languages = tep_get_languages();

/* * ******************** RUN OPTIONS ******************** */
$categories            = array();
$categories            = array_merge($categories, tep_get_category_tree());
$categories[0]['text'] = SELECT_ALL_CATEGORIES; //replace the 'top' used by standard code

$catID = isset($_POST['category']) ? $_POST['category'] : 0;

/* * ******************** CHECK THE INPUT ********************* */
if (isset($_POST['update_silo_x'])) {
    for ($i = 0; $i < count($languages); ++$i) {
        $disable  = ($_POST['disable_'.$languages[$i]['id']] == 'on' ? 1 : 0);
        $heading  = $_POST['silo_box_heading_'.$languages[$i]['id']];
        $maxLinks = $_POST['silo_max_links_'.$languages[$i]['id']];
        $sortOn   = $_POST['sort_group_'.$languages[$i]['id']];

        if ($maxLinks == 0 && $disable == 0) {
            $messageStack->add(sprintf(ERROR_INCORRECT_MAX_LINKS,
                    $languages[$i]['name']));
            break;
        } else {
            $catCheck = tep_db_query("select count(*) as ttl from ".TABLE_HEADERTAGS_SILO." where category_id = ".(int) $catID." and language_id = ".(int) $languages[$i]['id']." limit 1");
            $cat      = tep_db_fetch_array($catCheck);
            if ($cat['ttl'] > 0)
                    tep_db_query("update ".TABLE_HEADERTAGS_SILO." set box_heading = '".tep_db_input($heading)."', is_disabled = '".(int) $disable."', max_links = '".(int) $maxLinks."', sorton = '".(int) $sortOn."' where category_id = '".$catID."' and language_id = '".(int) $languages[$i]['id']."'");
            else
                    tep_db_query("insert into ".TABLE_HEADERTAGS_SILO." (category_id, box_heading, is_disabled, max_links, sorton, language_id) values ('".(int) $catID."', '".tep_db_input($heading)."', '".(int) $disable."', '".(int) $maxLinks."', '".(int) $sortOn."', '".(int) $languages[$i]['id']."')");
        }
    }
}

/* * ******************** LOAD THE STORED DATA ********************* */
$silo_query = tep_db_query("select * from ".TABLE_HEADERTAGS_SILO." where category_id = ".(int) $catID);
$siloArray  = array();
while ($silo       = tep_db_fetch_array($silo_query)) {
    $siloArray[$silo['language_id']] = $silo; //remap to the language ID
}


$categoryFiles = array();
$cq            = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, cd.categories_htc_title_tag, cd.categories_htc_desc_tag, cd.categories_htc_keywords_tag, cd.categories_htc_description from ".TABLE_CATEGORIES." c, ".TABLE_CATEGORIES_DESCRIPTION." cd where c.parent_id = '".(int) $_POST['category']."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' order by c.sort_order, cd.categories_name");
while ($c             = tep_db_fetch_array($cq)) {
    $categoryFiles[] = array('id' => $c['categories_id'], 'text' => $c['categories_name']);
}

require(DIR_WS_INCLUDES.'template_top.php');
?>
<style type="text/css">
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
    td.HTC_subHead {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px; } 
    .HTC_title {background: #fof1f1; text-align: center;} 
</style>
<script language="javascript">
    function EnableGenericCheckBoxes(custom) //enable all of the checkboxes
    {
        if (custom != 1)
            document.getElementById("add_generic_cat_filterlist").disabled = 'disabled';
        else if (document.getElementById("add_generic_cat_filterlist").disabled === true)
            document.getElementById("add_generic_cat_filterlist").disabled = '';
        else
            document.getElementById("add_generic_cat_filterlist").disabled = 'disabled';
    }
</script>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td width="<?php echo cfg('BOX_WIDTH'); ?>" valign="top"><table border="0" width="<?php echo cfg('BOX_WIDTH'); ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td><table border="0" width="100%">
                                    <tr>
                                        <td class="HTC_Head"><?php echo HEADING_TITLE_SILO; ?></td>
                                    </tr>
                                </table></td>  
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif',
    '100%', '10');
?></td>
                        </tr>
                        <tr>
                            <td class="HTC_subHead"><?php echo TEXT_PAGE_HEADING; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo tep_draw_separator('pixel_trans.gif',
                                    '100%', '10');
?></td>
                        </tr>
                        <tr>
                            <td><?php echo tep_black_line(); ?></td>
                        </tr>     

                        <!-- Begin of Header Tags -->   
                        <tr>
                            <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">     

                                    <!-- BEGIN SILO GLOBAL SECTION -->
                                    <tr>
                                        <td align="right" width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #fff; border: ridge #CCFFCC 3px; padding-left: 2px;">
                                                <tr style="background-color: #cccccc;">
                                                    <th class="main"><?php echo HEADING_TITLE_SECTION_MAIN; ?></th>
                                                </tr>
                                                <tr><td height="8"></td></tr>	

                                                <tr>
                                                    <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <?php
                                                            echo tep_draw_form('header_tags_silo',
                                                                FILENAME_HEADER_TAGS_SILO,
                                                                '', 'post').tep_draw_hidden_field('action',
                                                                'process');
                                                            ?>

                                                            <tr>
                                                                <td valign="top"><table border="0">
                                                                        <tr>           
                                                                            <td valign="top"><?php echo TEXT_FILTER_LIST_CATEGORY; ?></td>
                                                                            <td class="smallText"><?php echo tep_draw_pull_down_menu('category',
                                                                $categories, '',
                                                                'onChange="this.form.submit();"');
                                                            ?></td>
                                                                        </tr>       
                                                                    </table></td>    
                                                            </tr>

<?php for ($i = 0; $i
    < count($languages); ++$i) {
    ?>        
                                                                <tr>
                                                                    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="line-height: 20px; background-color: #fff; border: ridge #CCFFCC 3px; padding-left: 2px;">
                                                                            <tr bgcolor="#f0f1f1">
                                                                                <th class="main" colspan="2" align="left"><?php echo $languages[$i]['name']; ?></th>
                                                                            </tr>  
                                                                            <tr>
                                                                                <td colspan="2"><?php echo tep_black_line(); ?></td>
                                                                            </tr>
                                                                            <tr><td height="5"></td></tr>	

                                                                            <tr>
                                                                                <td valign="top"><table border="0" cellpadding="0">           
                                                                                        <tr>
                                                                                            <td class="main" width="140" valign="top"><?php echo ENTRY_SILO_BOX_TITLE; ?></td>
                                                                                            <td><?php
                                                                                                echo tep_draw_input_field('silo_box_heading_'.$languages[$i]['id'],
                                                                                                    $siloArray[$languages[$i]['id']]['box_heading'],
                                                                                                    'maxlength="60" size=20"',
                                                                                                    false,
                                                                                                    '',
                                                                                                    false);
                                                                                                ?> </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="main" width="140" valign="top"><?php echo ENTRY_SILO_NUMBER_LINKS; ?></td>
                                                                                            <td><?php
                                                                                                                                           echo tep_draw_input_field('silo_max_links_'.$languages[$i]['id'],
                                                                                                                                               $siloArray[$languages[$i]['id']]['max_links'],
                                                                                                                                               'maxlength="60" size=20"',
                                                                                                                                               false,
                                                                                                                                               '',
                                                                                                                                               false);
                                                                                                                                           ?> </td>
                                                                                        </tr>            
                                                                                        <tr>
                                                                                            <td class="main" valign="top"><?php echo ENTRY_SILO_SORT_BY; ?></td>
                                                                                            <td><table width="280" border="0" cellspacing="0" cellpadding="0">
                                                                                                    <tr>
                                                                                                        <td class="main" align=left><INPUT TYPE="radio" NAME="<?php echo 'sort_group_'.$languages[$i]['id']; ?>" VALUE="0" <?php
                                                                                                        echo ($siloArray[$languages[$i]['id']]['sorton']
                                                                                                        == 0
                                                                                                                ? 'checked'
                                                                                                                : '');
                                                                                                        ?> onClick="return EnableGenericCheckBoxes(0);" ><?php echo ENTRY_SILO_SORT_DATE; ?></td>
                                                                                                        <td class="main" align=left><INPUT TYPE="radio" NAME="<?php echo 'sort_group_'.$languages[$i]['id']; ?>" VALUE="1" <?php
                                                                                    echo ($siloArray[$languages[$i]['id']]['sorton']
                                                                                    == 1
                                                                                            ? 'checked'
                                                                                            : '');
                                                                                    ?> onClick="return EnableGenericCheckBoxes(0);" ><?php echo ENTRY_SILO_SORT_NAME; ?></td>
                                                                                                        <td class="main" align=left><INPUT TYPE="radio" NAME="<?php echo 'sort_group_'.$languages[$i]['id']; ?>" VALUE="2" <?php
                                                                                    echo ($siloArray[$languages[$i]['id']]['sorton']
                                                                                    == 2
                                                                                            ? 'checked'
                                                                                            : '');
                                                                                    ?> onClick="return EnableGenericCheckBoxes(0);" ><?php echo ENTRY_SILO_SORT_BEST; ?></td>
                                                                                                        <td class="main" align=left><INPUT TYPE="radio" NAME="<?php echo 'sort_group_'.$languages[$i]['id']; ?>" VALUE="3" <?php echo ($siloArray[$languages[$i]['id']]['sorton']
                                                                    == 2 ? 'checked'
                                                                            : '');
                                                                    ?> onClick="return EnableGenericCheckBoxes(1);" ><?php echo ENTRY_SILO_SORT_CUSTOM; ?></td>
                                                                                                    </tr>
                                                                                                </table></td>  
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td class="main" valign="top"><?php echo ENTRY_SILO_DISABLE; ?></td>
                                                                                            <td><input type="checkbox" name="<?php echo 'disable_'.$languages[$i]['id']; ?>" <?php echo ($siloArray[$languages[$i]['id']]['is_disabled']
                                                                    == 1 ? 'checked'
                                                                            : '');
                                                                    ?> ></td>
                                                                                        </tr>
                                                                                    </table></td>              
                                                                                <td class="smallText" valign="top"><?php
                                                                    echo SMMultiSelectMenu('catfiles[]',
                                                                        $categoryFiles,
                                                                        $selectedCats,
                                                                        ' disabled style="width: 255;" size=12 id="add_generic_cat_filterlist"');
                                                                    ?></td>
                                                                            </tr>            
                                                                        </table></td>
                                                                </tr>        
                                                                <tr><td height="10"></td></tr>	 
                                                            <?php } ?>

                                                            <tr> 
                                                                <td align="center"><?php echo (tep_image_submit('button_update.gif',
                                                                IMAGE_UPDATE,
                                                                'name="update_silo"') );
                                                            ?></td>
                                                            </tr> 

                                                            </form> 
                                                        </table></td>
                                                </tr>   
                                            </table></td>
                                    </tr>   
                                    <!-- END SILO GLOBAL SECTION -->

                                    <tr><td height="20"></td></tr>	 

                                    <!-- BEGIN SILO LINK SECTION -->
                                    <tr>
                                        <td align="right" width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #fff; border: ridge #CCFFCC 3px; padding-left: 2px;">
                                                <tr style="background-color: #cccccc;">
                                                    <th class="main"><?php echo HEADING_TITLE_SECTION_LINKS; ?></th>
                                                </tr>
                                                <tr><td height="8"></td></tr>	       
                                                <tr> 
                                                    <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                                            <?php
                                                                                            echo tep_draw_form('header_tags_silo_links',
                                                                                                FILENAME_HEADER_TAGS_SILO,
                                                                                                '',
                                                                                                'post').tep_draw_hidden_field('action',
                                                                                                'process_links');
                                                                                            ?>

<?php for ($i = 0; $i < count($languages); ++$i) { ?>        
                                                                <tr>
                                                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="line-height: 20px; background-color: #fff; border: ridge #CCFFCC 3px; padding-left: 2px;">
                                                                            <tr bgcolor="#f0f1f1">
                                                                                <th class="main" colspan="4" align="left"><?php echo $languages[$i]['name']; ?></th>
                                                                            </tr>  
                                                                            <tr>
                                                                                <td class="main" width="30%"><?php echo TABLE_HEADING_CAT_NAME; ?>
                                                                                <td class="main" width="30%"><?php echo TABLE_HEADING_BOX_TITLE; ?>
                                                                                <td class="main" width="15%"><?php echo TABLE_HEADING_MAX_LINKS; ?>
                                                                                <td class="main" ><?php echo TABLE_HEADING_SORT_ORDER; ?>              
                                                                            </tr>                
                                                                            <tr>
                                                                                <td colspan="4"><?php echo tep_black_line(); ?></td>
                                                                            </tr>
                                                                            <tr><td height="8"></td></tr>	

                                                                            <tr>
                                                                                <td valign="top" colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">        
    <?php
    $silo_query = tep_db_query("select * from ".TABLE_HEADERTAGS_SILO." where is_disabled = 0 and language_id = ".(int) $languages[$i]['id']);
    while ($silo       = tep_db_fetch_array($silo_query)) {
        ?>
                                                                                            <tr>
                                                                                                <td class="main" width="30%"><?php echo tep_get_category_name($silo['category_id'],
            $languages[$i]['id']);
        ?></td>
                                                                                                <td class="main" width="30%"><?php echo $silo['box_heading']; ?></td>
                                                                                                <td class="main" width="15%"><?php echo $silo['max_links']; ?></td>
                                                                                                <td class="main"><?php echo $silo['sorton']; ?></td>
                                                                                            </tr>
    <?php } ?>
                                                                                    </table</td>              
                                                                            </tr>            
                                                                        </table></td>
                                                                </tr>        
                                                                <tr><td height="10"></td></tr>	 
<?php } ?>

                                                            <tr> 
                                                                <td align="center"><?php echo (tep_image_submit('button_update.gif',
    IMAGE_UPDATE, 'name="update_silo_links"') );
?></td>
                                                            </tr> 

                                                            </form> 
                                                        </table></td>
                                                </tr> 
                                            </table></td>
                                    </tr>  
                                    <!-- END SILO LINK SECTION -->

                                </table></td> 
                        </tr>
                        <!-- end of Header Tags -->

                    </table></td>
    </tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>

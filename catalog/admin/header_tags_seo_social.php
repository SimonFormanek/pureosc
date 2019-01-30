<?php
/*
  $Id: header_tags_seo_social.php,v 1.2 2008/08/08
  header_tags_seo Originally Created by: Jack_mcs - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
 */

require('includes/application_top.php');
require_once(DIR_WS_FUNCTIONS.'header_tags.php');

$checked               = array();
$checked[TEXT_SIZE_16] = TEXT_SIZE_16;

$db_query = tep_db_query("select configuration_value from ".TABLE_CONFIGURATION." where configuration_key ='HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS'");
$db       = tep_db_fetch_array($db_query);


$iconsArray = GetSocialIconsArray();

require(DIR_WS_INCLUDES.'template_top.php');
?>
<style type="text/css">
    table.BorderedBox {border: ridge #ddd 3px; background-color: #eee; }
    table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #fff; }
    td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
    td.HTC_subHead {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px; } 
    .HTC_title {background: #fof1f1; text-align: center;} 
    .container { width:980px; float:left; }
    .logo-box { float:left; }
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        LoadImages(); //initial load  


        $('#disable_social').click(function () {
            if ($(this).is(":checked")) {
                ChangeDisableStatus('false');
            } else {
                ChangeDisableStatus('true');
            }
        });
    });

    function ChangeDisableStatus(status) {
        var dataArray = {};
        dataArray[0] = 'configchange';
        dataArray[1] = status;

        $.ajax({
            type: 'POST',
            data: dataArray,
            async: false,
            url: "<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
            success: function (data) {
                $("#form_result").html(data);
            }
        });
    }

    function ChangeIconSize() {
        var size;
        $(":radio").each(function () {
            size = $("input[name='size_group']:checked").val();
            var dataArray = {};
            dataArray[0] = 'sizechange';
            dataArray[1] = size;

            $.ajax({
                type: 'POST',
                data: dataArray,
                async: false,
                url: "<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
                dataType: 'json',
                success: function (data) {
                    $('#' + size).attr('checked', true);
                    $("#showicons").html(data.div);
                }
            });
            return false;
        });

        return true;
    }

    function ChangeStatus(size, icon) {
        var id = size + '_' + icon;

        if (document.getElementById(id).style.display == 'none') {
            document.getElementById(id).style.display = 'block';
        } else {
            document.getElementById(id).style.display = 'none';
        }

        $("#form_result").html("");

        return false;
    }

    function ClearStatus() {
        $("#form_result").html("");
        return true;
    }

    function LoadImages() {
        var dataArray = {};
        dataArray[0] = 'sizechange';
        dataArray[1] = 'saved';

        $.ajax({
            type: 'POST',
            data: dataArray,
            async: false,
            url: "<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
            dataType: 'json',
            success: function (data) {
                $('#' + data.group).attr('checked', true);
                $("#showicons").html(data.div);
            }
        });
        return true;
    }

    function SaveSocialIcons() {
        $("form").submit(function (e) {
            e.preventDefault(); //stop the form reload
            var dataArray = {};
            var ids = 3;
            dataArray[0] = 'submit';
            var group = ($("input[type='radio']:checked").val());
            dataArray[1] = group;
            var disablebox = ($("input[type='checkbox']:checked").val());
            dataArray[2] = (disablebox === false ? 0 : 1);

            /**** GET THE IMAGES ****/
            var images = [];
            var x = 0;
            $.each($("input[type=image]"), function () {
                var showing = $(this).css("display");
                if (showing == 'block') {
                    images[x] = $(this).attr("name");
                    x = x + 1;
                }
            });

            dataArray[ids] = []; //make a sub array        
            var id = '';
            var url = '';
            var x = 0;

            $.each($("input"), function () {
                id = $(this).attr('id');
                if (id == "url") {
                    url = $(this).val();
                    if (url && url.trim().length) {
                        if (url.indexOf("TITLE") != -1) {
                            var name = $(this).attr('name');
                            var found = $.inArray(name, images) > -1; //make sure the image has a url
                            if (found) {
                                dataArray[ids][x] = [];
                                dataArray[ids][x][0] = name;
                                dataArray[ids][x][1] = url;
                                x = x + 1;
                            }
                        }
                    }
                }
            });

            if (x == 0) {
                alert("<?php echo ERROR_NO_MATCH; ?>");
            } else {
                $.ajax({
                    type: 'POST',
                    data: dataArray,
                    async: false,
                    url: "<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
                    success: function (data) {
                        $("#form_result").html(data);
                    }
                });
            }
        });
    }

    function SaveTwitterCard() {
        $("form").submit(function (e) {
            e.preventDefault(); //stop the form reload
            var dataArray = {};
            dataArray[0] = 'submit_twitter';
            var found = 0;

            $.each($("input"), function () {
                id = $(this).attr('id');
                indata = $(this).val();
                if (id == 'store_name' && $.trim(indata.length) > 0) {
                    dataArray[1] = indata;
                    found = found + 1;
                } else if (id == 'creator' && $.trim(indata.length) > 0) {
                    dataArray[2] = indata;
                    found = found + 1;
                }
            });

            if (found != 2) {
                dataArray[3] = 'delete';  //at least one of the entries is missing so delete the option
            }

            $.ajax({
                type: 'POST',
                data: dataArray,
                async: false,
                url: "<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
                success: function (data) {
                    $("#form_result_twitter").html(data);
                }
            });
        });

    }
</script>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>



        <td><table border="0" cellpadding="0" width="100%">
                <tr><td>
                        <?php
                        echo '<div class="pageHeading">'.HEADING_TITLE.'</div>';
                        echo '<div class="main" style="border-bottom:1px solid #000; width:100%; padding-top:10px; padding-bottom:10px;">'.HEADING_TEXT_SOCIAL_ICONS.'</div>';

                        echo '<div style="float:left;  padding-top:10px; padding-bottom:6px;">';
                        foreach ($iconsArray as $group => $key) {
                            echo '<div class="main" id="group_names" style="float:left; font-weight:bold; padding-right:10px;"><INPUT TYPE="radio" NAME="size_group" VALUE="'.$group.'"'.' id="'.$group.'"'.($group
                            == $checked[$group] ? ' checked ' : '').' onclick="javascript:return ChangeIconSize()" />'.$group.'</div>';
                        }
                        echo '<div style="float:left;"><input type="checkbox" id="disable_social"'.($db['configuration_value']
                        == 'false' ? 'checked' : '').' />'.TEXT_DISABLE.'</div>';
                        echo '</div>';

                        /*                         * *** SHOW THE ICONS *** */
                        echo '<div class="container" style="padding-bottom:10px;" id="showicons"></div>';

                        /*                         * *** SHOW THE URL BOXES *** */
                        echo '<div class="container" style="padding:15px 0;">';
                        foreach ($iconsArray as $group => $key) {
                            if ($group == $checked[$group]) {
                                foreach ($key as $icon) {
                                    $url      = '';
                                    $db_query = tep_db_query("select url from ".TABLE_HEADERTAGS_SOCIAL." where section='socialicons' and groupname='".$icon."'");
                                    if (tep_db_num_rows($db_query) > 0) {
                                        $db  = tep_db_fetch_array($db_query);
                                        $url = $db['url'];
                                    }
                                    echo '<div style="float:left;  width:300px;  ">';
                                    echo '<div class="logo-box" style="width:110px; height:20px ;">'.$icon.'</div>';
                                    echo '<div class="logo-box"><input type="text" name="'.$icon.'" id="url" value="'.$url.'" style="margin-left:10px; size:140px;" /></div>';
                                    echo '</div>';
                                }
                            }

                            break;
                        }
                        echo '</div>';

                        echo '<form name="social_icons" action="" onsubmit="return false;">';
                        echo '<div style="text-align:center; padding-top:10px;"><input type="submit" name="Save Changes" value="Save Changes" onclick="javascript:return SaveSocialIcons()" style="font-size:12px; height:16px; width:100px; border:1px solid #000; background:#9a9">';
                        echo '<span id="form_result">&nbsp;&nbsp;</span></div>';
                        echo '</form>';

                        /*                         * ********************** BEGIN TWITTER CARD ********************** */
                        $db_query = tep_db_query("select groupname as store, data as creator from ".TABLE_HEADERTAGS_SOCIAL." where section = 'twitter'");
                        $arry     = array();

                        if (tep_db_num_rows($db_query)) {
                            $db                 = tep_db_fetch_array($db_query);
                            $arry['store_name'] = $db['store'];
                            $arry['creator']    = $db['creator'];
                        } else {
                            $arry['store_name'] = STORE_NAME;
                        }

                        echo '<div class="container">';
                        echo '<div style="float:left;  width:100%; border-top:1px solid #000;">';
                        echo '<form name="twitter_card" action="" onsubmit="return false;">';
                        echo '<div style="float:left; padding-top:10px; padding-bottom:10px;">'.HEADING_TEXT_TWITTER_CARD.'</div>';
                        echo '<div style="float:left; text-align:center; padding-left:20px; padding-top:10px;"><input type="submit" name="Save Changes" value="Save Changes" onclick="javascript:return SaveTwitterCard()" style="font-size:12px; height:16px; width:100px; border:1px solid #000; background:#9a9">';
                        echo '<span id="form_result_twitter">&nbsp;&nbsp;</span></div>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div style="float:left;">';
                        echo '<div style="float:left; width:80px;">'.TEXT_TWITTER_SITE.'</div>';
                        echo '<div style="float:left; width:100px;"><input type="text" id="store_name" value="'.$arry['store_name'].'" /></div>';
                        echo '<div style="float:left; width:160px; padding-left:60px;">'.TEXT_TWITTER_CREATOR.'</div>';
                        echo '<div style="float:left; width:100px;"><input type="text" id="creator" value="'.$arry['creator'].'" /></div>';
                        echo '</div>';

                        /*                         * ********************** END TWITTER CARD ********************** */
                        ?> 

                    </td></tr>
            </table></td>
    </tr>
</table>

<?php
require(DIR_WS_INCLUDES.'template_bottom.php');
require(DIR_WS_INCLUDES.'application_bottom.php');
?>

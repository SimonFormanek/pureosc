<?php
/*
  $Id: database_optimizer_cron.php,v 1.0 2011/02/02
  database_optimizer_cron.php Originally Created by: Jack_mcs - http://www.oscommerce-solution.com
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Portions Copyright 2011 oscommerce-solution.com
  Released under the GNU General Public License
*/
  require('includes/application_top.php');
  require('includes/database_optimizer_db_handler.php');   
  
  DO_CheckDatabase();

  $actionRunOptimizer  = ((isset($_POST['action_run_optimizer']) && $_POST['action_run_optimizer'] == 'process') ? true : false);
  $currentVersion = '';
  $message = '';
  /********************** BEGIN VERSION CHECKER *********************/
  if (file_exists('includes/functions/version_checker.php')) {
      require('includes/languages/' . $language . '/version_checker.php');
      require('includes/functions/version_checker.php');
      $contribPath = 'http://addons.oscommerce.com/info/4441';
      $currentVersion = 'Database Optimizer V 1.7';
      $contribName = 'Database Optimizer V';
      $versionStatus = '';
  }
  /********************** END VERSION CHECKER *********************/
  if (isset($_POST['action']))  {
      /********************** CHECK THE VERSION ***********************/
      if ($_POST['action'] == 'getversion') {
          if (isset($_POST['version_check']) && $_POST['version_check'] == 'on') {
              $versionStatus = AnnounceVersion($contribPath, $currentVersion, $contribName);
          }
      }
  }
  else if ($actionRunOptimizer) {
      $forceOptimize = true;       //this is being ran manually so ignore the setting for optimizing
      require('includes/functions/database_optimizer.php');
      require('includes/modules/database_optimizer.php');
      if (! $optionSelected) {
          $messageStack->add(ERROR_NO_OPTION_SELECTED, 'error');
      }
  }
  require('includes/template_top.php');
?>
<link rel="stylesheet" type="text/css" href="includes/database_optimizer.css"> 
<script type="text/javascript">
 
function showHelp(page) { 
//console.log('show help '+page);
	$( "#do_help" ).dialog({
  show: "fade",
  hide: "fade",
  position: ['middle',100], 
  width: 600,
  height: 400,
  modal: true,
  open: function(event, ui)	{ 
   $(this).load(page);
  }
  //, buttons: { "Ok": function() { $(this).dialog("close"); } }
 });
}

function ToggleBoxes(cnt) {   
  for (i = 0; i < cnt; i++) { 
    var id = 'opt_'+ i;
    if (document.getElementById(id).checked == true) {
       document.getElementById(id).checked = false;
    } else {
       document.getElementById(id).checked = true;
    }
  }  
}
 
</script>
<style type="text/css">
table.BorderedBox {border: ridge #ddd 3px; background-color: #eee; }
table.BorderedBoxWhite {border: ridge #ddd 3px; background-color: #fff; }
.do_small { float:right; font-family:Verdana, Arial, sans-serif; font-size:10px; font-weight:bold; color:#ff0000 }
.do_small_inline { display:inline-block; font-family:Verdana, Arial, sans-serif; font-size:10px; font-weight:bold; color:#ff0000 }
</style>

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
     <tr>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="BorderedBox">
       <tr>
        <td><table border="0" width="40%" cellspacing="0" cellpadding="0">
            <tr>
               <td class="pageHeading" valign="top"><?php echo str_replace(" ", "&nbsp;", $currentVersion); ?></td>
            </tr>
            <tr>
               <td class="smallText" valign="top"><?php echo HEADING_TITLE_SUPPORT_THREAD; ?></td>
            </tr>
        </table></td>
        <td><table border="0" width="100%">
         <tr>
          <td class="smallText" align="right"><?php echo HEADING_TITLE_AUTHOR; ?></td>
         </tr>
         <?php
         if (function_exists('AnnounceVersion')) {
            $idParts = explode(' ', $currentVersion);
            foreach ($idParts as $part) {
               if ($part !== 'V') {
                 $name .= $part;
               } else {
                  break;
               }               
            }
            $id = $idParts[count($idParts)-1];
            if (DATABASE_OPTIMIZER_ENABLE_VERSION_CHECKER == 'true') {
         ?>
               <tr>
                <td style="float:right"><table border="0" cellpadding="0"><tr>
                  <td class="do_small"><?php echo AnnounceVersion($contribPath, $currentVersion, $contribName); ?></td>
                  <td class="do_small"><INPUT style="vertical-align:middle; margin-top:3px" TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><span style="vertical-align:top"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></span></td>
                </tr></table></td>                  
               </tr>
         <?php } else if (tep_not_null($versionStatus)) {
           echo '<tr><td class="do_small">' . $versionStatus . '</td></tr>';
         } else {
           echo tep_draw_form('version_check', 'database_optimizer.php', '', 'post') . tep_draw_hidden_field('action', 'getversion');
         ?>
               <tr>
                <td style="float:right"><table border="0" cellpadding="0"><tr>
                  <td class="do_small_inline"><INPUT style="vertical-align:middle; margin-top:0px" TYPE="radio" NAME="version_check" onClick="this.form.submit();"><?php echo TEXT_VERSION_CHECK_UPDATES; ?></td>
                  <td class="do_small_inline"><INPUT style="vertical-align:middle; margin-top:0px" TYPE="radio" NAME="version_check_unreleased" onClick="window.open('http://www.oscommerce-solution.com/check_unreleased_updates.php?id=<?php echo $id; ?>&name=<?php echo $name; ?>')"><span style="vertical-align:top"><?php echo TEXT_VERSION_CHECK_UPDATES_UNRELEASED; ?></span></td>
                </tr></table></td>
               </tr>
           </form>
         <?php } } else { ?>
           <tr>
              <td class="do_small"><?php echo TEXT_MISSING_VERSION_CHECKER; ?></td>
           </tr>
         <?php } ?>
        </table></td>
       </tr>
       <tr>
        <td class="do_small tt"><div style="float:right; margin-bottom:10px; color:sienna; text-align:center"><?php echo TEXT_HELP; ?></div></td>
       </tr>
      </table></td>
     </tr>
     <!-- BEGIN LOWER SECTION -->
     <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="BorderedBoxWhite">
       <!-- BEGIN DELETE AND GENERATE FILE -->
      
       <tr>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
          <td align="right"><?php echo tep_draw_form('database_optimizer', 'database_optimizer.php', '', 'post') . tep_draw_hidden_field('action_run_optimizer', 'process'); ?>
           <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                  <td><input type="checkbox" name="toggle_boxes" onclick="return ToggleBoxes('<?php echo count($optionsArray); ?>');"> </td>
                </tr>
              <?php 
                $idx = 0;
                foreach ($optionsArray as $option) { ?>
                <tr>
                  <td><input type="checkbox" name="<?php echo $option['post']; ?>" id="<?php echo 'opt_' . $idx; ?>" /></td>
                  <td class="smallText"><?php echo $option['option']; ?></td>
                  <td class="smallText"><?php echo $option['explain']; ?></td>
                </tr>
              <?php $idx++; } ?>
            </table></td>
           </tr>
           <tr>
             <td><table border="0" width="40%" cellspacing="0" cellpadding="2">
               <tr>
                 <td align="center"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE);?></td>
               </tr>
             </table></td>
           </tr>
          </form>
          </td>
         </tr>
        </table></td>
       </tr>
       <!-- END DELETE AND GENERATE FILE -->
       <!-- BEGIN SHOW THE RESULTS -->
       <?php if (tep_not_null($message)) { ?>
       <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
       </tr>
       <tr>
         <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
             <td class="smallText" style="padding-left:10px; padding-bottom:5px"><?php echo str_replace("\r\n", "<br>", $message); ?></td>
           </tr>
         </table></td>
       </tr>
       <?php } ?>
       <!-- END SHOW THE RESULTS -->
      </table></td>
     </tr>
     <!-- END LOWER SECTION -->
    </table></td>
  </tr>
</table>
<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

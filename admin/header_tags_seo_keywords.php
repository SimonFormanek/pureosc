<?php
/*
  $Id: header_tags_seo_keywords.php,v 1.2 2011/07/24
  header_tags_keywords Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require_once('includes/functions/header_tags.php');
  require_once(DIR_WS_FUNCTIONS . 'headertags_seo_position_google.php');

  $current_page = (isset($_POST['current_page']) ? $_POST['current_page'] : 1);
  $filename = DIR_FS_CATALOG. DIR_WS_INCLUDES . 'header_tags.php'; 
  $languages = tep_get_languages();
  $paginationType = 0; //set to 1 if page numbers are to be used  
  $selected_display_type = TEXT_DISPLAY_TYPE_ALL;
  $sortBy = array('keyword' => 'checked', 'current' => 'found DESC, keyword ASC');
  $sortWhere = '';
 
  /********************** HANDLE THE REQUESTS *********************/
  if (isset($_POST['sortgroup'])) {
      $selected_display_type = $_POST['display_type'];
      $type = '';
      switch ($_POST['display_type']) {
          case TEXT_DISPLAY_TYPE_FOUND:     $sortWhere = ' where found=1 '; $type = 'found DESC, '; break;
          case TEXT_DISPLAY_TYPE_NOT_FOUND: $sortWhere = ' where found=0 '; $type = 'found, '; break;
          default: break;          
      } 
      switch ($_POST['sortgroup']) {
          case TEXT_SORT_ON_DATE:           $sortBy['date'] = 'checked';                 $sortBy['current'] = $type . ' last_search DESC'; break;
          case TEXT_SORT_ON_KEYWORD:        $sortBy['keyword'] = 'checked';              $sortBy['current'] = $type . ' keyword ASC'; break;
          case TEXT_SORT_ON_GOOGLE:         $sortBy['google_last_position'] = 'checked'; $sortBy['current'] = $type . ' google_last_position DESC, keyword ASC'; break;
          case TEXT_SORT_ON_KEYWORD_NONHTS: $sortBy['nonhts_keyword'] = 'checked';       $sortBy['current'] = $type . ' keyword ASC'; break;
          case TEXT_SORT_ON_SEARCHES:       $sortBy['searches'] = 'checked';             $sortBy['current'] = $type . ' counter DESC'; break;
          default:                          $sortBy['keyword'] = 'checked';              $sortBy['current'] = $type . ' keyword ASC';
      }
  } 

  else if (isset($_POST['delete_words']) && $_POST['delete_words'] == true) {
      $deleted = 0;

      while (list($key, $value) = each($_POST)) {
          if (strpos($key, 'delete_word_') !== FALSE) {
              $deleted++;
              tep_db_query("delete from " . TABLE_HEADERTAGS_KEYWORDS . " where id = " . (int)$value);
          }
      }

      if ($deleted) $messageStack->add(sprintf(TEXT_DELETE_SUCCESSFUL, $deleted), 'success');
  }

  else if (isset($_POST['deleteall']) && $_POST['deleteall'] == TEXT_DELETE_KEYWORDS) {
      $searches = GetSearchCounts(); 
      tep_db_query("truncate headertags_keywords");
      $messageStack->add(sprintf(TEXT_DELETE_SUCCESSFUL, $searches['ttl_words']), 'success');
  }
  else if (isset($_POST['search_site']) && $_POST['search_site'] == true) {
      $updated = 0;

      while (list($key, $value) = each($_POST)) {
          if (strpos($key, 'searchgroup_') !== FALSE) {
              $parts = explode('_', $value);

              $pID = (isset($_POST['searchpid_'.$parts[2]]) ? (int)$_POST['searchpid_'.$parts[2]] : '');

              if ($pID > 0) { 
                  $kwrd_query = tep_db_query("select product_id from " . TABLE_HEADERTAGS_SEARCH . " where keyword = '" . tep_db_input($parts[1]) . "' and language_id = " . (int)$parts[3]);

                  if ($parts[0] == TEXT_KEYWORD_SEARCH_SITE_YES) {
                      if (tep_db_num_rows($kwrd_query) > 0) { //found in the search
                          $kwrd = tep_db_fetch_array($kwrd_query);
                          if ($kwrd['product_id'] != $pID) {
                              tep_db_query("update " . TABLE_HEADERTAGS_SEARCH . " set product_id = " . (int)$pID);
                          }    
                      } else {
                          tep_db_query("insert into " . TABLE_HEADERTAGS_SEARCH . " (product_id, keyword, language_id) values ('" . (int)$pID . "', '" . tep_db_input($parts[1]) . "', '" . (int)$parts[3] . "')");
                      }    
                      $updated++;
                  } else if ($parts[0] == TEXT_KEYWORD_SEARCH_SITE_NO) {
                      if (tep_db_num_rows($kwrd_query) > 0) { //otherwise there's nothing to delete
                          tep_db_query("delete from " . TABLE_HEADERTAGS_SEARCH . " where product_id = " . (int)$pID. " and keyword = '" . tep_db_input($parts[1]) . "' and language_id = " . (int)$parts[3] );
                          tep_db_query("update " . TABLE_HEADERTAGS_KEYWORDS . " set found = 0 where id = " . (int)$parts[2] . " and keyword = '" . tep_db_input($parts[1]) . "' and language_id = " . (int)$parts[3]);
                          $updated++;
                      }
                  }
              } else {
                  $messageStack->add(ERROR_MISSING_PRODUCT_ID, 'error');
              }
          }
      }

      if ($updated) $messageStack->add(sprintf(TEXT_KEYWORD_SEARCH_SITE_SUCCESSFUL, $updated), 'success');
  }  

 /********************** Perform Maintenance on keywords **********************/


 /********************** LOAD THE STORED SEARCH WORDS **********************/
  $searchWords = array();
  $searchwords_query = tep_db_query("select * from " . TABLE_HEADERTAGS_SEARCH);
  
  while ($words = tep_db_fetch_array($searchwords_query)) {
      $searchWords[] = $words;
  }
 
  $keywords_query = tep_db_query("select * from " . TABLE_HEADERTAGS_KEYWORDS . $sortWhere);
  $pages = ceil(tep_db_num_rows($keywords_query)/MAX_DISPLAY_SEARCH_RESULTS);	
  
  //create pagination
  $pagesList = array();
  
  if($pages > 1) {
      if ($paginationType) {
          $pad = ($pages < 100 ? 20 : 30);        //adjust width for alignment
          $col = ($pages < 100 ? 45 : 30);        //adjust columns for alignment 
      $pagination .= '<div style="float:left;">';
      for($i = 1; $i <= $pages; $i++) {
          $pagination .= '<span style="float:left; width:' . $pad . 'px; text-align:center;"><a href="#" class="paginate_click active" id="'.$i.'-page">'.$i.'</a>&nbsp;</span>';
          
          if ($i % $col == 0) {
              $pagination .= '</div><div style="float:left;">';
          }
      }
      $pagination .= '</div>';
      } else {
          for($i = 1; $i <= $pages; $i++) {
              $pagesList[] = array('id' => $i, 'text' => $i);
          }
      } 
  }  
  
  
  $display_types = array();
  $display_types[] = array('id' => TEXT_DISPLAY_TYPE_ALL, 'text' => TEXT_DISPLAY_TYPE_ALL);
  $display_types[] = array('id' => TEXT_DISPLAY_TYPE_FOUND, 'text' => TEXT_DISPLAY_TYPE_FOUND);
  $display_types[] = array('id' => TEXT_DISPLAY_TYPE_NOT_FOUND, 'text' => TEXT_DISPLAY_TYPE_NOT_FOUND);
  
  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link rel="stylesheet" type="text/css" href="includes/headertags_seo_styles.css">
<style type="text/css">
td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
td.HTC_subHead {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 12px; } 
.HTC_title {background: #fof1f1; text-align: center;} 
input { vertical-align: middle; margin-top: -1px;}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    var type = '<?php echo $paginationType; ?>';
    if (type == 1) {
    DoPagination(1,1); //initial load
    
    $(".paginate_click").click(function (e) {
       
       // $("#results").prepend('<div class="loading-indication"><img src="images/ajax-loader.gif" /> Loading...</div>');
       
        var clicked_id = $(this).attr("id").split("-"); //ID of clicked element, split() to get page number.
        var page_num = parseInt(clicked_id[0]); //clicked_id[0] holds the page number we need
       
        $('.paginate_click').removeClass('active'); //remove any active class       
       
          DoPagination(page_num, clicked_id);
    //    $(this).addClass('active'); //add active class to currently clicked element
       
        return false; //prevent going to herf link
    });
    } else {
        var current_page = $("#current_page").val(); //by id
        //var current_page = '<?php echo $current_page; ?>';
          
        DoPaginationList(current_page, current_page); //initial load
        
        $("#pagelist").on('change', function () {
            var current_page = $('#pagelist option:selected').val();
            DoPaginationList($(this).val(), current_page)
        });    
    }
});

function confirmdelete(form) {
 if (confirm('Do you really want to delete all of the keywords?\r\n\r\nThey cannot be recovered once deleted.'))
  form.submit();
  
 return false;
}

function DoPaginationList(page_num, clicked_id) {  
        var dataArray = {};
        dataArray[0] = 'pagination';
        dataArray[1] = page_num;
        dataArray[2] = clicked_id; //not used in ajax code
        dataArray[3] = "<?php echo $sortBy['current']; ?>";
        dataArray[4] = "<?php echo $sortWhere; ?>";
        dataArray[5] = <?php echo json_encode($searchWords); ?>;
      //  $('.paginate_click').removeClass('active'); //remove any active class
        $.ajax({
           type:  'POST',
           data:  dataArray ,
           async: false,
           url:"<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
           dataType: 'json',
           success:function(data) {
               $( "#myformdata" ).html( data.div ); 
               $('#current_page').val(clicked_id);
               $('#pagelist').val(clicked_id);
           }
        });
        return false;      
}
function DoPagination(page_num, clicked_id) {
  
        var dataArray = {};
        dataArray[0] = 'pagination';
        dataArray[1] = page_num;
        dataArray[2] = clicked_id; //not used in ajax code
        dataArray[3] = "<?php echo $sortBy['current']; ?>";
        dataArray[4] = "<?php echo $sortWhere; ?>";
        dataArray[5] = <?php echo json_encode($searchWords); ?>;
        $('.paginate_click').removeClass('active'); //remove any active class

        $.ajax({
           type:  'POST',
           data:  dataArray ,
           async: false,
           url:"<?php echo tep_href_link('header_tags_seo_ajax.php'); ?>",
           dataType: 'json',
           success:function(data) {
               $( "#myformdata" ).html( data.div ); 
               $('#'+page_num+'-page').addClass('active'); //add active class to currently clicked element (style purpose)                
           }
        });
        return false;
       

}

function ShowKeyword(str, id) {
  if (str=="")
    {
    document.getElementById(id).innerHTML="";
    return;
    } 
  if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
  else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  xmlhttp.onreadystatechange=function()
    {
    //alert(xmlhttp.readyState);
    if(xmlhttp.readyState == 1 || xmlhttp.readyState == "loading") {
      document.getElementById('waitimg').style.display = 'block';
      document.getElementById('waitimg').src = 'images/busywait.gif';
      document.getElementById('waitimg').border='0';
      //document.getElementById('waitimg').innerHTML="<img src='images/ajax-loader.gif' border='0' alt='running' style='display:block' />";   
      document.getElementById('waitdiv').style.top = $(window).scrollTop() + 200;
    }

    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      document.getElementById(id).innerHTML=xmlhttp.responseText;
      document.getElementById('waitimg').style.display = 'none';
      document.getElementById('waitimg').src = '';
      }
    }
  var URL = document.getElementById('search_url').value;
  var cnt = document.getElementById('page_count').value;

  var gooID = 'goolast_'+id;
  var googleLast = document.getElementById(gooID).value;

 // alert("word="+URL);  
  xmlhttp.open("GET","headertags_seo_keyword_position.php?keyword="+str+"&section=get_kword&url="+URL+"&page_cnt="+cnt+"&googleLast="+googleLast,true);
  xmlhttp.send();
}

function handlesubmit(id) {
  if (id == 'search_site') {
    document.keywords_form.search_site.value = true;
  } else if (id == 'delete_words') {
    document.keywords_form.delete_words.value = true;  
  }
  document.keywords_form.submit();
} 

if (document.images) {
    waitimg = new Image();
    waitimg.src = "images/busywait.gif";
}
</script>
<div id="waitdiv" style="position:absolute; left:380px; top:200px;"><img id="waitimg" style="display:none" ></div>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td><table border="0" width="100%">
       <tr>
        <td class="HTC_Head"><?php echo HEADING_TITLE_SEO_KEYWORDS; ?></td>
       </tr>
      </table></td>  
     </tr>
     <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
     <tr><td class="HTC_subHead"><?php echo TEXT_PAGE_HEADING_KEYWORDS; ?></td></tr>
     <tr><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td></tr>
     <tr><td><?php echo tep_black_line(); ?></td></tr>     

     <!-- Begin of Header Tags -->   
     <tr>
      <td align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">     

       <!-- BEGIN KEYWORDS SECTION -->   
       
       <?php if ($paginationType) { ?>
          <tr><td><table border="1" width="100%" cellpadding="0"><tr><td><div id="results"></div><?php echo $pagination; ?></td></tr></table></td></tr>       
       <?php } else { 
          $searches = GetSearchCounts(); 
          $pageCount = count($pagesList);
          $pageCount = ($pageCount == 0 ? 1 : $pageCount);
       ?>   
          <tr>
            <td class="main" style="padding:5px 0">
              <div>
                <div style="float:left"><?php echo TEXT_SHOWING_PAGE . '&nbsp;' . tep_draw_pull_down_menu('pagelist', $pagesList, '', 'id="pagelist"'); ?></div>  
                <div class="main" style="float:left; padding-left:15px"><?php echo sprintf(TEXT_PAGE_TALLY, $pageCount, $searches['ttl_words'], $searches['found_words'], $searches['notfound_words']); ?></div>
                <div class="main" style="float:left; padding-left:35px">
                 <?php 
                   echo tep_draw_form('delete_all', 'header_tags_seo_keywords.php', '', 'post') . tep_hide_session_id() . tep_draw_hidden_field('action', 'process'); ?> 
                   <INPUT TYPE="radio" NAME="deleteall" VALUE="<?php echo TEXT_DELETE_KEYWORDS; ?>" onClick="confirmdelete(this.form)">
                   <?php echo TEXT_DELETE_KEYWORDS; ?> 
                   </form> 
                </div>
              </div>
            </td>              
          </tr>
       <?php } ?>
       
       <tr>
         <td align="right" width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #fff; border: ridge #CCFFCC 3px; padding-left: 2px;">
          <tr style="background-color: #cccccc;">
            <th class="smallText"><?php echo HEADING_TITLE_SECTION_MAIN; ?></th>
          </tr>
          <tr><td height="8"></td></tr>	

          <tr>
            <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><table border="0" cellpadding="0">
                    <tr class="smallText">
                      <form action="header_tags_seo_keywords.php" method="post" name="sortorder">     
                      <td class="main">
                        <div style="float:left">                      
                          <div style="float:left; font-weight:bold; width:50px;"><?php echo TEXT_SORT_DISPLAY_TYPE; ?></div>
                          <div style="float:left; padding-left:10px"><?php echo tep_draw_pull_down_menu('display_type', $display_types, $selected_display_type, 'onChange="this.form.submit();"'); ?></div>
                          <div style="float:left; padding-left:15px; font-weight:bold;"><?php echo TEXT_SORT_BY; ?></div>
                          <div style="float:left; padding-left:10px"><INPUT TYPE="radio" NAME="sortgroup" VALUE="<?php echo TEXT_SORT_ON_KEYWORD; ?>" <?php echo $sortBy['keyword']; ?> onClick="this.form.submit();"><?php echo TEXT_SORT_ON_KEYWORD; ?>&nbsp;</div>
                          <div style="float:left; padding-left:10px"><INPUT TYPE="radio" NAME="sortgroup" VALUE="<?php echo TEXT_SORT_ON_DATE; ?>" <?php echo $sortBy['date']; ?> onClick="this.form.submit();"><?php echo TEXT_SORT_ON_DATE; ?>&nbsp;</div>
                          <div style="float:left; padding-left:10px"><INPUT TYPE="radio" NAME="sortgroup" VALUE="<?php echo TEXT_SORT_ON_SEARCHES; ?>" <?php echo $sortBy['searches']; ?> onClick="this.form.submit();"><?php echo TEXT_SORT_ON_SEARCHES; ?>&nbsp;</div>
                          <div style="float:left; padding-left:10px"><INPUT TYPE="radio" NAME="sortgroup" VALUE="<?php echo TEXT_SORT_ON_GOOGLE; ?>" <?php echo $sortBy['google_last_position']; ?> onClick="this.form.submit();"><?php echo TEXT_SORT_ON_GOOGLE; ?>&nbsp;</div>
                        </div>
                      </td>  
                      <?php echo tep_draw_hidden_field('current_page', $current_page, 'id="current_page"'); ?>
                      </form>
                    </tr>
                  </table></td>
                  <td valign="top"><table border="0" cellpadding="0">
                    <tr class="smallText">
                      <td class="main">
                        <div style="float:left; padding-bottom:6px">
                          <div style="float:left; font-weight:bold; width:30px;"><?php echo TEXT_SEARCH_URL; ?></div>
                          <div style="float:left; padding-left:10px; font-weight:bold;"><?php echo tep_draw_input_field('search_url', (defined('HEADER_TAGS_POSITION_DOMAIN') ? HEADER_TAGS_POSITION_DOMAIN : ''), ' id="search_url" maxlength="255" size="35"', false); ?> </div>
                          <div style="float:left; padding-left:10px; font-weight:bold; width:30px;"><?php echo TEXT_SEARCH_PAGE_COUNT; ?></div>
                          <div style="float:left; padding-left:10px"><?php echo tep_draw_input_field('page_count', (defined('HEADER_TAGS_POSITION_PAGE_COUNT') ? HEADER_TAGS_POSITION_PAGE_COUNT : ''), ' id="page_count" maxlength="3" size="4"', false); ?> </div>
                        </div>
                      </td> 
                    </tr>
                  </table></td>                    
                </tr>    
                <tr><td hiehgt="10"></td></tr>
            </table></td>
          </tr>            

          <tr>
            <td align="right" width="60%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">                
               <tr><td><div id="myformdata"></div></td></tr>
            </table></td>
          </tr>   
         </table></td>
       </tr>   
       <!-- END KEYWORDS SECTION -->

       <tr><td height="20"></td></tr>	 


      </table></td> 
     </tr>
     <!-- end of Header Tags -->

    </table></td>
  </tr>
</table>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

<?php
require('includes/application_top.php');
require(DIR_WS_LANGUAGES.$language.'/headertags_seo/headertags_seo_'.$_GET['file'].'.php');
?>
<style type="text/css">
    <!--
    div.heading {font-weight:bold; padding-bottom: 6px; }
    div.section {padding-bottom: 6px; }
    div.section_block {clear:both; float:left; padding:10px 0;}
    div.section_block_line {clear:both; float:left; padding:10px 0; margin-top:30px; border-top:2px dotted #C0C0C0; width:100%}
    div.section_row_help a:link { float:left; padding-left:20px; color:#A0522D; text-align:center; white-space:nowrap; }
    a.section_email { color:#A0522D;  }
    a.section_email_blue { color:#0000FF;  }
    span.subheading { color:#ff0000; }
    -->
</style>

<?php
echo '<div>';
echo '<div style="text-align:center">'.HTS_HEADING.'</div>';

echo '<div class="smallText">'.stripslashes(HTS_TEXT_MAIN).'</div>';
echo '</div>';

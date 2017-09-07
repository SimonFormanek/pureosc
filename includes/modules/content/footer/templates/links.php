<div class="col-sm-<?php echo $content_width; ?>">
  <div class="footerbox information">
    <h2><?php echo MODULE_CONTENT_FOOTER_INFORMATION_HEADING_TITLE; ?></h2>
    <ul class="nav nav-pills nav-stacked">
  <?php echo tep_information_show_category(1);?>
  <?php //echo  '<li><a href="' . tep_href_link('contact_us.php') . '">' . MODULE_CONTENT_FOOTER_INFORMATION_CONTACT . '</a></li>';

      /*** Begin Article Manager ****/
      echo $aLinks; 
      /*** End Article Manager ****/
      ?>
    </ul>  
  </div>
</div>

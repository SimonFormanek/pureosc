<?php
/*
  $Id cm_modular_navbar.php v1.0 20160215 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
*/
  
?>
<!-- Start cm_modular_navbar -->
<nav class="navbar navbar-inverse navbar-no-corners navbar-no-margin" role="navigation">
  <div class="<?php echo BOOTSTRAP_CONTAINER; ?>">
    <div class="navbar-header"><?php if (MODULE_CONTENT_NAVIGATION_MODULAR_NAVBAR_LOGO_ENABLED=='True') echo '<a class="fl" href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . STORE_LOGO, STORE_NAME) . '</a>'; ?>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-core-nav">
        <span class="sr-only"><?php echo HEADER_TOGGLE_NAV; ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-navbar-collapse-core-nav">
        <ul class="nav navbar-nav">
          <?php 
          foreach ( $navigation_left as $left_nav_item ) {
            echo $left_nav_item;
          }
          ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php
          foreach ( $navigation_right as $right_nav_item ) {
            echo $right_nav_item;
          }
          ?>
       </ul>
    </div>
  </div>
</nav>
<!-- End cm_modular_navbar -->

<?php 
/*
  $Id cm_nb_settings.php v1.0 20160215 Kymation $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 James C Keebaugh

  Released under the GNU General Public License
*/
?>

<!-- Start cm_nb_settings -->
          <?php
          if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
            ?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo HEADER_SITE_SETTINGS; ?></a>
              <ul class="dropdown-menu">
                <li class="text-center text-muted bg-primary"><?php echo sprintf(USER_LOCALIZATION, ucwords($language), $currency); ?></li>
                <?php
                // languages
                if (!isset($lng) || (isset($lng) && !is_object($lng))) {
                 include(DIR_WS_CLASSES . 'language.php');
                  $lng = new language;
                }
                if (count($lng->catalog_languages) > 1) {
                  echo '<li class="divider"></li>';
                  reset($lng->catalog_languages);
                  while (list($key, $value) = each($lng->catalog_languages)) {
                    echo '<li><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name'], null, null, null, false) . ' ' . $value['name'] . '</a></li>';
                  }
                }
                // currencies
                if (isset($currencies) && is_object($currencies) && (count($currencies->currencies) > 1)) {
                  echo '<li class="divider"></li>';
                  reset($currencies->currencies);
                  $currencies_array = array();
                  while (list($key, $value) = each($currencies->currencies)) {
                    $currencies_array[] = array('id' => $key, 'text' => $value['title']);
                    echo '<li><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'currency=' . $key, $request_type) . '">' . $value['title'] . '</a></li>';
                  }
                }
                ?>
              </ul>
            </li>
            <?php
          }
          ?>
<!-- End cm_nb_settings -->

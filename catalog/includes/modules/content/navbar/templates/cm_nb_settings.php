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
if (substr(basename($_SERVER['PHP_SELF']), 0, 8) != 'checkout') {
    ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navsettings" role="button" href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php
            echo '<i class="fa fa-cog"></i><span class="hidden-sm"> '._('Lng/CCY').'</span> <span class="caret"></span>';
            ?></a>
        <div class="dropdown-menu" aria-labelledby="navsettings" >
            <a class="dropdown-item"><?php
                echo sprintf(
                    '<abbr title="'._('Selected Language').'">'._('L:').'</abbr> %s <abbr title="'._('Selected Currency').'">'._('C:').'</abbr> %s'
                    , ucwords($language), $currency);
                ?></a>
            <?php
            // languages
            if (!isset($lng) || (isset($lng) && !is_object($lng))) {

                $lng = new language();
            }
            if (count($lng->catalog_languages) > 1) {
                echo '<div class="dropdown-divider"></div>';
                reset($lng->catalog_languages);
                foreach ($lng->catalog_languages as $key => $value) {
                    echo '<a class="dropdown-item" href="'.tep_href_link(basename($_SERVER['PHP_SELF']),
                        tep_get_all_get_params(array('language', 'currency')).'language='.$key,
                        $request_type).'">'.tep_image(DIR_WS_LANGUAGES.$value['directory'].'/images/'.$value['image'],
                        $value['name'], null, null, null, false).' '.$value['name'].'</a>';
                }
            }
            // currencies
            if (isset($currencies) && is_object($currencies) && (count($currencies->currencies) > 1)) {
                echo '<div class="dropdown-divider"></div>';
                reset($currencies->currencies);
                $currencies_array = array();
                foreach ($currencies->currencies as $key => $value) {
                    $currencies_array[] = array('id' => $key, 'text' => $value['title']);
                    echo '<a class="dropdown-item" href="'.tep_href_link(basename($_SERVER['PHP_SELF']),
                        tep_get_all_get_params(array('language', 'currency')).'currency='.$key,
                        $request_type).'">'.$value['title'].'</a>';
                }
            }
            ?>
        </div>
    </li>
    <?php
}
?>
<!-- End cm_nb_settings -->

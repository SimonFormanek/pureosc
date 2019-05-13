<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Edited by 2014 Newburns Design and Technology
 * ************************************************
 * *********** New addon definitions **************
 * ***********        Below          **************
 * ************************************************
  Custom change for product attribute sort ordering added -- http://forums.oscommerce.com/topic/123629-sorting-attributes/
  KISS Image Thumbnailer added -- http://addons.oscommerce.com/info/9206

  Released under the GNU General Public License
 */

require_once('includes/application_top.php');

if (!isset($_GET['products_id'])) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
$products_id = $_REQUEST['products_id'];

require(DIR_WS_LANGUAGES.$language.'/'.FILENAME_PRODUCT_INFO);

$product_check_query = tep_db_query("select count(*) as total from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_status = '1' and p.products_id = '".$products_id."' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."'");
$product_check       = tep_db_fetch_array($product_check_query);

require(DIR_WS_INCLUDES.'template_top.php');

if ($product_check['total'] < 1) {
    ?>

    <div class="contentContainer">
        <div class="contentText">
            <div class="alert alert-warning"><?php echo _('Product not found'); ?></div>
        </div>

        <div class="pull-right">
            <?php
            echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-angle-right',
                tep_href_link(FILENAME_DEFAULT));
            ?>
        </div>
    </div>

    <?php
} else {
    $product_info_query = tep_db_query("select p.products_id, p.product_template, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_status = '1' and p.products_id = '".(int) $_GET['products_id']."' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."'");
    $product_info       = tep_db_fetch_array($product_info_query);

    tep_db_query("update ".TABLE_PRODUCTS_DESCRIPTION." set products_viewed = products_viewed+1 where products_id = '".(int) $_GET['products_id']."' and language_id = '".(int) $languages_id."'");

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
        $products_price = '<del>'.$currencies->display_price($product_info['products_price'],
                tep_get_tax_rate($product_info['products_tax_class_id'])).'</del> <span class="productSpecialPrice" itemprop="price" content="'.preg_replace('/[^0-9.]*/',
                '',
                $currencies->display_price($new_price,
                    tep_get_tax_rate($product_info['products_tax_class_id']))).'">'.$currencies->display_price($new_price,
                tep_get_tax_rate($product_info['products_tax_class_id'])).'</span>';
    } else {
        $products_price = '<span itemprop="price" content="'.preg_replace('/[^0-9.]*/',
                '',
                $currencies->display_price($product_info['products_price'],
                    tep_get_tax_rate($product_info['products_tax_class_id']))).'">'.$currencies->display_price($product_info['products_price'],
                tep_get_tax_rate($product_info['products_tax_class_id'])).'</span>';
    }

    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
        $products_price .= '<link itemprop="availability" href="http://schema.org/PreOrder" />';
    } elseif ((STOCK_CHECK == 'true') && ($product_info['products_quantity'] < 1)) {
        $products_price .= '<link itemprop="availability" href="http://schema.org/OutOfStock" />';
    } else {
        $products_price .= '<link itemprop="availability" href="http://schema.org/InStock" />';
    }

    $products_price .= '<meta itemprop="priceCurrency" content="'.tep_output_string($currency).'" />';

    $products_name = '<a href="'.tep_href_link('product_info.php',
            'products_id='.$product_info['products_id']).'" itemprop="url"><span itemprop="name">'.$product_info['products_name'].'</span></a>';

    if (tep_not_null($product_info['products_model'])) {
        $products_name .= '<br /><small>[<span itemprop="model">'.$product_info['products_model'].'</span>]</small>';
    }
    ?>

    <?php
    echo tep_draw_form('cart_quantity',
        tep_href_link_original(FILENAME_PRODUCT_INFO,
            tep_get_all_get_params(array('action', 'atts')).'action=add_product',
            'NONSSL'), 'post', 'class="form-horizontal" role="form"');
    ?>

    <div itemscope itemtype="http://schema.org/Product">

        <div class="page-header">
            <?php if ($product_info['product_template'] == 1) { ?>
                <h1 class="pull-right" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><?php echo $products_price; ?></h1>
    <?php } ?>
            <h1><?php echo $products_name; ?></h1>
            <br />
        </div>

        <?php
        if ($messageStack->size('product_action') > 0) {
            echo $messageStack->output('product_action');
        }
        ?>

        <div class="contentContainer">
            <div class="contentText">

                <?php
                if (tep_not_null($product_info['products_image'])) {
                    $kmpiw = constant('KISSIT_MAIN_PRODUCT_IMAGE_WIDTH');
                    $kmpih = constant('KISSIT_MAIN_PRODUCT_IMAGE_HEIGHT');
                    echo tep_image(DIR_WS_IMAGES.$product_info['products_image'],
                        NULL, $kmpiw,
                        $kmpih,
                        'itemprop="image" style="display:none;"');

                    $photoset_layout = '1';

                    $pi_query = tep_db_query("select image, htmlcontent from ".TABLE_PRODUCTS_IMAGES." where products_id = '".(int) $product_info['products_id']."' order by sort_order");
                    $pi_total = tep_db_num_rows($pi_query);

                    if ($pi_total > 0) {
                        $pi_sub = $pi_total - 1;

                        while ($pi_sub > 5) {
                            $photoset_layout .= 5;
                            $pi_sub          = $pi_sub - 5;
                        }

                        if ($pi_sub > 0) {
                            $photoset_layout .= ($pi_total > 5) ? 5 : $pi_sub;
                        }
                        ?>
                        <div class="piGalDiv">
                            <div id="piGal" data-imgcount="<?php echo $photoset_layout; ?>">

<?php
            $pi_html = array();
            $pi_counter = 0;
            
                                while ($pi = tep_db_fetch_array($pi_query)) {
                                    $pi_counter++;

    if (tep_not_null($pi['htmlcontent'])) {
        $pi_html[] = '<div id="piGalDiv_'.$pi_counter.'">'.$pi['htmlcontent'].'</div>';
    }
    
    if($pi_counter == ''){
        $alt = $pi;
    } else {
        $alt = addslashes($product_info['products_name']);
    }
    
    /* * * BOF alterations for KISS IT ** */
    list($width, $height) = file_exists(DIR_WS_IMAGES.$pi['image']) ? getimagesize(DIR_WS_IMAGES.$pi['image']) : array(150, 150);
    
    echo tep_image(DIR_WS_IMAGES.$pi['image'], addslashes($product_info['products_name']).' '.$pi_counter,
        (($pi_counter > 1 ) ? round($kmpiw / (($pi_total <= 5) ? $pi_total - 1 : 5)) : $kmpiw),
        (($pi_counter > 1 ) ? round($kmpih / (($pi_total <= 5) ? $pi_total - 1 : 5)) : $kmpih),
        'id="piGalImg_'.$pi_counter.'" '.((KISSIT_MAIN_PRODUCT_WATERMARK_SIZE > 0) ? preg_replace('%<img width="[0-9 ]+" height="[0-9 ]+" src="(.*)title=.+%',
                'data-highres="$1',
                tep_image(DIR_WS_IMAGES.$pi['image'],  $alt, $width, $height)) : 'data-highres="'.DIR_WS_IMAGES.$pi['image'].'"'));
    /* * * EOF alterations for KISS IT ** */
}
?>

                            </div>

                            <?php
                            if (!empty($pi_html)) {
                                echo '    <div style="display: none;">'.implode('',
                                    $pi_html).'</div>';
                            }
                            /*                             * * BOF alterations for KISS IT ** 		
                              } else {
                              ?>


                              <div class="piGal pull-right">
                              <?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), $kmpiw, $kmpih, 'id="piGalImg_' . $pi_counter . '" data-highres="'. DIR_WS_IMAGES . $product_info['products_image'] .'"'); ?>
                              </div>
                             */
                        } else {
                            list($width, $height) = file_exists(DIR_WS_IMAGES.$product_info['products_image'])
                                    ? getimagesize(DIR_WS_IMAGES.$product_info['products_image'])
                                    : array(150, 150);
                            ?>
                            <div class="piGalDiv">
                                <?php
                                echo tep_image(DIR_WS_IMAGES.$product_info['products_image'],
                                    addslashes($product_info['products_name']),
                                    $kmpiw,
                                    $kmpih,
                                    ((KISSIT_MAIN_PRODUCT_WATERMARK_SIZE > 0) ? preg_replace('%<img width="[0-9 ]+" height="[0-9 ]+" src="(.*)title=.+%',
                                            'data-highres="$1',
                                            tep_image(DIR_WS_IMAGES.$product_info['products_image'],
                                                null, $width, $height)) : 'data-highres="'.DIR_WS_IMAGES.$product_info['products_image'].'"'));
                                ?>

                                <?php /*                                 * * EOF alterations for KISS IT ** */ ?>
                                <?php
                            }
                            echo '</div>';
                        }
                        /* TODO:JS
                          orig: width: '250px' replaced by: width: '45%' mobile small
                         */
                        ?>
                        <script type="text/javascript">
                            $(function () {
                                $('#piGal').css({
                                    'visibility': 'hidden'
                                });

                                $('#piGal').photosetGrid({
                                    layout: '<?php echo ($photoset_layout ? : ''); ?>',
                                    width: '100%',
                                    highresLinks: true,
                                    rel: 'pigallery',
                                    onComplete: function () {
                                        $('#piGal').css({'visibility': 'visible'});

                                        $('#piGal a').colorbox({
                                            maxHeight: '90%',
                                            maxWidth: '90%',
                                            rel: 'pigallery'
                                        });

                                        $('#piGal img').each(function () {
                                            var imgid = $(this).attr('id').substring(9);

                                            if ($('#piGalDiv_' + imgid).length) {
                                                $(this).parent().colorbox({inline: true, href: "#piGalDiv_" + imgid});
                                            }
                                        });
                                    }
                                });
                            });
                        </script>

                        <div itemprop="description">
    <?php echo stripslashes($product_info['products_description']); ?>
                        </div>

                        <?php
                        $products_attributes_query = tep_db_query("select count(*) as total from ".TABLE_PRODUCTS_OPTIONS." popt, ".TABLE_PRODUCTS_ATTRIBUTES." patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $languages_id."'");
                        $products_attributes       = tep_db_fetch_array($products_attributes_query);
                        if ($products_attributes['total'] > 0) {
                            ?>

                            <h4><?php echo _('Options'); ?></h4>

                            <p>
                                <?php
                                $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from ".TABLE_PRODUCTS_OPTIONS." popt, ".TABLE_PRODUCTS_ATTRIBUTES." patrib where patrib.products_id='".(int) $_GET['products_id']."' and patrib.options_id = popt.products_options_id and popt.language_id = '".(int) $languages_id."' order by popt.products_options_name");
                                while ($products_options_name       = tep_db_fetch_array($products_options_name_query)) {
                                    $products_options_array = array();
                                    /*                                     * * Altered for custom change for Custom Attribute Sort Ordering **
                                      $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
                                     */
                                    $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix, pa.products_attributes_id from ".TABLE_PRODUCTS_ATTRIBUTES." pa, ".TABLE_PRODUCTS_OPTIONS_VALUES." pov where pa.products_id = '".(int) $_GET['products_id']."' and pa.options_id = '".(int) $products_options_name['products_options_id']."' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '".(int) $languages_id."'"." order by pov.products_options_values_id, pa.products_attributes_id");
                                    /*                                     * * EOF alteration for Custom Attribute Sort Ordering ** */
                                    while ($products_options       = tep_db_fetch_array($products_options_query)) {
                                        $products_options_array[] = array('id' => $products_options['products_options_values_id'],
                                            'text' => $products_options['products_options_values_name']);
                                        if ($products_options['options_values_price']
                                            != '0') {
                                            $products_options_array[sizeof($products_options_array)
                                                - 1]['text'] .= ' ('.$products_options['price_prefix'].$currencies->display_price($products_options['options_values_price'],
                                                    tep_get_tax_rate($product_info['products_tax_class_id'])).') ';
                                        }
                                    }

                                    if (is_string($_GET['products_id']) && isset($cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']])) {
                                        $selected_attribute = $cart->contents[$_GET['products_id']]['attributes'][$products_options_name['products_options_id']];
                                    } else {
                                        $selected_attribute = false;
                                    }
                                    ?>
                                    <strong><?php echo $products_options_name['products_options_name'].':'; ?></strong><br /><?php
                                    echo tep_draw_pull_down_menu('id['.$products_options_name['products_options_id'].']',
                                        $products_options_array,
                                        $selected_attribute,
                                        'style="width: 200px;"');
                                    ?><br />
                                    <?php
                                }
                                ?>
                            </p>

                            <?php
                        }
                        ?>

                        <div class="clearfix"></div>

                        <?php
                        if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
                            ?>

                            <div class="alert alert-info"><?php
                            echo sprintf(TEXT_DATE_AVAILABLE,
                                tep_date_long($product_info['products_date_available']));
                            ?></div>

        <?php
    }
    ?>

                    </div>

                    <?php
                    $reviews_query = tep_db_query("select count(*) as count, avg(reviews_rating) as avgrating from ".TABLE_REVIEWS." r, ".TABLE_REVIEWS_DESCRIPTION." rd where r.products_id = '".(int) $_GET['products_id']."' and r.reviews_id = rd.reviews_id and rd.languages_id = '".(int) $languages_id."' and reviews_status = 1");
                    $reviews       = tep_db_fetch_array($reviews_query);

                    if ($reviews['count'] > 0) {
                        echo '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><meta itemprop="ratingValue" content="'.$reviews['avgrating'].'" /><meta itemprop="ratingCount" content="'.$reviews['count'].'" /></span>';
                    }
                    ?>

                    <div class="buttonSet row">
                        <div class="col-xs-6"><?php
                            /* pure:new allow reviews */ if (($product_info['product_template']
                                == 1 && ALLOW_REVIEWS == 'true') || ($product_info['product_template']
                                == 3)) {
                                echo tep_draw_button(IMAGE_BUTTON_REVIEWS.(($reviews['count']
                                    > 0) ? ' ('.$reviews['count'].')' : ''),
                                    'fa fa-commenting',
                                    tep_href_link(FILENAME_PRODUCT_REVIEWS,
                                        tep_get_all_get_params(array('atts'))));
                            }
                            ?></div>
                        <div class="col-xs-6 text-right"><?php
                            /* pure:new if product cart TRUE */ if ($product_info['product_template']
                                == 1) {
                                echo tep_draw_hidden_field('products_id',
                                    $product_info['products_id']).tep_draw_button(IMAGE_BUTTON_IN_CART,
                                    'fa fa-shopping-cart', null, 'primary',
                                    null, 'btn-success');
                            }
                            ?></div>
                    </div>

                    <div class="row">
                    <?php echo $oscTemplate->getContent('product_info'); ?>
                    </div>

                    <?php
                    if ((USE_CACHE == 'true') && empty($SID)) {
                        echo tep_cache_also_purchased(3600);
                    } else {
                        include(DIR_WS_MODULES.FILENAME_ALSO_PURCHASED_PRODUCTS);
                    }

                    if ($product_info['manufacturers_id'] > 0) {
                        $manufacturer_query = tep_db_query("select manufacturers_name from ".TABLE_MANUFACTURERS." where manufacturers_id = '".(int) $product_info['manufacturers_id']."'");
                        if (tep_db_num_rows($manufacturer_query)) {
                            $manufacturer = tep_db_fetch_array($manufacturer_query);
                            echo '<span itemprop="manufacturer" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="'.tep_output_string($manufacturer['manufacturers_name']).'" /></span>';
                        }
                    }
                    ?>

                </div>

            </div>

            </form>

            <?php
        }
        require(DIR_WS_INCLUDES.'template_bottom.php');
        require(DIR_WS_INCLUDES.'application_bottom.php');
        ?>

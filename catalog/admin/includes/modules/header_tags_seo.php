<tr><td colspan="2"><table border="0" cellpadding="0" width="100%" style="background-color:#eee; padding:2px; border:2px solid #000;"><tr><td>

                    <div class="main" style="font-weight:bold; padding-bottom:10px;"><?php echo TEXT_PRODUCT_METTA_INFO; ?></div>

                    <?php
                    $langCnt    = $n          = sizeof($languages);
                    $inputWidth = "size=55";
                    $textWidth  = "53";

                    /*                     * ************************************ SHOW THE TITLE AND BREADCRUMB ************************************* */
                    echo '<div style="float:left; width:100%;">';
                    echo '<div class="main" style="float:left; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_PAGE_TITLE.'</div>';
                    echo '<div class="main" style="float:left; padding-bottom:4px; padding-left:330px; font-weight:bold;">'.TEXT_PRODUCTS_BREADCRUMB.'</div>';
                    echo '</div>';

                    for ($i = 0; $i < $langCnt; $i++) {
                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                            $languages[$i]['name']).':</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_input_field('products_head_title_tag['.$languages[$i]['id'].']',
                            (isset($products_head_title_tag[$languages[$i]['id']])
                                    ? stripslashes($products_head_title_tag[$languages[$i]['id']])
                                    : tep_get_products_head_title_tag($pInfo->products_id,
                                    $languages[$i]['id'])), $inputWidth).'</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_input_field('products_head_breadcrumb_text['.$languages[$i]['id'].']',
                            (isset($products_head_breadcrumb_text[$languages[$i]['id']])
                                    ? stripslashes($products_head_breadcrumb_text[$languages[$i]['id']])
                                    : tep_get_products_head_breadcrumb_text($pInfo->products_id,
                                    $languages[$i]['id'])), $inputWidth).'</div>';
                        echo '</div>';
                    }

                    /*                     * ************************************ SHOW THE ALTERNATE AND SEO TITLES ************************************* */
                    echo '<div style="float:left; width:100%;">';
                    echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_PAGE_TITLE_ALT.'</div>';
                    echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:253px; font-weight:bold;">'.TEXT_PRODUCTS_PAGE_TITLE_URL.'</div>';
                    echo '</div>';

                    for ($i = 0; $i < $langCnt; $i++) {
                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                            $languages[$i]['name']).':</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_input_field('products_head_title_tag_alt['.$languages[$i]['id'].']',
                            (isset($products_head_title_tag_alt[$languages[$i]['id']])
                                    ? stripslashes($products_head_title_tag_alt[$languages[$i]['id']])
                                    : tep_get_products_head_title_tag_alt($pInfo->products_id,
                                    $languages[$i]['id'])), $inputWidth).'</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_input_field('products_head_title_tag_url['.$languages[$i]['id'].']',
                            (isset($products_head_title_tag_url[$languages[$i]['id']])
                                    ? stripslashes($products_head_title_tag_url[$languages[$i]['id']])
                                    : tep_get_products_head_title_tag_url($pInfo->products_id,
                                    $languages[$i]['id'])), $inputWidth).'</div>';
                        echo '</div>';
                    }

                    /*                     * ************************************ SHOW THE DESCRIPTION AND KEYWORDS ************************************* */
                    echo '<div style="float:left; width:100%;">';
                    echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_HEADER_DESCRIPTION.'</div>';
                    echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:277px; font-weight:bold;">'.TEXT_PRODUCTS_KEYWORDS.'</div>';
                    echo '</div>';

                    for ($i = 0; $i < $langCnt; $i++) {
                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                            $languages[$i]['name']).':</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_textarea_field('products_head_desc_tag['.$languages[$i]['id'].']',
                            'soft', $textWidth, '7',
                            (isset($products_head_desc_tag[$languages[$i]['id']])
                                    ? stripslashes($products_head_desc_tag[$languages[$i]['id']])
                                    : tep_get_products_head_desc_tag($pInfo->products_id,
                                    $languages[$i]['id']))).'</div>';
                        echo '<div class="main" style="float:left; padding-left:10px;">'.tep_draw_textarea_field('products_head_keywords_tag['.$languages[$i]['id'].']',
                            'soft', $textWidth, '7',
                            (isset($products_head_keywords_tag[$languages[$i]['id']])
                                    ? stripslashes($products_head_keywords_tag[$languages[$i]['id']])
                                    : tep_get_products_head_keywords_tag($pInfo->products_id,
                                    $languages[$i]['id']))).' </div>';
                        echo '</div>';
                    }


                    /*                     * ************************************ SHOW THE PRODUCT LISTING AND SUB TEXT ************************************* */
                    if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'No Editor' || HEADER_TAGS_ENABLE_EDITOR_LISTING_TEXT
                        == 'false') {
                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_LISTING_TEXT.'</div>';
                        echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:258px; font-weight:bold;">'.TEXT_PRODUCTS_SUB_TEXT.'</div>';
                        echo '</div>';

                        for ($i = 0; $i < $langCnt; $i++) {
                            echo '<div style="float:left; width:100%;">';
                            echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                $languages[$i]['name']).':</div>';
                            echo '<div class="main" style="float:left; padding-left:10px;">';
                            echo tep_draw_textarea_field('products_head_listing_text['.$languages[$i]['id'].']',
                                'soft', $textWidth, '7',
                                (isset($products_head_listing_text[$languages[$i]['id']])
                                        ? stripslashes($products_head_listing_text[$languages[$i]['id']])
                                        : tep_get_products_head_listing_text($pInfo->products_id,
                                        $languages[$i]['id'])));
                            echo '</div>';
                            echo '<div class="main" style="float:left; padding-left:10px;">';
                            echo tep_draw_textarea_field('products_head_sub_text['.$languages[$i]['id'].']',
                                'soft', $textWidth, '7',
                                (isset($products_head_sub_text[$languages[$i]['id']])
                                        ? stripslashes($products_head_sub_text[$languages[$i]['id']])
                                        : tep_get_products_head_sub_text($pInfo->products_id,
                                        $languages[$i]['id'])));
                            echo '</div></div>';
                        }
                    } else if (HEADER_TAGS_ENABLE_HTML_EDITOR != 'No Editor' && HEADER_TAGS_ENABLE_EDITOR_LISTING_TEXT
                        != 'false') {
                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_LISTING_TEXT.'</div>';
                        echo '</div>';

                        for ($i = 0; $i < $langCnt; $i++) {
                            echo '<div style="float:left; width:100%;">';
                            echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                $languages[$i]['name']).':</div>';
                            echo '<div class="main" style="float:left; padding-left:10px;">';

                            if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'FCKEditor') {
                                echo tep_draw_fckeditor('products_head_listing_text['.$languages[$i]['id'].']',
                                    $textWidth, '300',
                                    (isset($products_head_listing_text[$languages[$i]['id']])
                                            ? $products_head_listing_text[$languages[$i]['id']]
                                            : tep_get_products_head_listing_text($pInfo->products_id,
                                            $languages[$i]['id'])));
                            } else if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'CKEditor') {
                                echo tep_draw_textarea_field('products_head_listing_text['.$languages[$i]['id'].']',
                                    'soft', $textWidth, '15',
                                    (isset($products_head_listing_text[$languages[$i]['id']])
                                            ? $products_head_listing_text[$languages[$i]['id']]
                                            : tep_get_products_head_listing_text($pInfo->products_id,
                                            $languages[$i]['id'])),
                                    'id = "products_head_listing_text['.$languages[$i]['id'].']" class="ckeditor"');
                            } else {
                                echo tep_draw_textarea_field('products_head_listing_text['.$languages[$i]['id'].']',
                                    'soft', $textWidth, '7',
                                    (isset($products_head_listing_text[$languages[$i]['id']])
                                            ? $products_head_listing_text[$languages[$i]['id']]
                                            : tep_get_products_head_listing_text($pInfo->products_id,
                                            $languages[$i]['id'])));
                            }

                            echo '</div>';
                        }

                        echo '<div style="float:left; width:100%;">';
                        echo '<div class="main" style="float:left; padding-top:20px; padding-bottom:4px; padding-left:72px; font-weight:bold;">'.TEXT_PRODUCTS_SUB_TEXT.'</div>';
                        echo '</div>';

                        for ($i = 0; $i < $langCnt; $i++) {
                            echo '<div style="float:left; width:100%;">';
                            echo '<div class="main" style="float:left; font-weight:bold; color:#888; width:60px;">'.tep_image(DIR_WS_CATALOG_LANGUAGES.$languages[$i]['directory'].'/images/'.$languages[$i]['image'],
                                $languages[$i]['name']).':</div>';
                            echo '<div class="main" style="float:left; padding-left:10px;">';

                            if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'FCKEditor') {
                                echo tep_draw_fckeditor('products_head_sub_text['.$languages[$i]['id'].']',
                                    $textWidth, '300',
                                    (isset($products_head_sub_text[$languages[$i]['id']])
                                            ? $products_head_sub_text[$languages[$i]['id']]
                                            : tep_get_products_head_sub_text($pInfo->products_id,
                                            $languages[$i]['id'])));
                            } else if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'CKEditor') {
                                echo tep_draw_textarea_field('products_head_sub_text['.$languages[$i]['id'].']',
                                    'soft', $textWidth, '15',
                                    (isset($products_head_sub_text[$languages[$i]['id']])
                                            ? $products_head_sub_text[$languages[$i]['id']]
                                            : tep_get_products_head_sub_text($pInfo->products_id,
                                            $languages[$i]['id'])),
                                    'id = "products_head_sub_text['.$languages[$i]['id'].']" class="ckeditor"');
                            } else {
                                echo tep_draw_textarea_field('products_head_sub_text['.$languages[$i]['id'].']',
                                    'soft', $textWidth, '7',
                                    (isset($products_head_sub_text[$languages[$i]['id']])
                                            ? $products_head_sub_text[$languages[$i]['id']]
                                            : tep_get_products_head_sub_text($pInfo->products_id,
                                            $languages[$i]['id'])));
                            }

                            echo '</div></div>';
                        }
                    }
                    ?>
                </td></tr></table></td></tr>
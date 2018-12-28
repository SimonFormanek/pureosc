<?php
$loc                  = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
$ogArray              = array();
$ogArray['site_name'] = STORE_NAME;
$ogArray['locale']    = str_replace('-', '_', $loc[0]);
$showOG               = false;
$showTwitter          = false;

$twitterArray = array();
$db_query     = tep_db_query("select groupname as storename, data as creator from ".TABLE_HEADERTAGS_SOCIAL." where section = 'twitter'");
$db           = array();
if (tep_db_num_rows($db_query)) {
    $db             = tep_db_fetch_array($db_query);
    $twitterArray[] = '<meta name="twitter:card" content="summary">';
    $twitterArray[] = '<meta name="twitter:site" content="@'.$db['storename'].'">';
    $showTwitter    = true;
}

switch (true) {
    case (basename($_SERVER['SCRIPT_FILENAME']) === FILENAME_DEFAULT):
        if ($category_depth == 'top') {
            $img = (file_exists('store_logo.png') ? tep_href_link(DIR_WS_IMAGES.'store_logo.png',
                    '', $request_type, false, false) : '');

            if (!tep_not_null($canonical_url)) {
                $canonical_url = GetCanonicalURL();
            }

            $twitterArray[] = '<meta name="twitter:creator" content="@'.$db['creator'].'">';
            $twitterArray[] = '<meta name="twitter:url" content="'.tep_href_link(FILENAME_DEFAULT,
                    '', $request_type, false).'">';
            $twitterArray[] = '<meta name="twitter:title" content="'.$header_tags_array['title'].'">';
            $twitterArray[] = '<meta name="twitter:description" content="'.$header_tags_array['desc'].'">';
            $twitterArray[] = '<meta name="twitter:image" content="'.$img.'">';

            $ogArray['type']  = 'website';
            $ogArray['image'] = $img;
            $ogArray['url']   = $canonical_url;
            $showOG           = true;
        }
        break;

    case (basename($_SERVER['SCRIPT_FILENAME']) === FILENAME_PRODUCT_INFO):
    case (basename($_SERVER['SCRIPT_FILENAME']) === FILENAME_PRODUCT_REVIEWS):
    case (basename($_SERVER['SCRIPT_FILENAME']) === FILENAME_PRODUCT_REVIEWS_INFO):
        if ($_GET['products_id'] > 0) {
            $og_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_quantity, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_available from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_status = '1' and p.products_id = '".(int) $_GET['products_id']."' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."'");

            if (tep_db_num_rows($og_query) > 0) {
                $og = tep_db_fetch_array($og_query);

                $img = (tep_not_null($og['products_image']) ? tep_href_link(DIR_WS_IMAGES.$og['products_image'],
                        '', $request_type, false, false) : '');
                $url = tep_href_link(FILENAME_PRODUCT_INFO,
                    'products_id='.$og['products_id'], $request_type, false);

                /*                 * ** Get the price *** */
                if (($new_price = tep_get_products_special_price($og['products_id']))) {
                    
                } else {
                    $new_price = $og['products_price'];
                }
                $og_price = $currencies->display_price($new_price,
                    tep_get_tax_rate($og['products_tax_class_id']));

                $twitterArray[] = '<meta name="twitter:creator" content="@'.$db['creator'].'">';
                $twitterArray[] = '<meta name="twitter:url" content="'.$url.'">';
                $twitterArray[] = '<meta name="twitter:title" content="'.htmlspecialchars($og['products_name'],
                        ENT_QUOTES).'">';
                $twitterArray[] = '<meta name="twitter:description" content="'.GetOGDescription($og['products_description']).'">';
                $twitterArray[] = '<meta name="twitter:image" content="'.$img.'">';

                $twitterArray[] = '<meta name="twitter:data1" content="'.$og_price.'">';
                $twitterArray[] = '<meta name="twitter:label1" content="'.HTS_OG_PRICE.'">';

                $twitterArray[] = '<meta name="twitter:data2" content="'.$og['products_quantity'].'">';
                $twitterArray[] = '<meta name="twitter:label2" content="'.HTS_OG_AVAILABLE_STOCK.'">';

                $ogArray['type']         = 'product';
                $ogArray['title']        = htmlspecialchars($og['products_name'],
                    ENT_QUOTES);
                $ogArray['description']  = GetOGDescription($og['products_description']);
                $ogArray['image']        = $img;
                $ogArray['url']          = $url;
                $ogArray['price']        = $og_price;
                $ogArray['currency']     = $currency;
                $ogArray['availability'] = ($og['products_date_available'] > date('Y-m-d H:i:s')
                        ? 'pending' :
                    $og['products_quantity'] < 1 ? 'oos' :
                    $og['products_quantity'] > 0 ? 'instock' : 'oos');
                $showOG                  = true;
            }
        }
        break;

    case (defined('FILENAME_ARTICLE_INFO') && basename($_SERVER['SCRIPT_FILENAME'])
    === FILENAME_ARTICLE_INFO):
        if ($_GET['articles_id'] > 0) {
            $og_query = tep_db_query("select a.articles_date_added, a.articles_last_modified, ad.articles_image, ad.articles_name, a.authors_id, ad.articles_description, ad.articles_url, au.authors_name, td.topics_name from ".
                TABLE_ARTICLES." a left join ".
                TABLE_AUTHORS." au on a.authors_id = au.authors_id left join ".
                TABLE_ARTICLES_DESCRIPTION." ad on a.articles_id = ad.articles_id left join ".
                TABLE_ARTICLES_TO_TOPICS." a2t on a.articles_id = a2t.articles_id left join ".
                TABLE_TOPICS_DESCRIPTION." td on a2t.topics_id = td.topics_id
              where a.articles_status = '1' and a.articles_id = '".(int) $_GET['articles_id']."' and ad.language_id = '".(int) $languages_id."'");
            if (tep_db_num_rows($og_query) > 0) {
                $og = tep_db_fetch_array($og_query);

                $img = (tep_not_null($og['articles_image']) ? tep_href_link(DIR_WS_IMAGES.$og['articles_image'],
                        '', $request_type, false, false) : '');
                $url = tep_href_link(FILENAME_ARTICLE_INFO,
                    'article_id='.$og['articles_id'], $request_type, false);

                $twitterArray[] = '<meta name="twitter:creator" content="@'.(tep_not_null($og['authors_name'])
                        ? $og['authors_name'] : $db['creator']).'">';
                $twitterArray[] = '<meta name="twitter:url" content="'.$url.'">';
                $twitterArray[] = '<meta name="twitter:title" content="'.htmlspecialchars($og['articles_name'],
                        ENT_QUOTES).'">';
                $twitterArray[] = '<meta name="twitter:description" content="'.GetOGDescription($og['articles_description']).'">';
                $twitterArray[] = '<meta name="twitter:image" content="'.$img.'">';

                $ogArray['type']            = 'article';
                $ogArray['url']             = $url;
                $ogArray['description']     = GetOGDescription($og['articles_description']);
                $ogArray['tag']             = $header_tags_array['keywords'];
                if (isset($og['articles_date_added'][1]))
                        $ogArray['published_time']  = $og['articles_date_added'];
                if (isset($og['articles_last_modified'][1]))
                        $ogArray['modified_time']   = $og['articles_last_modified'];
                if (isset($og['expiration_time'][1]))
                        $ogArray['expiration_time'] = $og['expiration_time'];
                if (isset($og['authors_name'][1]))
                        $ogArray['author']          = $og['authors_name'];
                if (isset($og['authors_id'][1]))
                        $ogArray['author']          = tep_href_link(FILENAME_ARTICLES,
                        'authors_id='.$og['authors_id'], $request_type, false);
                if (isset($og['topics_name'][1]))
                        $ogArray['section']         = $og['topics_name'];
                if (isset($og['articles_image'][1])) $ogArray['image']           = $img;

                $showOG = true;
            }
        }
        break;
}

if ($showTwitter) {
    foreach ($twitterArray as $tag => $data) {
        echo $data."\n";
    }
}

if ($showOG) {
    foreach ($ogArray as $tag => $data) {
        echo '<meta property="og:'.$tag.'" content="'.$data.'" />'."\n";
    }
}
?> 
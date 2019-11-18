<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC;

/**
 * Description of Product
 *
 * @author vitex
 */
class Product extends \Ease\SQL\Engine {

    public function __construct($products_id = null,$options = []) {
        $this->myTable = 'products';
        $this->keyColumn = 'products_id';
        $this->setMyKey($products_id);
        $this->setUp($options);
        if($products_id){
            $this->loadFromSQL($products_id);
        }
    }

    /**
     * Obtain Available prices for product
     * 
     * @param int $products_id
     * @param int $languages_id
     * 
     * @return array
     */
    public static function getAvailablePrices($products_id, $languages_id) {
        $prices = [];
        foreach (self::getProductsOptions($products_id, $languages_id) as $products_options) {

            if ((intval($products_options['options_values_price']) > 0) && ($products_options['options_values_active'] > 0) && ($products_options['options_values_nobuy'] < 1)) {

                $prices[$products_options['products_options_values_name']] = $products_options['options_values_price'];
            }
        }
        return $prices;
    }

    public static function getProductsOptions($products_id, $languages_id) {
        $options = [];
        $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $products_id . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int) $languages_id . "' order by popt.products_options_sort_order");

        while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
            //$products_options_array = array();
            $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.options_values_active, pa.options_values_nobuy, pa.options_values_ean, pa.options_values_color, pa.price_prefix, pa.products_attributes_id, pa.products_options_sort_order, pa.options_id FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $products_id . "' and pa.options_id = '" . (int) $products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int) $languages_id . "'" . " order by pa.products_options_sort_order");
            //order by pov.products_options_values_id, pa.products_attributes_id

            while ($products_options = tep_db_fetch_array($products_options_query)) {
                $options[$products_options['products_attributes_id']] = $products_options;
            }
        }
        return $options;
    }

    /*
      public static function parseName($name, &$color=false)
      {

      if(($p = strpos($name, '#')) !== false) {

      $ret = substr($name, 0, $p);
      $color = substr($name, $p);

      } else {
      $ret = $name;
      $color = false;
      }

      return $ret;
      }
     */


    /*

      $product_info_query = tep_db_query("select p.products_id, p.product_template, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd where p.products_status = '1' and p.products_id = '".$products_id."' and pd.products_id = p.products_id and pd.language_id = '".(int) $languages_id."'");
      $product_info = tep_db_fetch_array($product_info_query);

      tep_db_query("update ".TABLE_PRODUCTS_DESCRIPTION." set products_viewed = products_viewed+1 where products_id = '".$products_id."' and language_id = '".(int) $languages_id."'");

      $palette = false;
      $optValId = isset($_GET['optid']) ? $_GET['optid'] : 0;

      $prodOpts = \PureOSC\Product::getProductsOptions($products_id, $languages_id);
      //echo var_export($prodOpts, true);
      foreach($prodOpts as $product_options_id => $product_options) {

      if((! $optValId) && ($product_options['options_values_active']>0) && ($product_options['options_values_nobuy']<1)) {
      //vzit 1.polozku (pokud neni neaktivni/nedostupna)
      $optId = $product_options['options_id'];
      $optValId = $product_options['products_options_values_id'];
      $imgSortOrder = $product_options['products_options_sort_order'];
      if(trim($product_options['options_values_color']) != '') $palette = true;
      //$palette = (trim($product_options['options_values_color']) != '') ? true : false;
      break;
      }
      //jinak iterace, dokud se nenajde
      if($optValId == $product_options['products_options_values_id']) {
      $optId = $product_options['options_id'];
      $imgSortOrder = $product_options['products_options_sort_order'];
      if(trim($product_options['options_values_color']) != '') $palette = true;
      break;
      }
      }

      $img_emg = '';

      $imgQ = tep_db_query($qs = "SELECT image FROM ".TABLE_PRODUCTS_IMAGES." WHERE products_id = ".$products_id." AND opt_id = ".$optValId);

      if(tep_db_num_rows($imgQ) < 1) {
      $imgQ = tep_db_query("SELECT image FROM ".TABLE_PRODUCTS_IMAGES." WHERE products_id = ".$products_id." ORDER BY sort_order");

      $img_emg = '<h3>WARNING - PRODUKT NEMA PRIRAZENY OBRAZEK PRO AKTUALNI ATRIBUT!</h3>';
      }


      $new_price = tep_get_products_special_price($product_info['products_id']);

      if ($new_price) {

      } else {

      if ((floatval($product_info['products_price'])) && ($product_info['products_price'] > 0)) {
      } else { //Product variant prices

      $selData = [];
      foreach($prodOpts as $oK => $oV) {

      if($oV['products_options_values_id'] == $optValId) $actOpt = $oV;

      if($oV['options_values_active'] > 0) $selData[] = ['id'=>$oV['products_options_values_id'],
      'text'=>$oV['products_options_values_name'] . ' '.$currencies->display_price($oV['options_values_price'],
      tep_get_tax_rate($product_info['products_tax_class_id'])) . (($oV['options_values_nobuy']>0) ? ' (dočasně nedostupné)' : ''),
      'disabled'=>$oV['options_values_nobuy']
      ];

      }


     */
}

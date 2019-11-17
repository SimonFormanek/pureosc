<?php

/*
 * Example usage:
 * 
$fastCartForm = new PureOSC\ui\AddVariantToCartForm($products_id);
$fastCartForm->addItem( new Ease\Html\InputNumberTag('cart_quantity['.$products_id.']', 1,['title'=>_('pieces')]) );
$fastCartForm->finalize();
echo $fastCartForm;
 *  
 */

namespace PureOSC\ui;

/**
 * Description of AddVariantToCartForm
 *
 * @author vitex
 */
class AddVariantToCartForm extends \Ease\Html\Form {

    /**
     *
     * @var \PureOSC\Product 
     */
    public $productor;

    /**
     *
     * @var \PureOSC\currencies 
     */
    public $currencies;

    //put your code here


    public function __construct(int $products_id) {

        global $languages_id;

        $this->productor = new \PureOSC\Product($products_id);
        $this->currencies = new \PureOSC\currencies();


        parent::__construct($this->productor->getDataValue('products_name'), \Ease\Functions::addUrlParams(WebPage::getUri(), ['action' => 'add_product']), 'POST', new \Ease\Html\InputHiddenTag('products_id', $products_id));

        $prices = \PureOSC\Product::getProductsOptions($products_id, $languages_id);
        $oId = current($prices)['options_id'];

        if (count($prices) > 1) {
            $select = new \Ease\Html\SelectTag('id[' . $oId . ']', $this->pricesToOptions($prices));
            foreach ($prices as $priceInfo)  {
                if($priceInfo['options_values_active'] != 1){
                    $select->disableItem( $priceInfo['products_options_values_id']  );
                }
            }
        } else {
            $price = current($prices);
            $select = new \Ease\Html\InputHiddenTag('id[' . $oId . ']', current($prices)['products_options_values_id']);
            $this->addItem(new \Ease\Html\SpanTag($price['products_options_values_name'] . ' ' . $this->currencies->display_price($price['options_values_price'], $this->productor->getDataValue('products_tax_id')) . ' '));
        }

        $this->addItem($select);
    }

    /**
     * 
     * @param array $prices
     * 
     * @return string
     */
    public function pricesToOptions(array $prices) {
        $options = [];

        foreach ($prices as $priceId => $priceInfo) {
            $options[$priceInfo['products_options_values_id']] = $priceInfo['products_options_values_name'] . ' ' . $this->currencies->display_price($priceInfo['options_values_price'], tep_get_tax_rate($this->productor->getDataValue('products_tax_class_id')));
        }

        return $options;
    }

    public function finalize() {
        $this->addItem(new \Ease\Html\SubmitButton('&nbsp;'._('To Cart'), ' '. _('Add To Cart'), _('To Cart')));
        parent::finalize();
    }

}

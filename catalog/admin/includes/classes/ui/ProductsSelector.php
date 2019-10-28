<?php

namespace PureOSC\Admin\ui;

use Ease\Html\SelectTag;

/**
 * Description of DiscountSelector
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class ProductsSelector extends SelectTag
{
    use \Ease\SQL\Orm;
    
    public $myTable = 'products';
    
    public function __construct($name, $value = null, $properties = [])
    {
        $properties['multiple'] = 'multiple';
        $this->setUp($properties);
        parent::__construct($name,$this->loadItems(), null, $value, $properties);
    }

    public function loadItems(): array
    {
        
        global $languages_id;

        foreach ($this->getFluentPDO()->from('products')->select('products_description.products_name as pname')->leftJoin('products_description ON products_description.products_id = products.products_id')->where('products_description.language_id',(int) $languages_id)->orderBy("products_description.products_name")->fetchAll() as $productInfo){
                $menuItems[$productInfo['products_id']] = $productInfo['pname'] .' '. $productInfo['products_model'];
        }        
 
        return $menuItems;
    }

    public function finalize() {
        $this->includeJavaScript('../ext/select2/js/select2.js');
        $this->addJavaScript(" $('#". $this->getTagID() ."').select2();");
    }
    
}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin;

/**
 * Description of Coupon
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Coupon extends \Ease\SQL\Engine {

    public $myTable = 'coupons';
    public $myKeyColumn = 'coupon_id';

    public function __construct($identifier = null, $options = array()) {
        $this->myKeyColumn = 'coupon_id';
        $this->setUp($options);
        $this->setkeyColumn($this->myKeyColumn);
        if (!is_null($identifier)) {
            $this->setMyKey(intval($identifier));
        }
        parent::__construct($identifier, $options);
    }

    public function takeData($data) {
        if (array_key_exists('restrict_to_customers', $data)) {
            $data['restrict_to_customers'] = strval($data['restrict_to_customers']);
        }
        return parent::takeData($data);
    }

    /**
     * Assign One product to Coupoun
     * 
     * @param int $products_id
     * 
     * @return int
     */
    public function assignProduct($products_id) {
        $result = false;
        $this->myKeyColumn = 'coupon_id';

        $currentRaw = $this->getDataValue('restrict_to_products');

        $newMembers = strstr($currentRaw, ',') ? array_combine(explode(',',
                                $currentRaw), explode(',', $currentRaw)) : array_combine([$currentRaw], [$currentRaw]);

        if (array_key_exists($products_id, $newMembers)) {
            $result = true;
        } else {
            $newMembers[$products_id] = $products_id;
            $this->setDataValue('restrict_to_products',
                    implode(',', $newMembers));
            $result = $this->updateToSQL();
        }

        return $result;
    }

    /**
     * Assign all products in category to Coupoun
     * 
     * @param int $categories_id
     */
    public function assignCategory($categories_id) {
        $tepCT = tep_get_category_tree($categories_id);
        $tepCT[0]['id'] = $categories_id;
        foreach ($tepCT as $category) {
            $categoryMembers = $this->getFluentPDO()->from(cfg('TABLE_PRODUCTS_TO_CATEGORIES'))->where('categories_id', $category['id'])->fetchAll();
            foreach ($categoryMembers as $memberId) {
                $this->assignProduct((int) $memberId['products_id']);
            }
        }
    }

}

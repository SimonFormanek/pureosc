<?php

namespace PureOSC\Admin\ui;

use Ease\Html\OptionTag;
use Ease\Html\SelectTag;
use PureOSC\Admin\Coupon;
use function __;

/**
 * Description of DiscountSelector
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class DiscountSelector extends SelectTag {

    public $memberId = null;
    public $memberType = null;
    public $discounts = [];

    public function __construct($name, int $memberId, string $mode = 'product',
            $properties = array()) {
        $this->memberType = $mode;
        $this->memberId = $memberId;
        parent::__construct($name,$memberId);
        $this->addItems($this->loadItems());
    }

    public function loadItems(): array {
        $coupouner = new Coupon();
        $menuItems = [''=>_('None')];
        $this->discounts = $coupouner->getColumnsFromSQL('*', null, 'coupon_code',
                'coupon_id');
        if (!empty($this->discounts)) {
            foreach ($this->discounts as $discountId => $discountInfo) {
                $menuItems [$discountId] = $discountInfo['coupon_code'];
            }
        }
        return $menuItems;
    }

    public function memberOfDiscount($memberId) {

        $myDiscounts = \Ease\Functions::reindexArrayBy($this->discounts, 'coupon_code');

        $candidates = $this->memberType == 'product' ? $this->discounts[$memberId]['restrict_to_products'] : $this->discounts[$memberId]['restrict_to_cathegories'];

        $candidatesArray = strstr($candidates, ',') ? explode(',', $candidates) : [
        ];

        return array_key_exists($memberId, $candidatesArray);
    }

    /**
     * Hromadné vložení položek.
     *
     * @param array $items položky výběru
     */
    public function addItems($items) {
        foreach ($items as $itemName => $itemValue) {
            $newItem = $this->addItem(new OptionTag($itemValue, $itemName));
            if ($this->memberOfDiscount($itemName)) {
                $newItem->setDefault();
            }
        }
    }

}

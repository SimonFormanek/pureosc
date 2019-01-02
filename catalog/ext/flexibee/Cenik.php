<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\flexibee;

/**
 * Description of Customer
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Cenik extends \FlexiPeeHP\Cenik
{

    use \Ease\SQL\Orm;
    public $nameColumn = 'nazev';

    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
        $this->takemyTable('products');
    }

    public function convertOscData($productData, $lang = 'cs')
    {
        if (!empty($productData['products_id'])) {
            $cenikData['id'] = 'ext:products:'.$productData['products_id'];
        }
        if (!empty($productData['products_price'])) {
            $cenikData['cenaZakl'] = $productData['products_price'];
        }

        if (array_key_exists('products_tax_class_id', $productData)) {
            switch ($productData['products_tax_class_id']) {
                 case 0:
                    $cenikData['typSzbDphK'] = 'typSzbDph.dphOsv';
                    break;

                 case 1:
                    $cenikData['typSzbDphK'] = 'typSzbDph.dphSniz';
                    break;

                 case 2:
                    $cenikData['typSzbDphK'] = 'typSzbDph.dphZakl';
                    break;

                case 3:
                    $cenikData['typSzbDphK'] = 'typSzbDph.dphSniz2';
                    break;

                default:
                    break;
            }
        }

        switch ($lang) {
            case 'en':
                if (isset($productData['products_name'])) {
                    $cenikData['nazevA'] = $productData['products_name'];
                }
                break;
            case 'de':
                if (isset($productData['products_name'])) {
                    $cenikData['nazevB'] = $productData['products_name'];
                }
                break;

            case 'fr':
                if (isset($productData['products_name'])) {
                    $cenikData['nazevC'] = $productData['products_name'];
                }
                break;

            default:
                if (isset($productData['products_name'])) {
                    $cenikData['nazev'] = $productData['products_name'];
                }
                if (isset($productData['products_description'])) {
                    $cenikData['popis'] = $productData['products_description'];
                }
                $kodSource = empty($productData['products_model']) ? !empty($productData['products_name'])
                        ? $productData['products_name'] : $productData['products_model']
                        : $productData['products_seo_title'];


                $cenikData['poznam'] = _('FlexiBee import');
                if (!empty($kodSource)) {
                    $cenikData['kod'] = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));
                }
                break;
        }


        return $cenikData;
    }
}

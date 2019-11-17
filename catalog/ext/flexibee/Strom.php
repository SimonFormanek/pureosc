<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\flexibee;

/**
 * Description of Strom
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Strom extends \FlexiPeeHP\Strom
{

    use \Ease\SQL\Orm;


    public function __construct($init = null, $options = array())
    {
        $this->myTable = 'categories';
        parent::__construct($init, $options);
        $this->setDataValue('strom', self::code('STR_CEN'));
    }

    public function convertOscData($categoryData, $langCode = 'cs')
    {
        $stromData['id'] = 'ext:categories:'.$categoryData['categories_id'];
        if (isset($categoryData['parent_id'])) {
            $stromData['otec'] = 'ext:categories:'.$categoryData['parent_id'];
        }
        
        if(isset($categoryData['sort_order'])){
            $stromData['poradi'] = $categoryData['sort_order'];
        } else {
            $stromData['poradi'] = 1;
        }
        
        switch ($langCode) {
            case 'cs':
                $stromData['nazev']  = $categoryData['categories_name'];
                $stromData['popis']  = $categoryData['categories_description'];
                $stromData['poznam'] = _('FlexiBee import');
                $kodSource           = empty($categoryData['categories_seo_title'])
                        ? $categoryData['categories_name'] : $categoryData['categories_seo_title'];
                $stromData['kod']    = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));
                break;
            case 'en':
                $stromData['nazevA'] = $categoryData['categories_name'];
                break;

            default:
                break;
        }



        return $stromData;
    }
}

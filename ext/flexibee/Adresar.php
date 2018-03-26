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
class Adresar extends \FlexiPeeHP\Adresar
{

    use \Ease\SQL\Orm;
    public $nameColumn = 'nazev';

    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
        $this->takemyTable('customers');
    }

    public function convertOscData($customerData)
    {
        $adresarData['id'] = 'ext:customers:'.$customerData['customers_id'];

        $adresarData['email']  = $customerData['customers_email_address'];
        $adresarData['tel']    = $customerData['customers_telephone'];
        $adresarData['nazev']  = $customerData['customers_firstname'].' '.$customerData['customers_lastname'];
        $kodSource             = $customerData['customers_lastname'].$customerData['customers_firstname'];
        $adresarData['poznam'] = _('FlexiBee import');

        $firstContactData = empty($customerData['customers_id']) ? [] : $this->getFirstContact($customerData['customers_id']);
        if (count($firstContactData)) {
            $adresarData['ic']    = $firstContactData['ico'];
            $kodSource            = $adresarData['nazev'] = $firstContactData['entry_company'];

            $adresarData['dic']   = $firstContactData['entry_company_tax_id'];
            $adresarData['ic']    = $firstContactData['entry_company_id'];
            $adresarData['ulice'] = $firstContactData['entry_street_address'];
            $adresarData['mesto'] = $firstContactData['entry_city'];
            $adresarData['psc']   = $firstContactData['entry_postcode'];
            $adresarData['stat']  = $this->oscCountryCode($firstContactData['entry_country_id']);
        }
        $adresarData['kod'] = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));

        return $adresarData;
    }

    public function getFirstContact($customerData)
    {
        $contactRaw = $this->dblink->queryToArray('SELECT * FROM address_book WHERE customers_id='.$customerData['customers_id'].' LIMIT 1');
        return empty($contactRaw) ? [] : current($contactRaw);
    }

    public function getContacts($customerId)
    {
        $contactRaw = $this->dblink->queryToArray('SELECT * FROM address_book WHERE customers_id='.$customerId);
        return empty($contactRaw) ? [] : $contactRaw;
    }

    public function oscCountryCode($countryID)
    {
        $countryCode = $this->dblink->queryToValue('SELECT countries_iso_code_2 FROM countries WHERE countries_id = '.$countryID);
        return empty($countryCode) || ($countryCode == 'null') ? [] : \FlexiPeeHP\FlexiBeeRO::code($countryCode);
    }
}

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
    use \Ease\RecordKey;
    
    public $nameColumn = 'nazev';

    public $myTable = 'customers';


    public function __construct($init = null, $options = array())
    {
        parent::__construct($init, $options);
    }

    public function convertOscData($customerData)
    {
        if (array_key_exists('customers_id', $customerData)) {
            $adresarData['id'] = 'ext:customers:'.$customerData['customers_id'];
        }

        if (array_key_exists('customers_email_address', $customerData)) {
            $adresarData['email'] = $customerData['customers_email_address'];
        }
        if (array_key_exists('customers_telephone', $customerData)) {
            $adresarData['tel'] = $customerData['customers_telephone'];
        }

        if (array_key_exists('customers_lastname', $customerData) && array_key_exists('customers_firstname',
                $customerData)) {
            $adresarData['nazev'] = $customerData['customers_firstname'].' '.$customerData['customers_lastname'];

            $kodSource = empty($customerData['customers_lastname'].$customerData['customers_firstname']) ? $customerData['customers_id'] : $customerData['customers_lastname'].$customerData['customers_firstname'];

            $firstContactData = empty($customerData['customers_id']) ? [] : $this->getFirstContact($customerData['customers_id']);
            if (count($firstContactData)) {
                $adresarData['ic']    = $firstContactData['entry_company_number'];
                $adresarData['dic']   = $firstContactData['entry_company_tax_id'];
                $adresarData['ulice'] = $firstContactData['entry_street_address'];
                $adresarData['mesto'] = $firstContactData['entry_city'];
                $adresarData['psc']   = $firstContactData['entry_postcode'];
                $adresarData['stat']  = $this->oscCountryCode($firstContactData['entry_country_id']);
            }
        }

        if (array_key_exists('entry_company', $customerData)) {
            $adresarData['nazev'] = $customerData['entry_company'];
        } else {
            if (array_key_exists('entry_firstname', $customerData) || array_key_exists('entry_lastname',
                    $customerData)) {
                $adresarData['nazev'] = $customerData['entry_firstname'].' '.$customerData['entry_lastname'];
            }
        }

        if (array_key_exists('entry_city', $customerData)) {
            $adresarData['mesto'] = $customerData['entry_city'];
        }

        if (array_key_exists('entry_street_address', $customerData)) {
            $adresarData['ulice'] = $customerData['entry_street_address'];
        }
        
        
        if (array_key_exists('entry_company_number', $customerData)) {
            $adresarData['ic'] = $customerData['entry_company_number'];
        }
        
        if (array_key_exists('entry_vat_number', $customerData)) {
            $adresarData['dic'] = $customerData['entry_vat_number'];
        }



        return $adresarData;
    }

    public function getFirstContact($customerId)
    {
        
        
        
        $contactRaw = (new  \Ease\SQL\Engine(null,['myTable'=>'address_book']))->listingQuery()->orderBy('customers_lastname,customers_firstname')->where('customers_id',$customerId)->fetch();
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

    /**
     * Take SQL Data and prepare for use with FlexiBee
     * 
     * @param array $sqlDataArray
     * 
     * @return int
     */
    public function takeSQLData($sqlDataArray)
    {
        return $this->takeData($this->convertOscData($sqlDataArray));
    }
   
  
}

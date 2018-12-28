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
class Kontakt extends \FlexiPeeHP\Kontakt
{

    public function convertOscData($contactData)
    {
        if (array_key_exists('address_book_id', $contactData)) {
        $kontaktData['id'] = 'ext:contact:'.$contactData['address_book_id'];
        }
        if (empty($contactData['entry_company'])) {
            $kodSource = $contactData['entry_firstname'].' '.$contactData['entry_lastname'];
        } else {
            $kodSource = $contactData['entry_company'];
        }
        $kontaktData['jmeno']    = $contactData['entry_firstname'];
        $kontaktData['prijmeni'] = $contactData['entry_lastname'];

        $kontaktData['ic']    = $contactData['entry_company_number'];
        $kontaktData['dic']   = $contactData['entry_company_tax_id'];
        $kontaktData['ulice'] = $contactData['entry_street_address'];
        $kontaktData['mesto'] = $contactData['entry_city'];
        $kontaktData['psc']   = $contactData['entry_postcode'];
        $kontaktData['kod']   = \FlexiPeeHP\FlexiBeeRO::uncode($this->getKod($kodSource));
        return $kontaktData;
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

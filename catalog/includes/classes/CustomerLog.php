<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC;

/**
 * Description of CustomerLog
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class CustomerLog extends \Ease\Brick
{
    /**
     * Administrator invoked
     * @var int 
     */
    public $administrators_id = null;

    /**
     * Current Customer
     * @var int 
     */
    public $customers_id = null;

    /**
     * Default venue
     * @var string 
     */
    public $venue = null;

    /**
     * Log Customer events
     * 
     * @param string $venue       current url is used as default  
     * @param int    $customer_id current logged user id is used as default
     * @param int    $administrators_id
     */
    public function __construct($venue = null, $customer_id = null,
                                $administrators_id = null)
    {
        parent::__construct();
        $this->setVenue($venue);
        $this->setCustomerID($customers_id);
        $this->setAdministratorID(empty($administrators_id) ? 0 : $administrators_id );
        $this->takemyTable('user_log');
    }

    /**
     * Log An event
     * 
     * @param string $question
     * @param string $answer
     * @param string $venue 
     * @param int    $customers_id
     * @param int    $administrators_id
     * 
     * @return boolean success
     */
    public function logEvent($question, $answer, $venue = null, $extId = 'none',
                             $customers_id = null, $administrators_id = null)
    {
        return $this->insertToSQL([
                'customers_id' => empty($customers_id) ? $this->customers_id : $customers_id,
                'customers_id' => empty($customers_id) ? $this->customers_id : $customers_id,
                'venue' => empty($venue) ? $this->venue : $venue,
                'question' => $question,
                'answer' => $answer,
                'extid' => $extId
            ]) == 1;
    }

    /**
     * 
     * @param int $administrators_id
     */
    public function setAdministratorID($administrators_id)
    {
        $this->administrators_id = $administrators_id;
    }

    /**
     * 
     * @param string $venue
     */
    public function setVenue($venue)
    {
        if (empty($venue)) {
            $venue = \Ease\WebPage::phpSelf();
        }
        $this->venue = $venue;
    }

    /**
     * 
     * @param int $customers_id
     */
    public function setCustomerID($customers_id)
    {
        if (empty($customers_id)) {
            $customers_id = $_SESSION['customers_id'];
        }
        $this->customers_id = $customers_id;
    }

    public function logMySQLEvent($tableName, $columnName, $recordID,
                                  $columnValue)
    {
        return $this->logEvent($columnName, $columnValue, null,
                'mysql://'.constant('DB_HOST').'/'.constant('DB_DATABASE').'/'.$tableName.'/'.$columnName.'/'.$recordID);
    }

    /**
     * Log FlexiBee event
     * 
     * @param \FlexiPeeHP\FlexiBeeRW $flexibee
     * @param array $columns
     */
    public function logFlexiBeeEvent($flexibee, $columns)
    {
        foreach ($columns as $columnName) {
            $this->logEvent($columnName, $flexibee->getDataValue($columnName),
                null, $flexibee->getApiURL());
        }
    }
}

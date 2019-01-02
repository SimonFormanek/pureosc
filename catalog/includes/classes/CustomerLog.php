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
                'administrators_id' => empty($administrators_id) ? $this->administrators_id
                    : $administrators_id,
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

    /**
     * Log event in MySQL database
     * 
     * @param string $tableName   affected table name
     * @param string $columnName
     * @param int    $recordID
     * @param string $columnValue
     * 
     * @return boolean success
     */
    public function logMySQLEvent($tableName, $columnName, $recordID,
                                  $columnValue)
    {
        return $this->logEvent($columnName, $columnValue, null,
                self::sqlUri($tableName, $recordID, $columnName));
    }

    /**
     * Log MySQL change
     *  
     * @param array  $originalData
     * @param array  $newData
     * @param string $tableName
     * @param int    $recordID
     * @param arrays $columns
     */
    public function logMySQLChange($originalData, $newData, $tableName,
                                   $recordID, $columns)
    {
        foreach ($columns as $columnName) {
            if ($originalData[$columnName] != $newData[$columnName]) {
                $this->logEvent($columnName, 'update', null,
                    self::sqlUri($tableName, current($originalData), $columnName));
            }
        }
    }

    /**
     * URI In MySQL
     * 
     * @param string $tableName
     * @param int    $recordID
     * @param string $columnName
     * 
     * @return string
     */
    static public function sqlUri($tableName, $recordID, $columnName)
    {
        return 'mysql://'.constant('DB_HOST').'/'.constant('DB_DATABASE').'/'.$tableName.'/'.$recordID.'#'.$columnName;
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
            $this->logEvent($columnName,
                empty($flexibee->lastInsertedID) ? 'update' : 'create', null,
                $flexibee->getApiURL().'#'.$columnName);
        }
    }

    /**
     * Log Change in FlexiBee
     * 
     * @param \FlexiPeeHP\FlexiBeeRW $flexibee
     * @param array $originalData
     * @param array $columns
     */
    public function logFlexiBeeChange($flexibee, $originalData, $columns)
    {
        foreach ($columns as $columnName) {
            if ($originalData[$columnName] != $flexibee->getDataValue($columnName)) {
                $this->logEvent($columnName, 'update', null,
                    $flexibee->getApiURL().'#'.$columnName);
            }
        }
    }
}

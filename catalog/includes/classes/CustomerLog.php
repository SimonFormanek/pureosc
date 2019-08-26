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
class CustomerLog extends Engine {

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
  public $myTable = 'gdpr_log';
  public $myKeyColumn = 'id';
  public $createColumn = 'timestamp';

  /**
   *
   * @var \PureCRYPTO\SslCrypto
   */
  private $cryptor;

  /**
   * Log Customer events
   * 
   * @param string $venue       current url is used as default  
   * @param int    $customers_id current logged user id is used as default
   * @param int    $administrators_id
   */
  public function __construct($venue = null, $customers_id = null,
    $administrators_id = null) {
    parent::__construct();
    $this->setVenue($venue);
    $this->setCustomerID($customers_id);
    $this->setAdministratorID(empty($administrators_id) ? 0 : $administrators_id );
    $this->setEncryption(1);
  }

  public function setEncryption($admin_id) {
    $this->cryptor = new \PureCRYPTO\SslCrypto();
    $admin_password_query = tep_db_query("SELECT user_password, pubkey FROM administrators WHERE id = " . $admin_id);
    $admin_password = tep_db_fetch_array($admin_password_query);
    $this->cryptor->setPassphrase($admin_password['user_password']);
    $this->cryptor->setPublicKey($admin_password['pubkey']);
    
  }
  
  /**
   * Log An event
   * 
   * @param string $question          What is Subject of change
   * @param string $answer            Which change
   * @param string $venue             Location of change name
   * @param string $extId             Url of change
   * @param int    $customers_id      Affected Customer
   * @param int    $administrators_id Acting administrator
   * 
   * @return boolean success
   */
  public function logEvent($question, $answer, $venue = null, $extId = 'none',
    $customers_id = null, $administrators_id = null) {
    return $this->insertToSQL([
        'customers_id' => empty($customers_id) ? $this->customers_id : $customers_id,
        'customers_id' => empty($customers_id) ? $this->customers_id : $customers_id,
        'administrators_id' => empty($administrators_id) ? $this->administrators_id : $administrators_id,
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
  public function setAdministratorID($administrators_id) {
    $this->administrators_id = $administrators_id;
  }

  /**
   * 
   * @param string $venue
   */
  public function setVenue($venue) {
    if (empty($venue)) {
      $venue = \Ease\WebPage::phpSelf();
    }
    $this->venue = $venue;
  }

  /**
   * 
   * @param int $customers_id
   */
  public function setCustomerID($customers_id) {
    if (empty($customers_id) && isset($_SESSION['customers_id'])) {
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
    $columnValue) {
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
   * @param array  $columns
   */
  public function logMySQLChange($originalData, $newData, $tableName,
    $recordID, $columns) {
    foreach ($columns as $columnName) {
      if ($originalData[$columnName] != $newData[$columnName]) {
        $this->logEvent(
          $columnName,
          $this->recognizeOperation($columnName, $originalData,
            $newData), null,
          self::sqlUri($tableName, current($originalData), $columnName)
        );
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
  static public function sqlUri($tableName, $recordID, $columnName) {
    return 'mysql://' . constant('DB_HOST') . '/' . constant('DB_DATABASE') . '/' . $tableName . '/' . $recordID . '#' . $columnName;
  }

  /**
   * Log FlexiBee event
   * 
   * @param \FlexiPeeHP\FlexiBeeRW $flexibee
   * @param array $columns
   */
  public function logFlexiBeeEvent($flexibee, $columns) {
    foreach ($columns as $columnName) {
      $this->logEvent($columnName,
        empty($flexibee->lastInsertedID) ? 'update' : 'create', null,
        $flexibee->getApiURL() . '#' . $columnName);
    }
  }

  /**
   * Log Change in FlexiBee
   * 
   * @param \FlexiPeeHP\FlexiBeeRW $flexibee
   * @param array $originalData
   * @param array $columns
   */
  public function logFlexiBeeChange($flexibee, $originalData, $columns) {
    foreach ($columns as $columnName) {
      if ($originalData[$columnName] != $flexibee->getDataValue($columnName)) {
        $this->logEvent($columnName, $flexibee->getLastOperationType(),
          null, $flexibee->getApiURL() . '#' . $columnName);
      }
    }
  }

  /**
   * Compare Old and New data to recoginze Operation type
   * 
   * @param string $columnName
   * @param array $originalData
   * @param array $newData
   * 
   * @return string update|insert|delete
   */
   public function recognizeOperation($columnName, array $originalData,
    array $newData) {
    if (array_key_exists($columnName, $newData) && array_key_exists($columnName,
        $originalData)) {
      $operation = 'update ' . $this->cryptor->encrypt($newData[$columnName]);
    }
    if (array_key_exists($columnName, $newData) && !array_key_exists($columnName,
        $originalData)) {
      $operation = 'insert ' . $this->cryptor->encrypt($newData[$columnName]);
    }
    if (!array_key_exists($columnName, $newData) && array_key_exists($columnName,
        $originalData)) {
      $operation = 'delete';
    }
    return $operation;
  }

  /**
   * Search resuts targeting to  here
   * @var string 
   */
  public $keyword = 'gdprlog';

  public function translate() {
    $this->subject = _('Gdpr Log');
    parent::translate();
  }

  public function columns($columns = []) {

//CREATE TABLE `gdpr_log` (
//  `id` int(11) NOT NULL,
//  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
//  `customers_id` int(11) NOT NULL COMMENT 'affected customer id',
//  `administrators_id` int(11) NOT NULL DEFAULT '0' COMMENT 'admin user id',
//  `venue` varchar(255) NOT NULL COMMENT 'place of occurence. ex: user profile page',
//  `question` varchar(255) NOT NULL COMMENT 'ex: agree with newsletter sending',
//  `answer` varchar(255) NOT NULL COMMENT 'ex: yes',
//  `extid` varchar(255) NOT NULL COMMENT 'ex: mysql://localhost/table/column#line',
//  `predecessor` varchar(255) DEFAULT NULL COMMENT 'checksum of previous record - blockchain glue'
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='gdpr protocol';       

    return parent::columns([
        ['name' => 'customers_id', 'type' => 'text', 'label' => _('affected client')],
        ['name' => 'administrators_id', 'type' => 'text', 'label' => _('admin user')],
        ['name' => 'venue', 'type' => 'text', 'label' => _('place of occurence')],
        ['name' => 'question', 'type' => 'text', 'label' => _('question')],
        ['name' => 'answer', 'type' => 'text', 'label' => _('answer')],
        ['name' => 'extid', 'type' => 'text', 'label' => _('extid')],
        ['name' => 'predecessor', 'type' => 'text', 'label' => _('predecessor'),
          'hidden' => true],
        ['name' => 'client_name', 'type' => 'text', 'column' => 'LTRIM(CONCAT(client.SURNAME, \' \', client.NAME, \' \', IFNULL(client.TITLE,"") ))',
          'label' => _('Customer Name'), 'hidden' => true],
        ['name' => 'admin_name', 'type' => 'text', 'column' => 'CONCAT(administrators.SURNAME, \' \',administrators.NAME)',
          'label' => _('Admin Name'), 'hidden' => true],
    ]);
  }

  /**
   * 
   * @return  \Envms\FluentPDO
   */
  public function listingQuery() {
    return $this->getFluentPDO()->from($this->myTable)
        ->select('LTRIM(CONCAT(customers.customers_lastname, \' \', customers.customers_firstname)) AS client_name')
        ->select('administrators.user_name AS admin_name')
        ->leftJoin('customers ON ' . $this->myTable . '.customers_id=customers.customers_id')
        ->leftJoin('administrators ON ' . $this->myTable . '.administrators_id=administrators.id');
  }

  /**
   * @link https://datatables.net/examples/advanced_init/column_render.html 
   * @return string Column rendering
   */
  public function columnDefs() {
    return '
"columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return  "<a href=\"client.php?id=" + data +"\">" + row["client_name"] + "</a>";
                },
                "targets": 0
            },
            {
                "render": function ( data, type, row ) {
                    return  "<a href=\"administrators.php?id=" + data +"\">" + row["admin_name"] + "</a>";
                },
                "targets": 1
            },
            {
                "render": function ( data, type, row ) {
                    return  "<a href=\"calendar.php?datetime=" + data +"\">" + data + "</a>";
                },
                "targets": 6
            }
        ]            
,
';
  }
  
  public function getAllForDataTable($conditions = [])
  {
      $data = parent::getAllForDataTable($conditions);
      
      if(isset($data['data'])){

          $this->cryptor->setPrivateKey( file_get_contents(DIR_FS_MASTER_ROOT_DIR.'oscconfig/keys/privateKey.asc'));
          
          foreach ($data['data'] as $rowId => $rowValues) {
              if(!empty($rowValues['answer']) && strstr($rowValues['answer'],' ')){
                  $answer = explode(' ', $rowValues['answer']);
                  $operation = $answer[0];    
                  $crypttext = $answer[1];    
                  switch ($operation) {
                      case 'insert':
                      case 'update':
                          
                          $decrypted = $this->cryptor->decrypt($crypttext);
                          if(!is_null($decrypted)){
                              $data['data'][$rowId]['answer'] = _($operation).' '.$decrypted;
                          }
                          break;

                      default:
                          break;
                  }                      
                      
              }
          }
      }
          
      return $data;
  }

}

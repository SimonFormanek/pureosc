<?php
/**
 * PureOSC Order 
 * 
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright (c) 2017, Vítězslav Dvořák
 */

namespace PureOSC;

/**
 * Description of DBFContracts
 *
 * @author vitex
 */
class OrdersStatus extends Engine
{
    public $myTable      = TABLE_ORDERS_STATUS;
    public $myKeyColumn  = 'orders_status_id';
  
    /**
     * Group Rows by
     * @var boolean 
     */
    public $grouping = false;
//    public $modifiedColumn = 'updated_at';
    /**
     * Search resuts targeting to  here
     * @var string 
     */
    public $keyword  = 'orderstatus';

    /**
     * ContractContract Id
     * 
     * @param int $init
     * @param array $filter
     */
    public function __construct($init = null, $filter = array())
    {
        parent::__construct($init, $filter);
    }
    /**
     * Column with record name
     * @var string 
     */
    public $nameColumn = 'contract_id';

    /**
     * 
     */
    public function translate()
    {
        $this->subject = _('Contract');
        parent::translate();
    }

    /**
     * Contract Columns
     * 
     * @return arrat
     */
    public function columns($columns = [])
    {
        $languager = new Languages();
        
        return parent::columns([
                ['name' => 'orders_status_name', 'type' => 'text', 'label' => _('Order Status name'),'requied' => true],
                ['name' => 'language_id', 'type' => 'selectize',
                    'requied' => true,
                    'label' => _('Languague'),
                    'options' => $languager->feedSelectizeCached(),
                    'engine' => get_class($languager),
                    'listingPage' => 'clients.php', 'detailPage' => 'client.php',
                    'idColumn' => 'client_id', 'valueColumn' => 'client_name',],
                ['name' => 'public_flag', 'type' => 'text', 'label' => _('Public'),'type' => 'boolean'],
                ['name' => 'downloads_flag', 'type' => 'boolean', 'label' => _('Downloads')],
        ]);
    }


    public function editorPostCreateJS()
    {
        return '
            window.location.href = "order_status.php?id=" + data["id"] ;
';
    }

}

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
class Orders extends Engine
{
    public $myTable      = 'order';
    public $myKeyColumn  = 'orders_status_id';
    public $createColumn = 'date_purchased';

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
    public $keyword  = 'contract';

    /**
     * Contract
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
    public $nameColumn = 'customers_name';

    /**
     * 
     */
    public function translate()
    {
        $this->subject = _('Orders');
        parent::translate();
    }

    /**
     * Contract Columns
     * 
     * @return arrat
     */
    public function columns($columns = [])
    {
        $statuser = new OrdersStatus();

        return parent::columns([
//                ['name' => 'customer_id', 'type' => 'selectize',
//                    'requied' => true,
//                    'label' => _('Customer'),
//                    'options' => $customerer->feedSelectizeCached(),
//                    'engine' => get_class($customerer),
//                    'listingPage' => 'customers.php', 'detailPage' => 'customer.php',
//                    'idColumn' => 'customer_id', 'valueColumn' => 'client_name',],
                ['name' => 'customers_name', 'type' => 'text', 'label' => _('Customer name'),
                    'requied' => true],
                ['name' => "customers_id", 'type' => 'text', 'label' => _('Customer')],
                ['name' => 'date_purchased', 'type' => 'date', 'label' => _('Purchased'),
                    'requied' => true, 'unique' => true],
                ['name' => 'payment_amount', 'type' => 'text', 'label' => _('Payment amount'),
                    'type' => 'currency'],
//                ['name' => 'currency_id', 'type' => 'selectize', 'label' => _('Currency'),
//                    'options' => $currencer->feedSelectizeCached(),
//                    'engine' => get_class($currencer),
//                ],
//                ['name' => 'order_status', 'type' => 'selectize', 'listingPage' => 'providers.php',
//                    'detailPage' => 'orderstatus.php', 'idColumn' => 'bank_id', 'valueColumn' => 'bank_name',
//                    'label' => _('Status'), 'options' => $statuser->feedSelectizeCached(),
//                    'engine' => get_class($statuser)],
        ]);
    }

    /**
     * 
     * @return  \Envms\FluentPDO
     */
    public function listingQuery()
    {
        return parent::listingQuery()
                ->select('DATE_ADD(contract.BEGINNING_AT, INTERVAL  contract.REVISION_MONTHS MONTH) AS revision')
                ->select('DATE_ADD(contract.BEGINNING_AT, INTERVAL  contract.TURN_MONTHS MONTH) AS maturity')
        ;
    }
//    http://www.mysqltutorial.org/mysql-self-join/

    /**
     * 
     * @return type
     */
    public function feedSelectize($options = [])
    {
        $contracts  = [];
        $candidates = $this->getFluentPDO()->from('contract')
                ->select('contract.id')
                ->select('contract.contract_id')
                ->select('bank.NAME as poskytovatel')
                ->select('product.NAME AS produkt')
                ->select('LTRIM(CONCAT(client.SURNAME, \' \', client.NAME, \' \', IFNULL(client.TITLE,"") )) AS klient')
                ->select('CONCAT(advisor.SURNAME, \' \',advisor.NAME) AS poradce')
                ->where('is_active = 1')->orderBy('contract.contract_id');

        if (array_key_exists('client_id', $options)) {
            $candidates->where('client_id='.$options['client_id']);
        }

        foreach (self::fixIterator($candidates) as $contract) {
            $contracts[] = ['label' => addslashes($contract['contract_id'].'  -  '.$contract['klient'].' / '.$contract['produkt'].' ('.$contract['poskytovatel'].') '),
                'value' => intval($contract['id'])];
        }
        return $contracts;
    }

    /**
     * @link https://datatables.net/examples/advanced_init/column_render.html 
     * 
     * @return string Column rendering
     */
    public function columnDefs()
    {
        return
            '
"createdRow": function( row, data, dataIndex){
    if( data["is_active"] == "0"){
        $(row).addClass(\'disabledrow\');
//        $(row).css("fontSize", 0).children(\'td, th\').css("padding",0);
    }
},
"columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return  "<!-- " + data + " --><a href=\"customer.php?id=" + row["id"] +"\">" + data + "</a>";
                },
                "targets": [0,1]
            },
            '.self::renderYesNo('2').'
            '.self::renderDate('3').'
//            { "visible": false,  "targets": [ 16 ] },
        ]            
,
';
    }

    /**
     * 
     * @param type $data
     * @param type $action
     * 
     * @return type
     */
    public function prepareToSave($data, $action, $recordId = null)
    {
        $data     = parent::prepareToSave($data, $action, $recordId = null);
        /*
          INSERT INTO contract (`ID`,`BANK_ID`,`PRODUCT_ID`,`CLIENT_ID`,`advisor_ID`,`CONTRACT_ID`,`IS_ACTIVE`,`STATE`,`PAYMENT_FREQUENCY`,`PAYMENT_AMOUNT`,`LAST_MONTHS`, `SIGNED_AT`,`BEGINNING_AT`, `EXPIRY_AT`,`TURN_MONTHS`,`REVISION_MONTHS`)
         * VALUES              (NULL,       23,          19,       2590,         85,     '123456',          1,   'LA',                 90,        '123456',           24,'2010-12-12',  '2012-11-13','2026-12-15',           12,6)
         */

        unset($data['client_name']);
        unset($data['product_type_id']);

        $productDetails = $this->getFluentPDO()->from('product')->where('id = '.$data['product_id'])->fetch();

        $clientDetails = $this->getFluentPDO()->from('client')->where('id = '.$data['client_id'])->fetch();
        if ($productDetails) {
            $data['bank_id'] = $productDetails['bank_id'];
        }
        if ($clientDetails) {
            $data['riskiness'] = $clientDetails['riskiness'];
            $data['pep']       = $clientDetails['pep'];
        }
        return $data;
    }

    /**
     * 
     * @param type $tableID
     * 
     * @return string
     */
    public function preTableCode($tableID)
    {
        //\Ease\Shared::webPage()->includeJavaScript('js/contractRowGrouping.js');
    }

    /**
     * Additional code for DataTable initialization
     * 
     * @return string
     */
    public function tableCode($tableID)
    {
        return $this->grouping ? '
"order": [[1, \'asc\'], [12, \'asc\'], [13, \'asc\']],
"drawCallback": function ( settings ) {
           groupRows(settings,this);
        },            
' : '';
    }

    /**
     * Get Top Parent ID for branch member
     * 
     * @param int $id
     * 
     * @return int
     */
    public function getTopID($parentId)
    {
        $topId = null;
        if ($parentId) {
            do {
                $topId    = $parentId;
                $parentId = $this->dblink->queryToValue('SELECT parent_id FROM '.$this->getMyTable().' WHERE id='.$parentId);
            } while ($parentId);
        }

        return $topId;
    }

    /**
     * Save Broker Log
     */
    public function postCreate($datableSaver, $id, $row)
    {
        $details = $this->getFluentPDO()->from('product')
            ->select('brokerdiary')
            ->where('id = '.$this->getDataValue('product_id'));

        if ($details->fetchColumn() && $this->getDataValue('payment_amount')) {
            $brokerdiary = new BrokerLog();
            if ($brokerdiary->insertToSQL(['contract_id' => $this->getMyKey()])) {
                $this->addStatusMessage(sprintf(_('Contract %s was added to broker diary'),
                        $this->getDataValue('contract_id').' '.$this->getDataValue('name')),
                    'success');
            }
        }
    }

    public function editorPostCreateJS()
    {
        return '
            window.location.href = "contract.php?id=" + data["id"] ;
';
    }

    public function validation($saver)
    {
        
    }

    public function getProductType()
    {
        return $this->getFluentPDO()->from('product')->select('progress_id')->where('id',
                $this->getDataValue('product_id'))->fetchColumn(2);
    }

    public function check()
    {
        if ($this->getDataValue('ok') != 1) {
            $productTyper = new ProductType((int) $this->getProductType());
            $requiedTypes = $productTyper->getRequiedDoctTypes();

            $typesUsed = $this->getAttachments();

            if (!empty($typesUsed)) {
                $typesUsed = array_values(self::reindexArrayBy($typesUsed,
                        'doctype_id'));
            }

            foreach ($requiedTypes as $requiedTypeId => $requiedType) {
                if (!array_key_exists($requiedTypeId, $typesUsed)) {
                    $this->addStatusMessage(sprintf(_('Product type %s Require attachment of document type %s'),
                            '<strong>'.$productTyper->getDataValue('description').'</strong>',
                            '<strong>'.$requiedType['name'].'</strong>'),
                        'warning');
                }
            }
        }
    }
}

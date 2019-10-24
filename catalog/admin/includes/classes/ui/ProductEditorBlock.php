<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\Admin\ui;

use Ease\Html\TdTag;
use Ease\Html\TrTag;

/**
 * Description of ProductEditorBlock
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class ProductEditorBlock extends TrTag
{
    /**
     *
     * @var TdTag
     */
    public $content = null;

    /**
     * TableRow - component
     * 
     * @param string|mixed $heading
     * @param string|mixed $content
     * @param array        $properties
     */
    public function __construct($heading, $content = null, $properties = array())
    {
        parent::__construct(null, $properties);
        parent::addItem(new TdTag($heading, ['class' => 'main']));
        $this->content = parent::addItem(new TdTag($content, ['class' => 'main']));
    }

    /**
     * Add Item into Block main field
     * 
     * @param mixed $pageItem
     * 
     * @return mixed
     */
    public function addItem($pageItem, $pageItemName = NULL)
    {
        return $this->content->addItem($pageItem, $pageItemName);
    }
}

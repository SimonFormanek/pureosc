<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manufacturers_overview
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class cm_fp_manufacturers_overview
{
    public $version = '0.0.1';
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;

    public function __construct() {
      $this->code = get_class($this);
      $this->group = basename(dirname(__FILE__));

      $this->title = MODULE_CONTENT_FRONT_PAGE_MANUFACTURERS_TITLE;
      $this->description = MODULE_CONTENT_FRONT_PAGE_MANUFACTURERS_DESCRIPTION;

      if (defined('MODULE_CONTENT_FRONT_PAGE_MANUFACTURERS_STATUS')) {
        $this->sort_order = MODULE_CONTENT_FRONT_PAGE_MANUFACTURERS_SORT_ORDER;
        $this->enabled = (MODULE_CONTENT_FRONT_PAGE_MANUFACTURERS_STATUS == 'True');
      }
    }

}

<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\ui;

/**
 * Description of Head
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class Head extends \Ease\Html\HeadTag
{
    public function __construct($oscTemplate, $content = null)
    {
        
        parent::__construct($content);
        parent::addItem('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
        parent::addItem( '<title>' . tep_output_string_protected($oscTemplate->getTitle()) . '</title>');
        $this->includeCss('ext/font-awesome-4.4.0/css/font-awesome.min.css');
            
        $this->includeCss('custom.css');
        $this->includeCss('user.css');

        $this->addJavascript('
        <!--[if lt IE 9]>
           <script src="ext/js/html5shiv.js"></script>
           <script src="ext/js/respond.min.js"></script>
           <script src="ext/js/excanvas.min.js"></script>
        <![endif]-->
');

    }
}

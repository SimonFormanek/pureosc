<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC\ui;

/**
 * Description of WebPage
 *
 * @author Vítězslav Dvořák <info@vitexsoftware.cz>
 */
class WebPage extends \Ease\TWB\WebPage
{
    /**
     * Where to look for jquery script
     * @var string path or url 
     */
      public $jqueryJavaScript    = null;
      public $bootstrapThemeCSS  = null;
}

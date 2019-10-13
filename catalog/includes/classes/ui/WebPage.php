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
class WebPage extends \Ease\TWB4\WebPage
{
    /**
     * Where to look for jquery script
     * @var string path or url 
     */
    public $jqueryJavaScript  = 'ext/jquery/jquery.min.js';
    
   
    /**
     * Where to look for bootstrap stylesheet
     * @var string path or url 
     */
    public $bootstrapCSS = 'ext/bootstrap/css/bootstrap.min.css';

    /**
     * Where to look for bootstrap stylesheet theme
     * @var string path or url 
     */
    public $bootstrapThemeCSS = '';

    /**
     * Where to look for bootstrap stylesheet scripts
     * @var string path or url 
     */
    public $bootstrapJavaScript = 'ext/bootstrap/js/bootstrap.bundle.js';
    
    

}

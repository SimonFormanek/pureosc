#!/usr/bin/php5
<?php

//namespace chp;
chdir('/home/f/git/osc/osc/catalog');
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
ini_set('display_errors', '0');

//require_once 'includes/application_top.php';
require('includes/application_top.php');

echo "konec1\n";
use League\CommonMark\CommonMarkConverter;
//exit;
//require_once '../vendor/autoload.php';

//$fileToShow = '../admin/txt/cs/novinky/markdown.md';
$fileToShow = $argv[1];
//$oPage =  new \Ease\WebPage(basename($fileToShow));
//$container = $oPage->addItem(new \Ease\TWB\Container());


if (file_exists($fileToShow)) {
    $converter = new CommonMarkConverter();
//    $container->addItem(new \Ease\Html\Div($converter->convertToHtml(file_get_contents($fileToShow)), ['class' => 'jumbotron']));
$txt = $converter->convertToHtml(file_get_contents($fileToShow));
//echo $txt;
////preg_match('#<h1>(.+?)</h1>#is', $txt, $matches);
preg_match('#<h([1-6])>(.+?)</h\1>#is', $txt, $matches);
echo 'vyleze:' . $matches[2];
echo "konec\n";
}
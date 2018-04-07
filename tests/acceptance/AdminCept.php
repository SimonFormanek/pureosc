<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Test Admin');    //nic nevykonává, ale slouží pro nás. Když test neprojde, vypíše se mimo jiné tento string
$I->amOnPage('/admin/');              //kontrola, že jsem na homepage
$I->seeElement("form input[name=\"username\"]");  
$I->seeElement("form input[name=\"password\"]");  

$I->fillField("form input[name=\"username\"]", "admin"); 
$I->fillField("form input[name=\"password\"]", "admin"); 
$I->click("form button");
$I->waitForElement("form[name=\"login\"]", 3);      


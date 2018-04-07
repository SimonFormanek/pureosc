<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->wantTo('Test homepage');
$I->amOnPage('/');
$I->seeElement("form input[id=\"quick_search\"]");
$I->see("PureHTML");

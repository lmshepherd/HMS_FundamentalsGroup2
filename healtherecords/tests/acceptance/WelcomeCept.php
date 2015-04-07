<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('login');
$I->fillField('username', 'fdsa');
$I->fillField('password', 'asdf');
$I->click('Login');
$I->see('Patient Information');
?>
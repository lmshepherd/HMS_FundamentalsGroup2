<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('perform actions and see result');
$I->amOnPage('/');
$I->see('login');
$I->fillField('username', 'patient1');
$I->fillField('password', 'asdf');
$I->click('login_submit');
$I->see('Patient Information');
$I->click('View Medical Record');
$I->see('Religion: Packer');
$I->see('2x League MVP');
$I->see('Weight: 190');
?>
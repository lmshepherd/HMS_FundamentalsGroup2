<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('test signup');
$I->amOnPage('index.php/main/new_user');
$I->see('New User Signup');
$I->fillField('username', 'lalala1');
$I->fillField('password', 'asdf');
$I->fillField('cpassword', 'asdf');
$I->fillField('email',  'matthawkeyefina@gmail.com');
$I->selectOption('role', 'Doctor');
$I->click('Sign Up!');
$I->see('A link to complete registration has been sent to your email address!');
?>
<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('fill out registration');
$I->amOnPage('index.php/main/user_confirmation/a7b6ede24af73bf5dca3b3a4a49281c6');
$I->see('Please fill');
$I->fillField('firstname', 'doctor');
$I->fillField('lastname', 'love');
$I->fillField('dob', '5555-23-23');
$I->fillField('homephone', '123-123-1234');
$I->fillField('workphone', '123-123-1234');
$I->selectOption('gender', 'Male');
$I->selectOption('specialization', 'Neurologist');
$I->fillField('experience', '5 days');

$I->selectOption('sunstart', '8:00am');
$I->selectOption('sunend', '4:00pm');
$I->selectOption('monstart', '8:00am');
$I->selectOption('monend', '4:00pm');
$I->selectOption('tuestart', '8:00am');
$I->selectOption('tueend', '4:00pm');
$I->selectOption('wedstart', '8:00am');
$I->selectOption('wedend', '4:00pm');
$I->selectOption('thustart', '8:00am');
$I->selectOption('thuend', '4:00pm');
$I->selectOption('fristart', '8:00am');
$I->selectOption('friend', '4:00pm');
$I->selectOption('satstart', '8:00am');
$I->selectOption('satend', '4:00pm');
$I->click('Complete Registration!');
$I->see('Doctor Information');
?>
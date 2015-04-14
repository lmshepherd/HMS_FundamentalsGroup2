<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('make a patient appointment');
$I->amOnPage('/');
$I->see('login');
$I->fillField('username', 'patient1');
$I->fillField('password', 'asdf');
$I->click('login_submit');
$I->see('Patient Information');
$I->click('Make an Appointment');
$I->see('Specialization');
//$I->selectOption("//input[@id='spec']", 'Caridologist');
//$I->selectOption('.specialization','Cardiologist');
$I->submitForm('#spec', array('user' => array(
     'specialization' => 'Cardiologist',
     'submitButton' => 'Select'
))
);
$I->see('Name');
$I->click('Select');
$I->see('Date');
$I->submitForm('#datepicker', array('user' => array(
		'appointment' => '2015-04-15',
))
);
//$I->selectOption('date', '2015-04-15');
$I->see('Availability');
//$I->selectOption('hours', '5:00 pm');
$I->submitForm('#datepicker', array('user' => array(
		'hours' => '5:00pm',
		//'date' => '2015-04-15',
		//'hours' => 'm',
		'submitButton' => 'Complete Appointment!'
))
);
$I->click('Complete Appointment!');
$I->see('Your appointment has been made!');
$I->see('15-4-15 at 5 pm with Dr. Montana');
$I->click('Back to Home');
$I->click('View appointments');
$I->click('Cancel appointment');
?>
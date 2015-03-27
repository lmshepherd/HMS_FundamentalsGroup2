<?php
$gender_options=array('m'=>'Male','f'=>'Female');
echo "<p>Gender: ";
echo form_dropdown('gender', $gender_options,'m');
echo "</p>";

//store dropdown box options as an array
$marital_options = array('single'=>'Single',
		'married'=>'Married',
		'divorced'=>'Divorced',
		'widowed'=>'Widowed');
echo "<p>Marital Status: ";
//create dropdown box, default option patient
echo form_dropdown('maritalstatus',$marital_options,'single');
echo "</p>";

echo "<p>Address Line 1: ";
echo form_input('addressline1',$this->input->post('addressline1'));
echo "</p>";

echo "<p>Address Line 2: ";
echo form_input('addressline2',$this->input->post('addressline2'));
echo "</p>";

echo "<p>City: ";
echo form_input('city',$this->input->post('city'));
echo "</p>";

echo "<p>Zipcode: ";
echo form_input('zipcode',$this->input->post('zipcode'));
echo "</p>";

echo "<p>Emergency Contact Name: ";
echo form_input('ecname',$this->input->post('ecname'));
echo "</p>";

echo "<p>Emergency Contact Phone: ";
echo form_input('ecphone',$this->input->post('ecphone'));
echo " Please use format XXX-XXX-XXXX";
echo "</p>";

echo "<p>Insurance Start: ";
echo form_input('insurancestart',$this->input->post('insurancestart'));
echo " Please use format YYYY-MM-DD";
echo "</p>";

echo "<p>Insurance End: ";
echo form_input('insuranceend',$this->input->post('insuranceend'));
echo " Please use format YYYY-MM-DD";
echo "</p>";

echo "<p>Insurance Provider: ";
echo form_input('insuranceprovider',$this->input->post('insuranceprovider'));
echo "</p>";

echo "<p>record: ";
echo form_input('record',$this->input->post('record'));
echo "</p>";

echo "<p>Treatments: ";
echo form_input('treatments',$this->input->post('treatments'));
echo "</p>";

echo "<p>Allergies: ";
echo form_input('allergies',$this->input->post('allergies'));
echo "</p>";
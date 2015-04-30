<?php 
/*
echo form_open('main/complete_medicalRecord');
echo "<p>";
echo form_submit('medicalRecord_submit', 'Fill out Medical Record');
echo "</p>";
echo form_close();

echo form_open('main/view_medicalRecord');
echo "<p>";
echo form_submit('medicalRecordReadOnly_submit', 'View Medical Record');
echo "</p>";
echo form_close();*/

echo form_open('update/update_medicalRecord');
echo "<p>";
echo form_submit('medicalRecordReadOnly_submit', 'View Medical Record');
echo "</p>";
echo form_close();

echo form_open('appointment/make_appointment');
echo "<p>";
echo form_submit('appointment_submit', 'Make an Appointment');
echo "</p>";
echo form_close();

echo form_open('appointment/view_patient_appointments');
echo "<p>";
echo form_submit('appointment_submit', 'View Appointments');
echo "</p>";
echo form_close();

echo form_open('bill/view_bill');
echo "<p>";
echo form_submit('billing_submit', 'Billing');
echo "</p>";
echo form_close();

echo form_open('update/update_patient_info');
echo "<p>";
echo form_submit('update_submit', 'Update Your Information');
echo "</p>";
echo form_close();
?>
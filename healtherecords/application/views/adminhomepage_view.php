<?php
$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');

echo form_open('admin/doctor_schedules');
echo "<p>";
echo form_submit('doc_sched_submit', 'View Doctor Schedules');
echo "</p>";
echo form_close();

echo form_open('admin/nurse_schedules');
echo "<p>";
echo form_submit('nurse_sched_submit', 'View Nurse Schedules');
echo "</p>";
echo form_close();

echo form_open('admin/');
echo "<p>";
echo form_submit('patient_submit', 'View Patients');
echo "</p>";
echo form_close();

echo form_open('admin/');
echo "<p>";
echo form_submit('appoitnment_submit', 'View Appointments');
echo "</p>";
echo form_close();

echo form_open('admin/');
echo "<p>";
echo form_submit('Payment_submit', 'View Processed Payments');
echo "</p>";
echo form_close();
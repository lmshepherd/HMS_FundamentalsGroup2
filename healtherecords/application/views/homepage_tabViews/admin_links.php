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

echo form_open('admin/view_patients');
echo "<p>";
echo form_submit('patient_submit', 'View Patients');
echo "</p>";
echo form_close();

echo form_open('admin/view_appointments');
echo "<p>";
echo form_submit('appoitnment_submit', 'View History');
echo "</p>";
echo form_close();

echo form_open('admin/view_processed_payments');
echo "<p>";
echo form_submit('Payment_submit', 'View Processed Payments');
echo "</p>";
echo form_close();

echo form_open('admin/view_payroll');
echo "<p>";
echo form_submit('Payroll_submit', 'View Payroll Information');
echo "</p>";
echo form_close();

echo form_open('salary/viewSalary');
echo "<p>";
echo form_submit('salary_view', 'View Admin Salary');
echo "</p>";
echo form_close();

echo form_open('update/update_admin_info');
echo "<p>";
echo form_submit('update_submit', 'Update Your Information');
echo "</p>";
echo form_close();
?>
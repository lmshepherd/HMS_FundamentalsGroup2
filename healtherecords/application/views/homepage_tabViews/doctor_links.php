<?php 
$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
echo form_open('schedule/change_schedule', $attributes);
echo "<p>";
echo form_submit('schedule_submit', 'View/Change Schedule');
echo "</p>";
echo form_close();

echo form_open('appointment/view_appointments');
echo "<p>";
echo form_submit('appointment_submit', 'View Appointments');
echo "</p>";
echo form_close();

echo form_open('salary/view_salary');
echo "<p>";
echo form_submit('salary_view', 'View Doctor Salary');
echo "</p>";
echo form_close();

echo form_open('update/update_doctor_info');
echo "<p>";
echo form_submit('update_submit', 'Update Your Information');
echo "</p>";
echo form_close();
?>
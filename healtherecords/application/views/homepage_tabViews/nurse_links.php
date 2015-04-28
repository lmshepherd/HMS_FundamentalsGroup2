<?php 
echo form_open('schedule/change_schedule');
echo "<p>";
echo form_submit('schedule_submit', 'View/Change Schedule');
echo "</p>";
echo form_close();

echo form_open('appointment/nurse_view_patients');
echo "<p>";
echo form_submit('appointment_submit', 'View Patient Appointments');
echo "</p>";
echo form_close();

echo form_open('salary/view_salary');
echo "<p>";
echo form_submit('salary_view', 'View Nurse Salary');
echo "</p>";
echo form_close();

echo form_open('update/update_nurse_info');
echo "<p>";
echo form_submit('update_submit', 'Update Your Information');
echo "</p>";
echo form_close();
?>
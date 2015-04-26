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
?>
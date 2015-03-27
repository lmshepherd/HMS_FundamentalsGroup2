<?php
echo "<p>Specialization: ";
echo form_input('specialization',$this->input->post('specialization'));
echo "</p>";

echo "<p>Availability: ";
echo form_input('availability',$this->input->post('availability'));
echo "</p>";

echo "<p>Department: ";
echo form_input('department',$this->input->post('department'));
echo "</p>";
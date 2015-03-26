<?php
echo "<p>Specialization: ";
echo form_input('specialization',$this->input->post('specialization'));
echo "</p>";

echo "<p>Availability: ";
echo form_input('availability',$this->input->post('availability'));
echo "</p>";

echo "<p>Experience: ";
echo form_input('experience',$this->input->post('experience'));
echo "</p>";
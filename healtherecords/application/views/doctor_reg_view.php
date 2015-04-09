<?php

$gender_options=array('m'=>'Male','f'=>'Female');
echo "<p>Gender: ";
echo form_dropdown('gender', $gender_options,'m');
echo "</p>";

$specialization = array(''=>'Select Specialization',
			'cardiologist'=>'Cardiologist',
			'endocrinologist'=>'Endocrinologist',
			'general'=>'General Practitioner',
			'immunologist'=>'Immunologist',
			'neurologist'=>'Neurologist');
echo "<p>Specialization: ";
//create dropdown box
echo form_dropdown('specialization',$specialization,'','id="spec"');
echo "</p>";

echo "<p>Availability: ";
$time_options = array('0'=>'12:00am',
		'1'=>'1:00am','2'=>'2:00am',
		'3'=>'3:00am','4'=>'4:00am',
		'5'=>'5:00am','6'=>'6:00am',
		'7'=>'7:00am','8'=>'8:00am',
		'9'=>'9:00am','10'=>'10:00am',
		'11'=>'11:00am','12'=>'12:00pm',
		'13'=>'1:00pm','14'=>'2:00pm',
		'15'=>'3:00pm','16'=>'4:00pm',
		'17'=>'5:00pm','18'=>'6:00pm',
		'19'=>'7:00pm','20'=>'8:00pm',
		'21'=>'9:00pm','22'=>'10:00pm',
		'23'=>'11:00pm','23'=>'11:59pm','-1'=>'none');
$this->table->set_heading('','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$this->table->add_row('Start time:',
		form_dropdown('sunstart',$time_options,'9','id="sunstart"'),
		form_dropdown('monstart',$time_options,'9','id="monstart"'),
		form_dropdown('tuestart',$time_options,'9','id="tuestart"'),
		form_dropdown('wedstart',$time_options,'9','id="wedstart"'),
		form_dropdown('thustart',$time_options,'9','id="thustart"'),
		form_dropdown('fristart',$time_options,'9','id="fristart"'),
		form_dropdown('satstart',$time_options,'9','id="satstart"'));
unset($time_options[-1]);
$this->table->add_row('End time:',
		form_dropdown('sunend',$time_options,'17','id="sunend"'),
		form_dropdown('monend',$time_options,'17','id="monend"'),
		form_dropdown('tueend',$time_options,'17','id="tueend"'),
		form_dropdown('wedend',$time_options,'17','id="wedend"'),
		form_dropdown('thuend',$time_options,'17','id="thuend"'),
		form_dropdown('friend',$time_options,'17','id="friend"'),
		form_dropdown('satend',$time_options,'17','id="satend"'));
echo $this->table->generate();
//echo form_input('availability',$this->input->post('availability'));
echo "</p>";

echo "<p>Experience: ";
echo form_input('experience',$this->input->post('experience'));
echo "</p>";
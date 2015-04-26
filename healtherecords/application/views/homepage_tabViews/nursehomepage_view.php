<?php
$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');

$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

$this->db->where('id',$id);
$query = $this->db->get('nurses');
$row = $query->row();
$query = $this->db->get('schedule');
$row2 = $query->row();

/*echo '<p>Specialization: ';
echo $row->specialization;
echo '</p>';*/

echo '<p>Department: ';
echo $row->department;
echo '</p>';

/*
echo '<p>Availability: ';
//echo $row->availability;
$this->table->set_heading('','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$this->table->add_row('Start time:',
		$row2->sunstart,
		$row2->monstart,
		$row2->tuestart,
		$row2->wedstart,
		$row2->thustart,
		$row2->fristart,
		$row2->satstart);
$this->table->add_row('End time:',
		$row2->sunend,
		$row2->monend,
		$row2->tueend,
		$row2->wedend,
		$row2->thuend,
		$row2->friend,
		$row2->satend);
echo $this->table->generate();
echo '</p>';*/


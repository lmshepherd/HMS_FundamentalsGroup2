<?php
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

$this->db->where('id',$id);
$query = $this->db->get('nurses');
$row = $query->row();

echo '<p>Specialization: ';
echo $row->specialization;
echo '</p>';

echo '<p>Department: ';
echo $row->department;
echo '</p>';

echo '<p>Availability: ';
echo $row->availability;
echo '</p>';
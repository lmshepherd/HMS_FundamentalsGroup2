<?php
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

$this->db->where('id',$id);
$query = $this->db->get('doctors');
$row = $query->row();

echo '<p>Specialization: ';
echo $row->specialization;
echo '</p>';

echo '<p>Experience: ';
echo $row->experience;
echo '</p>';

echo '<p>Availability: ';
echo $row->availability;
echo '</p>';

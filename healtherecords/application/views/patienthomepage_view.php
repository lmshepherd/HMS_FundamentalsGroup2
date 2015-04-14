
<?php 
$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

$this->db->where('id',$id);
$query = $this->db->get('patients');
$row = $query->row();

echo '<p>Gender: ';
if($row->gender == 'm'){
	echo 'Male';
}
else{
	echo 'Female';
}
echo '</p>';

echo '<p>Marital Status: ';
echo $row->maritalstatus;
echo '</p>';

echo '<p>Address: ';
echo $row->addressline1;
echo '</p>';

echo '<p>';
echo $row->addressline2;
echo '</p>';

echo '<p>City: ';
echo $row->city;
echo '</p>';

echo '<p>Zipcode: ';
echo $row->zipcode;
echo '</p>';

echo '<p>Emergency Contact Name: ';
echo $row->ecname;
echo '</p>';

echo '<p>Emergency Contact Phone Number:';
echo $row->ecphone;
echo '</p>';

echo '<p> Insurance Start: ';
echo $row->insurancestart;
echo '</p>';

echo '<p>Insurance End: ';
echo $row->insuranceend;
echo '</p>';

echo '<p>Insurance Provider: ';
echo $row->insuranceprovider;
echo '</p>';

echo '<p>Medical Record: ';
echo $row->record;
echo '</p>';

echo '<p>Treatments: ';
echo $row->treatments;
echo '</p>';

echo '<p>Allergies: ';
echo $row->allergies;
echo '</p>';

echo form_open('main/complete_medicalRecord',$attributes);
echo "<p>";
echo form_submit('medicalRecord_submit', 'Fill out Medical Record');
echo "</p>";
echo form_close();

echo form_open('main/view_medicalRecord');
echo "<p>";
echo form_submit('medicalRecordReadOnly_submit', 'View Medical Record');
echo "</p>";
echo form_close();

echo form_open('appointment/make_appointment');
echo "<p>";
echo form_submit('appointment_submit', 'Make an Appointment');
echo "</p>";
echo form_close();

echo form_open('appointment/view_appointments');
echo "<p>";
echo form_submit('appointment_submit', 'View Appointments');
echo "</p>";
echo form_close();

?>
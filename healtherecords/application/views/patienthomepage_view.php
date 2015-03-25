<!--  

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	
	<h1>Welcome to Health E-Records, <?php //echo $this->session->userdata('username'); ?>!</h1>
	
	<a href = '<?php 
		//echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
-->

<?php 
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

$this->db->where('id',$id);
$query = $this->db->get('patients');
$row = $query->row();

echo '<p>Gender: ';
echo $row->gender;
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
?>
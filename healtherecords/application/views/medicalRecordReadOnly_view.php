<?php 
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('medical_record');
$row = $query->row();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	
	<h1>Here is your current medical record</h1>
	<?php
	if($row!=NULL){
		echo '<p>Height: ';
		echo $row->height;
		echo '</p>';
		
		echo '<p>Weight: ';
		echo $row->weight;
		echo '</p>';
		
		echo '<p>Surgery history: ';
		echo $row->surgery;
		echo '</p>';
		
		echo '<p>Family history: ';
		echo $row->family;
		echo '</p>';
		
		echo '<p>Religion: ';
		echo $row->religion;
		echo '</p>';
		
		echo '<p>Career: ';
		echo $row->career;
		echo '</p>';
		
		echo '<p>Alcohol: ';
		echo $row->alcohol;
		echo '</p>';
		
		echo '<p>Smoking: ';
		echo $row->smoker;
		echo '</p>';
		
		echo '<p>Other notes: ';
		echo $row->other;
		echo '</p>';
		
		echo form_open('main/complete_medicalRecord');
		
		echo "<p>";
		echo form_submit('medicalRecord_submit', 'Update Your Medical Record');
		echo "</p>";
		
		echo form_close();	
	}
	?>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Health E-Records</title>
</head>

<body>
<div id="container">
	<h1>Health E-Records Appointment Confirmation</h1>
	<p>Your appointment has been made!</p>
	<p>Appointment information: </p>

	<?php 
	$hour = $this->input->post('hours');
	$aptdate = $this->session->userdata('aptdate');
	$docid = $this->session->userdata('selected_doctor');
	//$table_name = $docid.'_appts';
	$this->db->from('userinfo');
	$this->db->where('id',$docid);
	//$this->db->where('hour',$hour);
	$query = $this->db->get();
	$row = $query->row();
	
	//echo 'Appointment confirmed for: '.$aptdate;
	echo $aptdate.' at '.$hour.' with Dr. '.$row->lastname;
	?>

	<br>
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	<a href = '<?php
		echo base_url(),"index.php/main"
	?>'>Back to Login</a>
</div>
</body>
</html>


	
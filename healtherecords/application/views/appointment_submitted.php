
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
<meta charset="utf-8">
<title>Health E-Records</title>
</head>

<body>
<header id="header"><h1>Health E-Records Appointment Confirmation</h1></header>
<div id="container">
	<p>Your appointment has been made!</p>
	<p>Appointment information: </p>

	<?php 
	$hour = $this->input->post('hours');
	$aptdate = $this->session->userdata('aptdate');
	$docid = $this->session->userdata('selected_doctor');
	$this->db->from('userinfo');
	$this->db->where('id',$docid);
	//$this->db->where('hour',$hour);
	$query = $this->db->get();
	$row = $query->row();
	
	
	if ($hour>12)
	{
		$hour12 = $hour%12;
		$ampm = 'pm';
	}
	else
	{
		$hour12 = $hour;
		$ampm = 'am';
	}
	if ($hour12==0)
		$hour12 = $hour12 + 12;
	//echo 'Appointment confirmed for: '.$aptdate;
	echo $aptdate.' at '.$hour12.' '.$ampm.' with Dr. '.$row->lastname;
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


	
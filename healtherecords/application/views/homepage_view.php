<?php 
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$role = $row->role;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	
	<h1>Welcome to Health E-Records, <?php echo $row->firstname; ?></h1>
	
	<?php 
	echo '<p>'; 
	if ($row->role=='patient')
		echo 'Patient';
	else if ($row->role=='nurse')
		echo 'Nurse';
	else if ($row->role=='doctor')
		echo 'Doctor';
	else echo 'Admin';
	echo ' Information: </p>';
	
	echo '<p>Name: ';
	echo $row->firstname;
	echo ' ';
	echo $row->lastname;
	echo '</p>';
	
	echo '<p>Email: ';
	echo $row->email;
	echo '</p>';
	
	echo '<p>Date of Birth: ';
	echo $row->dob;
	echo '</p>';
	
	echo '<p>Home Phone: ';
	echo $row->homephone;
	echo '</p>';
	
	echo '<p>Work Phone: ';
	echo $row->workphone;
	echo '</p>';
	
	if($role=='patient')
		$this->load->view('patienthomepage_view');
	else if($role=='nurse')
		$this->load->view('nursehomepage_view');
	else if($role=='doctor')
		$this->load->view('doctorhomepage_view');
	
	?>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
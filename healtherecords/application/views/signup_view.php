<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	<h1>Health E-Records New User Signup</h1>

	<div id="body">
		<?php 
		echo form_open('main/verify_signup');
		
		echo validation_errors();
		
		echo "<p>Username: ";
		echo form_input('username',$this->input->post('username'));
		echo "</p>";
		
		echo "<p>Password: ";
		echo form_password('password');
		echo "</p>";
		
		echo "<p>Confirm Password: ";
		echo form_password('cpassword');
		echo "</p>";
		
		echo "<p>Email: ";
		echo form_input('email',$this->input->post('email'));
		echo "</p>";
		
		//store dropdown box options as an array
		$role_options = array('patient'=>'Patient',
				'nurse'=>'Nurse',
				'doctor'=>'Doctor',
				'admin'=>'Admin');
		echo "<p>Role: ";
		//create dropdown box, default option patient
		echo form_dropdown('role',$role_options,'patient');
		echo "</p>";
		
		echo "<p>";
		echo form_submit('signup_submit', 'Sign Up!');
		echo "</p>";
		
		echo form_close();
		?>
		
		<a href = '<?php 
		echo base_url(),"index.php/main"
		?>'>Back to Login</a>
	
	</div>

</div>

</body>
</html>
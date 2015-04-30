<!DOCTYPE html>
<html lang="en">
<head>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>
    <header id="header"><h1>Health E-Records New User Signup</h1></header>
    <div id="container">
    	<div class="row">
        	<div class="col-lg-2", id="left">
				<?php $this->load->view('commonViews/links');?>
			</div>
	        <div class="col-lg-10", id="center">
	        	<br>
	        	<?php 
				$attributes = array('class' => 'form-group', 'role' => 'form');
				
				echo form_open('main/verify_signup', $attributes);
				
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
				?>'>Back to Login</a><p></p>
			</div>
    	</div>  
	</div>
	<?php $this->load->view('commonViews/footer');?>
</body>
</html>
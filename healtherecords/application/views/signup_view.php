<?php $this->load->view('commonViews/header');?>

<body>
    <header id="header"><h1>Health E-Records New User Signup</h1></header>
    <div id="container">
    	<div class="row">
        	<div class="col-lg-3">
				<?php $this->load->view('commonViews/links');?>
			</div>
	        <div class="col-lg-9">
	        	<br><br><br><br>
	        	<?php 
				$attributes = array('class' => 'form-group', 'role' => 'form', 'id' =>'center', 'class' =>'column');
				
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
				?>'>Back to Login</a>
			</div>
    	</div>  
	</div>
	<?php $this->load->view('commonViews/footer');?>
</body>
</html>
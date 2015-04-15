<?php $this->load->view('header');?>

<body>
    <header id="header"><h1>Health E-Records New User Signup</h1></header>
    <div id="container">
		
		<nav id="left" class="column">
			<h3>Patient Links</h3>
			<ul>
				<li><a href="http://projectsgeek.com/2013/08/hospital-management-system-mini-project-2.html">HMS Info</a></li>
				<li><a href="#">Link 2</a></li>
				<li><a href="#">Link 3</a></li>
				<li><a href="#">Link 4</a></li>
				<li><a href="#">Link 5</a></li>
			</ul>
			<h3>Doctor Links</h3>
		    <ul>
				<li><a href="#">Link 1</a></li>
				<li><a href="#">Link 2</a></li>
			    <li><a href="#">Link 3</a></li>
				<li><a href="#">Link 4</a></li>
				<li><a href="#">Link 5</a></li>
			</ul>
		</nav>    
		
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

</body>
</html>
<?php
//$this->load->model('user');
//$role = $this->user->get_role();
$role = $this->session->userdata('role');
//$username = $this->session->userdata('username');
//$args = array('role' => $role, 'username' => $username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records New User Info</title>
</head>

<body>
<div id="container">
	<h1>Health E-Records New User Info</h1>
	<p>Please fill in your information:</p>
	<div id="body">
		<?php 
		echo form_open('main/complete_registration');
		
		echo validation_errors();
		
		echo "<p>First Name: ";
		echo form_input('firstname',$this->input->post('firstname'));
		echo "</p>";
		
		echo "<p>Last Name: ";
		echo form_input('lastname',$this->input->post('lastname'));
		echo "</p>";
		
		echo "<p>Date of Birth: ";
		echo form_input('dob',$this->input->post('dob'));
		echo " Please use format YYYY-MM-DD";
		echo "</p>";
		
		echo "<p>Home Phone: ";
		echo form_input('homephone',$this->input->post('homephone'));
		echo " Please use format XXX-XXX-XXXX";
		echo "</p>";
		
		echo "<p>Work Phone: ";
		echo form_input('workphone',$this->input->post('workphone'));
		echo " Please use format XXX-XXX-XXXX";
		echo "</p>";

		if($role=='patient')
			$this->load->view('patient_reg_view');
		else if($role=='nurse')
			$this->load->view('nurse_reg_view');
		else if($role=='doctor')
			$this->load->view('doctor_reg_view');
		
		echo "<p>";
		echo form_submit('info_submit', 'Complete Registration!');
		echo "</p>";
		
		echo form_close();
		?>
	</div>
	
	<a href = '<?php 
		echo base_url(),"index.php/main"
		?>'>Back to Login</a>
</div>
</body>
</html>
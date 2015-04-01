<?php
//$this->load->model('user');
//$role = $this->user->get_role();
$username = $this->session->userdata('username');
//$username = $this->session->userdata('username');
//$args = array('role' => $role, 'username' => $username);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records Medical Record</title>
</head>

<body>
<div id="container">
	<h1>Health E-Records Medical Record</h1>
	<p>Please fill in your information:</p>
	<div id="body">
		<?php 
		echo form_open('main/complete_medicalRecord');
		
		echo validation_errors();
		
		echo "<p>Height: ";
		echo form_input('height',$this->input->post('height'));
		echo " inches";
		echo "</p>";
		
		echo "<p>Weight: ";
		echo form_input('weight',$this->input->post('weight'));
		echo " pounds";
		echo "</p>";
		
		echo "<p>Surgery History: ";
		echo form_input('surgery',$this->input->post('surgery'));
		echo "</p>";
		
		echo "<p>Family History: ";
		echo form_input('family',$this->input->post('family'));
		echo "</p>";
		
		echo "<p>Religion: ";
		echo form_input('workphone',$this->input->post('workphone'));
		echo "</p>";
		
		echo "<p>Career: ";
		echo form_input('career',$this->input->post('career'));
		echo "</p>";
		
		echo "<p>Alcohol: ";
		echo form_input('alcohol',$this->input->post('alcohol'));
		echo "</p>";
		
		echo "<p>Smoking: ";
		echo form_input('smoker',$this->input->post('smoker'));
		echo "</p>";
		
		echo "<p>Other: ";
		echo form_input('other',$this->input->post('other'));
		echo "</p>";
		
		echo "<p>";
		echo form_submit('medicalRecord_submit', 'Complete Medical Record!');
		echo "</p>";
		
		echo form_close();
		?>
	</div>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main"
		?>'>Back to Login</a>
</div>
</body>
</html>
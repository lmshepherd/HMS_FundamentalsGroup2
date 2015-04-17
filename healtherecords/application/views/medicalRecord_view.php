<?php
//$this->load->model('user');
//$role = $this->user->get_role();
$username = $this->session->userdata('username');
//$username = $this->session->userdata('username');
//$args = array('role' => $role, 'username' => $username);
?>
<?php $this->load->view('header');?>

<body>
<header id="header"><h1>Health E-Records: Medical Record</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-4">
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
		</div>
        <div class="col-lg-8">
        	<p>Please fill in your information:</p>
			<?php 
	//***************This is an example of how to add attributes to a form!
			$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
			$data = array('class' => 'btn-lg', 'id' => 'submitMedicalRecord');
			$height = array(
					'name'        => 'height',
					'id'          => 'height',
					'value'       => $this->input->post('height'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$weight = array(
					'name'        => 'weight',
					'id'          => 'weight',
					'value'       => $this->input->post('weight'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$surgery = array(
					'name'        => 'surgery',
					'id'          => 'surgery',
					'value'       => $this->input->post('surgery'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$religion = array(
					'name'        => 'religion',
					'id'          => 'religion',
					'value'       => $this->input->post('surgery'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$family = array(
					'name'        => 'family',
					'id'          => 'family',
					'value'       => $this->input->post('family'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$workphone = array(
					'name'        => 'workphone',
					'id'          => 'workphone',
					'value'       => $this->input->post('workphone'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$career = array(
					'name'        => 'career',
					'id'          => 'career',
					'value'       => $this->input->post('career'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$alcohol = array(
					'name'        => 'alcohol',
					'id'          => 'alcohol',
					'value'       => $this->input->post('alcohol'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$smoker = array(
					'name'        => 'smoker',
					'id'          => 'smoker',
					'value'       => $this->input->post('smoker'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			$other = array(
					'name'        => 'other',
					'id'          => 'other',
					'value'       => $this->input->post('other'),
					'maxlength'   => '100',
					'size'        => '50',
					'style'       => 'width:50%',
			);
			
			echo form_open('main/complete_medicalRecord', $attributes);
			
			echo validation_errors();
			
			echo "<p>Height: ";
			echo form_input($height);
			echo " inches";
			echo "</p>";
			
			echo "<p>Weight: ";
			echo form_input($weight);
			echo " pounds";
			echo "</p>";
			
			echo "<p>Surgery History: ";
			echo form_input($surgery);
			echo "</p>";
			
			echo "<p>Family History: ";
			echo form_input($family);
			echo "</p>";
			
			echo "<p>Religion: ";
			echo form_input($religion);
			echo "</p>";
			
			echo "<p>Career: ";
			echo form_input($career);
			echo "</p>";
			
			echo "<p>Alcohol: ";
			echo form_input($alcohol);
			echo "</p>";
			
			echo "<p>Smoking: ";
			echo form_input($smoker);
			echo "</p>";
			
			echo "<p>Other: ";
			echo form_input($other);
			echo "</p>";
			
			echo "<p>";
			echo form_submit( $data, 'medicalRecord_submit', 'Complete Medical Record!');
			echo "</p>";
			
			echo form_close();
			?>
		
		<a href = '<?php 
			echo base_url(),"index.php/main/home"
			?>'>Back to Home</a>
		
		<a href = '<?php 
			echo base_url(),"index.php/main"
			?>'><br>Back to Login</a>
	</div>
      </div>
</div>
</body>
</html>
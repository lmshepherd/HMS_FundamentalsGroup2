<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	</script>
	


<body>
<header id="header"><h1>Health E-Records: Update Patient Information</h1></header>
<div id="container">

	<div class="col-lg-10", id="center">
		<?php 
			echo validation_errors();
			$username = $this->session->userdata('username');
		
			$this->db->where('username',$username);
			$query1 = $this->db->get('userinfo');
			$row1 = $query1->row();
			$role = $row1->role;
		
			echo form_open('update/change_username');
			echo '<p>Username: ';
			echo $row1->username;
			echo '    ';
			echo form_input('username',$this->input->post('username'));
			echo form_submit('username_change', 'Change Username');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_email');
			echo '<p>Email: ';
			echo $row1->email;
			echo '    ';
			echo form_input('email',$this->input->post('email'));
			echo form_submit('username_change', 'Change Email');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_homephone');
			echo '<p>Home Phone: ';
			echo $row1->homephone;
			echo '    ';
			echo form_input('homephone',$this->input->post('homephone'));
			echo form_submit('homephone_change', 'Change Home Number');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_workphone');
			echo '<p>Work Phone: ';
			echo $row1->workphone;
			echo '    ';
			echo form_input('workphone',$this->input->post('workphone'));
			echo form_submit('workphone_change', 'Change Work Number');
			echo '</p>';
			echo form_close();
			
			$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
			$username = $this->session->userdata('username');
			
			$this->db->where('username',$username);
			$query = $this->db->get('userinfo');
			$row = $query->row();
			$id = $row->id;
			
			$this->db->where('id',$id);
			$query = $this->db->get('patients');
			$row = $query->row();
			
			
			$gender_options=array('m'=>'Male','f'=>'Female');
			echo form_open('update/change_gender');
			echo '<p>Gender: ';
			if($row->gender == 'm'){
				echo 'Male';
			}
			else{
				echo 'Female';
			}
			echo '    ';
			echo form_dropdown('gender', $gender_options,'m');
			echo form_submit('gender_change', 'Change Gender');
			echo '</p>';
			echo form_close();
			
			
			$marital_options = array('single'=>'Single',
					'married'=>'Married',
					'divorced'=>'Divorced',
					'widowed'=>'Widowed');
			echo form_open('update/change_marriage');
			echo '<p>Marital Status: ';
			echo $row->maritalstatus;
			echo '    ';
			echo form_dropdown('maritalstatus',$marital_options,'single');
			echo form_submit('marriage_change', 'Change Marital Status');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_al1');
			echo '<p>Address: ';
			echo $row->addressline1;
			echo '    ';
			echo form_input('addressline1',$this->input->post('addressline1'));
			echo form_submit('addline1_change', 'Change Address Line 1');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_al2');
			echo '<p>Line 2: ';
			echo $row->addressline2;
			echo '    ';
			echo form_input('addressline2',$this->input->post('addressline2'));
			echo form_submit('addline2_change', 'Change Address Line 2');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_city');
			echo '<p>City: ';
			echo $row->city;
			echo '    ';
			echo form_input('city',$this->input->post('city'));
			echo form_submit('city_change', 'Change City');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_zip');
			echo '<p>Zipcode: ';
			echo $row->zipcode;
			echo '    ';
			echo form_input('zipcode',$this->input->post('zipcode'));
			echo form_submit('zip_change', 'Change Zipcode');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_ecname');
			echo '<p>Emergency Contact Name: ';
			echo $row->ecname;
			echo '    ';
			echo form_input('ecname',$this->input->post('ecname'));
			echo form_submit('ecn_change', 'Change Emergency Contact Name');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_ecphone');
			echo '<p>Emergency Contact Phone Number:';
			echo $row->ecphone;
			echo '    ';
			echo form_input('ecphone',$this->input->post('ecphone'));
			echo form_submit('ecp_change', 'Change Emergency Contact Phone #');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_insurancestart');
			echo '<p> Insurance Start: ';
			echo $row->insurancestart;
			echo '    ';
			echo form_input('insurancestart',$this->input->post('insurancestart'));
			echo form_submit('iss_change', 'Change Insurance Start Date');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_insuranceend');
			echo '<p>Insurance End: ';
			echo $row->insuranceend;
			echo '    ';
			echo form_input('insuranceend',$this->input->post('insuranceend'));
			echo form_submit('ise_change', 'Change Insurance End Date');
			echo '</p>';
			echo form_close();
			
			echo form_open('update/change_insurancepolicy');
			echo '<p>Insurance Provider: ';
			echo $row->insuranceprovider;
			echo '    ';
			echo form_input('insuranceprovider',$this->input->post('insuranceprovider'));
			echo form_submit('isp_change', 'Change Insurance Provider');
			echo '</p>';
			echo form_close();

			echo form_open('update/change_allergies');
			echo '<p>Allergies: ';
			echo $row->allergies;
			echo '    ';
			echo form_input('allergies',$this->input->post('allergies'));
			echo form_submit('aller_change', 'Change Allergies');
			echo '</p>';
			echo form_close();
		?>
		<?php $this->load->view('commonViews/backLinks');?>
	</div>

	
	
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
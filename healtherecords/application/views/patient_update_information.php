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
	<br>
		<?php 
			echo validation_errors();
			$username = $this->session->userdata('username');
		
			$this->db->where('username',$username);
			$query1 = $this->db->get('userinfo');
			$row1 = $query1->row();
			$role = $row1->role;
		
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('Category','Information ','  New Info','Change Button');
			
			$this->table->add_row('Username ',
								$row1->username,
								form_open('update/change_username').form_input('username',$this->input->post('username')),
								form_submit('username_change', 'Change Username').form_close());
			
			$this->table->add_row('Email ',
								$row1->email,
								form_open('update/change_email').form_input('email',$this->input->post('email')),
								form_submit('username_change', 'Change Email').form_close()
					);
			
			$this->table->add_row('Home Phone ',
								$row1->homephone,
								form_open('update/change_homephone').form_input('homephone',$this->input->post('homephone')),
								form_submit('homephone_change', 'Change Home Number').form_close()
					);
			
			$this->table->add_row('Work Phone ',
								$row1->workphone,
								form_open('update/change_workphone').form_input('workphone',$this->input->post('workphone')),
								form_submit('workphone_change', 'Change Work Number').form_close()
					);
			
			
			//echo $this->table->generate();
			
			$username = $this->session->userdata('username');
			
			$this->db->where('username',$username);
			$query = $this->db->get('userinfo');
			$row = $query->row();
			$id = $row->id;
			
			$this->db->where('id',$id);
			$query = $this->db->get('patients');
			$row = $query->row();
			
			
			$gender_options=array('m'=>'Male','f'=>'Female');
			if($row->gender == 'm'){
				$gender =  'Male';
			}
			else{
				$gender =  'Female';
			}
			
			$this->table->add_row('Gender',
								$gender,
								form_open('update/change_gender').form_dropdown('gender', $gender_options,'m'),
								form_submit('gender_change', 'Change Gender').form_close()
					);
		
			
			$marital_options = array('single'=>'Single',
					'married'=>'Married',
					'divorced'=>'Divorced',
					'widowed'=>'Widowed');
			
			$this->table->add_row('Marital Status',
									$row->maritalstatus,
									form_open('update/change_marriage').form_dropdown('maritalstatus',$marital_options,'single'),
									form_submit('marriage_change', 'Change Marital Status').form_close());

			$this->table->add_row('Address',
								$row->addressline1,
								form_open('update/change_al1').form_input('addressline1',$this->input->post('addressline1')),
								form_submit('addline1_change', 'Change Address Line 1').form_close());
			
			$this->table->add_row('Line 2',
									$row->addressline2,
									form_open('update/change_al2').form_input('addressline2',$this->input->post('addressline2')),
									form_submit('addline2_change', 'Change Address Line 2').form_close());
			
			$this->table->add_row('City',
									$row->city,
									form_open('update/change_city').form_input('city',$this->input->post('city')),
									form_submit('city_change', 'Change City').form_close());
			
			$this->table->add_row('Zipcode',
								$row->zipcode,
								form_open('update/change_zip').form_input('zipcode',$this->input->post('zipcode')),
									form_submit('zip_change', 'Change Zipcode').form_close()
							);
			
			$this->table->add_row('Emergency Contact Name',
								$row->ecname,
								form_open('update/change_ecname').form_input('ecname',$this->input->post('ecname')),
								form_submit('ecn_change', 'Change Emergency Contact Name').form_close()
							);
			
			$this->table->add_row('Emergency Contact Phone',
									$row->ecphone,
									form_open('update/change_ecphone').form_input('ecphone',$this->input->post('ecphone')),
									form_submit('ecp_change', 'Change Emergency Contact Phone #').form_close());
			
			$this->table->add_row('Insurance Start',
								$row->insurancestart,
								form_open('update/change_insurancestart').form_input('insurancestart',$this->input->post('insurancestart')),
								form_submit('iss_change', 'Change Insurance Start Date').form_close()
							);
			
			$this->table->add_row('Insurance End',
								$row->insuranceend,
								form_open('update/change_insuranceend').form_input('insuranceend',$this->input->post('insuranceend')),
								form_submit('ise_change', 'Change Insurance End Date').form_close()
							);
			
			$this->table->add_row('Insurance Provider',
								$row->insuranceprovider,
							form_open('update/change_insurancepolicy').form_input('insuranceprovider',$this->input->post('insuranceprovider')),
							form_submit('isp_change', 'Change Insurance Provider').form_close()
					);

			$this->table->add_row('Allergies',
								$row->allergies,
								form_open('update/change_allergies').form_input('allergies',$this->input->post('allergies')),
								form_submit('aller_change', 'Change Allergies').form_close()
					);
			
			echo $this->table->generate();
		?>
		<?php $this->load->view('commonViews/backLinks');?><p></p>
	</div>

	
	
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
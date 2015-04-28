
<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	</script>
	


<body>
<header id="header"><h1>Health E-Records: Update Doctor Information</h1></header>
<div id="container">

	<div class="col-lg-10", id="center">
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
								form_open('update/change_username_doctor').form_input('username',$this->input->post('username')),
								form_submit('username_change', 'Change Username').form_close());
			
			$this->table->add_row('Email ',
								$row1->email,
								form_open('update/change_email_doctor').form_input('email',$this->input->post('email')),
								form_submit('username_change', 'Change Email').form_close()
					);
			
			$this->table->add_row('Home Phone ',
								$row1->homephone,
								form_open('update/change_homephone_doctor').form_input('homephone',$this->input->post('homephone')),
								form_submit('homephone_change', 'Change Home Number').form_close()
					);
			
			$this->table->add_row('Work Phone ',
								$row1->workphone,
								form_open('update/change_workphone_doctor').form_input('workphone',$this->input->post('workphone')),
								form_submit('workphone_change', 'Change Work Number').form_close()
					);
			
			$this->db->where('id', $row1->id);
			$query2 = $this->db->get('doctors');
			$row2 = $query2->row();
			$this->table->add_row('Experience ',
								$row2->experience.' years',
								form_open('update/change_experience_doctor').form_input('experience',$this->input->post('experience')),
								form_submit('experience_change', 'Change Experience').form_close());
			
			echo $this->table->generate();
		?>
		<?php $this->load->view('commonViews/backLinks');?>
	</div>

	
	
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
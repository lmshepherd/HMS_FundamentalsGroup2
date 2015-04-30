<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Update Your Medical Record</h1></header>
<div id="container">
	<div class="row">
        <div class="col-lg-2", id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10", id="center">
    	    <?php
	    	    echo validation_errors();
	    	    $username = $this->session->userdata('username');
	    	    
	    	    $this->db->where('username',$username);
	    	    $query1 = $this->db->get('userinfo');
	    	    $row1 = $query1->row();
	    	    $id = $row1->id;
	    	    
	    	    $this->db->where('id', $id);
	    	    $query = $this->db->get('medical_record');
	    	    $row =$query->row();
	    	    
	    	    $table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
	    	    		'table_close' => '</table>');
	    	    $this->table->set_template($table_config);
	    	    $this->table->set_heading('Category','Information ','  New Info','Change Button');
    	    
	    	    $this->table->add_row('Height ',
	    	    		$row->height.' inches',
	    	    		form_open('update/change_height').form_input('height',$this->input->post('height')),
	    	    		form_submit('height_change', 'Change Height').form_close());
	    	    	
	    	    $this->table->add_row('Weight ',
	    	    		$row->weight.' pounds',
	    	    		form_open('update/change_weight').form_input('weight',$this->input->post('weight')),
	    	    		form_submit('weight_change', 'Change Weight').form_close());
	    	   
	    	    $this->table->add_row('Surgery History ',
	    	    		$row->surgery,
	    	    		form_open('update/change_surgery').form_input('surgery',$this->input->post('surgery')),
	    	    		form_submit('surgery_change', 'Change Surgery History').form_close());
	    	 
	    	    $this->table->add_row('Family History ',
	    	    		$row->family,
	    	    		form_open('update/change_family').form_input('family',$this->input->post('family')),
	    	    		form_submit('family_change', 'Change Family History').form_close());

	    	    $this->table->add_row('Religion ',
	    	    		$row->religion,
	    	    		form_open('update/change_religion').form_input('religion',$this->input->post('religion')),
	    	    		form_submit('religion_change', 'Change Religion').form_close());

	    	    $this->table->add_row('Career ',
	    	    		$row->career,
	    	    		form_open('update/change_career').form_input('career',$this->input->post('career')),
	    	    		form_submit('career_change', 'Change Career').form_close());


	    	    $this->table->add_row('Alcohol ',
	    	    		$row->alcohol,
	    	    		form_open('update/change_alcohol').form_input('alcohol',$this->input->post('alcohol')),
	    	    		form_submit('alcohol_change', 'Change Alcohol Use').form_close());
	    	    

	    	    $this->table->add_row('Smoking ',
	    	    		$row->smoker,
	    	    		form_open('update/change_smoking').form_input('smoker',$this->input->post('smoker')),
	    	    		form_submit('smoking_change', 'Change Smoking Use').form_close());
	    	    

	    	    $this->table->add_row('Other Notes ',
	    	    		$row->other,
	    	    		form_open('update/change_other').form_input('other',$this->input->post('other')),
	    	    		form_submit('other_change', 'Change Other Notes').form_close());
			
				
				echo $this->table->generate();
			
			?>
			<?php $this->load->view('commonViews/backLinks');?>
		</div>
	</div>

</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
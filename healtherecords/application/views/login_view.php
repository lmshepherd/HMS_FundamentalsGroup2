<?php $this->load->view('commonViews/header');?>
<body>
	<div id="header"><h1><img src="<?= base_url();?>bootstrap/images/HER.png" alt="logo"></h1></div>
	    <div class="row">
	        <div class="col-lg-2", id="left">
				<?php $this->load->view('commonViews/links');?>
			</div>
	        <div class="col-lg-8", id="center">
	        <br>
	        	<?php 
	        	/*testing for nurse assignment checking nurse schedule
	        	$day = strtolower(date('D', strtotime('2015-4-29')));
	        	$daystart = $day.'start';
	        	$dayend = $day.'end';
	        	$hour = 13;
	        	echo $daystart.' '.$dayend.' ';
	        	
	        	$this->db->from('schedule');
	        	$this->db->where('id', 42);
	        	$schedule_query = $this->db->get();
	        	$schedule_row = $schedule_query->row();
	        	//check if nurse is scheduled to work
	        	echo $schedule_row->$daystart.' '.$schedule_row->$dayend.' ';
	        	if ($schedule_row->$daystart!=-1 && $schedule_row->$daystart<=$hour && $schedule_row->$dayend>$hour)
	        		echo 'yes';
	        	else echo 'no';
	        	*/
	        	
	        	$this->load->view('commonViews/information_view');?>
			</div>
			<div class="col-lg-2" id='right'>
			<h3>Login</h3>
		        <?php 
				$attributes = array('class' => 'col-lg-3');
				$login = array(
						'name'        => 'login_submit',
						'id'          => 'login_submit',
						'value'       => 'Login',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:50%',
						'class' => 'btn-primary',
				);
				$signup = array(
						'name'        => 'signup_submit',
						'id'          => 'signup_submit',
						'value'       => 'Sign up',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:50%',
						'class' => 'btn-primary',
				);
				$pwchange = array(
						'name'        => 'pwchange_submit',
						'id'          => 'pwchange_submit',
						'value'       => 'Forgot Password?',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:75%',
						'class' => 'btn-primary',
				);
				
				echo form_open('main/verify_login');
			
				echo validation_errors();
				
				echo "<p>Username: ";
				echo form_input('username',$this->input->post('username'));
				echo "</p>";
				
				echo "<p>Password: ";
				echo form_password('password');
				echo "</p>";
				
				echo "<p>";
				echo form_submit($login);
				echo "</p>";
			
				echo form_close();
				
				echo form_open('main/new_user');
		
				echo "<p>";
				echo form_submit($signup, 'signup_submit', 'Sign Up');
				echo "</p>";
				
				echo form_close();
				
				echo form_open('update/change_password');
				
				echo "<p>";
				echo form_submit($pwchange);
				echo "</p>";
				
				echo form_close();
				?>
			</div>
		</div>
			
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
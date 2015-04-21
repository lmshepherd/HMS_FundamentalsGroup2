<?php $this->load->view('header');?>
<body>
	<div id="header"><h1>Health E-Records</h1></div>
	    <div class="row">
	        <div class="col-lg-3">
				<?php $this->load->view('links');?>
			</div>
	        <div class="col-lg-6">
	        	<h1>Homepage</h1>
				
				<p>This is where we can put the home page information for our HMS!<br><br><br>By Matt<br>Chuck<br>Laura<br><br><br>"I stood out in the open cold 
				<br>To see the essence of the eclipse <br>Which was its perfect darkness. <br>
				<br>I stood in the cold on the porch <br>And could not think of anything so perfect 
				<br>As mans hope of light in the face of darkness."<br><br>-Richard Eberhart</p>
			</div>
			<div class="col-lg-3" id='right'>
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
						'class' => 'btn-success',
				);
				$signup = array(
						'name'        => 'signup_submit',
						'id'          => 'signup_submit',
						'value'       => 'Sign up',
						'maxlength'   => '100',
						'size'        => '50',
						'style'       => 'width:50%',
						'class' => 'btn-success',
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
				?>
			</div>
		</div>
			
<?php $this->load->view('footer');?>
</body>
</html>
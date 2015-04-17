		    <?php 
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
					'class' => 'btn-lrg',
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
			echo form_submit('signup_submit', 'Sign Up');
			echo "</p>";
			
			echo form_close();
			?>
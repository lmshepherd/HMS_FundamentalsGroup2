<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<title>Health E-Records</title>
</head>

<body>
	    <header id="header"><h1>Health E-Records</h1></header>
        <div id="container">
			<main id="center" class="column">
			<article>
				<h1>Homepage</h1>
				<p>This is where we can put the home page information for our HMS!<br><br><br>By Matt<br>Chuck<br>Laura<br><br><br>"I stood out in the open cold <br>To see the essence of the eclipse <br>Which was its perfect darkness. <br><br>I stood in the cold on the porch <br>And could not think of anything so perfect <br>As mans hope of light in the face of darkness."<br><br>-Richard Eberhart</p>
			</article>								
		    </main>
		
			<nav id="left" class="column">
			    <h3>Patient Links</h3>
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
		    </nav>
	
		    <?php 
			$attributes = array('class' => 'form-group', 'role' => 'form', 'id' =>'right', 'class' =>'column');
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
			
			echo form_open('main/verify_login', $attributes);
		
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
		
		</div>
	</div>

</body>
</html>
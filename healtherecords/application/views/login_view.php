<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	<h1>Health E-Records Login</h1>

	<div id="body">
		<?php 
		echo form_open('main/verify');
		
		echo "<p>Username: ";
		echo form_input('username');
		echo "</p>";
		
		echo "<p>Password: ";
		echo form_password('password');
		echo "</p>";
		
		echo "<p>";
		echo form_submit('login_submit', 'Login');
		//echo "</p>";
		
		echo form_close();
		?>
		
		<?php 
		echo form_open();

		//echo "<p>";
		echo form_submit('signup_submit', 'Sign Up');
		echo "</p>";
		
		echo form_close();
		?>
	</div>

</div>

</body>
</html>
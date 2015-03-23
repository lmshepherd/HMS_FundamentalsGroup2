<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>

<body>

<div id="container">
	<h1>Health E-Records</h1>

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
		echo "</p>";
		
		echo form_close();
		?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records New User Info</title>
</head>

<body>
<div id="container">
	<h1>Health E-Records New User Info</h1>
	<p>Please fill in your information:</p>
	<div id="body">
		<?php 
		echo form_open();
		
		echo validation_errors();
		
		echo "<p>First Name: ";
		echo form_input('firstname');
		echo "</p>";
		
		echo "<p>Last Name: ";
		echo form_password('lastname');
		echo "</p>";
		
		echo "<p>";
		echo form_submit('info_submit', 'Submit');
		echo "</p>";
		
		echo form_close();
		?>
	</div>
	
	<a href = '<?php 
		echo base_url(),"index.php/main"
		?>'>Back to Login</a>
</div>
</body>
</html>
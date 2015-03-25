<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records Patient HomePage</title>
</head>

<body>

<div id="container">
	
	<h1>Welcome to Health E-Records, <?php echo $this->session->userdata('username'); ?>!</h1>
	<p>we made it</p>
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
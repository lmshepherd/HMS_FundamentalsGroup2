<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>
<header id="header"><h1>Health E-Records: Email Sent!</h1></header>
<div id="container">
	<h1>Health E-Records Sign Up</h1>
	<p>A link to complete registration has been sent to your email address!</p>
	<a href = '<?php 
		echo base_url(),"index.php/main"
		?>'>Back to Login</a>
</div>
</body>
</html>
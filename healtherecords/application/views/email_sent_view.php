<?php $this->load->view('header');?>

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
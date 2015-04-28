<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	</script>
	


<body>
<header id="header"><h1>Health E-Records: Password Recovery</h1></header>
<div id="container">

	<div class="col-lg-10", id="center">
		<p>Please enter in your username, email, home phone number and new password</p>
		<?php 
			echo validation_errors();
			
			echo form_open('update/password_recovery');
			
			echo "<p>";
			echo "Username: ";
			echo form_input('username');
			echo "</p>";
			
			echo "<p>";
			echo "Email: ";
			echo form_input('email');
			echo "</p>";
			
			echo "<p>";
			echo "Home phone: ";
			echo form_input('homephone');
			echo "</p>";
			
			echo "<p>";
			echo "Password: ";
			echo form_password('password');
			echo "</p>";
			
			echo "<p>";
			echo "Confirm Password: ";
			echo form_password('cpassword');
			echo "</p>";
			
			echo "<p>";
			echo form_submit('pw_submit', 'Change Password');
			echo "</p>";
			
			echo form_close();
		?>
		<a href='<?php echo base_url(), "index.php/main"?>'>Back to Login</a>
	</div>

	
	
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
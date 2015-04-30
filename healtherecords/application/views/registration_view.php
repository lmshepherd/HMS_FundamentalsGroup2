<?php
//$this->load->model('user');
//$role = $this->user->get_role();
$role = $this->session->userdata('role');
//$username = $this->session->userdata('username');
//$args = array('role' => $role, 'username' => $username);
?>
<!DOCTYPE html>
<html lang="en">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	$(document).ready (function() {
		if($("#sunstart").val()==-1){
			$("#sunend").prop("disabled",true);}
		else{$("#sunend").prop("disabled",false);}
		if($("#monstart").val()==-1){
			$("#monend").prop("disabled",true);}
		else{$("#monend").prop("disabled",false);}
		if($("#tuestart").val()==-1){
			$("#tueend").prop("disabled",true);}
		else{$("#tueend").prop("disabled",false);}
		if($("#wedstart").val()==-1){
			$("#wedend").prop("disabled",true);}
		else{$("#wedend").prop("disabled",false);}
		if($("#thustart").val()==-1){
			$("#thuend").prop("disabled",true);}
		else{$("#thuend").prop("disabled",false);}	
		if($("#fristart").val()==-1){
			$("#friend").prop("disabled",true);}
		else{$("#friend").prop("disabled",false);}
		if($("#satstart").val()==-1){
			$("#satend").prop("disabled",true);}
		else{$("#satend").prop("disabled",false);}	
		
		$("#sunstart").change(function(){
			if($("#sunstart").val()==-1){
				$("#sunend").prop("disabled",true);}
			else{$("#sunend").prop("disabled",false);}});
		$("#monstart").change(function(){
			if($("#monstart").val()==-1){
				$("#monend").prop("disabled",true);}
			else{$("#monend").prop("disabled",false);}});
		$("#tuestart").change(function(){
			if($("#tuestart").val()==-1){
				$("#tueend").prop("disabled",true);}
			else{$("#tueend").prop("disabled",false);}});
		$("#wedstart").change(function(){
			if($("#wedstart").val()==-1){
				$("#wedend").prop("disabled",true);}
			else{$("#wedend").prop("disabled",false);}});
		$("#thustart").change(function(){
			if($("#thustart").val()==-1){
				$("#thuend").prop("disabled",true);}
			else{$("#thuend").prop("disabled",false);}});
		$("#fristart").change(function(){
			if($("#fristart").val()==-1){
				$("#friend").prop("disabled",true);}
			else{$("#friend").prop("disabled",false);}});
		$("#satstart").change(function(){
			if($("#satstart").val()==-1){
				$("#satend").prop("disabled",true);}
			else{$("#satend").prop("disabled",false);}});	
		
	}); 
	</script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records New User Info</title>
</head>

<body>
<header id="header"><h1>Health E-Records: New User Info</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-2", id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10", id="center">
        	<p>Please fill in your information:</p>
			<div id="body">
				<?php 
				$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
				
				echo form_open('main/complete_registration',$attributes);
				
				echo validation_errors();
				
				echo "<p>First Name: ";
				echo form_input('firstname',$this->input->post('firstname'));
				echo "</p>";
				
				echo "<p>Last Name: ";
				echo form_input('lastname',$this->input->post('lastname'));
				echo "</p>";
				
				echo "<p>Date of Birth: ";
				echo form_input('dob',$this->input->post('dob'));
				echo " Please use format YYYY-MM-DD";
				echo "</p>";
				
				echo "<p>Home Phone: ";
				echo form_input('homephone',$this->input->post('homephone'));
				echo " Please use format XXX-XXX-XXXX";
				echo "</p>";
				
				echo "<p>Work Phone: ";
				echo form_input('workphone',$this->input->post('workphone'));
				echo " Please use format XXX-XXX-XXXX";
				echo "</p>";
		
				if($role=='patient')
					$this->load->view('patient_reg_view');
				else if($role=='nurse')
					$this->load->view('nurse_reg_view');
				else if($role=='doctor')
					$this->load->view('doctor_reg_view');
				
				echo "<p>";
				echo form_submit('info_submit', 'Complete Registration!');
				echo "</p>";
				
				echo form_close();
				?>
			</div>
	
			<a href = '<?php 
			echo base_url(),"index.php/main"
			?>'>Back to Login</a>
		</div>
      </div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
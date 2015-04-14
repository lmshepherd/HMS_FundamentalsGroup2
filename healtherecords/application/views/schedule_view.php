<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	<h1>Health E-Records Scheduling</h1>

	<div id="body">
		<?php 
		$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
		//get session username
		$username = $this->session->userdata('username');
		//get id from userinfo table
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$id = $row->id;
		//get schedule from
		$this->db->where('id',$id);
		$query = $this->db->get('schedule');
		$row = $query->row();
		
		//store dropdown box options as an array
		$time_options = array('0'=>'12:00am',
				'1'=>'1:00am','2'=>'2:00am',
				'3'=>'3:00am','4'=>'4:00am',
				'5'=>'5:00am','6'=>'6:00am',
				'7'=>'7:00am','8'=>'8:00am',
				'9'=>'9:00am','10'=>'10:00am',
				'11'=>'11:00am','12'=>'12:00pm',
				'13'=>'1:00pm','14'=>'2:00pm',
				'15'=>'3:00pm','16'=>'4:00pm',
				'17'=>'5:00pm','18'=>'6:00pm',
				'19'=>'7:00pm','20'=>'8:00pm',
				'21'=>'9:00pm','22'=>'10:00pm',
				'23'=>'11:00pm','23'=>'11:59pm','-1'=>'none');
		
		echo validation_errors();
		
		echo form_open('schedule/set_schedule',$attributes);
		
		$this->table->set_heading('','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$this->table->add_row('Start time:',
				form_dropdown('sunstart',$time_options,$row->sunstart,'id="sunstart"'),
				form_dropdown('monstart',$time_options,$row->monstart,'id="monstart"'),
				form_dropdown('tuestart',$time_options,$row->tuestart,'id="tuestart"'),
				form_dropdown('wedstart',$time_options,$row->wedstart,'id="wedstart"'),
				form_dropdown('thustart',$time_options,$row->thustart,'id="thustart"'),
				form_dropdown('fristart',$time_options,$row->fristart,'id="fristart"'),
				form_dropdown('satstart',$time_options,$row->satstart,'id="satstart"')
				);
		//remove 'none' value from time_options array
		unset($time_options[-1]);
		$this->table->add_row('End time:',
				form_dropdown('sunend',$time_options,$row->sunend,'id="sunend"'),
				form_dropdown('monend',$time_options,$row->monend,'id="monend"'),
				form_dropdown('tueend',$time_options,$row->tueend,'id="tueend"'),
				form_dropdown('wedend',$time_options,$row->wedend,'id="wedend"'),
				form_dropdown('thuend',$time_options,$row->thuend,'id="thuend"'),
				form_dropdown('friend',$time_options,$row->friend,'id="friend"'),
				form_dropdown('satend',$time_options,$row->satend,'id="satend"')
				);
		echo $this->table->generate();
		
		echo "<p>";
		echo form_submit('schedule_submit', 'Set Schedule');
		echo "</p>";
		echo form_close();
		?>
		
		<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	
		<a href = '<?php 
		echo base_url(),"index.php/main/logout"
		?>'>Logout</a>
	
	</div>

</div>

</body>
</html>
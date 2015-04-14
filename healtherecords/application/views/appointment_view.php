<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
	<meta charset="utf-8">
	<title>Health E-Records</title>
	
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	$(document).ready (function() {
	    $( "#datepicker" ).datepicker({
			changeYear: true,
			changeMonth: true,
			minDate: new Date(),
		    inline: true,
		    dateFormat: 'yy-mm-dd',
			onSelect: function(event, ui) {
			    var date = $(this).datepicker('getDate');
			    var year = date.getYear();
			    var month = date.getMonth();
			    var day = date.getDate();
			    var dayOfWeek = date.getUTCDay();
			    $.ajax({
					//run doctor_availability function of appointment controller
					url:"<?php echo base_url();?>index.php/appointment/doctor_availability",
					//set data value of POST to value selected in dropdown box
					data: {year: year, month:month, day:day, dayOfWeek: dayOfWeek},
					type: "POST",
					//update html inside doctor_list div to be what is returned
					success: function(data){
						//update doctor list div
						$("#doctor_schedule").html(data);
					}
				});
			}
		});
	  }); 

	//check that document is loaded
	$(document).ready(function(){
		//send post when specialty dropdown value changes
		$("#spec").change(function(){
			$.ajax({
				//run select_specialization function of appointment controller
				url:"<?php echo base_url();?>index.php/appointment/select_specialization",
				//set data value of POST to value selected in dropdown box
				data: {specialization: $(this).val()},
				type: "POST",
				//update html inside doctor_list div to be what is returned
				success: function(data){
					//update doctor list div
					$("#doctor_list").html(data);
					//clear doctor schedule div
					$("#doctor_schedule").html("");
				}
			});
		});
	});



	function select_doctor(button) 
	{
		$.ajax({
			//run doctor_availability function of appointment controller
			url:"<?php echo base_url();?>index.php/appointment/select_doctor",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST",
			//update html inside doctor_schedule div to be what is returned
			success: function(data){
				$("#doctor_schedule").html(data);
				$("#date_list").show();
			}
		});
		 
		//return false;
	};
	
	</script>
	
</head>

<body>

<div id="container">
	
	<?php
	//store dropdown box options as an array
	$specialization = array(''=>'Select Specialization',
			'cardiologist'=>'Cardiologist',
			'endocrinologist'=>'Endocrinologist',
			'general'=>'General Practitioner',
			'immunologist'=>'Immunologist',
			'neurologist'=>'Neurologist');
	echo "<p>Specialization: ";
	//create dropdown box
	echo form_dropdown('specialization',$specialization,'','id="spec"');
	echo "</p>";
	?>
	
	<?php $attributes = array('id'=>'doctor_form');
	echo form_open('',$attributes); 
	?>
	<div id="doctor_list" ></div>
	<?php echo form_close(); ?>
	
	<div id="date_list" style="display: none;">
	<br>
	<?php echo 'Date: ' ?>
	<input type="text" class="date" name="appointment" id="datepicker"><br>
	</div>
	
	<div id="doctor_schedule"></div>
	
	
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'><br>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'><br>Logout</a>

</div>

</body>
</html>

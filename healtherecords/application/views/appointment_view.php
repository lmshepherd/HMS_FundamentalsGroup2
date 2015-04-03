<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
	
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">

	//check that document is loaded
	$(document).ready(function(){
		//send post when specialty dropdown value changes
		$("#spec").change(function(){
			$.ajax({
				url:"<?php echo base_url();?>index.php/appointment/select_specialization",
				data: {specialization: $(this).val()},
				type: "POST",
				success: function(data){
					$("#doctor_list").html(data);
				}
			});
		});
	});
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
	
	<div id="doctor_list" ></div>
	<div id="result"></div>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
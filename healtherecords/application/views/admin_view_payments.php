<!DOCTYPE html>
<html lang="en">
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	function bill_patients(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/bill/bill_patients",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id'), patient: $('#patients').val()},
			type: "POST",
			success: function(data){
				$( "#byPatient" ).empty();
				$("#doctor_schedule").html(data);}
		});
		/*$.ajax({
			//run select_specialization function of appointment controller
			url:"<?php echo base_url();?>index.php/admin/select_patient",
			//set data value of POST to value selected in dropdown box
			data: {patient: $('#patients').val()},
			type: "POST",
			//update html inside doctor_list div to be what is returned
			success: function(data){
				$( "#byPatient" ).empty();
				//update doctor list div
				$("#byPatient").html(data);}
		});*/
	};

	$(document).ready(function(){
		//send post when specialty dropdown value changes
		$("#patients").change(function(){
			$.ajax({
				//run select_specialization function of appointment controller
				url:"<?php echo base_url();?>index.php/admin/select_patient",
				//set data value of POST to value selected in dropdown box
				data: {patient: $(this).val()},
				type: "POST",
				//update html inside doctor_list div to be what is returned
				success: function(data){
					//update doctor list div
					$("#byPatient").html(data);
					$( "#doctor_schedule" ).empty();
				}
			});
		});
	});
	</script>
</head>

<body>
<header id="header"><h1>Health E-Records: Payments to Process</h1></header>
<div id="container">
	<div class="row">
        <div class="col-md-2" id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-md-10", id="center">
        
        <?php 
 			$this->load->model('admin_search');
			echo form_dropdown('patient',$this->admin_search->get_patients(),'','id="patients"')
		?>
        
        <div id = "byPatient" ></div>
				
		<div id="date_list" style="display: none;">
		<br>
		<?php echo 'Date: ' ?>
		<input type="text" class="date" name="appointment" id="datepicker"><br>
		</div>
				
		<div id="doctor_schedule"></div>
		<div id="bill" style="display:none">
		
		</div>
		</div>
				
		<?php $this->load->view('commonViews/backLinks');?>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
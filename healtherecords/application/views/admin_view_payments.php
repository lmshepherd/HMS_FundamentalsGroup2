<!DOCTYPE html>
<html lang="en">

<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	function bill_patients(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/admin/bill_patients",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST"
			,success: function(data){
				$("#doctor_schedule").html(data);
			}
		});
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
	
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<? echo base_url();?>/css/Generic.css">
	<meta charset="utf-8">
	<title>Health E-Records</title>	
</head>

<body>
<header id="header"><h1>Health E-Records: Payments to Process</h1></header>
<div id="container">
	<div class="row">
        <div class="col-md-4">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-md-8">
        
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
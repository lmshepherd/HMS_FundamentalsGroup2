<?php 
$username = $this->session->userdata('username');
$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();

$id = $row->id;
$this->db->where('id',$id);
$query = $this->db->get('medical_record');
$row = $query->row();
?>

<!DOCTYPE html>
<html lang="en">

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

	function doctor_bill_finish(button){
		alert('press');
	}

	function change_time(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/appointment/change_appt_time",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST",
			//update html inside doctor_schedule div to be what is returned
			success: function(data){
				$("#doctor_schedule").html(data);
				$("#date_list").show();
			}
		});
	};

	function cancel_appt(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/appointment/cancel_appt",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST"
			,success: function(data){
				location.reload();
			}
		});
	};

/*
 * THIS SHOULD ADD SELECTED PATIENT TO SESSION DATA WHICH WILL BE USED TO GENERATE TABLE
 */
	$(document).ready(function(){
		//send post when specialty dropdown value changes
		$("#patients").change(function(){
			alert($(this).val());
			$.ajax({
				//run select_specialization function of appointment controller
				url:"<?php echo base_url();?>index.php/appointment/select_patient",
				//set data value of POST to value selected in dropdown box
				data: {patient: $(this).val()},
				type: "POST",
				//update html inside doctor_list div to be what is returned
				success: function(data){
					//update doctor list div
					$("#byPatient").html(data);
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
<header id="header"><h1>Health E-Records: My Appointments</h1></header>
<div id="container">
	<div class="row">
        <div class="col-md-4">
     	    <ul>
			    <li><a href="http://projectsgeek.com/2013/08/hospital-management-system-mini-project-2.html">HMS Info</a></li>
			    <li><a href="#">Link 2</a></li>
			    <li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
		    </ul>
		    <h3>Doctor Links</h3>
		    <ul>
			    <li><a href="#">Link 1</a></li>
			    <li><a href="#">Link 2</a></li>
		    	<li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
			</ul>
		</div>
        <div class="col-md-8">
        
        <?php 
			$this->load->model('search');
			echo form_dropdown('patientsList',$this->search->patients_by_doctor(),'','id="patients"')
		?>
        
        <div id = "byPatient" ></div>
				
		<div id="date_list" style="display: none;">
		<br>
		<?php echo 'Date: ' ?>
		<input type="text" class="date" name="appointment" id="datepicker"><br>
		</div>
				
		<div id="doctor_schedule"></div>
		<div id="bill" style="display:none">
			<?php 
				echo form_open('bill/nurse_schedules');
				echo "<p>";
				echo form_submit('doctor_finish_flag', 'Patient Treatment Complete');
				echo "</p>";
				echo form_close();
			?>
		</div>
		</div>
				
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
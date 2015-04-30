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
<head>

<?php 
if (!$this->session->userdata('is_logged_in'))
	redirect('/main/logout');
?>

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

	function change_time(button) 
	{
		if(window.confirm("Are you sure?"))
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
		}
	};

	function cancel_appt(button) 
	{
		if(window.confirm("Are you sure?"))
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
		}
	};
//button press for doctor to view treatment info
	function load_treatments(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/appointment/load_treatments",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST"
			,success: function(data){
				$("#doctor_schedule").html(data);
			}
		});
	};
	//button press for doctor to update treatment info
	function update_treatments(button) 
	{
		if(window.confirm("Are you sure?"))
		{
			$.ajax({
				//run select_doctor function of appointment controller
				url:"<?php echo base_url();?>index.php/appointment/update_treatments",
				//set data value of POST to button clicked
				data: {id: $(button).attr('id'), treatment:$('#new_treatment').val()},
				type: "POST"
				,success: function(data){
					$("#doctor_schedule").html(data);
				}
			});
		}
	};
	//button press for doctor to view prescription info for that appt
	function load_prescriptions(button) 
	{
		$.ajax({
			//run select_doctor function of appointment controller
			url:"<?php echo base_url();?>index.php/appointment/load_prescriptions",
			//set data value of POST to button clicked
			data: {id: $(button).attr('id')},
			type: "POST"
			,success: function(data){
				$("#doctor_schedule").html(data);
			}
		});
	};
	//button press for doctor to update prescription info
	function update_prescriptions(button) 
	{
		if(window.confirm("Are you sure?"))
		{
			$.ajax({
				//run select_doctor function of appointment controller
				url:"<?php echo base_url();?>index.php/appointment/update_prescriptions",
				//set data value of POST to button clicked
				data: {id: $(button).attr('id'), prescription:$('#new_prescription').val()},
				type: "POST"
				,success: function(data){
					$("#doctor_schedule").html(data);
				}
			});
		}
	};
/*
 * THIS SHOULD ADD SELECTED PATIENT TO SESSION DATA WHICH WILL BE USED TO GENERATE TABLE
 */
	$(document).ready(function(){
		//send post when specialty dropdown value changes
		$("#patients").change(function(){
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
					$( "#doctor_schedule" ).empty();
				}
			});
		});
	});

	function doctor_bill_setFlag(button){
		if(window.confirm("Are you sure?"))
		{
			$.ajax({
				//run select_doctor function of appointment controller
				url:"<?php echo base_url();?>index.php/bill/doctor_bill_flag",
				//set data value of POST to button clicked
				data: {apptID: button.id, patient: $('#patients').val()},
				type: "POST",
				//hide button after processed flag change
				success: function(data){
					$("#byPatient").html(data);
					$( "#doctor_schedule" ).empty();
				}
			});
		}
	}
	
	</script>
</head>

<body>
<header id="header"><h1>Health E-Records: My Appointments</h1></header>
<div id="container">
	<div class="row">
        <div class="col-md-2", id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-md-10", id="center">
        
        <?php 
			$this->load->model('search');
			echo form_dropdown('patient',$this->search->patients_by_doctor(),'','id="patients"')
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
				
		<?php $this->load->view('commonViews/backLinks');?>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
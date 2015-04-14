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
				alert("Appointment cancelled!");
			}
		});
	};
	
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

	<h1>Patient Appointments</h1>

	<?php 
	$this->load->model('search');
	$this->search->get_appts();
	?>
	
	<div id="date_list" style="display: none;">
	<br>
	<?php echo 'Date: ' ?>
	<input type="text" class="date" name="appointment" id="datepicker"><br>
	</div>
	
	<div id="doctor_schedule"></div>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
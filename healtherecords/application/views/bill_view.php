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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">

	$( document ).ready(function() {
		$.ajax({
			url:"<?php echo base_url();?>index.php/bill/load_bill_view",
			success: function(data){
				$("#bill_info").html(data);
				//$( "#payment_info" ).empty();
			}
		});
	});
////
	function pay_bill(button){
		//alert(button.id);
		$.ajax({
			url:"<?php echo base_url();?>index.php/bill/pay_bill",
			data: {total_cost: button.id, amount: $('#amount').val()},
			type: "POST",
			success: function(data){
				$.ajax({
					url:"<?php echo base_url();?>index.php/bill/load_bill_view",
					success: function(data){
						$("#bill_info").html(data);
					}
				});
				$("#payment_info").html(data);
			}
		});
		
	}
	
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

	<div id="bill_info"></div>
	<?php 
	/*
	$username = $this->session->userdata('username');
	$this->db->where('username',$username);
	$query = $this->db->get('userinfo');
	$row = $query->row();
	
	$id = $row->id;
	$this->db->where('patient_id',$id);
	$query = $this->db->get('appts');
	//$row2 = $query->row();
	
	echo '<p>Billing for: ';
	echo $row->firstname;
	echo ' ';
	echo $row->lastname;
	echo '</p>';
	
	//get insurance info
	$this->db->where('id',$id);
	$ins_query = $this->db->get('patients');
	$ins_row = $ins_query->row();
	
	echo '<div class="col-lg-12", id="center">';
	//configure table id
	$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
							'table_close' => '</table>');
	$this->table->set_template($table_config);
	$this->table->set_heading('Date ','Time ','Doctor ','Treatment ','Prescription ','Covered ','Bill ');
	//billing variables
	$count = 0;
	$base_cost = 50;
	$cost = 0;
	$total_cost = 0;
	$covered = 'no';
	
	foreach ($query->result() as $row)
	{
		$this->db->from('userinfo');
		$this->db->where('id',$row->doctor_id);
		$query2 = $this->db->get();
		$row2 = $query2->row();
		
		//get doctor information
		$this->db->from('doctors');
		$this->db->where('id',$row->doctor_id);
		$query3 = $this->db->get();
		$row3 = $query3->row();
		
		//format time
		$time = $row->hour;
		if ($time<12)
			$ampm = 'am';
		else $ampm = 'pm';
		$time = $time%12;
		if ($time==0)
			$time=12;
		
		//admin_process check should not be negative check, but needed some things to show up since no admin approval yet
		if (($row->admin_process == 1) &&($row->doctor_finish==1) &&($row->paid != 1))
		{
			$count++;
			//calculate cost based off of experience
			$cost = $base_cost*((100+$row3->experience))/100;
			
			//check if appt covered by insurance
			//echo '<p>'.'20'.$row->date.' '.$ins_row->insurancestart.' '.$ins_row->insuranceend.'</p>';
			if (strtotime('20'.$row->date)>=strtotime($ins_row->insurancestart) &&
				strtotime($row->date)<=strtotime($ins_row->insuranceend))
			{
				//$20 copay?
				$cost = 20;
				$covered = 'yes';
			}
			else 
				$covered = 'no';
			
			//keep track of total cost
			$total_cost += $cost;
			//populate table
			$this->table->add_row(
					$row->date,
					$time.' '.$ampm,
					$row2->firstname . ' ' . $row2->lastname,
					$row->treatment,
					$row->prescription,
					$covered,
					'$'.number_format($cost,2)
					);
		}
	}
	//check if an appt is found
	if ($count>0)
	{
		$this->table->add_row('','','','','','Total Cost: ','$'.number_format($total_cost,2));
		$this->table->add_row('','','','','','','<input id="amount" type="text" />');
		$this->table->add_row('','','','','','','<input id=$total_cost type="button" value="Pay Bill" onclick="pay_bill(this)" />');
		//$this->table->add_row('','','','','','',form_input('payment', ''));
		//$this->table->add_row('','','','','','',form_submit('pay_submit', 'Pay Bill'));
		//echo form_open('bill/pay_bill/'.$total_cost);
		echo "<p>";
		echo $this->table->generate();
		echo "</p>";
		//echo form_close();	
	}
	//no appts ready to be paid
	else 
		echo '<p>No payments currently due.</p>';
	
	echo '</div>';*/
	?>
	
	<div id='payment_info'></div>
	
	<?php $this->load->view('commonViews/backLinks');?>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
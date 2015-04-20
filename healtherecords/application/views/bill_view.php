<?php
$username = $this->session->userdata('username');
$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();

$id = $row->id;
$this->db->where('patient_id',$id);
$query = $this->db->get('appts');
//$row2 = $query->row();

?>

<!DOCTYPE html>
<html lang="en">
	
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

	<?php 
	echo '<p>Billing for: ';
	echo $row->firstname;
	echo ' ';
	echo $row->lastname;
	echo '</p>';
	
	$this->table->set_heading('Date ','Time ','Doctor ', 'Bill ');
	$count = 0;
	$base_cost = 50;
	$cost = 0;
	$total_cost = 0;
	
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
		if (!($row->admin_process) && !($row->paid))
		{
			$count++;
			//calculate cost based off of experience
			$cost = $base_cost*((100+$row3->experience))/100;
			//keep track of total cost
			$total_cost += $cost;
			//populate table
			$this->table->add_row(
					$row->date,
					$time.' '.$ampm,
					$row2->firstname . ' ' . $row2->lastname,
					'$'.number_format($cost,2));
					//$row->experience.' years', $age, implode($days)
					//add a button to select doctor
					//'<input id="'.$row->appt_id.'" type="button" value="Select" onclick="select_doctor(this)" />');
		}
	}
	//check if an appt is found
	if ($count>0)
	{
		echo $this->table->generate();
		
		echo '<p>Total amount due: ';
		echo '$'.number_format($total_cost,2);
		echo '</p>';
		
		echo form_open('bill/pay_bill');
		echo "<p>";
		echo form_submit('pay_submit', 'Pay Bill');
		echo "</p>";
		echo form_close();
	}
	//no appts ready to be paid
	else 
		echo '<p>No payments currently due.</p>';
	?>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
	?>'>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>
</div>
</body>
</html>
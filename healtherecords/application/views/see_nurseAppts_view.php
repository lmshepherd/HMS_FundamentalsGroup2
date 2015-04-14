<?php
//grab nurse id
$username = $this->session->userdata('username');
$this->db->where('username', $username);
$query = $this->db->get('userinfo');
$row = $query->row();
$id = $row->id;

//find matching patiends for nurse
$this->db->where('nurse_id', $id);
$query = $this->db->get('appts');
$row = $query->row();

//generate table to be displayed
if($query->num_rows()>0){
	$this->table->set_heading('Patient','Doctor','Next Appointment Date', 'Next Appointment Time');
	
	foreach($query->result() as $row){
		$this->db->from('userinfo');
		$this->db->where('id',$row->patient_id);
		$query2 = $this->db->get();
		$row2 = $query2->row();
		
		$patientname = $row2->firstname.' '.$row2->lastname;
		
		$this->db->from('userinfo');
		$this->db->where('id',$row->doctor_id);
		$query2 = $this->db->get();
		$row2 = $query2->row();
		
		$doctorname = 'Dr. '.$row2->firstname.' '.$row2->lastname;
		
		$time = $row->hour;
		if ($time<12)
			$ampm = 'am';
		else $ampm = 'pm';
		$time = $time%12;
		if ($time==0)
			$time=12;
		
		//need form open and form close
		$this->table->add_row($patientname,
				$doctorname,
				$row->date,
				$time.' '.$ampm,
				'<p>'.form_open('appointment/nurse_viewPatientRecord').form_submit('view_patient_info', 'View Patient Information').form_close().'</p>'
		);
		
	}
}

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

<div id="container">

	<h1>Here are your current patients</h1>
		<p>
		<?php 
			echo $this->table->generate();
		?>
		</p>
<a href = '<?php
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>

		<a href = '<?php
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>

<div id="container">
	<h1>Health E-Records Scheduling</h1>

	<div id="body">
		<?php 
		//get session username
		$username = $this->session->userdata('username');
		//get id from userinfo table
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$id = $row->id;
		//get schedule from
		$this->db->where('id',$id);
		$query = $this->db->get('schedule');
		$row = $query->row();
		
		//store dropdown box options as an array
		$time_options = array('0'=>'12:00am',
				'1'=>'1:00am','2'=>'2:00am',
				'3'=>'3:00am','4'=>'4:00am',
				'5'=>'5:00am','6'=>'6:00am',
				'7'=>'7:00am','8'=>'8:00am',
				'9'=>'9:00am','10'=>'10:00am',
				'11'=>'11:00am','12'=>'12:00pm',
				'13'=>'1:00pm','14'=>'2:00pm',
				'15'=>'3:00pm','16'=>'4:00pm',
				'17'=>'5:00pm','18'=>'6:00pm',
				'19'=>'7:00pm','20'=>'8:00pm',
				'21'=>'9:00pm','22'=>'10:00pm',
				'23'=>'11:00pm');
		
		echo validation_errors();
		
		echo form_open('schedule/set_schedule');
		
		$this->table->set_heading('','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
		$this->table->add_row('Start time:',
				form_dropdown('sunstart',$time_options,$row->sunstart),
				form_dropdown('monstart',$time_options,$row->monstart),
				form_dropdown('tuestart',$time_options,$row->tuestart),
				form_dropdown('wedstart',$time_options,$row->wedstart),
				form_dropdown('thustart',$time_options,$row->thustart),
				form_dropdown('fristart',$time_options,$row->fristart),
				form_dropdown('satstart',$time_options,$row->satstart)
				);
		$this->table->add_row('End time:',
				form_dropdown('sunend',$time_options,$row->sunend),
				form_dropdown('monend',$time_options,$row->monend),
				form_dropdown('tueend',$time_options,$row->tueend),
				form_dropdown('wedend',$time_options,$row->wedend),
				form_dropdown('thuend',$time_options,$row->thuend),
				form_dropdown('friend',$time_options,$row->friend),
				form_dropdown('satend',$time_options,$row->satend)
				);
		echo $this->table->generate();
		
		echo "<p>";
		echo form_submit('schedule_submit', 'Set Schedule');
		echo "</p>";
		echo form_close();
		?>
		
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
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

$count =0;
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
		if($row->doctor_finish != 1){
			$count = $count + 1;
			//need form open and form close
			$this->table->add_row($patientname,
					$doctorname,
					$row->date,
					$time.' '.$ampm,
					'<p>'.form_open('appointment/nurse_viewPatientRecord').form_submit('view_patient_info', 'View Patient Information').form_close().'</p>'
			);
		}
	}
}

?>
<?php $this->load->view('commonViews/header');?>

<div id="container">

	<h1>Here are your current patients</h1>
	    <div class="row">
        <div class="col-lg-2", id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10", id="center">		
	        <p>
			<?php 
				if($count != 0){
					echo $this->table->generate();
				}
				else{
					echo "No current appointments";
				}
			?>
			</p>
			<?php $this->load->view('commonViews/backLinks');?>
		</div>
      </div>

</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
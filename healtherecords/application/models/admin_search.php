<?php

class Admin_search extends CI_Model
{
	
	public function get_appts($id){
		
		//check appts where this user is the patient
		$this->db->where('patient_id',$id);
		$query = $this->db->get('appts');
		$row = $query->row();
		
		
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			//create table heading
			$this->table->set_heading('Date','Time','Process Payment');
				
			$count = 0;
				
			//cycle through doctors of matching specialty
			foreach ($query->result() as $row)
			{
				if($row->patient_id==$patientID){
					//if($row->patient_id==10){
					//get name from userinfo db
					$this->db->from('userinfo');
					$this->db->where('id',$row->patient_id);
					$query2 = $this->db->get();
					$row2 = $query2->row();
						
					$time = $row->hour;
					if ($time<12)
						$ampm = 'am';
					else $ampm = 'pm';
					$time = $time%12;
					if ($time==0)
						$time=12;
					//echo form_open('appointment/doctor_viewPatientRecord');
					$attributes = array('id' =>"'.$row->appt_id.'");
					//add doctor to table
					if ($row->doctor_finish)
					{
						$count++;
						$this->table->add_row($row->date,
								$time.' '.$ampm,
								'<input id="'.$row->appt_id.'" type="button" value="Bill Patient" onclick="bill_patients(this)" />'
								//$row2->firstname.' '.$row2->lastname,
								//add a button to select doctor
								);
						//'<input id="'.$row->appt_id.'" type="button" value="View Patient Information" onclick="" />');
					}
				}
				echo form_close();
			}
		
			//generate the table
			if ($count>0)
				echo $this->table->generate();
			else echo 'No payments with this patient';
		}
		else echo '<p>No patients currently scheduled.</p>';
		
	}
	
	public function get_patients(){
		
		$query2 = $this->db->get('appts');
		$patients=[];
		array_push($patients, "Select a patient");
		if($query2->num_rows()>0){
			foreach($query2->result() as $row){
				$patient=$row->patient_id;
				$this->db->from('userinfo');
				$this->db->where('id',$patient);
				$query3 = $this->db->get();
				$row3 = $query3->row();
				//array_push($patients,$row->patient_id);
				if (!in_array($row3->firstname.' '.$row3->lastname, $patients)){
					$patients[$row->patient_id]=$row3->firstname.' '.$row3->lastname;
				}
			}
		}
		return $patients;
	}
	
	public function load_appointments(){
		$query = $this->db->get('appts');
		
		if ($query->num_rows() >0){
			echo '<div class="col-lg-12">';
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('Doctor name', 'Patient Name', 'Nurse Name', 'Appointment Date', 'Appointment Time','Treatment','Presciption');
			
			foreach($query->result() as $row){
				$patientid = $row->patient_id;
				$doctorid = $row->doctor_id;
				$nurseid = $row->nurse_id;
				
				//grab doctors name from user info table
				$this->db->where('id', $doctorid);
				$query2 = $this->db->get('userinfo');
				$row2 = $query2->row();
				
				//grab patients name
				$this->db->where('id', $patientid);
				$query3 = $this->db->get('userinfo');
				$row3 = $query3->row();
				
				//grab nurses name
				$this->db->where('id', $nurseid);
				$query4 = $this->db->get('userinfo');
				$row4 = $query4->row();
				
				$time = $row->hour;
				//convert time to nice format
				if($time==0){
					$time=($time+12).'am';
				}
				else if ($time>12)
				{
					$time = ($time%12).'pm';
				}
				else
				{
					$time = $time.'am';
				}
				
				if($row->doctor_finish == 1){
					$finish=true;
				}
				else{
					$finish =false;
				}
				
				$this->table->add_row('Dr.'.$row2->firstname.' '.$row2->lastname,
						$row3->firstname.' '.$row3->lastname,
						$row4->firstname.' '.$row4->lastname,
						$row->date,
						$time,
						$row->treatment,
						$row->prescription
						);
			}
			echo $this->table->generate();
		}else echo "<p>No appointments found</p>";
	}
	
	public function load_patients(){
		$this->db->where('role','patient');
		$query = $this->db->get('userinfo');
		
		if($query->num_rows()>0){
			echo '<div class="col-lg-12">';
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			$this->table->set_heading('Name','Date of Birth');
			
			foreach($query->result() as $row){
				$this->table->add_row(
						$row->firstname.' '.$row->lastname,
						$row->dob);
			}
			echo $this->table->generate();
		}
		else echo "<p>No patients found</p>";
	}
	
	public function get_doctors(){
		$this->db->where('role','doctor');
		$query = $this->db->get('userinfo');
		
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			echo '<div class="col-lg-12">';
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			//create table heading
			$this->table->set_heading('Name','Gender','Experience','Specialization','Sunday Start','Sunday End','Monday Start','Monday End','Tuesday Start','Tuesday End','Wednesday Start','Wednesday End','Thursday Start','Thursday End','Friday Start','Firday End','Saturday Start','Saturday End');
			 
			
			foreach ($query->result() as $row)
			{
				$id = $row->id;
				$this->db->from('doctors');
				$this->db->where('id',$id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
				
				$gender= $row2->gender;
				
				$this->db->from('schedule');
				$this->db->where('id', $id);
				$query3 = $this->db->get();
				$row3 = $query3->row();
				
				$sunstart = $row3->sunstart;
				$sunend = $row3->sunend;
				$monstart = $row3->monstart;
				$monend = $row3->monend;
				$tuestart = $row3->tuestart;
				$tueend = $row3->tueend;
				$wedstart = $row3->wedstart;
				$wedend = $row3->wedend;
				$thustart = $row3->thustart;
				$thuend = $row3->thuend;
				$fristart = $row3->fristart;
				$friend = $row3->friend;
				$satstart = $row3->satstart;
				$satend = $row3->satend;
				
				if($sunstart == -1){
					$sunstart='off';
					$sunend='off';
				}
				else if($sunstart==0){
					$sunstart=($sunstart+12).'am';
				}
				else if ($sunstart>12)
				{
					$sunstart = ($sunstart%12).'pm';
				}
				else
				{
					$sunstart = $sunstart.'am';
				}
				if($sunend==0 && $sunend != 'off'){
					$sunend=($sunend+12).'am';
				}
				else if ($sunend>12)
				{
					$sunend = ($sunend%12).'pm';
				}
				else if($sunend != 'off')
				{
					$sunend = $sunend.'am';
				}
				
				if($monstart == -1){
					$monstart='off';
					$monend='off';
				}
				else if($monstart==0){
					$monstart=($monstart+12).'am';
				}
				else if ($monstart>12)
				{
					$monstart = ($monstart%12).'pm';
				}
				else
				{
					$monstart = $monstart.'am';
				}
				if($monend==0 && $monend != 'off'){
					$monend=($monend+12).'am';
				}
				else if ($monend>12)
				{
					$monend = ($monend%12).'pm';
				}
				else if($monend != 'off')
				{
					$monend = $monend.'am';
				}
				
				
				if($tuestart == -1){
					$tuestart='off';
					$tueend='off';
				}
				else if($tuestart==0){
					$tuestart=($tuestart+12).'am';
				}
				else if ($tuestart>12)
				{
					$tuestart = ($tuestart%12).'pm';
				}
				else
				{
					$tuestart = $tuestart.'am';
				}
				if($tueend==0 && $tueend != 'off'){
					$tueend=($tueend+12).'am';
				}
				else if ($tueend>12)
				{
					$tueend = ($tueend%12).'pm';
				}
				else if($tueend != 'off')
				{
					$tueend = $tueend.'am';
				}
				
				if($wedstart == -1){
					$wedstart='off';
					$wedend='off';
				}
				else if($wedstart==0){
					$wedstart=($wedstart+12).'am';
				}
				else if ($wedstart>12)
				{
					$wedstart = ($wedstart%12).'pm';
				}
				else
				{
					$wedstart = $wedstart.'am';
				}
				if($wedend==0 && $wedend != 'off'){
					$wedend=($wedend+12).'am';
				}
				else if ($wedend>12)
				{
					$wedend = ($wedend%12).'pm';
				}
				else if($wedend != 'off')
				{
					$wedend = $wedend.'am';
				}
				
				if($thustart == -1){
					$thustart='off';
					$thuend='off';
				}
				else if($thustart==0){
					$thustart=($thustart+12).'am';
				}
				else if ($thustart>12)
				{
					$thustart = ($thustart%12).'pm';
				}
				else
				{
					$thustart = $thustart.'am';
				}
				if($thuend==0 && $thuend != 'off'){
					$thuend=($thuend+12).'am';
				}
				else if ($thuend>12)
				{
					$thuend = ($thuend%12).'pm';
				}
				else if ($thuend != 'off')
				{
					$thuend = $thuend.'am';
				}
				
				if($fristart == -1){
					$fristart='off';
					$friend='off';
				}
				else if($fristart==0){
					$fristart=($fristart+12).'am';
				}
				else if ($fristart>12)
				{
					$fristart = ($fristart%12).'pm';
				}
				else
				{
					$fristart = $fristart.'am';
				}
				if($friend==0 && $friend != 'off'){
					$friend=($friend+12).'am';
				}
				else if ($friend>12)
				{
					$friend = ($friend%12).'pm';
				}
				else if($friend != 'off')
				{
					$friend = $friend.'am';
				}
				
				if($satstart == -1){
					$satstart='off';
					$satend='off';
				}
				else if($satstart==0){
					$satstart=($satstart+12).'am';
				}
				else if ($satstart>12)
				{
					$satstart = ($satstart%12).'pm';
				}
				else
				{
					$satstart = $satstart.'am';
				}
				if($satend==0 && $satend != 'off'){
					$satend=($satend+12).'am';
				}
				else if ($satend>12)
				{
					$satend = ($satend%12).'pm';
				}
				else if($satend != 'off')
				{
					$satend = $satend.'am';
				}
				
				//add doctor to table
				$this->table->add_row($row->firstname . ' ' . $row->lastname,
						$gender,
						$row2->experience.' years',
						//add a button to select doctor
						$row2->specialization,
						$sunstart,
						$sunend,
						$monstart,
						$monend,
						$tuestart,
						$tueend,
						$wedstart,
						$wedend,
						$thustart,
						$thuend,
						$fristart,
						$friend,
						$satstart,
						$satend
						);
			}
			//generate the table
			echo $this->table->generate();
		}
		else echo '<p>No doctors found.</p>';
	}
	
	public function get_nurses(){
		$this->db->where('role','nurse');
		$query = $this->db->get('userinfo');
	
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			echo '<div class="col-lg-12">';
			$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
					'table_close' => '</table>');
			$this->table->set_template($table_config);
			//create table heading
			$this->table->set_heading('Name','Department','Sunday Start','Sunday End','Monday Start','Monday End','Tuesday Start','Tuesday End','Wednesday Start','Wednesday End','Thursday Start','Thursday End','Friday Start','Firday End','Saturday Start','Saturday End');
	
				
			foreach ($query->result() as $row)
			{
				$id = $row->id;
				$this->db->from('nurses');
				$this->db->where('id',$id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
	
				//$gender= $row2->gender;
				$this->db->from('schedule');
				$this->db->where('id', $id);
				$query3 = $this->db->get();
				$row3 = $query3->row();
	
				$sunstart = $row3->sunstart;
				$sunend = $row3->sunend;
				$monstart = $row3->monstart;
				$monend = $row3->monend;
				$tuestart = $row3->tuestart;
				$tueend = $row3->tueend;
				$wedstart = $row3->wedstart;
				$wedend = $row3->wedend;
				$thustart = $row3->thustart;
				$thuend = $row3->thuend;
				$fristart = $row3->fristart;
				$friend = $row3->friend;
				$satstart = $row3->satstart;
				$satend = $row3->satend;
				
							if($sunstart == -1){
					$sunstart='off';
					$sunend='off';
				}
				else if($sunstart==0){
					$sunstart=($sunstart+12).'am';
				}
				else if ($sunstart>12)
				{
					$sunstart = ($sunstart%12).'pm';
				}
				else
				{
					$sunstart = $sunstart.'am';
				}
				if($sunend==0 && $sunend != 'off'){
					$sunend=($sunend+12).'am';
				}
				else if ($sunend>12)
				{
					$sunend = ($sunend%12).'pm';
				}
				else if($sunend != 'off')
				{
					$sunend = $sunend.'am';
				}
				
				if($monstart == -1){
					$monstart='off';
					$monend='off';
				}
				else if($monstart==0){
					$monstart=($monstart+12).'am';
				}
				else if ($monstart>12)
				{
					$monstart = ($monstart%12).'pm';
				}
				else
				{
					$monstart = $monstart.'am';
				}
				if($monend==0 && $monend != 'off'){
					$monend=($monend+12).'am';
				}
				else if ($monend>12)
				{
					$monend = ($monend%12).'pm';
				}
				else if($monend != 'off')
				{
					$monend = $monend.'am';
				}
				
				
				if($tuestart == -1){
					$tuestart='off';
					$tueend='off';
				}
				else if($tuestart==0){
					$tuestart=($tuestart+12).'am';
				}
				else if ($tuestart>12)
				{
					$tuestart = ($tuestart%12).'pm';
				}
				else
				{
					$tuestart = $tuestart.'am';
				}
				if($tueend==0 && $tueend != 'off'){
					$tueend=($tueend+12).'am';
				}
				else if ($tueend>12)
				{
					$tueend = ($tueend%12).'pm';
				}
				else if($tueend != 'off')
				{
					$tueend = $tueend.'am';
				}
				
				if($wedstart == -1){
					$wedstart='off';
					$wedend='off';
				}
				else if($wedstart==0){
					$wedstart=($wedstart+12).'am';
				}
				else if ($wedstart>12)
				{
					$wedstart = ($wedstart%12).'pm';
				}
				else
				{
					$wedstart = $wedstart.'am';
				}
				if($wedend==0 && $wedend != 'off'){
					$wedend=($wedend+12).'am';
				}
				else if ($wedend>12)
				{
					$wedend = ($wedend%12).'pm';
				}
				else if($wedend != 'off')
				{
					$wedend = $wedend.'am';
				}
				
				if($thustart == -1){
					$thustart='off';
					$thuend='off';
				}
				else if($thustart==0){
					$thustart=($thustart+12).'am';
				}
				else if ($thustart>12)
				{
					$thustart = ($thustart%12).'pm';
				}
				else
				{
					$thustart = $thustart.'am';
				}
				if($thuend==0 && $thuend != 'off'){
					$thuend=($thuend+12).'am';
				}
				else if ($thuend>12)
				{
					$thuend = ($thuend%12).'pm';
				}
				else if ($thuend != 'off')
				{
					$thuend = $thuend.'am';
				}
				
				if($fristart == -1){
					$fristart='off';
					$friend='off';
				}
				else if($fristart==0){
					$fristart=($fristart+12).'am';
				}
				else if ($fristart>12)
				{
					$fristart = ($fristart%12).'pm';
				}
				else
				{
					$fristart = $fristart.'am';
				}
				if($friend==0 && $friend != 'off'){
					$friend=($friend+12).'am';
				}
				else if ($friend>12)
				{
					$friend = ($friend%12).'pm';
				}
				else if($friend != 'off')
				{
					$friend = $friend.'am';
				}
				
				if($satstart == -1){
					$satstart='off';
					$satend='off';
				}
				else if($satstart==0){
					$satstart=($satstart+12).'am';
				}
				else if ($satstart>12)
				{
					$satstart = ($satstart%12).'pm';
				}
				else
				{
					$satstart = $satstart.'am';
				}
				if($satend==0 && $satend != 'off'){
					$satend=($satend+12).'am';
				}
				else if ($satend>12)
				{
					$satend = ($satend%12).'pm';
				}
				else if($satend != 'off')
				{
					$satend = $satend.'am';
				}
				
				//add doctor to table
				$this->table->add_row($row->firstname . ' ' . $row->lastname,
						//$gender,
						//$row2->experience.' years',
						//add a button to select doctor
						$row2->department,
						$sunstart,
						$sunend,
						$monstart,
						$monend,
						$tuestart,
						$tueend,
						$wedstart,
						$wedend,
						$thustart,
						$thuend,
						$fristart,
						$friend,
						$satstart,
						$satend);
			}
			//generate the table
			echo $this->table->generate();
		}
		else echo '<p>No nurses found.</p>';
	}
}
<?php 
$appt_id = $this->session->userdata('appt_id');
$this->db->where('appt_id', $appt_id);
$query = $this->db->get('appts');
$row=$query->row();

$patient_id = $row->patient_id;
$this->db->where('id',$patient_id);
$query2=$this->db->get('userinfo');
$row2=$query2->row();
?>

        <?php 
        	/*
			echo "<p>";
			echo "Patient Name: ";
			echo $row2->firstname.' '.$row2->lastname;
			echo "</p>";*/
			
			echo "<p>";
			echo "Current Prescription: ";
			echo $row->prescription;
			echo "</p>";
			
			/*echo form_open('appointment/update_prescriptions');
			echo "<p>";
			echo form_input('prescriptions');
			echo "</p>";
			echo "<p>";
			echo form_submit('prescription_submit', 'Update Prescription');
			echo "</p>";	
			echo form_close();*/
			echo '<input id="new_prescription"type="text"/>';
			echo '<input id="'.$row->appt_id.'"type="button" value="Update Prescription" onclick="update_prescriptions(this)" />';
			
			echo '<br>';
			echo "<p>";
			echo "Prescriptions from Past Appointments: ";
			echo "</p>";
			
			$this->db->where('patient_id', $patient_id);
			$query = $this->db->get('appts');
			$count = 0;
			foreach ($query->result() as $row)
			{
				if ($row->doctor_finish)
				{
					$doctor_id = $row->doctor_id;
					$this->db->where('id',$doctor_id);
					$query3=$this->db->get('userinfo');
					$row3=$query3->row();
					
					if ($row->prescription != '')
					{
						echo "<p> 20".$row->date.': '.$row->prescription.' from Dr. '.$row3->firstname.' '.$row3->lastname;
						$count++;
					}
				}
			}
			if ($count==0)
				echo "No previous appointments have been completed."
			?>
			


<?php

class Admin_search extends CI_Model
{
	
	public function test(){
		echo 'TEST!';
	}
	
	public function get_doctors(){
		$this->db->where('role','doctor');
		$query = $this->db->get('userinfo');
		
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			//create table heading
			$this->table->set_heading('Name','Gender','Experience','Specialization');
			 
			
			foreach ($query->result() as $row)
			{
				$id = $row->id;
				$this->db->from('doctors');
				$this->db->where('id',$id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
				
				$gender= $row2->gender;
				
				
				//add doctor to table
				$this->table->add_row($row->firstname . ' ' . $row->lastname,
						$gender,
						$row2->experience.' years',
						//add a button to select doctor
						$row2->specialization);
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
			//create table heading
			$this->table->set_heading('Name','Department');
	
				
			foreach ($query->result() as $row)
			{
				$id = $row->id;
				$this->db->from('nurses');
				$this->db->where('id',$id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
	
				//$gender= $row2->gender;
	
	
				//add doctor to table
				$this->table->add_row($row->firstname . ' ' . $row->lastname,
						//$gender,
						//$row2->experience.' years',
						//add a button to select doctor
						$row2->department);
			}
			//generate the table
			echo $this->table->generate();
		}
		else echo '<p>No nurses found.</p>';
	}
}
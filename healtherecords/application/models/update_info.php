<?php
class Update_info extends CI_Model
{
	public function experience_change(){
		$newxp = $this->input->post('experience');
		$temp = array('experience' => $newxp);
		
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
		
		$this->db->where('id', $id);
		$query = $this->db->update('doctors',$temp);
		
		return $query;
	}
	
	public function username_change(){
		$newusername = $this->input->post('username');
		$temp = array('username' => $newusername);
		
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->update('userinfo',$temp);
		
		return $query;
	}
	
	public function email_change(){
		$newemail = $this->input->post('email');
		$temp = array('email' => $newemail);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->update('userinfo',$temp);
	
		return $query;
	}
	
	public function homephone_change(){
		$newphone = $this->input->post('homephone');
		$temp = array('homephone' => $newphone);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->update('userinfo',$temp);
	
		return $query;
	}
	
	public function workphone_change(){
		$newphone = $this->input->post('workphone');
		$temp = array('workphone' => $newphone);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query = $this->db->update('userinfo',$temp);
	
		return $query;
	}
	
	public function gender_change(){
		$newgender = $this->input->post('gender');
		$temp = array('gender' => $newgender);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
		
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function marriage_change(){
		$newmarriage = $this->input->post('maritalstatus');
		$temp = array('maritalstatus' => $newmarriage);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function al1_change(){
		$newline = $this->input->post('addressline1');
		$temp = array('addressline1' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function al2_change(){
		$newline = $this->input->post('addressline2');
		$temp = array('addressline2' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function city_change(){
		$newline = $this->input->post('city');
		$temp = array('city' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function zip_change(){
		$newline = $this->input->post('zipcode');
		$temp = array('zipcode' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function ecname_change(){
		$newline = $this->input->post('ecname');
		$temp = array('ecname' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function ecphone_change(){
		$newline = $this->input->post('ecphone');
		$temp = array('ecphone' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function insurancestart_change(){
		$newline = $this->input->post('insurancestart');
		$temp = array('insurancestart' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function insuranceend_change(){
		$newline = $this->input->post('insuranceend');
		$temp = array('insuranceend' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function insurancepolicy_change(){
		$newline = $this->input->post('insuranceprovider');
		$temp = array('insuranceprovider' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
	
	public function allergies_change(){
		$newline = $this->input->post('allergies');
		$temp = array('allergies' => $newline);
	
		$this->db->where('username', $this->session->userdata('username'));
		$query2 = $this->db->get('userinfo');
		$row = $query2->row();
		$id=$row->id;
	
		$this->db->where('id', $id);
		$query = $this->db->update('patients',$temp);
	
		return $query;
	}
}
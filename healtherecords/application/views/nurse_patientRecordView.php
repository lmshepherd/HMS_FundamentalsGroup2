<?php
$nursename = $this->session->userdata('username');
$this->db->where('username', $nursename);
$query5 = $this->db->get('userinfo');
$row5 = $query5->row();
$nurseid = $row5->id;

$this->db->where('nurse_id',$nurseid);
$query4 = $this->db->get('appts');
$row4 = $query4->row();

$patientid = $row4->patient_id;

//grab patient medical record
$this->db->where('id',$patientid);
$query = $this->db->get('medical_record');
$row = $query->row();

//grab patient name, phone
$this->db->where('id',$patientid);
$query2 = $this->db->get('userinfo');
$row2 = $query2->row();

//grab patient contact info, insurance,
$this->db->where('id', $patientid);
$query3 = $this->db->get('patients');
$row3 = $query3->row();
?>

<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>View Patients</h1></header>
<div id="container">
<div class="col-lg-2" id="left">
     	    <?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10" id="center">
	<?php 
		echo "Here is your pateints information:";
		echo "<br>";
		//read from userinfo table
		echo '<p>Name: ';
		echo $row2->firstname;
		echo ' ';
		echo $row2->lastname;
		echo '</p>';
		
		echo '<p>Date of Birth: ';
		echo $row2->dob;
		echo '</p>';
		
		echo '<p>Home Phone : ';
		echo $row2->homephone;
		echo '</p>';
		
		echo '<p>Work Phone: ';
		echo $row2->workphone;
		echo '</p>';
		
		//read from patients table
		echo '<p>Gender: ';
		echo $row3->gender;
		echo '</p>';
		
		echo '<p>Marital Status: ';
		echo $row3->maritalstatus;
		echo '</p>';
		
		echo '<p>Address Line 1: ';
		echo $row3->addressline1;
		echo '</p>';
		
		echo '<p>Address Line 2: ';
		echo $row3->addressline2;
		echo '</p>';
		
		echo '<p>City: ';
		echo $row3->city;
		echo '</p>';
		
		echo '<p>Zipcode: ';
		echo $row3->zipcode;
		echo '</p>';
		
		echo '<p>Emergency Contact: ';
		echo $row3->ecname;
		echo '</p>';
		
		echo '<p>Emergency Contact Phone: ';
		echo $row3->ecphone;
		echo '</p>';
		
		echo '<p>Insurance Provider: ';
		echo $row3->insuranceprovider;
		echo '</p>';
		
		echo '<p>Insurance Start: ';
		echo $row3->insurancestart;
		echo '</p>';
		
		echo '<p>Insurance End: ';
		echo $row3->insuranceend;
		echo '</p>';
		
		echo '<p>Allergies: ';
		echo $row3->allergies;
		echo '</p>';
	
	?>
	<br>
	
	<?php
	if($row!=NULL){
		echo "Here is your patients medical record:";
		echo "<br>";
		
		echo '<p>Height: ';
		echo $row->height;
		echo " inches";
		echo '</p>';
		
		echo '<p>Weight: ';
		echo $row->weight;
		echo " pounds";
		echo '</p>';
		
		echo '<p>Surgery history: ';
		echo $row->surgery;
		echo '</p>';
		
		echo '<p>Family history: ';
		echo $row->family;
		echo '</p>';
		
		echo '<p>Religion: ';
		echo $row->religion;
		echo '</p>';
		
		echo '<p>Career: ';
		echo $row->career;
		echo '</p>';
		
		echo '<p>Alcohol: ';
		echo $row->alcohol;
		echo '</p>';
		
		echo '<p>Smoking: ';
		echo $row->smoker;
		echo '</p>';
		
		echo '<p>Other notes: ';
		echo $row->other;
		echo '</p>';
	
	}
	?>
	
	<?php $this->load->view('commonViews/backLinks');?>
</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>

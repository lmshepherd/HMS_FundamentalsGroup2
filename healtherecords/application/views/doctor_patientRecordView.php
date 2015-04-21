<?php 
$docname = $this->session->userdata('username');
$this->db->where('username', $docname);
$query5 = $this->db->get('userinfo');
$row5 = $query5->row();
$docid = $row5->id;

$patientid = $this->session->userdata('patient');

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

<?php $this->load->view('header');?>
<header id="header"><h1>Health E-Records: My Patients</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-4">
     	    <ul>
			    <li><a href="http://projectsgeek.com/2013/08/hospital-management-system-mini-project-2.html">HMS Info</a></li>
			    <li><a href="#">Link 2</a></li>
			    <li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
		    </ul>
		    <h3>Doctor Links</h3>
		    <ul>
			    <li><a href="#">Link 1</a></li>
			    <li><a href="#">Link 2</a></li>
		    	<li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
			</ul>
		</div>
        <div class="col-lg-8">
		    <h1> General Patient Information</h1>
			<?php 
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
			<h1>Here is your patients medical record</h1>
			<?php
			if($row!=NULL){
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
			
			<a href = '<?php 
				echo base_url(),"index.php/main/home"
				?>'>Back to Home</a>
			
			<a href = '<?php 
				echo base_url(),"index.php/main/logout"
			?>'>Logout</a>
	</div>
      </div>

</div>

</body>
</html>
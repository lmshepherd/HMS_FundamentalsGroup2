<?php 
$username = $this->session->userdata('username');
$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();

$id = $row->id;
$this->db->where('id',$id);
$query = $this->db->get('medical_record');
$row = $query->row();
?>

<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Here is your current medical record</h1></header>
<div id="container">
	<div class="row">
        <div class="col-lg-4">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-8">
    	    <?php
			$attributes = array('class' => 'form-group', 'role' => 'form','id'=>'center', 'class'=>'column');
			
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
				
				echo form_open('main/complete_medicalRecord', $attributes);
				
				echo "<p>";
				echo form_submit('medicalRecord_submit', 'Update Your Medical Record');
				echo "</p>";
				
				echo form_close();	
			}
			$this->load->view('commonViews/backLinks');
			?>
		</div>
	</div>

</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
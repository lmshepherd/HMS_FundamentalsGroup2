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
<header id="header"><h1>Here is your current medical record</h1></header>
<div id="container">
	<?php
	$attributes = array('class' => 'form-group', 'role' => 'form','class'=>'column');
	
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
	?>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/home"
		?>'>Back to Home</a>
	
	<a href = '<?php 
		echo base_url(),"index.php/main/logout"
	?>'>Logout</a>

</div>

</body>
</html>
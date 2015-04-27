<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function(){
		$.ajax({
			//run select_specialization function of appointment controller
			url:"<?php echo base_url();?>index.php/salary/view_payroll",
			//set data value of POST to value selected in dropdown box
			//update html inside doctor_list div to be what is returned
			success: function(data){
				//update doctor list div
				$("#payroll_info").html(data);
				//$( "#doctor_schedule" ).empty();
			}
		});
	});
	</script>


<body>
<header id="header"><h1>Health E-Records: Payroll</h1></header>
<div id="container">

	<div class="row">
        <div class="col-md-2" id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-md-10", id="center">
		
		<br>
        <div id = "year">
        	<?php 
        	$options = array('2015' => '2015',
        					'2014' => '2014');
        	echo form_dropdown('year',$options,'','id="year"');
        	?>
        </div>
        <div id = "period">
        	<?php 
        	$options = array('jan' => 'January','feb' => 'February',
        					'mar' => 'March','apr' => 'April',
							'may' => 'Mayy','jun' => 'June',
							'jul' => 'July','aug' => 'August',
							'sep' => 'September','oct' => 'October',
							'nov' => 'November','dec' => 'December',);
        	echo form_dropdown('month',$options,'','id="month"');
        	?>
        </div>
        
		<div id="payroll_info"></div>
		
		<div id='paycheck_info'></div>
	
	<?php $this->load->view('commonViews/backLinks');?>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
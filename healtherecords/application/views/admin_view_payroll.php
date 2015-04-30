<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">

	$(document).ready(function(){
		$("#year").change(function(){
			$("#month").val('0');
			$("#payroll_info").empty();
			$( "#paycheck_info" ).empty();
		});
		
		$("#month").change(function(){
			$.ajax({
				url:"<?php echo base_url();?>index.php/salary/view_payroll",
				data: {year: $("#year").val(), month: $(this).val()},
				type: "POST",
				success: function(data){
					$("#payroll_info").html(data);
					$( "#paycheck_info" ).empty();}
			});
		});
	});

	//'distribute paycheck' button clicked
	function send_paycheck(button){
		//confirm send
		if(window.confirm("Distribute Paycheck?"))
		{
			$.ajax({
				url:"<?php echo base_url();?>index.php/salary/send_paycheck",
				data: {paycheck_id: button.id},
				type: "POST",
				success: function(data){
					$("#paycheck_info").html(data);
					//refresh payroll info div to remove distributed paycheck
					$.ajax({
						url:"<?php echo base_url();?>index.php/salary/view_payroll",
						data: {year: $("#year").val(), month: $("#month").val()},
						type: "POST",
						success: function(data){
							$("#payroll_info").html(data);}
					});
				}
			});	
		}
	}
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
        <div id = "period">
        	<?php 
        	$options = array('2015' => '2015',
        					'2014' => '2014');
        	echo form_dropdown('selected_year',$options,'2015','id="year"');
        	?>

        	<?php 
        	$options = array('0' => 'Choose Month',
							'1' => 'January','2' => 'February',
        					'3' => 'March','4' => 'April',
							'5' => 'May','6' => 'June',
							'7' => 'July','8' => 'August',
							'9' => 'September','10' => 'October',
							'11' => 'November','12' => 'December',);
        	echo form_dropdown('selected_month',$options,'0','id="month"');
        	?>
        	
        </div>
        
        <div id='paycheck_info'></div>
        
		<div id="payroll_info"></div>
		<br>
		
	
	<?php $this->load->view('commonViews/backLinks');?>
	<br>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
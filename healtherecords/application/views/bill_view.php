<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">

	$( document ).ready(function() {
		$.ajax({
			url:"<?php echo base_url();?>index.php/bill/load_bill_view",
			success: function(data){
				$("#bill_info").html(data);
				//$( "#payment_info" ).empty();
			}
		});
	});

	function pay_bill(button){
		if(button.id!=$('#amount').val())
			alert('Amount entered does not match amount owed.');
		else
		{
			$.ajax({
				url:"<?php echo base_url();?>index.php/bill/pay_bill",
				data: {total_cost: button.id, amount: $('#amount').val()},
				type: "POST",
				success: function(data){
					$.ajax({
						url:"<?php echo base_url();?>index.php/bill/load_bill_view",
						success: function(data){
							$("#bill_info").html(data);
						}
					});
					$("#payment_info").html(data);
				}
			});
		}
		
	}
	
	</script>
	


<body>
<header id="header"><h1>Health E-Records: My Bills</h1></header>
<div id="container">

	<div id="bill_info"></div>

	
	<div id='payment_info'></div>
	
	<?php $this->load->view('commonViews/backLinks');?></div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
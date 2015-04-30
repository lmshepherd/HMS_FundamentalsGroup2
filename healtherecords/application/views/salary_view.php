<?php $this->load->view('commonViews/header')?>
	<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/flick/jquery-ui.css" rel="stylesheet" type="text/css" />
	<!-- load jquery javascript ajax communication -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
	
	<script type="text/javascript">
	
	</script>
	
<body>
<header id="header"><h1>Health E-Records: Salary History</h1></header>
<div id="container">

	<div class="row">
        <div class="col-md-2" id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-md-10", id="center">
		
		<br>
      
        
        <div id='salary_history'>
        
        <?php 
        //echo form_open('salary/load_paycheck_view');
        $this->load->model('payroll');
        $this->payroll->salary_history();
        //echo form_close();
        ?>
        
        </div>
	
	<p><?php $this->load->view('commonViews/backLinks');?></p>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
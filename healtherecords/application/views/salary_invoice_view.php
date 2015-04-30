<?php $this->load->view('commonViews/header')?>

<body>
<header id="header"><h1>Health E-Records: Paycheck Invoice</h1></header>
<div id="container">

	<div id="paycheck_info">
	
	<?php 
        $this->load->model('payroll');
        $this->payroll->load_paycheck_invoice($this->input->post('paycheck_id'));
        ?>
	
	</div>


	<p><a href='<?php echo base_url(), "index.php/salary/view_salary"?>'>Back to Salary History</a><br>
	
	<?php $this->load->view('commonViews/backLinks');?></p>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
<?php
class Payroll extends CI_Model
{
	public function view_payroll()
	{
		
		echo '<br>';
		echo '<div class="panel panel-default">
	  			<div class="panel-heading">Name</div>
	  			<div class="panel-body">
	    			Panel content
	  			</div>
				<div class="panel-footer">
					<input id="something" type="button" value="Distribute Paycheck" onclick="send_paycheck(this)" />
				</div>
			</div>';

	}
}
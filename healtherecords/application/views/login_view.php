<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Health E-Records</title>
	<style>
	
		/* Layout */
		body {
			min-width: 630px;
		}

		#container {
			padding-left: 200px;
			padding-right: 220px;
		}
		
		#container .column {
			position: relative;
			float: left;
		}
		
		#center {
			padding: 10px 20px;
			width: 100%;
		}
		
		#left {
			width: 180px;
			padding: 0 10px;
			right: 240px;
			margin-left: -100%;
		}
		
		#right {
			width: 160px;
			padding: 0 10px;
			margin-right: -100%;
		}
		
		#footer {
			clear: both;
		}
		
		* html #left {
			left: 150px;
		}

		/* Make the columns the same height as each other */
		#container {
			overflow: hidden;
		}

		#container .column {
			padding-bottom: 1001em;
			margin-bottom: -1000em;
		}

		* html body {
			overflow: hidden;
		}
		
		* html #footer-wrapper {
			float: left;
			position: relative;
			width: 100%;
			padding-bottom: 10010px;
			margin-bottom: -10000px;
			background: #fff;
		}

		body {
			margin: 0;
			padding: 0;
			font-family:Sans-serif;
			line-height: 1.5em;
		}
		
		p {
			color: #555;
		}

		nav ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}
		
		nav ul a {
			color: darkgreen;
			text-decoration: none;
		}

		#header, #footer {
			font-size: large;
			padding: 0.3em;
			background: #BCCE98;
		}

		#left {
			background: #DAE9BC;
		}
		
		#right {
			background: #F7FDEB;
		}

		#center {
			background: #fff;
		}

		#container .column {
			padding-top: 1em;
		}
		</style>
</head>

<body>
	<header id="header"><h1>Health E-Records Login</h1></header>

	<div id="container">
	
	<main id="center" class="column">
		<article>
			
			<h1>Homepage</h1>
			<p>This is where we can put the home page information for our HMS!<br><br><br>By Matt<br>Chuck<br>Laura<br><br><br>"I stood out in the open cold <br>To see the essence of the eclipse <br>Which was its perfect darkness. <br><br>I stood in the cold on the porch <br>And could not think of anything so perfect <br>As mans hope of light in the face of darkness."<br><br>-Richard Eberhart</p>
			
		</article>								
	</main>

	<nav id="left" class="column">
		<h3>Patient Links</h3>
		<ul>
			<li><a href="http://www.uihealthcare.org/">UIHC</a></li>
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

	</nav>
	
	<div id="right" class="column">
		<form name="loginForm">
			<?php 
			echo form_open('main/verify_login');
		
			echo validation_errors();
		
			echo "<p>Username: ";
			echo form_input('username');
			echo "</p>";
		
			echo "<p>Password: ";
			echo form_password('password');
			echo "</p>";
		
			echo "<p>";
			echo form_submit('login_submit', 'Login');
			echo "</p>";
		
			echo form_close();
		
			echo form_open('main/new_user');

			echo "<p>";
			echo form_submit('signup_submit', 'Sign Up');
			echo "</p>";
		
			echo form_close();
			?>
			</form>
		</div>
	</div>

	<div id="footer-wrapper">
		<footer id="footer"><p><strong><script type="text/javascript">
			var date = new Date();
			var month = new Array(7);
			month[0] = "January";
			month[1] = "February";
			month[2] = "March";
			month[3] = "April";
			month[4] = "May";
			month[5] = "June";
			month[6] = "July";
			month[7] = "August";
			month[8] = "September";
			month[9] = "October";
			month[10] = "November";
			month[11] = "December";
			var year = date.getYear();
			if (year < 2000) { year+=1900; }
			document.write(month[date.getMonth()] + " " + date.getDate() + ", " + year);
		</script></strong></p></footer>
	</div>

</body>
</html>
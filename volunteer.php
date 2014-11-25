<?php
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');
?>
<html lang="en">
	<head>
		<script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/volunteer.js"></script>
		<title>
			Volunteer
		</title>
	</head>
	<body>
		<button id="test-view-button" class="btn" type="button">Test view</button>
		<div id="not-logged-in-view">
			<h2>Volunteers</h2>
			<br /><br />
			<p class="paragraph-body">
				View events you've volunteered for, volunteer for an event, and cancel an
				event that you've volunteered for.
			</p>
	        <?php
	            if(!isset($token))
	                echo "<button id=\"volunteer-login-button\" class=\"btn btn-primary\" type=\"button\">Log In</button></li>";
	        ?>
    	</div>

    	<div id="logged-in-view">
			<h2 id="volunteer-menu-my-event-head"><b>My Events</b></h2>
			<h2 id="volunteer-menu-signup-event-head"><b>Sign Up for Event</b></h2>
			<h2 id="volunteer-menu-cancel-event-head"><b>Cancel Event</b></h2>
			<br /><br />
    		<p class="paragraph-body">
				<ul id="volunteer-menu" class="nav nav-pills nav-stacked" style="max-width: 300px;">
			      <li id="volunteer-my-event-menu-button" role="presentation" class="active"><a href="#">My Events</a></li>
			      <li id="volunteer-sign-up-event-menu-button" role="presentation"><a href="#">Sign Up for Event</a></li>
			      <li id="volunteer-cancel-event-menu-button" role="presentation"><a href="#">Cancel Event</a></li>
			    </ul>
    		</p>
    	</div>
	</body>
</html>


<?php
include_once('includes/footer.php');
?>
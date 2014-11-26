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
		<!-- View to display when user is not logged in -->
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
    	<!-- End view to display when user is not logged in -->

    	<!-- View to display when user is logged in -->
    	<div id="logged-in-view">
    		<ul id="volunteer-menu" class="nav nav-pills">
		      <li id="volunteer-my-event-menu-button" role="presentation" class="active"><a href="#">My Events</a></li>
		      <li id="volunteer-sign-up-event-menu-button" role="presentation"><a href="#">Sign Up for Event</a></li>
		      <li id="volunteer-cancel-event-menu-button" role="presentation"><a href="#">Cancel Event</a></li>
		    </ul>
		    <br /><br />
			<h2 id="volunteer-menu-my-event-head"><b>My Events</b></h2>
			<h2 id="volunteer-menu-signup-event-head"><b>Sign Up for Event</b></h2>
			<h2 id="volunteer-menu-cancel-event-head"><b>Cancel Event</b></h2>
			<br /><br />
			<!-- My Events -->
    		<p id="volunteer-my-event-body" class="paragraph-body">
    			<i>Events that you have volunteered for are listed below</i><br /><br />
				<table class="table" id="volunteer-my-event-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Location</th>
							<th>Time</th>
							<th>Duration</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>November 15, 2014</td>
							<td>45 Smith St., Guelph, ON</td>
							<td>2:30 pm</td>
							<td>2 hours</td>
							<td><a>View Details</a></td>
						</tr>
						<tr>
							<td>November 22, 2014</td>
							<td>1 Anders St., Hamilton, ON</td>
							<td>10:00 am</td>
							<td>3 hours</td>
							<td><a>View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of My Events Section -->

    		<!-- Sign up for Event -->
    		<p id="volunteer-sign-up-event-body" class="paragraph-body">
    			<i>Events that you can volunteer for are listed below</i><br /><br />
				<table class="table" id="volunteer-sign-up-event-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Location</th>
							<th>Time</th>
							<th>Duration</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>December 17, 2014</td>
							<td>3484 Lakeshore Rd., Burlington, ON</td>
							<td>11:00 am</td>
							<td>1 hour</td>
							<td><a>View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of Sign up Event -->

    		<!-- Cancel Event -->
    		<p id="volunteer-cancel-event-body" class="paragraph-body">
    			<i>To drop out of an event, click 'View Detail', and then 'Delete Event'</i><br /><br />
				<table class="table" id="volunteer-cancel-event-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Location</th>
							<th>Time</th>
							<th>Duration</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>November 15, 2014</td>
							<td>45 Smith St., Guelph, ON</td>
							<td>2:30 pm</td>
							<td>2 hours</td>
							<td><a>View Details</a></td>
						</tr>
						<tr>
							<td>November 22, 2014</td>
							<td>1 Anders St., Hamilton, ON</td>
							<td>10:00 am</td>
							<td>3 hours</td>
							<td><a>View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of Cancel Event -->
    	</div>
    	<!-- End view to display when user is logged in -->

	</body>
</html>


<?php
include_once('includes/footer.php');
?>

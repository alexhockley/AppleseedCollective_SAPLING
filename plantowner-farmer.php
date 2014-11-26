<?php
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');
?>
<html lang="en">
	<head>
		<script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/producer.js"></script>
		<title>
			Plant Owners and Farmers
		</title>
	</head>
	<body>
		<button id="test-view-button" class="btn" type="button">Test view</button><br />
		<!-- Using the staff code because it's basically the same at this point
			 in terms of user-facing things -->

 		<!-- View to display when user is not logged in -->
		<div id="not-logged-in-view">
			<h2>Plant Owners and Farmers</h2>
			<br /><br />
			<p class="paragraph-body">
				View gleaning events, register a gleaning, and cancel events.
			</p>
	        <?php
	            if(!isset($token))
	                echo "<button id=\"staff-login-button\" class=\"btn btn-primary\" type=\"button\">Log In</button></li>";
	        ?>
    	</div>
    	<!-- End view to display when user is not logged in -->

    	<!-- View to display when user is logged in -->
		<div id="logged-in-view">
    		<ul id="producer-menu" class="nav nav-pills">
		      <li id="producer-pending-events-button" role="presentation" class="active"><a href="#">My Gleaning Events</a></li>
		      <li id="producer-register-gleaning-button" role="presentation"><a href="#">Create a Gleaning Event</a></li>
		      <li id="producer-cancel-gleaning-button" role="presentation"><a href="#">Cancel a Gleaning Event</a></li>
		    </ul>
		    <br /><br />

			<h2 id="producer-pending-events-head"><b>My Gleaning Events</b></h2>
			<h2 id="producer-register-gleaning-head"><b>Create a Gleaning Event</b></h2>
			<h2 id="producer-cancel-gleaning-head"><b>Cancel a Gleaning Event</b></h2>

			<!-- My Gleaning Events -->
    		<p id="producer-pending-events-body" class="paragraph-body">
    			<i>Gleaning events that you have created are listed below</i><br /><br />
    			<table class="table" id="producer-pending-events-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Location</th>
							<th>Time</th>
							<th>Duration</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>November 20, 2014</td>
							<td>45 Water St., Guelph, ON</td>
							<td>2:00 pm</td>
							<td>2 hours</td>
							<td>Approved</td>
							<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
						</tr>
						<tr>
							<td>November 22, 2014</td>
							<td>11 Guelph Line, Burlington, ON</td>
							<td>11:30 am</td>
							<td>3 hours</td>
							<td>Pending</td>
							<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of My Gleaning Events -->

    		<!-- Register Gleaning -->
    		<p id="producer-register-gleaning-body" class="paragraph-body">
    			<i>Fill in gleaning information below to register an event.
    				The event will be approved by staff member from Appleseed Collective</i><br />
				<form id="create-event-form">
					<label>Gleaning Date:</label>
					<input id="gleaning-date-input" type="text" class="form-control" placeholder="mm/dd/yyyy">
					<br /><br />

					<label>Time:</label>
					<input id="gleaning-time-input" type="text" class="form-control" placeholder="hh/mm (24-hour clock)">
					<br /><br />

					<label>Duration:</label>
					<input id="gleaning-duration-input" type="text" class="form-control" placeholder="(In Hours) ex: 2 ">
					<br /><br />

					<label>Location of Produce:</label><br />
					<textarea id="gleaning-location-input" type="text" class="form-control">
					</textarea>
					<br /><br />

					<label>Produce Information:</label><br />
					<textarea id="gleaning-produce-info-input" type="text" class="form-control">
					</textarea>
					<br /><br />

					<label>Additional Information:</label><br />
					<textarea id="gleaning-additional-info-input" type="text" class="form-control">
					</textarea>
					<br /><br />

					<button id="gleaning-input-submit" type="submit" class="btn btn-success">Submit</button>
					<button id="gleaning-input-cancel" type="button" class="btn btn-primary">Cancel</button>
				</form>
    		</p>
    		<!-- End of Register of Gleaning -->

    		<!-- Cancel Gleaning -->
    		<p id="producer-cancel-gleaning-body" class="paragraph-body">
    			<i>To cancel an event, click 'View Details', and then 'Delete Event'</i><br /><br />
    			<table class="table" id="producer-cancel-events-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Location</th>
							<th>Time</th>
							<th>Duration</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>November 20, 2014</td>
							<td>45 Water St., Guelph, ON</td>
							<td>2:00 pm</td>
							<td>2 hours</td>
							<td>Approved</td>
							<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
						</tr>
						<tr>
							<td>November 22, 2014</td>
							<td>11 Guelph Line, Burlington, ON</td>
							<td>11:30 am</td>
							<td>3 hours</td>
							<td>Pending</td>
							<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of Cancel Gleaning -->

		</div>
    	<!-- End view to display when user is logged in -->
	</body>
</html>


<?php
include_once('includes/footer.php');
?>

<?php
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');
?>
<html lang="en">
	<head>
		<script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/staff.js"></script>
		<title>
			Staff
		</title>
	</head>
	<body>
		<button id="test-view-button" class="btn" type="button">Test view</button><br />
		<div id="not-logged-in-view">
			<h2>Staff Members</h2>
			<br /><br />
			<p class="paragraph-body">
				View gleaning events, register a gleaning, and cancel events.
			</p>
	        <?php
	            if(!isset($token))
	                echo "<button id=\"staff-login-button\" class=\"btn btn-primary\" type=\"button\">Log In</button></li>";
	        ?>
    	</div>

    	<div id="logged-in-view">
    		<ul id="staff-menu" class="nav nav-pills">
		      <li id="staff-pending-events-button" role="presentation" class="active"><a href="#">Events Pending Approval</a></li>
		      <li id="staff-create-gleaning-button" role="presentation"><a href="#">Create a Gleaning Event</a></li>
		      <li id="staff-delete-gleaning-button" role="presentation"><a href="#">Delete a Gleaning Event</a></li>
		    </ul>
		    <br /><br />

			<h2 id="staff-pending-events-head"><b>Events Pending Approval</b></h2>
			<h2 id="staff-create-gleaning-head"><b>Create a Gleaning Event</b></h2>
			<h2 id="staff-delete-gleaning-head"><b>Cancel a Gleaning Event</b></h2>
			<br /><br />

			<!-- Events Pending Approval-->
    		<p id="staff-pending-events-body" class="paragraph-body">
    			<i>Events that require staff approval before being displayed on the 'Upcoming Events' page
    			 are listed below</i><br /><br />
				<table class="table" id="staff-pending-events-table">
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
							<td>November 20, 2014</td>
							<td>45 Water St., Guelph, ON</td>
							<td>2:00 pm</td>
							<td>2 hours</td>
							<td><a>View Details</a></td>
						</tr>
						<tr>
							<td>November 22, 2014</td>
							<td>11 Guelph Line, Burlington, ON</td>
							<td>11:30 am</td>
							<td>3 hours</td>
							<td><a>View Details</a></td>
						</tr>
					</tbody>
				</table><br />
    		</p>
    		<!-- End of My Events Section -->

    		<!-- Create Gleaning Event -->
			<p id="staff-create-events-body" class="paragraph-body">
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
    		<!-- End Gleaning Event -->

    		<!-- Delete Event -->
    		<p id="staff-delete-events-body" class="paragraph-body">
    			<i>To delete an event, click 'View Details', and then 'Delete Event'</i><br /><br />
				<table class="table" id="delete-event-table">
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
						<tr>
							<td>November 22, 2014</td>
							<td>3484 Lakeshore Rd., Burlington, ON</td>
							<td>11:00 am</td>
							<td>1 hour</td>
							<td><a>View Details</a></td>
						</tr>
					</tbody>
				</table><br />
			</p>
    		<!-- End of Delete Event -->
    	</div>
	</body>
</html>


<?php
include_once('includes/footer.php');
?>
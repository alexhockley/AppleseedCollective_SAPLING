<?php
/******************************************************************************
 * FILE NAME: events.php
 * PURPOSE: Contains the html code related to the events
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Thursay November 21, 2014
 * CONTACT: 
 * UPDATED BY: Erica Pisani-Konert
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');
?>
<html lang="en">
	<head>
		<script type="text/javascript" src="<?php Helpers::BASE_URL_LOCAL?>js/events.js"></script>
		<title>
			Upcoming Events
		</title>
	</head>
	<body>
		<h2>Upcoming Events</h2><br />

		<div id="events-container">

		</div>

		<h4>2014 >></h4><br />

		<!-- List upcoming events in a month -->
		<table class="table" id="upcoming-event-date-table">
			<h4>Nov</h4><br />
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
					<td>15</td>
					<td>45 Smith St., Guelph, ON</td>
					<td>2:30 pm</td>
					<td>2 hours</td>
					<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
				</tr>
				<tr>
					<td>22</td>
					<td>1 Anders St., Hamilton, ON</td>
					<td>10:00 am</td>
					<td>3 hours</td>
					<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
				</tr>
				<tr>
					<td>22</td>
					<td>3484 Lakeshore Rd., Burlington, ON</td>
					<td>11:00 am</td>
					<td>1 hour</td>
					<td><a href="<?php echo Helpers::BASE_URL_LOCAL?>eventdetails.php">View Details</a></td>
				</tr>
			</tbody>
		</table><br />
		<!-- End list of upcoming events -->

		<h4>May</h4><br />
		<div id="info-box" class="alert alert-info" role="feedback-info-box">
			<b><i>
				No upcoming events.
			</i></b>
		</div>
	</body>
</html>




<?php
include_once('includes/footer.php');
?>

<?php
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');

if(isset($_GET['id']))
  $id = $_GET['id'];
//no id should error out and go to another page or something

?>
<html>
<head>
  <script type="text/javascript">
    var id = <?php echo $id?>;
  </script>
  <title>
  	Event Details
  </title>
</head>
<body>
	<h2>Events Details</h2><br /><br />
	<span class="event-details-label label label-default">Date:</span>
	<label class="event-details">November 15, 2014</label><br /><br />
	<span class="event-details-label label label-default">Time:</span>
	<label class="event-details">2:30pm</label><br /><br />
	<span class="event-details-label label label-default">Address:</span>
	<label class="event-details">45 Smith St., Guelph, ON</label><br /><br />
	<span class="event-details-label label label-default">Duration:</span>
	<label class="event-details">2 hours</label><br /><br />
	<span class="event-details-label label label-default">Produce Being Gleaned:</span>
	<label class="event-details">Apples, Oranges</label><br /><br />
	<span class="event-details-label label label-default">Additional Info:</span>
	<label class="event-details">About 12 volunteers needed. It will be mix of cherry and apple picking. If you need a carpool, <br />please email us asap via guelphgrow@gmail.com.</label><br /><br />
	<span class="event-details-label label label-default">Organizer:</span>
	<label class="event-details">Bob Loblaw</label><br /><br />

	<div id="harvest-info-box" class="alert alert-success" role="harvest-info-box">
		<b><i>
			If you are looking for the Appleseed Collective to come harvest your plants
			<a href="<?php echo Helpers::BASE_URL_LOCAL?>plantowner-farmer.php">click here</a>.
		</i></b>
	</div>

	<button id="signup-button" type="button" class="btn btn-primary">Sign Up for This Event</button>

</body>


<?php
include_once('includes/footer.php');
?>

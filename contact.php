<?php
include_once('includes/header.php');
include_once('includes/leftsidebar.php');
include_once('includes/rightsidebar.php');
?>
<html lang="en">
	<head>
		<title>
			Contact Us
		</title>
	</head>
	<body>
		<h2>Contact Us!</h2>
		<br /><br />
		<p class="paragraph-body">
			<h5>Coordinator: </h5> Denise
			<h5>Email: </h5> guelphgrow@gmail.com
			<br />
			<h5>Staff: </h5> Charlie Brown
			<h5>Email: </h5> cbrown@appleseedcollective.ca
		</p>
		<br /><br />
		<h3>We'd Love To Hear From You!</h3>

		<div id="feedback-info-box" class="alert alert-info" role="feedback-info-box">
			<b><i>
				If you have any concerns or highlights from recent events
				or just want to drop a line, fill out this short form
				<a href="<?php echo Helpers::BASE_URL_LOCAL?>feedback.php">here</a>.
			</i></b>
		</div>
	</body>
</html>


<?php
include_once('includes/footer.php');
?>
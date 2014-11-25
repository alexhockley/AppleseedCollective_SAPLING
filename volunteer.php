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
	</body>
</html>


<?php
include_once('includes/footer.php');
?>
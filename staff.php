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
		<h2>Staff Members</h2>
		<br /><br />
		<p class="paragraph-body">
			View gleaning events, register a gleaning, and cancel events.
		</p>
        <?php
            if(!isset($token))
                echo "<button id=\"staff-login-button\" class=\"btn btn-primary\" type=\"button\">Log In</button></li>";
        ?>
	</body>
</html>


<?php
include_once('includes/footer.php');
?>
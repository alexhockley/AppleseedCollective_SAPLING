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
	<h2>Events Details</h2><br />
	Coming soon...
</body>


<?php
include_once('includes/footer.php');
?>

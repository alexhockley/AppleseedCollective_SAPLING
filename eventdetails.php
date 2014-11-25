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
</head>



<?php
include_once('includes/footer.php');
?>

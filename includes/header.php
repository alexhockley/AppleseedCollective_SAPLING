<?php
include_once('helpers.php');
if(isset($_SESSION['token']))
    $token = $_SESSION['token'];
else
    unset($token);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/header.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo Helpers::BASE_URL_LOCAL?>/bootstrap/dist/css/bootstrap.min.css"></script>
    <link rel="stylesheet" href="<?php echo Helpers::BASE_URL_LOCAL?>/css/style.css"></script>
    <script type="text/javascript">
        <?php
            if(isset($token))
                echo "var token = $token";
            else
                echo "var token = null";
        ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default" role="navigation" style="height:10%; background-color:black">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="http://localhost/3750/repo/index.php">
                    Appleseed Collective
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar navbar-nav">
                    <li><a class="header-link" href="http://localhost/3750/repo/aboutus.html">About us</a></li>
                    <li><a class="header-link" href="http://localhost/3750/repo/events.php">Events</a></li>
                    <li><a class="header-link" href="http://localhost/3750/repo/contact.php">Contact</a></li>
                    
                </ul>
            </div>
            
        </div>
    </nav>


</body>
</html>


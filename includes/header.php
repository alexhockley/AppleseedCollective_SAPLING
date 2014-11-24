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
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/header.js"></script>
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
    <nav class="navbar navbar-inverse" role="navigation">   
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo Helpers::BASE_URL_LOCAL?>index.php">
                    Appleseed Collective
                </a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav" style="float:right">
                    <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>aboutus.php">About us</a></li>
                    <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>events.php">Events</a></li>
                    <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>contact.php">Contact</a></li>   
                    
                    <?php
                        if(isset($token))
                            echo "<li>$token</li>";
                        else
                            echo "<li><button id=\"login-button\">Login</button></li>";
                    ?>
                    
                    
                </ul>
            </div>           
        </div>
    </nav>
    
    <div class="modal fade" id="login-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" id="modal-x" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <input id="login-field" placeholder="Login" type="text">
                    <input id="password-field" placeholder="Password" type="password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-login-button" >Login</button>
                    <button type="button" class="btn btn-primary" id="modal-cancel-button" data-dismiss="modal">Cancel</button>  
                </div>
            </div>
        </div>
    </div>


</body>
</html>


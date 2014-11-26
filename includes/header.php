<?php
/*
  header.php
  Contains the header for the top of every page in the website.  As this file will be included in every
  page in the site, it also contains the inclusion of globally needed css, javascript and html code.
  Date: Nov 24 2014
  Authors: Sapling
  Updated: Alex Hockley
  Date Updated: Nov 25 2014
*/
session_start(); //starts the session
include_once('helpers.php'); //include the helper functions and classes
if(isset($_SESSION['token'])){ //token is set
    $token = $_SESSION['token'];
    if(isset($_SESSION['user_id'])) //user id is set
      $id = $_SESSION['user_id'];
    else
      unset($id); //clear the id, in case its set
}
else
    unset($token);//clear the token, in case its set
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/jquery-1.11.1.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/helpers.js"></script>
    <script type="text/javascript" src="<?php echo Helpers::BASE_URL_LOCAL?>/js/header.js"></script>

    <link rel="stylesheet" href="<?php echo Helpers::BASE_URL_LOCAL?>/bootstrap/dist/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="<?php echo Helpers::BASE_URL_LOCAL?>/css/style.css"></link>

    <script type="text/javascript">
        <?php
          //transfer the token and id to javascript
            if(isset($token)){
                echo "var token = '$token';";
                if(isset($id)){
                  echo "var userId = $id;";
                  echo "var user = getUser(userId);"; //get the user object for the current user
                }
            }
            else
                echo "var token = null;";
        ?>
    </script>
</head>
<body>
    <nav id="nav-bar" class="navbar navbar-inverse" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Helpers::BASE_URL_LOCAL?>index.php">
            Appleseed Collective
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>aboutus.php">About</a></li>
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>events.php">Events</a></li>
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>contact.php">Contact Us</a></li>
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>volunteer.php">Volunteer</a></li>
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>staff.php">Staff</a></li>
            <li><a href="<?php echo Helpers::BASE_URL_LOCAL?>plantowner-farmer.php">Plant Owners/Farmers</a></li>
            <?php
                if(isset($id)){
                    echo "<li><div class='dropdown'>
                    <button class='btn btn-default dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='true'>
                    $token
                    <span class='caret'></span>
                    </button>
                    <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu1'>
                      <li role='presentation'><a role='menuitem' tabindex='-1' href='" .Helpers::BASE_URL_LOCAL. "settings.php?id=$id'>Settings</a></li>
                      <li role='presentation'><a role='menuitem' tabindex='-1' href='" .Helpers::BASE_URL_LOCAL. "account.php?id=$id'>Account</a></li>
                      <li role='presentation'><a role='menuitem' tabindex='-1' href='" .Helpers::BASE_URL_LOCAL. "feedback.php'>Feedback</a></li>
                      <li id='logout-button' role='presentation'><a role='menuitem' tabindex='-1' href=''>Logout</a></li>
                    </ul>
                    </div>
                    </li>";
                  }
                else
                    echo "<li id=\"login-button\"><a href=\"#\">Login</a></li>";
                    // echo "<li><button id=\"login-button\">Login</button></li>";
            ?>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!-- Modal login window -->
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
                    <div id="login-error" hidden></div>
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

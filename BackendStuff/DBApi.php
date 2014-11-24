<?php
$username = "appleseed";
$password = "";
$hostname = "localhost"; 
$databaseName = "appleseed_collective";

//connect to database using mysqli which is requried for prepared statement
function mysqliConnect($hostname, $username, $password,$databaseName){
    $dbhandle  = mysqli_connect($hostname, $username, $password, $databaseName)
        or die("Unable to connect to MySQL");
    return $dbhandle;   //else return dbhanle
}
//close connection to database using mysqlLI
function closeMysqliDb($dbhandle)
{
    mysqli_close($dbhandle);
}


function doesEmailExist($email){
    return false;
}

function insertUser($userArray){
    $dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

        echo "Error on connecting to db.";
    }
    else{

        //echo "Succeed.";
        //do database operations
        $sql="";

        closeMysqliDb($dbhandle);
        return $userId;
    }
    
}


function getUserFromDB($userId){
    print($userId."\n");
    $userArray = array("hello"=>"world");
    
    return $userArray; 
}

?>

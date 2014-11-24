<?php

function connect(){
    return "";
}

function close($dbConn){
    return "";
}

function doesEmailExist($email){
    return false;
}

function insertUserIntoDB($userArray){
    $dbConn = connect();
    print("Inserting user into DB\n");
    $userId = 5;
    close($dbConn);
    return $userId;
}

function getUserFromDB($userId){
    print($userId."\n");
    $userArray = array("hello"=>"world");
    
    return $userArray; 
}

?>

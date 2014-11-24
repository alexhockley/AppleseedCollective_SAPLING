<?php
include 'verifyUserInfo.php';
include 'DBApi.php';

function getUser($userId){
    $userArray = getUserFromDB($userId);
    return $userArray;
}

function getUsers($limit,$offset){
    
}

function updateUser($userArray){
    
}

function deleteUser($userId){
    
}

function addUser($userArray){
    $errors = verifyUserInfo($userArray);//Function in verifyUserInfo.php
    
    if(!(empty($errors))){
        $responseBody = array("message"=>"Incorrect data","errors"=>$errors);
        return $responseBody;
    }else{
        $userId = insertUserIntoDB($userArray);//Function in DBApi.php
        $reponseBody = getUser($userId);
        return $reponseBody;
    }
} 


?>

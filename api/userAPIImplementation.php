<?php
/******************************************************************************
 * FILE NAME: userAPIImplementation.php
 * PURPOSE: Function implementations for userAPI.php
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Thursay November 20, 2014
 * CONTACT: 
 * NOTES: 
 * UPDATED BY: Przemyslaw Gawron
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/

include 'userAPI.php';
include 'verifyUserInfo.php';
include 'userDatabaseAPIImplementation.php';
/*
 * To do:
 * -- Fix the default values for each field -- Set to default if not provided?
 * -- Fix the date format
 * 
 */

/*****************************************************************************
 * Note: Description in userAPI.php
 *****************************************************************************/
function logIn($email,$passwordHash){
    if(verifyLogInCredentials($email, $passwordHash)){
        $userArray = getUser(getUserID($email));
        $responseBody = $userArray;
        $responseBody['token'] = getUserID($email);
        return $responseBody;
    }else{
        return $reponseBody = array("message"=>"Invalid email or password");
    }
}

/*****************************************************************************
 * Note: Description in userAPI.php
 *****************************************************************************/
function getUser($userId){
    if(doesUserExistWithID($userId)){
        $userArray = array("users"=>getUserFromDB($userId));
        unset($userArray["users"]["passwordHash"]);
        unset($userArray["users"]["deleted"]);
    
        for($i = 0; $i < count($userArray["users"]['locations']); $i++){
            unset($userArray["users"]['locations'][$i]['userId']);
            unset($userArray["users"]['locations'][$i]['type']);
            unset($userArray["users"]['locations'][$i]['deleted']);
        
        }
    return $userArray;
    }else{
        return $reponseBody = array("message"=>"User not found");
    }
}

/*****************************************************************************
 * Note: Description in userAPI.php
 *****************************************************************************/
function updateUser($userArrayWithUpdates){
    if(doesUserExistWithID($userArrayWithUpdates["user"]["id"])){
        foreach ($userArrayWithUpdates["user"] as $key => $value) {
            if(!($key=="id")){
                updateUserInDB($userArrayWithUpdates["user"]["id"] , $key, $value);
            }
        }
        return getUser($userArrayWithUpdates["user"]["id"]);
    }else{
        return $reponseBody = array("message"=>"User not found");
    }
}

/*****************************************************************************
 * Note: Description in userAPI.php
 *****************************************************************************/
function deleteUser($userID){
    if(doesUserExistWithID($userID)){
        deleteUserFromDB($userID);
        return $responseBody = array("message"=>"User deleted");
    }else{
        return $reponseBody = array("message"=>"User not found");
    }
}

/*****************************************************************************
 * Note: Description in userAPI.php
 *****************************************************************************/
function createUser($userArray){
    $errors = verifyUserInfo($userArray);

    if(!(empty($errors))){
        $responseBody = array("message"=>"Incorrect data","errors"=>$errors);
        return $responseBody;
    }else{
        $userId = insertUserIntoDB($userArray);
        $reponseBody = getUser($userId);
        return $reponseBody;
    }
}


?>

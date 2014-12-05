<?php
/******************************************************************************
 * FILE NAME: apiHandler.php
 * PURPOSE: Handles all the restful requests for Appleseed Collective
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

include './api/userAPIImplementation.php';

session_start();

$requestUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$getUserPattern = '/^\/user\/[0-9]+$/';

/*****************************************************************************
 * Function Name: JSONResponse
 * Purpose: 
 * Parameters: $arrayToEncode - Array that is going to be json encoded
 *             $statusCode - A int containing the status code that should be returned
 * Returns: Json - A json encoded array with the appropriate status code and header
 *****************************************************************************/
function JSONReponse($arrayToEncode, $statusCode){
    header('Content-Type: application/json');
    $responseBody = json_encode($arrayToEncode);
    http_response_code($statusCode);
    echo($responseBody);
}
    
/*****************************************************************************
 * Function Name: authenticate
 * Purpose: Authenticates the user's credentials and sets a session variable
 * Parameters: $email - A string containing the email of the user
 *             $passwordHash - A string containing the hashed password
 * Returns: Nothing
 *****************************************************************************/
function authenticate($email, $passwordHash){ 
    $responseBody = logIn($email,$passwordHash);
    if(isset($responseBody['message'])){
        JSONReponse($responseBody, 403);
    }else if(isset($responseBody['users'])){
//        $_SESSION["AppleSeed token"] = $responseBody['token'];
//        $_SESSION['token'] = $responseBody['token'];
        $_SESSION['token'] = $responseBody['users']['email'];
        $_SESSION['user_id'] = $responseBody['token']['id'];
        JSONReponse($responseBody, 200);
    }
}

//The following if and if else statements determine which methods to call for a given url
if($requestMethod == "GET"){ 
    if(preg_match($getUserPattern,$requestUrl,$match)){
        $userID = substr($requestUrl,6);
        JSONReponse(getUser($userID), 200);
    }else if($requestUrl = "/events"){
        JSONResponse(array("message"=>"Not implemented"),401);
    }
    
}else if($requestMethod == "PUT"){
        
    
}else if($requestMethod == "POST"){
    if($requestUrl == "/users/authenticate"){
        authenticate($_POST['email'],$_POST['passwordHash']);
    }else if($requestUrl == "/users"){
        $responseBody = createUser($_POST);
        if(isset($responseBody['message'])){
            JSONReponse($responseBody, 400);
        }else if(isset($responseBody['users'])){
            JSONReponse($responseBody, 201);
        }    
    }else if($requestUrl == "/users/current/logout"){
        session_unset();
    }
}else if($requestMethod == "DELETE"){
        
        
}else{
    echo 'Error: Invalid rest verb';
        
}
    
    
?>

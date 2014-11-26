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

include 'userAPIImplementation.php';

session_start();

$requestUrl = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

function JSONReponse($arrayToEncode, $statusCode){
    header('Content-Type: application/json');
    $responseBody = json_encode($arrayToEncode);
    http_response_code($statusCode);
    echo($responseBody);
}
    
function authenticate($email, $passwordHash){ 
    $responseBody = logIn($email,$passwordHash);
    if(isset($responseBody['message'])){
        JSONReponse($responseBody, 403);
    }else if(isset($responseBody['users'])){
        $_SESSION["AppleSeed token"] = $responseBody['token'];
        JSONReponse($responseBody, 200);
    }
}

if($requestMethod == "GET"){
        
    
}else if($requestMethod == "PUT"){
        
    
}else if($requestMethod == "POST"){
    if($requestUrl == "/users/authenticate"){
        authenticate($_POST['email'],$_POST['pass']);
    }else if($requestUrl == "/users"){
        $responseBody = createUser($_POST);
        if(isset($responseBody['message'])){
            JSONReponse($responseBody, 400);
        }else if(isset($responseBody['users'])){
            JSONReponse($responseBody, 201);
        }    
    }
}else if($requestMethod == "DELETE"){
        
        
}else{
    echo 'Error: Invalid rest verb';
        
}
    
    
?>

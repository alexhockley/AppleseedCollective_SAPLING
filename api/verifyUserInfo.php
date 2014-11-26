<?php
//Correct to assume that the specific keys will be included in the json?

function verifyFirstName($firstName){
    if($firstName == "" || !(isset($firstName))){
        return "First name not included";
    }else{
        return "";
    }
}

function verifyLastName($lastName){
    if($lastName == "" || !(isset($lastName))){
        return "Last name not included";
    }else{
        return "";
    }
}
//Check if unique
function verifyEmail($email){
    if($email == "" || !(isset($email))){
        return "Email not included";
    }else if(doesUserExist($email)){
        return "Email already exists";
    }else{
        return "";
    }
}

function verifyRoles($rolesArray){
    $listOfRoles = array("Staff","Normal"); //Add other roles if needed
    
    if(count($rolesArray) == 0 || !(isset($rolesArray))){
        return "Roles not included";
    }
    
    for($i = 0; $i < count($rolesArray); $i++){
        if($rolesArray[$i] == ""){
            return "A role was empty";
        }else if(!(in_array($rolesArray[$i],$listOfRoles))){
            return $rolesArray[$i]." is an undefined role";
        }
    }
    return "";
}

function countPhoneNumberDigits($phoneNumber){
    return(strlen((string)$phoneNumber));
}

// number can't be larger than 16? and less than 7?
function verifyPhoneNumber($phoneNumber){
    $maxLength = 10;
    $minLength = 10;
    $phoneNumberLength = countPhoneNumberDigits($phoneNumber);
    
    if(!(isset($phoneNumber))){
        return "";
    }if($phoneNumber == ""){
        return "";
    }else if($phoneNumberLength < $minLength){
        return "Phone number is too small";
    }else if($phoneNumberLength > $maxLength){
        return "Phone number is too large";
    }else{
        return "";
    }
}
//    !(isset($userNotes))
//Talk to group about this
function verifyLocations($locationsArray){
//    print_r($locationsArray);

    if(count($locationsArray) == 0){
        return "";
    }
    
    return "";
}

function verifyUserNotes($userNotes){
    if(!(isset($userNotes))){
        return "User notes cannot be undefined. Default is \"\"";
    }else{
        return "";
    }
}

function verifyCompany($company){
    if(!(isset($company))){
        return "Company cannot be undefined. Default is \"\"";
    }else{
        return "";
    }
}

function verifyEmailEnabled($emailEnabled){
    if($emailEnabled === false || $emailEnabled === true || $emailEnabled === "false" || $emailEnabled === "true"){
        return "";
    }else{
        return "Email enabled needs to be true or false";
    }
}

function verifyPassword($password){
    if($password == "" || !(isset($password))){
        return "Password not included";
    }else{
        return "";
    }
}

function verifyUserInfo($userArray){
    $returnErrorsToCaller = array();
    $errors = array();
    array_push($errors, verifyFirstName($userArray["user"]["firstname"]));
    array_push($errors,  verifyLastName($userArray["user"]["lastname"]));
    array_push($errors, verifyEmail($userArray["user"]["email"]));
    array_push($errors, verifyRoles($userArray["user"]["roles"]));
    array_push($errors, verifyPhoneNumber($userArray["user"]["phone"]));
    array_push($errors, verifyLocations($userArray["user"]["locations"]));
    array_push($errors, verifyUserNotes($userArray["user"]["userNotes"]));
    array_push($errors, verifyCompany($userArray["user"]["company"]));
    array_push($errors, verifyEmailEnabled($userArray["user"]["emailEnabled"]));
    array_push($errors, verifyPassword($userArray["user"]["passwordHash"]));
    
    for($i = 0; $i < count($errors); $i++){
        if($errors[$i] != ""){
            array_push($returnErrorsToCaller, $errors[$i]);
        }
    }
    return $returnErrorsToCaller;
}
?>

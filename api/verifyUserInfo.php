<?php
/******************************************************************************
 * FILE NAME: verifyUserInfo.php
 * PURPOSE: Contains function for verifying input data
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Tuesday November 25, 2014
 * CONTACT: 
 * NOTES: 
 * UPDATED BY: Przemyslaw Gawron,Jinhai Wang
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/

/*****************************************************************************
 * Function Name: verifyFirstName
 * Purpose: verify first name
 * Parameters: $firstName - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyFirstName($firstName){
    if($firstName == "" || !(isset($firstName))){
        return "First name not included";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyLastName
 * Purpose: verify last name
 * Parameters: $lastName - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyLastName($lastName){
    if($lastName == "" || !(isset($lastName))){
        return "Last name not included";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyEmail
 * Purpose: check if email is unique
 * Parameters: $email - string
 *            
 * Returns:  nothing or an error messages
 *****************************************************************************/
function verifyEmail($email){
    if($email == "" || !(isset($email))){
        return "Email not included";
    }else if(doesUserExist($email)){
        return "Email already exists";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyRoles
 * Purpose: check if $roles empty
 * Parameters: $rolesArray - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
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

/*****************************************************************************
 * Function Name: countPhoneNumberDigits
 * Purpose: count number of digits
 * Parameters: $rolesArray - string
 *            
 * Returns: length of digits
 *****************************************************************************/
function countPhoneNumberDigits($phoneNumber){
    return(strlen((string)$phoneNumber));
}


/*****************************************************************************
 * Function Name: verifyPhoneNumber
 * Purpose: verify if phone number is valid
 * Parameters: $phoneNumber - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
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

/*****************************************************************************
 * Function Name: verifyLocations
 * Purpose: verify if location is not empty
 * Parameters: $locationsArray - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyLocations($locationsArray){

    if(count($locationsArray) == 0){
        return "Location can't be empty.";
    }
    
    return "";
}

/*****************************************************************************
 * Function Name: verifyUserNotes
 * Purpose: verify if location is defined
 * Parameters: $userNotes - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyUserNotes($userNotes){
    if(!(isset($userNotes))){
        return "User notes cannot be undefined. Default is \"\"";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyCompany
 * Purpose: verify if company is defined
 * Parameters: $company - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyCompany($company){
    if(!(isset($company))){
        return "Company cannot be undefined. Default is \"\"";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyEmailEnabled
 * Purpose: verify if email notification option is set
 * Parameters: $emailEnabled - boolean
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyEmailEnabled($emailEnabled){
    if($emailEnabled === false || $emailEnabled === true || $emailEnabled === "false" || $emailEnabled === "true"){
        return "";
    }else{
        return "Email enabled needs to be true or false";
    }
}

/*****************************************************************************
 * Function Name: verifyPassword
 * Purpose: verify if password not empty or null
 * Parameters: $password - string
 *            
 * Returns: nothing or an error messages
 *****************************************************************************/
function verifyPassword($password){
    if($password == "" || !(isset($password))){
        return "Password not included";
    }else{
        return "";
    }
}

/*****************************************************************************
 * Function Name: verifyUserInfo
 * Purpose: verify if user input data for creating user or updating user is valid
 * Parameters: $userArray - array
 *            
 * Returns: nothing or set of  error messages indicating errors
 *****************************************************************************/
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

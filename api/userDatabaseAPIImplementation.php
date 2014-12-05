<?php
/******************************************************************************
 * FILE NAME: userDatabaseAPIHelperFunctions.php
 * PURPOSE: Function implementation for userDatabaseAPI.php
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Thursay November 20, 2014
 * CONTACT: 
 * NOTES: The database schema for these functions is in createTables.php
 * UPDATED BY: Przemyslaw Gawron
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/

include 'userDatabaseAPI.php';

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function connectToDB(){
    $username = "";
    $password = "";
    $connection = new PDO('mysql:host=127.0.0.1;dbname=appleseed_collective', $username, $password);
    return $connection;
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function closeConnection($connection){
    $connection = null;
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function doesUserExist($email){
    $db = connectToDB();
    
    $query = 'SELECT id FROM users WHERE email=:email AND deleted=0';
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    if($stmt->fetchAll(PDO::FETCH_ASSOC)){
        closeConnection($db);
        return true; //User exists
    }else{
        closeConnection($db);
        return false; //User doesn't exist
    }
}

/*****************************************************************************
 * Function Name: insertUserIntoUsersTable
 * Purpose: Inserts a user into the users table
 * Parameters: $userArray - Array containing predefined keys
 * Returns: Nothing
 *****************************************************************************/
function insertUserIntoUsersTable($userArray){
    $db = connectToDB();
    date_default_timezone_set('America/Toronto'); //Organization is based in Guelph Ontario, Canada 
    $date = date("Y-m-d\TH:i:s.0Z"); // ISO8601 format
    
    $query = 'INSERT INTO users(firstname,lastname,email,passwordHash,phone,userNotes,company,emailEnabled,emailVerified,created,deleted) VALUES(:firstname, :lastname, :email, :passwordHash, :phone, :userNotes, :company, :emailEnabled, :emailVerified, :created, :deleted)';
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(':firstname', $userArray["user"]["firstname"]);
    $stmt->bindValue(':lastname', $userArray["user"]["lastname"]);
    $stmt->bindValue(':email', $userArray["user"]["email"]);
    $stmt->bindValue(':passwordHash', $userArray["user"]["passwordHash"]);
    $stmt->bindValue(':phone', $userArray["user"]["phone"]);
    $stmt->bindValue(':userNotes', $userArray["user"]["userNotes"]);
    $stmt->bindValue(':company', $userArray["user"]["company"]);
    $stmt->bindValue(':emailEnabled', (int)$userArray["user"]["emailEnabled"]);
    $stmt->bindValue(':emailVerified', (int)false);
    $stmt->bindValue(':created', $date);
    $stmt->bindValue(':deleted', (int)false);
    $stmt->execute();
      
    closeConnection($db);
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function getUserID($email){
    $db = connectToDB();
    
    $query = 'SELECT id FROM users WHERE email=:email';
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
   
    closeConnection($db);
    return $results["id"];
}

/*****************************************************************************
 * Function Name: insertRolesForUserIntoUserRoles
 * Purpose: Insert the user's role(s) in the table userRoles
 * Parameters: $rolesArray - An array containing the role(s) that need to be inserted 
 *             $userID - An int containing the id of the user 
 * Returns: Nothing 
 *****************************************************************************/
function insertRolesForUserIntoUserRoles($rolesArray,$userID){
    $db = connectToDB();
    
    //Insert the id of the role type instead of the role into the userRoles table
    for($i = 0; $i < count($rolesArray); $i++){ 
        //Get the id of the role from the roles table 
        $query = 'SELECT id FROM roles WHERE type=:type';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':type', $rolesArray[$i]);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $query = 'INSERT INTO userRoles(userId, roleId, deleted) VALUES(:userID,:roleID, :deleted)';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userID', $userID);
        $stmt->bindValue(':roleID', $results["id"]);
        $stmt->bindValue(':deleted', (int)false);
        $stmt->execute();
    }
    
    closeConnection($db);
}

/*****************************************************************************
 * Function Name: insertUserLocationsIntoLocation
 * Purpose: Insert the user's location(s) into the table location
 * Parameters: $locationsArray - An array containing the location(s) that need to be inserted 
 *             $userID - An int containing the id of the user 
 *             $type - String containing user or event
 * Returns: Nothing 
 *****************************************************************************/
function insertUserLocationsIntoLocation($locationsArray, $userID, $type){
    $db = connectToDB();
    for($i = 0; $i < count($locationsArray); $i++){
        $query = 'INSERT INTO location(userId, description, address1, address2, city, postal, country, latitude, longitude, type, deleted) VALUES(:userId, :description, :address1, :address2, :city, :postal, :country, :latitude, :longitude, :type, :deleted)';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':userId', $userID);
        $stmt->bindValue(':description', $locationsArray[$i]["description"]);
        $stmt->bindValue(':address1', $locationsArray[$i]["address1"]);
        $stmt->bindValue(':address2', $locationsArray[$i]["address2"]);
        $stmt->bindValue(':city', $locationsArray[$i]["city"]);
        $stmt->bindValue(':postal', $locationsArray[$i]["postal"]);
        $stmt->bindValue(':country', $locationsArray[$i]["country"]);
        $stmt->bindValue(':latitude', $locationsArray[$i]["latitude"]);
        $stmt->bindValue(':longitude', $locationsArray[$i]["longitude"]);
        $stmt->bindValue(':type', $type);
        $stmt->bindValue(':deleted', (int)false);
        $stmt->execute();
    }
    
    closeConnection($db);
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function insertUserIntoDB($userArray){
    insertUserIntoUsersTable($userArray);
    
    $userID = getUserID($userArray["user"]["email"]);
    insertRolesForUserIntoUserRoles($userArray["user"]["roles"],$userID);
    insertUserLocationsIntoLocation($userArray["user"]["locations"],$userID,"user");
    return $userID;
}

/*****************************************************************************
 * Function Name: getUserInfoFromUsers
 * Purpose: Retrieves a user row from the table users 
 * Parameters: $userID - An int containing the user id 
 * Returns: array - An array contanining the row that was retrieved
 *****************************************************************************/
function getUserInfoFromUsers($userID){
    $db = connectToDB();
    
    $query = 'SELECT * FROM users WHERE id = :userID AND deleted = 0';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    closeConnection($db);
    return $results;
}

/*****************************************************************************
 * Function Name: getUserRolesFromUserRoles
 * Purpose: Retrieves a user's roles from the table userRoles
 * Parameters: $userID - An int containing the user id 
 * Returns: array - An array contanining the row(s) that where retrieved
 *****************************************************************************/
function getUserRolesFromUserRoles($userID){
    $db = connectToDB();
    $results = array();
    
    $query = 'SELECT * FROM userRoles WHERE userId = :userID AND deleted = 0';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    $usersRoles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //Convert the role ids to types and return types instead
    for($i = 0; $i < count($usersRoles); $i++){
        $query = 'SELECT type FROM roles WHERE id = :roleID AND deleted = 0';
        $stmt = $db->prepare($query);
        $stmt->bindValue(':roleID', $usersRoles[$i]["roleId"]);
        $stmt->execute();
        $role =$stmt->fetch(PDO::FETCH_ASSOC);
        array_push($results, $role["type"]);   
    }
    
    closeConnection($db);
    return $results;
}

/*****************************************************************************
 * Function Name: getUserLocationsFromLocation
 * Purpose: Retrieves a user's location(s) from the table location
 * Parameters: $userID - An int containing the user id 
 * Returns: array - An array contanining the row(s) that where retrieved
 *****************************************************************************/
function getUserLocationsFromLocation($userID){
    $db = connectToDB();
    
    $query = 'SELECT * FROM location WHERE userId = :userID AND deleted = 0';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    closeConnection($db);
    return $results;
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function getUserFromDB($userID){
    $userIfoFromUsers = getUserInfoFromUsers($userID);
    $userRolesFromUserRoles = getUserRolesFromUserRoles($userID);
    $userLocationsFromLocation = getUserLocationsFromLocation($userID);
    
    $userArray = $userIfoFromUsers;
    $userArray["emailEnabled"] = (bool)$userArray["emailEnabled"];
    $userArray["emailVerified"] = (bool)$userArray["emailVerified"];
    $userArray['roles'] = $userRolesFromUserRoles;
    $userArray['locations'] = $userLocationsFromLocation;
    return $userArray; 
}

/*****************************************************************************
 * Function Name: updateRolesInUserRoles
 * Purpose: Deletes and updates the role(s) for a user in the userRoles table
 * Parameters: $userID - An int containing the user id 
 *             $rolesArray - An array containing the new role(s) of the user
 * Returns: Nothing
 *****************************************************************************/
function updateRolesInUserRoles($userID,$rolesArray){
    $db = connectToDB();
    
    $query = 'SELECT id FROM users WHERE id=:userID AND deleted=0';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    
    if($stmt->fetchAll(PDO::FETCH_ASSOC)){ //Make sure you aren't updating a deleted user
        deleteRolesFromUserRoles($userID);
        insertRolesForUserIntoUserRoles($rolesArray,$userID);
    } 
    closeConnection($db);
}

/*****************************************************************************
 * Function Name: updateUserInUsers
 * Purpose: Deletes and updates the user information in the table users
 * Parameters: $userID - An int containing the user id 
 *             $columnName - A string containing the column that needs to be updated
 *             $value - The value that the column should be set to 
 * Returns: Nothing
 *****************************************************************************/
function updateUserInUsers($userID, $columnName, $value){
    $db = connectToDB();
    

    if($columnName == "firstname"){
        $query = 'UPDATE users SET firstname=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "lastname"){
        $query = 'UPDATE users SET lastname=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "phone"){
        $query = 'UPDATE users SET phone=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "emailEnabled"){
        $query = 'UPDATE users SET emailEnabled=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "userNotes"){
        $query = 'UPDATE users SET userNotes=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "company"){
        $query = 'UPDATE users SET company=:value WHERE id=:userID AND deleted = 0';
    }else if($columnName == "emailVerified"){
        $query = 'UPDATE users SET emailVerified=:value WHERE id=:userID AND deleted = 0';
    }
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->bindValue(':value', $value);
    $stmt->execute();
    
    closeConnection($db);
    
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function updateUserInDB($userID, $columnName, $value){
    if($columnName == "roles"){
        updateRolesInUserRoles($userID, $value);
    }else{
        updateUserInUsers($userID, $columnName, $value);
    }
}

/*****************************************************************************
 * Function Name: deleteUserFromUsers
 * Purpose: Deletes a user from the users table
 * Parameters: $userID - An int containing the user id 
 * Returns: Nothing
 *****************************************************************************/
function deleteUserFromUsers($userID){
    $db = connectToDB();
    $query = 'UPDATE users SET deleted=1 WHERE id=:userID';
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    closeConnection($db);
}

/*****************************************************************************
 * Function Name: deleteRolesFromUserRoles
 * Purpose: Deletes all the roles for a user in the userRoles table
 * Parameters: $userID - An int containing the user id 
 * Returns: Nothing
 *****************************************************************************/
function deleteRolesFromUserRoles($userID){
    $db = connectToDB();
    $query = 'UPDATE userRoles SET deleted=1 WHERE userId=:userID';
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    closeConnection($db);
}

/*****************************************************************************
 * Function Name: deleteLocationsFromLocation
 * Purpose: Deletes all the locations for a user from the table location
 * Parameters: $userID - An int containing the user id 
 * Returns: Nothing
 *****************************************************************************/
function deleteLocationsFromLocation($userID){
    $db = connectToDB();
    $query = 'UPDATE location SET deleted=1 WHERE id=:userID';
    
    $stmt = $db->prepare($query);
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    closeConnection($db);
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function deleteUserFromDB($userID){
    deleteUserFromUsers($userID);
    deleteRolesFromUserRoles($userID);
    deleteLocationsFromLocation($userID);
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function doesUserExistWithID($userID){
    $db = connectToDB();
    
    $query = 'SELECT id FROM users WHERE id=:userID AND deleted=0';
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(':userID', $userID);
    $stmt->execute();
    
    if($stmt->fetchAll(PDO::FETCH_ASSOC)){
        closeConnection($db);
        return true; //User exists
    }else{
        closeConnection($db);
        return false; //User doesn't exist
    }
}

/*****************************************************************************
 * Note: Description in userDatabaseAPI.php
 *****************************************************************************/
function verifyLogInCredentials($email, $passwordHash){
    $db = connectToDB();
    $query = 'SELECT * FROM users WHERE email=:email AND passwordHash=:passwordHash AND deleted=0';
    $stmt = $db->prepare($query);
    
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':passwordHash', $passwordHash);
    $stmt->execute();
    
    if($stmt->fetchAll(PDO::FETCH_ASSOC)){
        closeConnection($db);
        return true; //valid
    }else{
        closeConnection($db);
        return false; //invalid
    }
}


?>

<?php
/******************************************************************************
 * FILE NAME: userDatabaseAPI.php
 * PURPOSE: Contains all the functions for storing/retrieving user data
 *          from the database for Appleseed Collective
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

/*****************************************************************************
 * Function Name: connectToDB
 * Purpose: Establish the connection to the databse for storing/retrieving data
 * Parameters: None
 * Returns: A reference to the connection
 * Note: - The connection info is set up with CIS*3750 server info
 *       - Uses PDO connection  
 *****************************************************************************/

//function connectToDB(){}

/*****************************************************************************
 * Function Name: closeConnection
 * Purpose: Closes the connection to the database
 * Parameters: $connection - The connection that needs to be closed
 * Returns: Nothing
 *****************************************************************************/

//function closeConnection($connection){}

/*****************************************************************************
 * Function Name: DoesUserExist
 * Purpose: Checks if the user exists in the database
 * Parameters: $email - A string containing the email of the user 
 * Returns: boolean - true if user exists ,false if user doesn't exist
 * Note: The email is the username for each account
 *****************************************************************************/

//function doesUserExist($email){}

/*****************************************************************************
 * Function Name: DoesUserExistWithID
 * Purpose: Checks if the user exists in the database using an ID
 * Parameters: $userId- A int containing the id of the user
 * Returns: boolean - true if user exists ,false if user doesn't exist
 *****************************************************************************/

//function doesUserExistWithID($userID){}


/*****************************************************************************
 * Function Name: getUserID
 * Purpose: Gets the user id for an account
 * Parameters: $email - String containing the email
 * Returns: int - The id of the user 
 *****************************************************************************/

//function getUserID($email){}

/*****************************************************************************
 * Function Name: insertUserIntoDB
 * Purpose: Inserts an entire user record. Takes apart the user record 
 *          and calls the functions that insert each part into tables  
 * Parameters: $userArray - An array containing the account information
 * Returns: int - the user id
 *****************************************************************************/

//function insertUserIntoDB($userArray){}

/*****************************************************************************
 * Function Name: getUserFromDB
 * Purpose: Puts together info from all the tables for one account
 * Parameters: $userID - An int containing the user id 
 * Returns: array - An array contanining the account that was put together
 *****************************************************************************/

//function getUserFromDB($userID){}

/*****************************************************************************
 * Function Name: updateUserInDB
 * Purpose: Calls the update functions for each table
 * Parameters: $userID - An int containing the user id 
 *             $columnName - A string containing the column that needs to be updated
 *             $value - The value that the column should be set to 
 * Returns: Nothing
 *****************************************************************************/

//function updateUserInDB($userID, $columnName, $value){}

/*****************************************************************************
 * Function Name: deleteUserFromDB
 * Purpose: Calls the delete function for each table associated with the user
 * Parameters: $userID - An int containing the user id 
 * Returns: Nothing
 *****************************************************************************/

//function deleteUserFromDB($userID){}

/*****************************************************************************
 * Function Name: verifyLogInCredentials
 * Purpose: To see if the email exists and the password is correct.
 * Parameters: $email - String containing the email
 *             $passwordHash - String containing the password
 * Returns: Bool - true if credentials are valid, false if they are invalid
 *****************************************************************************/

//function verifyLogInCredentials($email, $passwordHash){}

?>

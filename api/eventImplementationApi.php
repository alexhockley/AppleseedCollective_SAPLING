<?php
	
/******************************************************************************
 * FILE NAME: eventsImplementaion.php
 * PURPOSE: Contains the implementaion of events api for Appleseed Collective
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Tuesday November 25, 2014
 * CONTACT: 
 * NOTES: Handles event creation, deletion, retrival , update
 * UPDATED BY: Przemyslaw Gawron,Jinhai Wang
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: not fully implemented due to time constraint
 ******************************************************************************/
	require 'eventInfoVerification.php';
	require 'eventApi.php'
	include 'DBApi.php';
	

/*****************************************************************************
 * Note: create database connection
 *****************************************************************************/
function connectDB(){
	$username = "root";
	$password = "";
	$hostname = "localhost"; 
	$databaseName = "appleseed_collective";
	$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
    
    return $dbhandle;
}

/*****************************************************************************
 * Note: close database connection
 *****************************************************************************/
function closeDBConnection($dbhandle){
    closeMysqliDb($dbhandle);
}


 
/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function insertEvent($eventArray){

		$eventId=0;

		//prevent sql injection
		$tempOwnerId =mysql_real_escape_string( $eventArray['event']['owner']['id']);
		$description = mysql_real_escape_string($eventArray['event']['description']);
		$locationId = mysql_real_escape_string($eventArray['event']['location']['id']);
		$startDateTime = mysql_real_escape_string($eventArray['event']['datetime']);
		$endTime = mysql_real_escape_string($eventArray['event']['endtime']);
		$staffNotes = mysql_real_escape_string($eventArray['event']['staffNotes']);

		//build sql statement
		$sqlStatement = "insert into events (owner_userID, description, locationId,start_time,end_time,
				staff_notes,created,status) values ('".$tempOwnerId."','".$description."','"
				.$locationId."','".$startDateTime."','".$endTime."','".$staffNotes."',now(),'pending');";
		$dbhandle = connectDB();

	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	return mysqli_error($dbhandle);         //return error

	        }

	        //get inserted event id
	        $eventId = mysqli_insert_id($dbhandle);
	        closeDBConnection($dbhandle);
	        
	    }
	    //call utillity function to update tree and attendee table
	    insertTrees($eventArray,$eventId);		
	    insertAttendees($eventArray,$eventId);
		
	}

	//Utility function: insert list of attendee related to the event
	function insertAttendees($eventArray,$eventId){

		$numAttendees=0;
		$numAttendees = count($eventArray['event']['attendees'] );
		if($numAttendees>0){
			//connect to db
			$dbhandle = connectDB();
			$query ="";
		    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

		        return "Error on connecting to db.";
		    }
		    $query = "insert into attendee (eventID,userID) values (?,?);";
			$stmt = mysqli_prepare($dbhandle, $query);
			for($i=0;$i<$numAttendees;$i++){
				if($i==0){
					//first time set up preparestatement and binding parameters
					$userID = $eventArray['event']['attendees'][$i]['id'];
					mysqli_stmt_bind_param($stmt,"ii",$eventId,$userID);
					
					if(!mysqli_stmt_execute($stmt)){
			        	return mysqli_error($dbhandle);  	//return error
			        }
				}
				else
				{
					//update binded value
					$userID = $eventArray['event']['attendees'][$i]['id'];
				    if(!mysqli_stmt_execute($stmt)){
			        	return mysqli_error($dbhandle);  	//return error
			        }
				}
			}
			mysqli_stmt_close($stmt);
			closeDBConnection($dbhandle);
		}
	}

	//utility function: insert list trees that related to event
	function insertTrees($eventArray,$eventId){

		//insert trees table
		$numTrees=0;
		$numTrees = count($eventArray['event']['trees'] );
		if($numTrees>0){

			//connect to db
			$dbhandle = connectDB();
			$query ="";
		    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

		        return "Error on connecting to db.";
		    }
		    $query = "insert into trees (eventID,type,quantity) values (?,?,?);";
			$stmt = mysqli_prepare($dbhandle, $query);

			//insert trees
			for($i=0;$i<$numTrees;$i++){
				if($i==0){
					//first time set up preparestatement and binding parameters
					$treeType = $eventArray['event']['trees'][$i]['type'];
					$treeQuantity = $eventArray['event']['trees'][$i]['quantity'];
					mysqli_stmt_bind_param($stmt,"isi",$eventId,$treeType,$treeQuantity);
					if(!mysqli_stmt_execute($stmt)){
			        	return mysqli_error($dbhandle);  	//return error message
			        }
				}
				else
				{
					//update binded value
					$treeType = $eventArray['event']['trees'][$i]['type'];
					$treeQuantity = $eventArray['event']['trees'][$i]['quantity'];
				    if(!mysqli_stmt_execute($stmt)){
			        	return mysqli_error($dbhandle);  	//echo for testing purpose
			        }
				}
			}
			mysqli_stmt_close($stmt);
			closeDBConnection($dbhandle);
		}

	}
	
	//get list of event from database
	function getListOfEvents($limit = 20, $offset =0, $status){
		
		
	    $sqlStatement ="";   //example: //SELECT * FROM somewhere LIMIT 18446744073709551610 OFFSET 5
		
	    //check if $status value is given
		if(!isset($status)||is_empty($status)){
			//is either null or empty
			$sqlStatement = "select id,owner_userID,description,locationID,start_time,end_time,status,staff_notes created from events limit ".$limit." offset ".$offset.";";
		}
		else{
			$eventStatus = mysql_real_escape_string( $status);
			$sqlStatement = "select id,owner_userID,description,locationID,start_time,end_time,status,staff_notes created from events where status = '".$eventStatus."'  limit ".$limit." offset ".$offset.";";
		}
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        $result = mysqli_query($dbhandle, $sqlStatement) or die(mysqli_error($dbhandle));
	        if(!$result){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }
	        $events = array();
	        while($arr = mysqli_fetch_assoc($result)){
	        	array_push($events,$arr);
	        }
	        closeDBConnection($dbhandle);
	        return $events;
	        
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function getAttendees($eventId){

		
		$sql = "select userID from attendee where eventid =?;";
		$dbhandle = connectDB();
		//$stmt = mysqli_prepare($dbhandle, $sql);
		$userArray = array();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{
	    	if($stmt = mysqli_stmt_prepare($dbhandle,$sql)){

	    		mysqli_stmt_bind_param($stmt,"i",$eventId);
	    		mysqli_stmt_execute($stmt);

	    		$attendeeId = "";
	 
	    		mysqli_stmt_bind_result($stmt,$attendeeId);
	    		while(mysqli_stmt_fetch($stmt)){
	    			$tempArray =getUserFromDB($attendeeId );
	    			array_push($userArray, $tempArray); 
	    		}
	    		mysqli_stmt_close($stmt);
	    		closeDBConnection($dbhandle);
	    		return $userArray;
	    	}
	    }
	    return $userArray;

	}



/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function updateEvent($eventArray){
		
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
	

		//insert data into event table
		$query = "update events set description = ?, locationID = ?, start_time = ?,end_time = ?, status=?,staff_notes = ? where id = ?";
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!($stmt = mysqli_prepare($dbhandle, $query))){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }
	        else{
	        	//update events table with prepared statement
	        	$tempEventId = $eventArray['event']['id'];
	        	$paramDescription = $eventArray['event']['description'];
	        	$paramLocationId = $eventArray['event']['location'];
	        	$paramStart_Time = $eventArray['event']['datetime'];
	        	$paramEnd_time = $eventArray['event']['endtime'];
	        	$paramStatus = $eventArray['event']['status'];
	        	$paramStaff_Notes = $eventArray['event']['staffNotes'];
	        	mysqli_stmt_bind_param($stmt,"sissssi",$paramDescription , $paramLocationId, $paramStart_Time,$paramEnd_time , $paramStatus,$paramStaff_Notes,$tempEventId);
	        	mysqli_stmt_execute($stmt);
	        	mysqli_stmt_close($stmt);
	        }
	        //need to update tree and attendee table too
	        closeDBConnection($dbhandle);
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function updateEventStatus($eventId,$eventStatus){
		
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempStatus = mysql_real_escape_string( $eventStatus);

		//insert data into event table
		$sqlStatement = "update events set status = '".$tempStatus."' where id = ".$tempEventId.";";
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeDBConnection($dbhandle);
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function deleteEvent($eventId){
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);

		//insert data into event table
		$sqlStatement = "delete from events where id = ".$tempEventId.";";
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeDBConnection($dbhandle);
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function attendEvent($eventId,$userId){
	
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempuserId = mysql_real_escape_string( $userId);

		//insert data into event table
		$sqlStatement = "insert into attendee (eventID,userID) values (".$tempEventId.",".$tempuserId.");";
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeDBConnection($dbhandle);
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function notAttendEvent($eventId,$userId){
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempuserId = mysql_real_escape_string( $userId);

		//insert data into event table
		$sqlStatement = "delete from attendee where eventID = ".$tempEventId." and UserId =".$tempuserId.";";
		$dbhandle = connectDB();
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	return mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeDBConnection($dbhandle);
	        
	    }
	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function cancelEvent(){

	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function acceptEvent(){

	}

/*****************************************************************************
 * Note:  Description in eventsApi.php
 *****************************************************************************/
	function rejectEvent(){

	}


?>
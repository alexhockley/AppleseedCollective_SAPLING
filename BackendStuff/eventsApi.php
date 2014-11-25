<?php
	
	require 'eventInfoVerification.php';
	require 'DBApi.php';
	
	//json encode and decode

	//database operation
	// function createEvent($eventArray){
	// 	//need to add error checking
		

	// }
	function insertEvent($eventArray){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		$eventId=0;
		//prevent sql injection
		$tempOwnerId =mysql_real_escape_string( $eventArray['event']['owner']['id']);
		$description = mysql_real_escape_string($eventArray['event']['description']);
		$locationId = mysql_real_escape_string($eventArray['event']['location']['id']);
		$startDateTime = mysql_real_escape_string($eventArray['event']['datetime']);
		$endTime = mysql_real_escape_string($eventArray['event']['endtime']);
		$staffNotes = mysql_real_escape_string($eventArray['event']['staffNotes']);

		//insert data into event table
		$sqlStatement = "insert into events (owner_userID, description, locationId,start_time,end_time,
				staff_notes,created,status) values ('".$tempOwnerId."','".$description."','"
				.$locationId."','".$startDateTime."','".$endTime."','".$staffNotes."',now(),'pending');";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }
	        $eventId = mysqli_insert_id($dbhandle);
	        closeMysqliDb($dbhandle);
	        
	    }
	    //update tree and attendee table
	    insertTrees($eventArray,$eventId);		
	    insertAttendees($eventArray,$eventId);
		
	}

	//insert data to attendee table
	function insertAttendees($eventArray,$eventId){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		$numAttendees=0;
		$numAttendees = count($eventArray['event']['attendees'] );
		if($numAttendees>0){
			//connect to db
			$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
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
			        	echo mysqli_error($dbhandle);  	//echo for testing purpose
			        }
				}
				else
				{
					//update binded value
					$userID = $eventArray['event']['attendees'][$i]['id'];
				    if(!mysqli_stmt_execute($stmt)){
			        	echo mysqli_error($dbhandle);  	//echo for testing purpose
			        }
				}
			}
			mysqli_stmt_close($stmt);
			closeMysqliDb($dbhandle);
		}
	}
	function insertTrees($eventArray,$eventId){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		//insert trees table
		$numTrees=0;
		$numTrees = count($eventArray['event']['trees'] );
		if($numTrees>0){
			//connect to db
			$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
			$query ="";
		    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

		        return "Error on connecting to db.";
		    }
		    $query = "insert into trees (eventID,type,quantity) values (?,?,?);";
			$stmt = mysqli_prepare($dbhandle, $query);
			for($i=0;$i<$numTrees;$i++){
				if($i==0){
					//first time set up preparestatement and binding parameters
					$treeType = $eventArray['event']['trees'][$i]['type'];
					$treeQuantity = $eventArray['event']['trees'][$i]['quantity'];
					mysqli_stmt_bind_param($stmt,"isi",$eventId,$treeType,$treeQuantity);
					if(!mysqli_stmt_execute($stmt)){
			        	echo mysqli_error($dbhandle);  	//echo for testing purpose
			        }
				}
				else
				{
					//update binded value
					$treeType = $eventArray['event']['trees'][$i]['type'];
					$treeQuantity = $eventArray['event']['trees'][$i]['quantity'];
				    if(!mysqli_stmt_execute($stmt)){
			        	echo mysqli_error($dbhandle);  	//echo for testing purpose
			        }
				}
			}
			mysqli_stmt_close($stmt);
			closeMysqliDb($dbhandle);
		}

	}
	

	function getListOfEvents(){

	}

	function getEvent($eventId){
		$username = "root";
	    	$password = "";
		$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		$eventId=0;
		//prevent sql injection
		$tempOwnerId =mysql_real_escape_string( $eventId);
		

		//insert data into event table
		$sqlStatement = "select * from events where id = ".$tempOwnerId.";";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }
	        $eventId = mysqli_insert_id($dbhandle);
	        closeMysqliDb($dbhandle);
	        
	    }
	}

	//
	// function updateEvent($eventArray){
	// 	$username = "root";
	//     $password = "";
	//     $hostname = "localhost"; 
	//     $databaseName = "appleseed_collective";
		
	// 	//prevent sql injection
	// 	$tempEventId =mysql_real_escape_string( $eventId);
	// 	$tempStatus = mysql_real_escape_string( $eventStatus);

	// 	//insert data into event table
	// 	$sqlStatement = "update events set description = '".locationId"',"." status = '".$tempStatus."' where id = ".$tempEventId.";";
	// 	$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	//     if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	//         return "Error on connecting to db.";
	//     }
	//     else{

	//         //echo "Succeed.";
	//         //do database operations
	//         if(!mysqli_query($dbhandle, $sqlStatement)){
	//         	echo mysqli_error($dbhandle);         //echo for testing purpose
	//         }

	//         closeMysqliDb($dbhandle);
	        
	//     }
	// }

	// //update event status 
	function updateEventStatus($eventId,$eventStatus){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
		$databaseName = "appleseed_collective";
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempStatus = mysql_real_escape_string( $eventStatus);

		//insert data into event table
		$sqlStatement = "update events set status = '".$tempStatus."' where id = ".$tempEventId.";";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeMysqliDb($dbhandle);
	        
	    }
	}

	function deleteEvent($eventId){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);

		//insert data into event table
		$sqlStatement = "delete from events where id = ".$tempEventId.";";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeMysqliDb($dbhandle);
	        
	    }
	}

	//event operations for user
	function attendEvent($eventId,$userId){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempuserId = mysql_real_escape_string( $userId);

		//insert data into event table
		$sqlStatement = "insert into attendee (eventID,userID) values (".$tempEventId.",".$tempuserId.");";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeMysqliDb($dbhandle);
	        
	    }
	}

	function notAttendEvent($eventId,$userId){
		$username = "root";
	    	$password = "";
	    	$hostname = "localhost"; 
	    	$databaseName = "appleseed_collective";
		
		//prevent sql injection
		$tempEventId =mysql_real_escape_string( $eventId);
		$tempuserId = mysql_real_escape_string( $userId);

		//insert data into event table
		$sqlStatement = "delete from attendee where eventID = ".$tempEventId." and UserId =".$tempuserId.";";
		$dbhandle = mysqliConnect($hostname, $username, $password,$databaseName);
	    if(mysqli_connect_errno($dbhandle)) {   // check if error occurs

	        return "Error on connecting to db.";
	    }
	    else{

	        //echo "Succeed.";
	        //do database operations
	        if(!mysqli_query($dbhandle, $sqlStatement)){
	        	echo mysqli_error($dbhandle);         //echo for testing purpose
	        }

	        closeMysqliDb($dbhandle);
	        
	    }
	}

	//event operations for staff
	function cancelEvent(){

	}

	function acceptEvent(){

	}

	function rejectEvent(){

	}


?>

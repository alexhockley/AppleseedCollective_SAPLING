<?php

include 'eventsApi.php';
$jsonString = '{ 
    "event": {
        "owner": {
            "id": 6
        },
        "description": "Come pick my 4 apple trees!",
        "location": {
            "id": 8
        },
        "datetime": "2014-11-18T16:20:27.174Z",
        "endtime": "2014-11-21T16:20:27.174Z",
        "trees": [
            {
                "type": "Apple",
                "quantity": 2
            },
            {
                "type": "Pineapple",
                "quantity": 100
            }
        ],
        "attendees": [
            {
                "id": 2
            },
            {
                "id": 3
            }
        ],
        "staffNotes": "shittt json"
    }
}';


$x = array("22",333,"sfs");
print_r($x);
 
print($jsonString);

$userJsonDecoded = json_decode($jsonString,true);
print("--------------------------------------------");

print_r($userJsonDecoded);
print($userJsonDecoded['event']['owner']['id']);
print($userJsonDecoded['event']['description']);
print($userJsonDecoded['event']['location']['id']);
print($userJsonDecoded['event']['datetime']);
print($userJsonDecoded['event']['endtime']);
print($userJsonDecoded['event']['trees'][0]['type']);
print($userJsonDecoded['event']['trees'][0]['quantity']);
foreach($userJsonDecoded['event']['trees'] as $item){
			print($item['type']);
			print ($item['quantity']);
		}
//attendEvent(9,2);
//notAttendEvent(9,6);
//deleteEvent(8);
//updateEventStatus(8,"approved");

//insertEvent($userJsonDecoded)
//$userJsonEncoded = json_encode($userJsonDecoded);
//print("==============================================");

//print($userJsonEncoded);

?>
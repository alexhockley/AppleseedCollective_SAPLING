<?php

include 'userApi.php';

$firstLocation = array(
    "description"=> "Home",
    "address1"=> "41 Old Rd",
    "address2"=> "",
    "city"=> "Guelph",
    "postal"=> "N1G O0O",
    "country"=> "Canada",
    "latitude"=> "43.530766",
    "longitude"=> "-80.229016"
);

//$secondLocation = array(
//    "description"=> "Work",
//    "address1"=> "41 Old Rd",
//    "address2"=> "",
//    "city"=> "Guelph",
//    "postal"=> "N1G O0O",
//    "country"=> "Canada",
//    "latitude"=> "43.530766",
//    "longitude"=> "-80.229016"
//);

$user =array("user"=>array("firstname" => "John",
    "lastname" => "Doe",
    "email" => "john@example.com",
    "roles"=>array("Staff"),
    "phone"=>9052435432,
    "passwordHash"=>"fdc51a338cbd6ecd0cb252ffaef615401e4f5424fda4420769542f1aeaea5dec",
    "locations"=>array($firstLocation),
    "userNotes"=>"TempUser",
    "company"=>"UoG",
    "emailEnabled"=>false
));


$userJsonEncoded = json_encode($user);

//print($userJsonEncoded);

$userJsonDecoded = json_decode($userJsonEncoded,true);

//print_r($userJsonDecoded);
//
//print($userJsonDecoded["user"]["firstname"]);

$return = addUser($userJsonDecoded);

$returnEncoded= json_encode($return);

print($returnEncoded."\n");

?>

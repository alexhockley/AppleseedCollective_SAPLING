<?php
$servername = "127.0.0.1";
$username = "root";
$password = "2929przemek";
$database = "pgawron";

$dbConn = mysql_connect($hostname, $username,$password); 
        
if (!($dbConn)) {
    print("\n");
    die('Failed to connect to database: ' . mysql_error());
}        

$dbSelected = mysql_select_db($database, $dbConn);

if (!$dbSelected) {
    print("\n");
    die ('Can\'t use '.'database'.' : ' . mysql_error());
}

$query = "Select * from test";
$result = mysql_query($query);

while($row = mysql_fetch_row ($result)){
    print_r($row);
    
}

print_r($row);

?>

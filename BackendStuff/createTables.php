<?php
include 'mysqlLoginInfo.php';

$database = 'appleseed_collective';

$dbConn = mysql_connect($servername, $username,$password); 
        
if (!($dbConn)) {
    print("\n");
    die('Failed to connect to database: ' . mysql_error());
}        

$query = "CREATE DATABASE  IF NOT EXISTS `appleseed_collective`";
$result = mysql_query($query);

$dbSelected = mysql_select_db($database, $dbConn);

if (!$dbSelected) {
    print("\n");
    die ('Can\'t use '.'database'.' : ' . mysql_error());
}

$query = "DROP TABLE IF EXISTS users";
$result = mysql_query($query);

$query = "CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `firstname` text NOT NULL,
    `lastname` text NOT NULL,
    `email` text NOT NULL,
    `passwordHash` text NOT NULL,
    `phone` int(11),
    `user_notes` text NOT NULL,
    `company` text NOT NULL,
    `email_enabled` tinyint(1) NOT NULL,
    `email_verified` tinyint(1) NOT NULL,
     PRIMARY KEY (`id`)
    )";

$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS roles";
$result = mysql_query($query);

$query = "CREATE TABLE `roles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` text NOT NULL,
     PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS userRoles";
$result = mysql_query($query);

$query = "CREATE TABLE `userRoles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `roleId` int(10) unsigned NOT NULL,
    FOREIGN KEY (userId) REFERENCES users (id),
    FOREIGN KEY (roleId) REFERENCES roles (id),
    PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);

$query = "DROP TABLES IF EXISTS location";
$result = mysql_query($query);

$query = "CREATE TABLE `location` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `description` text,
    `address1` text NOT NULL,
    `address2` text,
    `city` text NOT NULL,
    `postal` text NOT NULL,
    `country` text NOT NULL,
    `latitude` double,
    `longitude` double,
    `type` text NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (userId) REFERENCES users (id)
    )";
$result = mysql_query($query);
?>

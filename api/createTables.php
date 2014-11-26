<?php

/******************************************************************************
 * FILE NAME: CreateTablse.php
 * PURPOSE: set up or reset database if not exist
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Tuesday November 25, 2014
 * CONTACT: 
 * NOTES: Handles event creation, deletion, retrival , update
 * UPDATED BY: Przemyslaw Gawron,Jinhai Wang
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/

include 'mysqlLoginInfo.php';
$database = 'appleseed_collective';
$dbConn = mysql_connect($servername, $username,$password); 

//check database connection      
if (!($dbConn)) {
    print("\n");
    die('Failed to connect to database: ' . mysql_error());
}        
$query = "SET FOREIGN_KEY_CHECKS=0";
$result = mysql_query($query);

//drop database and set create new one
$query = "CREATE DATABASE  IF NOT EXISTS `appleseed_collective`";
$result = mysql_query($query);
$dbSelected = mysql_select_db($database, $dbConn);
if (!$dbSelected) {
    print("\n");
    die ('Can\'t use '.'database'.' : ' . mysql_error());
}

//create users table
$query = "DROP TABLE IF EXISTS users";
$result = mysql_query($query);
$query = "CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `firstname` text NOT NULL,
    `lastname` text NOT NULL,
    `email` text NOT NULL,
    `passwordHash` text NOT NULL,
    `phone` bigint(12),
    `userNotes` text NOT NULL,
    `company` text NOT NULL,
    `emailEnabled` tinyint(1) NOT NULL,
    `emailVerified` tinyint(1) NOT NULL,
    created TEXT NOT NULL,
    deleted tinyint(1) NOT NULL,
     PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);

//create roles table
$query = "DROP TABLES IF EXISTS roles";
$result = mysql_query($query);
$query = "CREATE TABLE `roles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` text NOT NULL,
    deleted tinyint(1) NOT NULL,
     PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);
$query = "INSERT INTO roles(type,deleted) VALUES('Normal',0)";
$result = mysql_query($query);
$query = "INSERT INTO roles(type,deleted) VALUES('Staff',0)";
$result = mysql_query($query);
$query = "DROP TABLES IF EXISTS userRoles";
$result = mysql_query($query);

//create userRoles table
$query = "CREATE TABLE `userRoles` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `userId` int(10) unsigned NOT NULL,
    `roleId` int(10) unsigned NOT NULL,
    deleted tinyint(1) NOT NULL,
    FOREIGN KEY (userId) REFERENCES users (id),
    FOREIGN KEY (roleId) REFERENCES roles (id),
    PRIMARY KEY (`id`)
    )";
$result = mysql_query($query);

//create location table
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
    deleted tinyint(1) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (userId) REFERENCES users (id)
    )";
$result = mysql_query($query);
$query = "SET FOREIGN_KEY_CHECKS=1";
$result = mysql_query($query);

//create events table
$query = "DROP TABLE IF EXISTS `events`;";
$result = mysql_query($query);
$query = "CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_userID` int(10) unsigned NOT NULL COMMENT 'fk to users table',
  `description` text,
  `locationID` int(10) unsigned NOT NULL COMMENT 'fk to location table',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` text NOT NULL,
  `staff_notes` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_owner_userID_idx` (`owner_userID`),
  KEY `FK_event_location_id_idx` (`locationID`),
  CONSTRAINT `FK_location_owner_userID` FOREIGN KEY (`owner_userID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_event_location_id` FOREIGN KEY (`locationID`) REFERENCES `location` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
);";
$result = mysql_query($query);

//create tree table
$query = "DROP TABLE IF EXISTS `trees`;";
$result = mysql_query($query);
$query = "CREATE TABLE `trees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventID` int(10) unsigned NOT NULL,
  `type` text NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tree_eventID_idx` (`eventID`),
  CONSTRAINT `FK_tree_eventID` FOREIGN KEY (`eventID`) REFERENCES `events` (`id`) ON DELETE cascade ON UPDATE NO ACTION
);";
$result = mysql_query($query);

//create attendee table
$query = "DROP TABLE IF EXISTS `attendee`;";
$result = mysql_query($query);
$query = "CREATE TABLE `attendee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventID` int(10) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_attendee_user_id_idx` (`userID`),
  KEY `FK_attendee_event_id_idx` (`eventID`),
  CONSTRAINT `FK_attendee_event_id` FOREIGN KEY (`eventID`) REFERENCES `events` (`id`) ON DELETE cascade ON UPDATE NO ACTION,
  CONSTRAINT `FK_attendee_user_id` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
);";
$result = mysql_query($query);

//create feedback table
$query = "DROP TABLE IF EXISTS `feedback`;";
$result = mysql_query($query);
$query = "CREATE TABLE `feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `should_be_contacted` tinyint(1) NOT NULL DEFAULT '0',
  `owner_userID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_feedback_ownerID_idx` (`owner_userID`),
  CONSTRAINT `FK_feedback_ownerID` FOREIGN KEY (`owner_userID`) REFERENCES `users` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
);";
$result = mysql_query($query);

?>
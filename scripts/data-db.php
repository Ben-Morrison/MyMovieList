<?php

/*
	Author: Ben Morrison
	Description: Used by PHP pages to handle database queries with a single connection for each page load
	Date Modified: 24 July 2017 
*/

//error_reporting(0);

class Database {
	private static $db;
	private static $connected = false;
	
	// Connects to the database
	public static function createConnection() {
		// Get these values from elsewhere later on
		$dbserver = "localhost";
		$dbuser = "root";
		$dbpassword = "";
		$dbname = "mymovielist_db";
		
		self::$db = new mysqli($dbserver, $dbuser, $dbpassword, $dbname);
		
		if(self::$db->connect_errno) {
			self::error("There was an error connecting to the Database");
		} else {
			self::$connected = true;
		}
	}
	
	// Returns the Database object
	public static function getConnection() {
		if(self::$connected == true) {
			return self::$db;
		} else {
			self::error("Not connected to database");
			return null;
		}
	}
	
	// Returns the affected rows from the last table insert
	public static function getAffectedRows() {
		if(self::$connected == true) {
			return mysqli_affected_rows(self::$db);
		} else {
			self::error("Not connected to database");
			return 0;
		}
	}
	
	// Executes a query on the database
	public static function executeQuery($query) {
		if(self::$connected == true) {
			$result = self::$db->query($query);
			if(!$result) {
				self::error("Query Error");
				return false;
			} else {
				return $result;
			}
		} else {
			self::error("Not connected to database");
			return false;
		}
	}
	
	// Closes the connection
	public static function closeConnection() {
		$close = self::$db->close();
		self::$connected = false;
		
		if($close === false) { self::error("Could not close Database connection"); }
	}
	
	// For handling errors
	public static function error($msg) {
		echo $msg . "<br>";
	}
}
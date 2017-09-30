<?php

/*
	Author: Ben Morrison
	Description: User class for user registration and validation
	Date Modified: 24 July 2017 
*/

require_once 'data-db.php';

class User {
	private $userid;
	private $username;
	private $password;
	private $email;
	private $joindate;
	
	// Adds a user to the Database
	public static function addUser($username, $password, $email) {
		$username = trim($username);
		$password = trim($password);
		$email = trim($email);
		
		date_default_timezone_set('Australia/Sydney');
		$joindate = date('y-m-d', time());
		
		$query = "INSERT INTO User VALUES (NULL, '" . 	$username . "', '" .
														$password . "', '" .
														$email . "', '" .
														$joindate . "');";
																								
		$result = Database::executeQuery($query);
		
		if($result == null or $result == false) {
			return false;
		}
		
		if(Database::getAffectedRows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Checks if the username exists in the database
	public static function userNameExists($username) {
		$username = trim($username);
		
		$query = "SELECT * FROM User WHERE userName = '" . $username . "';";
		$result = Database::executeQuery($query);
		
		if($result == null or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	
	// Checks if the email exists in the database
	public static function emailExists($email) {
		$email = trim($email);
		
		$query = "SELECT * FROM User WHERE email = '" . $email . "';";
		$result = Database::executeQuery($query);
		
		if($result == null or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Validates a username and password
	public static function validateUser($username, $password) {
		$username = trim($username);
		$password = trim($password);
		
		$query = "SELECT * FROM User WHERE username = '" . $username . "' and password = '" . $password . "';";
		$result = Database::executeQuery($query);
		
		if($result == null or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Validates an admin username and password for the admin pages
	public static function validateAdmin($username, $password) {
		$username = trim($username);
		$password = trim($password);
		
		$query = "SELECT * FROM Admin WHERE username = '" . $username . "' and password = '" . $password . "';";
		$result = Database::executeQuery($query);
		
		if($result == null or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function getUser($userid) {
		
	}
	
	public static function getList($userid) {
		
	}
	
	// For the users movie list
	public static function addToList($userid) {
		
	}
	
	public static function removeFromList($userid) {
		
	}
	
	public static function updateListItem($userid) {
		
	}
}

?>
<?php

require_once('object-user.php');
require_once('data-db.php');

class Validate {
	private static $err = '';
	
	// Username
	private static $minUsername = 3;
	private static $maxUsername = 20;
	
	// Email
	private static $minEmail = 3;
	private static $maxEmail = 40;
	
	// Password
	private static $minPassword = 3;
	private static $maxPassword = 20;
	
	// Title
	private static $minTitle = 1;
	private static $maxitle = 255;
		
	// Summary
	private static $minSummary = 0;
	private static $maxSummary = 1000;
	
	// Date		must be date format
	
	// Rating		max 4 dig
	
	// Runtime		max 5 digits
	
	// Score 2 		before decimal, 1 after
	
	// Name
	private static $minName = 3;
	private static $maxName = 40;
	
	// Description
	private static $minDescription = 3;
	private static $maxDescription = 40;
	
	// Errors
	private static function setError($e) {
		self::$err = $e;
	}
	
	// Returns the details of the previous error that occurred
	public static function GetError() {
		return self::$err;
	}
	
	// Filter any input through here to remove SQL injection and any other potential security threats
	public static function Input($v) {
		$v = mysqli_real_escape_string(Database::getConnection(), $v);
		
		return trim($v);
	}
	
	// Users
	public static function Username($username) {
		if($username == '' or $username == NULL) {
			self::setError("Enter a Username");
			return false;
		} else {
			if(strlen($username) < self::$minUsername or strlen($username) > self::$maxUsername) {
				self::setError("username must be between " . self::$minUsername . " and " . self::$maxUsername . " characters");
				return false;
			} else {
				$exists = User::userNameExists($username);
				if($exists) {
					self::setError("Username already in use");
					return false;
				}
			}
		}
		
		self::setError("");
		return true;
	}
	
	public static function Email($email) {
		if($email == '' or $email == NULL) {
			self::setError("Enter an Email Address");
			return false;
		} else {
			if(strlen($email) < self::$minEmail or strlen($email) > self::$maxEmail) {
				self::setError("Email must be between " . self::$minEmail . " and " . self::$maxEmail . " characters");
				return false;
			} else {
				$exists = User::emailExists($email);
				if($exists) {
					self::setError("Email already in use");
					return false;
				}
			}
		}
		
		self::setError("");
		return true;
	}
	
	public static function Password($password) {
		if($password == '' or $password == NULL) {
			self::setError("Enter a password");
			return false;
		} else {
			if(strlen($password) < self::$minPassword or strlen($password) > self::$maxPassword) {
				self::setError("Password must be between " . self::$minPassword . " and " . self::$maxPassword . " characters");
				return false;
			}
		}
		
		self::setError("");
		return true;
	}
	
	// Movies
	public static function Title($v) {
		return true;
	}
	
	public static function Summary($v) {
		return true;
	}
	
	public static function Release($v) {
		return true;
	}
	
	public static function Rating($v) {
		return true;
	}
	
	public static function Runtime($v) {
		return true;
	}
	
	public static function Score($v) {
		return true;
	}
	
	// General
	public static function Name($v) {
		return true;
	}
	
	public static function Description($v) {
		return true;
	}
	
	public static function Date($v) {
		return true;
	}
}

?>
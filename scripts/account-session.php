<?php

	require_once 'object-user.php';
	require_once 'data-db.php';

	$logged_in = false;

	session_start();

	if(isset($_SESSION['username']) and isset($_SESSION['password'])) {
		$logged_in = User::validateUser($_SESSION['username'], $_SESSION['password']);
	}

	if($logged_in == false) {
		$_SESSION = array();

		session_unset();
		session_destroy();
	}

?>

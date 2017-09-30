<center><h1>Login</h1></center>
<div id="userForm">

<?php
	session_start();

	$_SESSION = array();

	session_unset();
	session_destroy();

	$logged_in = false;

	ob_start();
	$url = "../adminindex.php";
	while(ob_get_status()) { ob_end_clean(); }
	header("Location: $url");
?>
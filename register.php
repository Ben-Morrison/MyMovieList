<html>
<head>
	<title>Register</title>
	
	<?php
		/*
			Author: Ben Morrison
			Description: This page is for registering a user to the database
			
				If a user is already logged in, this page will display an error message.
				If a user is not logged in, the register form will be displayed.
				If server request is POST, this page will display the register form with errors if the register was unsuccessful.
				If the register was successful, this page will display a success message and ask the user to log in.
			Date Modified: 24 July 2017 
		*/
	
		require_once 'scripts/template-head.php';
	?>
	
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
	<div id="container">

	<?php
		require_once 'scripts/template-header.php';
	?>

	<div id="main">

		<center><h1>Create Account</h1></center>
		<div id="userForm">

		<?php

		// Used for handling errors: which errors will be displayed and what specific error occurred
		$validusername = true;
		$errusername = '';

		$validemail = true;
		$erremail = '';

		$validpassword = true;
		$errpassword = '';

		$useradded = true;
		$success = true;

		$errother = '';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			require_once('scripts/object-user.php');
			require_once('scripts/data-validation.php');
			
			// Get data from the form
			$username = Validate::Input($_POST['userName']);
			$email = Validate::Input($_POST['email']);
			$password1 = Validate::Input($_POST['password1']);
			$password2 = Validate::Input($_POST['password2']);
			$agree = $_POST['agree']; // 0 or 1
			
			// Username validation
			$validusername = Validate::Username($username);
			if($validusername == false) { $errusername = Validate::GetError(); }
			
			// Email validation
			$validemail = Validate::Email($email);
			if($validemail == false) { $erremail = Validate::GetError(); }
			
			// Password validation
			$validpassword = Validate::Password($password1);
			if($validpassword == false) { $errpassword = Validate::GetError(); }
			else {
				if($password1 != $password2) {
					$validpassword = false;
					$errpassword = "Passwords must match";
				}
			}

			// If all data was validated successfully, add to the database
			if($validusername && $validemail && $validpassword) {
				$useradded = User::addUser($username, $password1, $email);
				$success = $useradded;
			} else {
				$success = false;
			}
			
			if($success) {
				// Display success message and login button
				echo "<div class=\"userFormElements\"><center>User successfully registered.<br><br>You can now login</div>";
				echo "<a href=\"login.php\"><center><div class=\"customButton\">Login</div></center></a>";
			} else {
				// Validation not successful, display the form with error messages
				showSignupForm();
			}
		} else {
			// Not coming from POST, display the form
			showSignupForm();
		}

		function showSignupForm() {
			global $validusername;
			global $errusername;
			global $validemail;
			global $erremail;
			global $validpassword;
			global $errpassword;
			global $useradded;
			
			global $success;
			
			global $logged_in;
		?>
			
				<form name="userCreate" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
				
		<?php
			if(!$logged_in) {
		?>
					<label class="userFormElements" for="userName">Username</label>
					<input class="userFormElements" type="text" name="userName" value="<?php if(isset($_POST['userName'])) { echo trim($_POST['userName']); } ?>">
					<label class="userFormElements" for="email">Email</label>
					<input class="userFormElements" type="text" name="email" value="<?php if(isset($_POST['email'])) { echo trim($_POST['email']); } ?>">
					<label class="userFormElements" for="password1">Password</label>
					<input class="userFormElements" type="password" name="password1">
					<label class="userFormElements" for="password2">Confirm Password</label>
					<input class="userFormElements" type="password" name="password2">
					
					<div class="userFormElements">
						<input type="hidden" name="agree" value="0">
						<input style="float:left;" type="checkbox" name="agree" value="1">
						<div style="margin-left:25px;">
						I have read and agree to the Terms of Service and Privacy Policy
						</div>
					</div>
					
					<input class="userFormElements" type="submit" value="Create Account">
		<?php
					if(!$validusername) {
						echo "<div class=\"userFormError\">* " . $errusername  . "</div>";
					}
					if(!$validemail) {
						echo "<div class=\"userFormError\">* " . $erremail  . "</div>";
					}
					if(!$validpassword) {
						echo "<div class=\"userFormError\">* " . $errpassword  . "</div>";
					}
					if(!$useradded) {
						echo "<div class=\"userFormError\">* There was an error registering user account</div>";
					}
			} else {
				
		?>
					<div class="userFormElements">
						<center>You must log out to access this page</center>
					</div>
		<?php
			}
		?>
				</form>
		<?php
		}
		?>

		</div>

	</div>

	<?php
		require_once 'scripts/template-footer.php';
	?>

	</div>
</body>
</html>
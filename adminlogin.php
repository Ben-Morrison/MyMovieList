<html>
<head>
	<title>Admin Login</title>
	
	<?php
		require_once 'scripts/template-adminhead.php';
	?>
</head>

<body>
	<div id="container">

	<?php
		require_once 'scripts/template-adminheader.php';
	?>

	<div id="main">

		<center><h1>Admin Login</h1></center>
		<div id="userForm">

		<?php
		// username or email
		$validlogin = true;
		$errmessage = '';

		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			require_once('scripts/object-user.php');
			
			// Get data from the form
			$username = trim($_POST['userName']);
			$password = trim($_POST['password']);
			
			// User validation
			$validlogin = User::validateAdmin($username, $password);
			
			if($validlogin) {
				session_start();
				$_SESSION["username"] = $username;
				$_SESSION["password"] = $password;
				
				ob_start();
				$url = "adminindex.php";
				while(ob_get_status()) { ob_end_clean(); }
				header("Location: $url");
			} else {
				$errmessage = "Enter a valid Username and Password";
				showLoginForm();
			}
		} else {
			showLoginForm();
		}

		function showLoginForm() {
			global $validlogin;
			global $errmessage;
			
			global $logged_in;
		?>
				<form name="userLogin" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="post">
		<?php
			if(!$logged_in) {
		?>
					<label class="userFormElements" for="userName">Username or Email</label>
					<input class="userFormElements" type="text" name="userName" value="<?php if(isset($_POST['userName'])) { echo trim($_POST['userName']); } ?>">
					<label class="userFormElements" for="password">Password</label>
					<input class="userFormElements" type="password" name="password">
					
					<input class="userFormElements" type="submit" value="Login">	
		<?php
				if(!$validlogin) {
					echo "<div class=\"userFormError\">* " . $errmessage  . "</div>";
				}	
			} else {
		?>
				<div class="userFormElements">
					<center>You have already logged in</center>
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
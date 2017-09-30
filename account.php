<html>
<head>
	<title>Account</title>
	
	<?php
		require_once 'scripts/template-head.php';
	?>
</head>

<link rel="stylesheet" type="text/css" href="styles/style.css">

<body>
	<div id="container">

	<?php
		require_once 'scripts/template-header.php';
	?>

	<div id="main">

		<?php
			
			if($logged_in) {
				echo "<h1>";
				echo $_SESSION['username'];
				echo "<br>";
				echo $_SESSION['password'];
				echo "</h1>";
			} else {
				echo "<h1><center>Account</center></h1>";
				
				echo "<center><a href=\"login.php\"><div class=\"customButton\">Login</div></a></center>";
				echo "<center><a href=\"register.php\"><div class=\"customButton\">Register</div></a></center>";
			}
			
		?>

	</div>

	<?php
		require_once 'scripts/template-footer.php';
	?>

	</div>
</body>
</html>
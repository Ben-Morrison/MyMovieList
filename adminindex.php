<html>
<head>
	<title>Admin Home</title>
	
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
	
		<?php
			if($logged_in) {
				echo "Logged in as Admin";
				echo "<br>";
				?>
					<br><a href="adminmovies.php">Movies</a>
					<br><a href="adminpeople.php">People</a>
					<br><a href="adminusers.php">Users</a>
				<?php
			} else {
				echo "Admin not logged in";
			}
		?>

	</div>

	<?php
		require_once 'scripts/template-footer.php';
	?>

	</div>
</body>
</html>
<html>
<head>
	<title>Admin People</title>
	
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
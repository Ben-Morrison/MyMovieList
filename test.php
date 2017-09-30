<html>
<head>
	<title>Movies</title>
	
	<?php require_once 'scripts/template-head.php'; ?>
</head>
<body>
	<div id="container">

	<?php require_once 'scripts/template-header.php'; ?>

	<div id="main">
		<?php
		if($logged_in) {
			echo "<center><h1>LOGGED IN</h1></center>";
		} else {
			echo "<center><h1>NOT LOGGED IN</h1></center>";
		}
		?>
	</div>

	<?php
		require_once 'scripts/template-footer.php';
	?>
	</div>
</body>
</html>
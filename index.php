<html>
<head>
	<title>Homepage</title>
	
	<?php
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
			<div class="wide">
				
				<center><div id="stepContainer">
					<div class="step" style="background-color: green">Create an Account</div>
					<div class="step" style="background-color: blue">Add Movies to your List</div>
					<div class="step" style="background-color: purple">Review and Share</div>
					<div class="floatDivider"></div>
				</div></center>
				
				<div class="wideContainer">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</div>
			
			<hr>
			
			<div class="left">
				<div class="leftContainer">
					<h1>Top Rated</h1>
					<?php
					require_once ('scripts/object-movie.php');
					$movies = Movie::getTopRated(10);
					
					if(!$movies) {
						echo "Error";
					} else {
						for($i = 0; $i < count($movies); $i++) {
							Movie::displayMovieLine($movies[$i]);
						}
					}
					?>
					
					
				</div>
				<hr>
				<div class="leftContainer">
					<h1>Recent Reviews</h1>
				</div>
				
				<div class="floatDivider"></div>	
			</div>
			
			<div class="right">
					<div class="ad"></div>
					<div class="rightContainer">
						Test
					</div>
					
					<hr>
					
					<div class="rightContainer">
						Test
					</div>
			</div>
			
			<div class="floatDivider"></div>			
		</div>
		
		<?php
			require_once 'scripts/template-footer.php';
		?>
	</div>
</body>
</html>
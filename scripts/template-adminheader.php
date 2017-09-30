<div id="header-background">
	<div id="header-top">
		<div id="logo">
			MyMovieList
		</div>
		
		<div id="account">
			<?php
			if($logged_in == true) {
				echo $_SESSION['username'];
				?>
				<a href="scripts/account-adminlogout.php"><div class="accountButton">Logout</div></a>
				<?php
			} else {
				?>
				<a href="adminlogin.php"><div class="accountButton">Login</div></a>
				<?php
			}
			?>
		</div>
	</div>
	
	<div id="header-bottom">
		<a href="adminindex.php">
			<div class="navigation">Home</div>
		</a>
		<a href="adminmovies.php">
			<div class="navigation">Movies</div>
		</a>
	</div>
</div>
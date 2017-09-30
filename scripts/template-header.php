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
				<a href="scripts/account-logout.php"><div class="accountButton">Logout</div></a>
				<?php
			} else {
				?>
				<a href="register.php"><div class="accountButton">Signup</div></a>
				<a href="login.php"><div class="accountButton">Login</div></a>
				<?php
			}
			?>
		</div>
	</div>
	
	<div id="header-bottom">
		<a href="index.php">
			<div class="navigation">Home</div>
		</a>
		<a href="movies.php">
			<div class="navigation">Movies</div>
		</a>
		<a href="">
			<div class="navigation">People</div>
		</a>
		<a href="">
			<div class="navigation">Reviews</div>
		</a>
		<a href="">
			<div class="navigation">News</div>
		</a>
	</div>
</div>
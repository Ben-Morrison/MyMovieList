<html>
<head>
	<title>Movies</title>
	
	<?php
		/*
			Author: Ben Morrison
			Description: This page is for displaying all details of a movie or displaying the search page or search results, depending on GET values
			
				If the GET value id is available, this page searches the database for that movie id, and if successful, displays all data for that movie
				
				If the GET value search is available, this page looks for the GET values: title, genre and year then performs and advanced search, then displays the results
				
				If none of these values are available, this page displays the search functions and lists of all the movies in the database
				
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
		
				<?php
				require_once('scripts/object-movie.php');
			
				if(isset($_GET['id'])) {
					// Search for a movie with the given id
					$movie = Movie::getMovieByID($_GET['id']);
					
					// If the movie is found
					if($movie != false) {
						?>
							<div class="wide">
								<div class="wideContainer">
								<div id="movieHeader">
									<img style="float: left; width: 182px; height: 268px;"src="images/posters/<?php echo $movie->getMovieID(); ?>.jpg">
									
									<div id="movieHeaderInfo">
										<h1><?php echo $movie->getTitle() . 
										"&nbsp<span style=\"color: #898989;\">(" . substr($movie->getReleasedate(), 0, 4) . ")<span>" ?></h1>
										
										<?php 
										// Get a list of genres for this movie, create links for searching by genre
										$genres = Movie::getGenres($movie->getMovieID());
										$s = "";
										for($i = 0; $i < count($genres); $i++) {
											$s = $s . "<a href=\"movies.php?search&genre=" . $genres[$i][0] . "\">" . $genres[$i][1] . "</a>";
											
											if($i != count($genres) - 1) {
												$s = $s . ", ";
											}											
										}
										echo $s;
										
										// Display the movie summary
										$summary = $movie->getSummary();
										echo "<br><br>" . $summary;
										
										// Display the movies director(s)
										$directors = Movie::getDirectors($movie->getMovieID());
										$s = "";
										for($i = 0; $i < count($directors); $i++) {
											$s = $s . $directors[$i][1] . " " . $directors[$i][2];
											if($i != count($directors) - 1) {
												$s = $s . ", ";
											}
										}
										echo "<br><br>Directed By: " . $s;

										
										?>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="left">
						<h1>Cast</h1>
						<?php
						// Display the movies cast
						$actors = Movie::getActors($movie->getMovieID());
						for($i = 0; $i < count($actors); $i++) {
							$s = "";
							$s = $actors[$i][1] . " " . $actors[$i][2];
							echo "<span style=\"color: white;\">" . $s . "</span><br>";
							echo $actors[$i][3] . "<br><br>";
							
							// TODO: Create a hyperlink for each cast member
						}
						?>
						<hr>
						<h1>Reviews</h1>
							<?php 
								// Display reviews for this movie here
							?>
						</div>
						<div class="right">
							<div class="ad"></div>
						</div>
						
						<?php
					} else {
						?>
						<div class="wide">
								<div class="wideContainer">
									<?php echo "Sorry, that movie does not exist in the database"; ?>
							</div>
						</div>
						<?php
					}
				} else {
					if(isset($_GET['search'])) {
						$title = null;
						if(isset($_GET['title'])) {
							$title = $_GET['title'];
						}
						
						// Implement this to support multiple genres with checkboxes
						// Do this by using GET to send an array to the server
						$genreid = null;
						$genre = null;
						if(isset($_GET['genre'])) {
							$genreid = $_GET['genre'];
							$genre = Movie::getGenre($genreid);
							if($genre == null) { $genreid = null; }
						}
						
						$year = null;
						if(isset($_GET['year'])) {
							$year = $_GET['year'];
						}
						?>
						<div class="wide">
							<div class="wideContainer">
								<h1>Movies</h1>
								<?php
								// Display search criteria here
								$s = "";
								if($title != null) { echo "Title: " . $title; }
								if($genre != null) { echo "Genre: " . $genre; }
								if($year != null) { echo "Year: " . $year; }
								?>
							</div>
						</div>
						<div class="wide">
							<div class="wideContainer">
								<?php
								$movies = Movie::advancedSearch($title, $year, $genreid);
								if($movies != null) {
									for($i = 0; $i < count($movies); $i++) {
										Movie::displayMovieSmall($movies[$i]);
									}
								} else {
									echo "No movie found";
								}
								?>
							</div>
						</div>
						<?php
					} else {
						?>
					<div class="wide">
						<div class="wideContainer">
							<h1>Movies</h1>
						</div>
					</div>
					<hr>
					<div class="wide">
						<div class="wideContainer">
							<h2>Search</h2>
							<h3>Title</h3><br>
								<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
									<input type="hidden" name="search" value="">
									<input style="width: 300px; float: left;" type="text" name="title">
									<input class="userFormElements" style="width: 100px; float: left; margin-top: 0px; margin-left: 8px; width: 80px; height: 23px;" type="submit" value="Search">
									<div class="floatDivider"></div>
								</form>
							<h3>Genres</h3><br>
							<?php
								$genres = Movie::getAllGenres();
								
								for($i = 0; $i < count($genres); $i++) {
									echo "<a style =\"float: left; margin-right: 10px;\"href=\"movies.php?search&genre=" . $genres[$i][0] . "\">" . $genres[$i][1] . "</a>";
								}
							?>
						</div>
					</div>
					<hr>					
					<div class="wide">
						<div class="wideContainer">
							<h2>All Movies</h2>
							<?php
								$movies = Movie::getAllMovies();
								
								for($i = 0; $i < count($movies); $i++) {
									Movie::displayMovieSmall($movies[$i]);
								}
							?>
						</div>
					</div>
					
					<?php
					}
				}
				?>
		<div class="floatDivider"></div>	
	</div>

	<?php
		require_once 'scripts/template-footer.php';
	?>

	</div>
</body>
</html>
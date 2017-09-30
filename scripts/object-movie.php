<?php

/*
	Author: Ben Morrison
	Description: Movie class for adding, searching and listing movies, their cast, crew and genres
	Date Modified: 24 July 2017 
*/

require_once('data-db.php');

class Movie {
	private $movieid;
	private $title;
	private $summary;
	private $releasedate;
	private $ratingid;
	private $runtime;
	private $score;
	
	public function __construct($movieid, $title, $summary, $releasedate, $ratingid, $runtime, $score) {
		$this->movieid = trim($movieid);
		$this->title = trim($title);
		$this->summary = trim($summary);
		$this->releasedate = trim($releasedate);
		$this->ratingid = trim($ratingid);
		$this->runtime = trim($runtime);
		$this->score = trim($score);
	}
	
	public function getMovieID() {
		return $this->movieid;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getSummary() {
		return $this->summary;
	}
	
	public function getReleasedate() {
		return $this->releasedate;
	}
	public function getRatingID() {
		return $this->ratingid;
	}
	
	public function getRuntime() {
		return $this->runtime;
	}
	
	public function getScore() {
		return $this->score;
	}
	
	// Useful for displaying movies in a resizeable grid
	public static function displayMovieSmall($movie) {
		?>
		<div class="movieSmall">
			<a href="movies.php?id=<?php echo $movie->getMovieID(); ?>"><img src="images/posters/<?php echo $movie->getMovieID(); ?>"></a>
			<div class="movieSmallInfo">
				<?php echo "<span style=\"color: yellow;\">&#9733</span> " . $movie->getScore(); ?>
				<?php 
					$title = $movie->getTitle();
					if(strlen($title) > 17) {
						$title = substr($title, 0, 17);
						$title = $title . "...";
					}
					
					echo $title;
				?>
			</div>
		</div>
		<?php
	}
	
	// Displays a movie object to fit in the "left" css column
	public static function displayMovieLine($movie) {
		?>
		<div class="movieLine">
			<a href="movies.php?id=<?php echo $movie->getMovieID(); ?>"><img style="float: left;" src="images/posters/<?php echo $movie->getMovieID(); ?>" height="60"></a>
			<div class="movieLineInfo">
				<?php echo "<span style=\"color: yellow;\">&#9733</span> " . $movie->getScore() . "&nbsp&nbsp"; ?>
				<?php 
					$title = $movie->getTitle();
					if(strlen($title) > 40) {
						$title = substr($title, 0, 40);
						$title = $title . "...";
					}
					
					$release = substr($movie->getReleasedate(), 0, 4);
					echo $title . " <span style=\"color: #898989;\">(" . $release . ")</span>";
				?>
			</div>
		</div>
		<?php
	}
	
	// Adds a movie to the database
	public static function addMovie($title, $summary, $releasedate, $ratingid, $runtime, $score) {
		$title = trim($title);
		$summary = trim($summary);
		$releasedate = trim($releasedate);
		$ratingid = trim($ratingid);
		$runtime = trim($runtime);
		$score = trim($score);
		
		date_default_timezone_set('Australia/Sydney');
		$date = date('y-m-d', time());

		$query = "INSERT INTO Movie VALUES (NULL, '" . 	$title . "', '" .
														$summary . "', '" .
														$releasedate . "', '" .
														$ratingid . "', '" .
														$runtime . "', '" .
														$score . "');";
																							
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	// Returns an array of Movie objects sorted by rating and limited by $num
	public static function getTopRated($num) {
		$num = trim($num);
		
		if($num < 0) { return false; }
		
		$query = "SELECT * FROM Movie ORDER BY score DESC LIMIT " . $num;
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {			
			$movies = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$movie = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
				$movies[] = $movie;
			}
			
			return $movies;
		} else {
			return false;
		}
	}
	
	// Returns an array of Movie objects
	public static function getAllMovies() {
		$query = "SELECT * FROM Movie";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return an array of movies
			
			$movies = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$movie = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
				$movies[] = $movie;
			}
			
			return $movies;
		} else {
			return false;
		}
	}
	
	// Returns a movie that matches the given id
	public static function getMovieByID($id) {
		$query = "SELECT * FROM Movie WHERE movieID = '" . $id . "';";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return a Movie
			
			$row = mysqli_fetch_array($result);
			
			$movie = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
			
			return $movie;
		} else {
			return false;
		}
	}
	
	/* Returns a 2 dimensional array of directors for a given movie id
		Data structure
			Director:
				professionalid
				firstname
				lastname
	*/
	public static function getDirectors($id) {
		$query = "CALL getDirectors(" . $id . ");";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {			
			$directors = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$director = array();
				$director[] = $row[0];
				$director[] = $row[1];
				$director[] = $row[2];
				
				$directors[] = $director;
			}
			
			$result->close();
			Database::getConnection()->next_result();
			return $directors;
		} else {
			return false;
		}
	}
	
	/* Returns a 2 dimensional array of actors for a given movie id
		Data structure
			Actor:
				professionalid
				firstname
				lastname
				description
	*/
	public static function getActors($id) {
		$query = "CALL getActors(" . $id . ");";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return a Movie
			
			$actors = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$actor = array();
				$actor[] = $row[0];
				$actor[] = $row[1];
				$actor[] = $row[2];
				$actor[] = $row[3];
				
				$actors[] = $actor;
			}
			
			$result->close();
			Database::getConnection()->next_result();
			return $actors;
		} else {
			return false;
		}
	}
	
	/* Returns a 2 dimensional array of genres for a given movie id
		Data structure
			Genre:
				genreid
				description
	*/
	public static function getGenres($id) {
		$query = "CALL getGenres(" . $id . ");";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return a Movie
			
			$genres = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$genre = array();
				$genre[] = $row[0];
				$genre[] = $row[1];
				
				$genres[] = $genre;
			}
			
			$result->close();
			Database::getConnection()->next_result();
			return $genres;
		} else {
			return false;
		}
	}
	
	/* Returns a 2 dimensional array of all the genres
		Data structure
			Genre:
				genreid
				description
	*/
	public static function getAllGenres() {
		$query = "SELECT * FROM Genre ORDER BY description ASC";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return an array of movies
			
			$genres = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$genre = array();
				$genre[] = $row[0];
				$genre[] = $row[1];
				
				$genres[] = $genre;
			}
			
			return $genres;
		} else {
			return false;
		}
	}
	
	// Gets the genre name for the given genreid
	public static function getGenre($genreid) {
		$query = "SELECT description FROM Genre WHERE genreID = " . $genreid . ";";
		$result = Database::executeQuery($query);
		
		if($result == NULL) {
			return false;
		}
		
		if($result->num_rows > 0) {
			// Return a genre name
			$row = mysqli_fetch_array($result);
			return $row[0];
		} else {
			return false;
		}
	}
	
	// Gets a list of movies that are related to the given genreid
	public static function getGenreMovies($genreid) {
		$query = "SELECT m.movieID, m.title, m.summary, m.releaseDate, m.ratingID, m.runTime, m.score FROM Movie as m 
				INNER JOIN MovieGenre as mg on mg.movieid = m.movieID 
				INNER JOIN Genre as g on g.genreid = mg.genreid 
				WHERE g.genreID = " . $genreid . ";";
		$result = Database::executeQuery($query);
		
		if($result == NULL or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			$movies = array();
			
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$movie = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
				
				$movies[] = $movie;
			}
			
			return $movies;			
		} else {
			return false;
		}
	}
	
	/* 
		Performs an advanced search function based on the given title, year and genre
		Returns an array of movie objects
	*/
	public static function advancedSearch($title, $year, $genreid) {
		// Add $start and $limit to implement pages later
		
		// The starting query, this is modified based on the search input
		$query = "SELECT m.movieID, m.title, m.summary, m.releaseDate, m.ratingID, m.runTime, m.score FROM Movie as m";
		
		
		if($genreid != null) {
			$query = $query . " INNER JOIN MovieGenre as mg on mg.movieid = m.movieid INNER JOIN Genre as g on g.genreid = mg.genreid";
		}
		
		$or = false;
		
		if($title != null) {
			$query = $query . " WHERE m.title LIKE '%" . $title . "%'";
			$or = true;
		}
		
		if($year != null) {
			if($or) {
				$query = $query . " AND WHERE m.title LIKE '%" . $title . "%'";
			} else {
				$query = $query . " WHERE m.title LIKE '%" . $title . "%'";
			}
			$or = true;
		}
		
		if($genreid != null) {
			if($or) {
				$query = $query . " AND g.genreID LIKE " . $genreid;
			} else {
				$query = $query . " WHERE g.genreID LIKE " . $genreid;
			}
		}
		
		$result = Database::executeQuery($query);
		$movies = array();
		
		if($result == null or $result == false) {
			return false;
		}
		
		if($result->num_rows > 0) {
			for($i = 0; $i < $result->num_rows; $i++) {
				$row = mysqli_fetch_array($result);
				
				$movie = new Movie($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
				$movies[] = $movie;
			}
			
			return $movies;
		} else {
			return false;
		}
	}
}

?>
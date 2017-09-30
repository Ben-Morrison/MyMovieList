<html>
<head>
	<title>Admin Movies</title>
	
	<?php
	require_once 'scripts/template-adminhead.php';
	?>
	
	<script type="text/javascript">
		function Crew(movieID, professionalID, roleID, description) {
			this.movieID = movieID;
			this.professionalID = professionalID;
			this.roleID = roleID;
			this.description = description;
		}
		
		var crew = [
			new Crew(0, 0, 0, 'Actor 1'),
			new Crew(0, 4, 0, 'Actor 2'),
			new Crew(0, 3, 0, 'Actor 3')
		];
		
		function removeCrew(index) {
			crew.splice(index, 1);
			ShowCrew();
		}
	
		function ShowCrew() {	
			var div = document.getElementById("Crew");
			
			while(div.firstChild) { div.removeChild(div.firstChild); }
		
			for(i = 0; i < crew.length; i++) {
				var newDiv = document.createElement('div');
				newDiv.className = 'userFormElements';
				newDiv.innerHTML = crew[i].description;
				
				var button = document.createElement('input');
				button.type = "button";
				button.value = "x";
				button.setAttribute('index', i);
				button.onclick = function() { removeCrew(this.getAttribute('index')) };
				
				newDiv.appendChild(button);
				
				div.appendChild(newDiv);
			}
		}
	</script>
</head>

<body>
	<div id="container">

	<?php
	require_once 'scripts/template-adminheader.php';
	?>

	<div id="main">
	
		<?php		
		if($logged_in) {
			require_once('scripts/object-movie.php');
			
			echo "Logged in as Admin";
			echo "<br>";
			
			if(isset($_GET['adminaction'])) {
				if($_GET['adminaction'] == 'listmovies') {
					echo "Listing Movies";
					echo "<br><br>";
					
					
					
					$movies = Movie::getAllMovies();
					
					for($i = 0; $i < count($movies); $i++) {
						echo $movies[$i]->getMovieID() . "&nbsp";
						echo $movies[$i]->getTitle();
						echo "<br>";
					}
				}
				
				if($_GET['adminaction'] == 'addmovie') {						
					echo "Adding Movies";
					
					$validmovie = true;
					$errmessage = '';
					
					$validtitle = false;
					$errtitle = '';
					
					$validsummary = false;
					$errsummary = '';
				
					$validrelease = false;
					$errrelease = '';
					
					$validrating = false;
					$errrating = '';
					
					$validruntime = false;
					$errruntime = '';
					
					$errother = '';
					
					$showform = false;
					
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						require_once('scripts/data-db.php');
						require_once('scripts/data-validation.php');
						
						
						
						// Get data from the form
						$title = Validate::Input($_POST['title']);
						$summary = Validate::Input($_POST['summary']);
						$releasedate = Validate::Input($_POST['releaseDate']);
						$ratingid = Validate::Input($_POST['ratingID']);
						$runtime = Validate::Input($_POST['runTime']);
						
						// Title validation
						
						
						// Summary validation
						
						
						// Release date validation
						
						
						// Rating validation
						
						
						// Runtime validation
						
						echo $title . "&nbsp" . $summary . "&nbsp" . $releasedate . "&nbsp" . $ratingid . "&nbsp" . $runtime;
					} else {
						$showform = true;
					}
					
					if($showform) {
						?>
						<div id="userForm">
							<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>?adminaction=addmovie">
								<label class="userFormElements" for="title">Title</label>
								<input class="userFormElements" type="text" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>">
								<label class="userFormElements" for="summary">Summary</label>
								<input class="userFormElements" type="text" name="summary" value="<?php if(isset($_POST['summary'])) { echo $_POST['summary']; } ?>">
								<label class="userFormElements" for="summary">Release Date</label>
								<input class="userFormElements" type="text" name="releaseDate">
								
								<div id="AddProfessional"></div>
								<div id="SearchProfessional"></div>
								
								<div id="Crew"></div>
								
								<script>
									ShowCrew();
								</script>
								
								<label class="userFormElements" for="ratingID">Rating</label>
								<select class="userFormElements" name="ratingID">
									<?php
									require_once('scripts/data-db.php');
									
									$query = "SELECT description FROM Rating";
									$result = Database::executeQuery($query);
									
									for($i = 0; $i < $result->num_rows; $i++) {
										$row = mysqli_fetch_array($result);
										?>
										<option value="<?php echo $i; ?>"><?php echo $row[0]; ?></option>
										<?php
									}
									?>
								</select>
								<label class="userFormElements" for="runTime">Runtime</label>
								<input class="userFormElements" type="text" name="runTime">
								<input class="userFormElements" type="submit" value="Add Movie">
							</form>
						</div>
						<?php
					}
				}
			} else {
				?>
				<br><a href="adminmovies.php?adminaction=listmovies">List Movies</a>
				<br><a href="adminmovies.php?adminaction=addmovie">Add Movie</a>
				<?php
			}
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
<?php
  $database = "if20_sofia1";
  
  function readroletoselect($selectedrole) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT person_in_movie_id, first_name, last_name, title, role FROM person_in_movie JOIN person ON person_in_movie.person_id = person.person_id JOIN movie ON person_in_movie.movie_id = movie.movie_id");
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb, $titlefromdb, $rolefromdb);
	$stmt->execute();
	$roles = "";
	  while($stmt->fetch()) {
		  if(!empty($rolefromdb)) {
			$roles .= '<option value ="' .$idfromdb .'"';
			if($idfromdb == $selectedrole) {
				$roles .= " selected";
			}
			$roles .= ">" .$titlefromdb ." - " .$rolefromdb ." (" .$firstnamefromdb ." " .$lastnamefromdb .")" ."</option> \n";
		  }
	  }
	  if(!empty($roles)) {
		  $notice = '<select name="roleinput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali roll filmis</option>' ."\n";
		  $notice .= $roles;
		  $notice .= "</select> \n";
	  }
	$stmt->close();
	$conn->close();
	return $notice;
  } 

  function readmovietoselect($selectedfilm) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_id, title FROM movie");
	  echo $conn->error; // <-- ainult õppimise jaoks!
	  $stmt->bind_result($idfromdb, $titlefromdb);
	  $stmt->execute();
	  $films = "";
	  while($stmt->fetch()) {
		  $films .= '<option value ="' .$idfromdb .'"';
		  if($idfromdb == $selectedfilm) {
			  $films .= " selected";
		  }
		  $films .= ">" .$titlefromdb ."</option> \n";
	  }
	  
	  if(!empty($films)) {
		  $notice = '<select name="filminput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali film</option>' ."\n";
		  $notice .= $films;
		  $notice .= "</select> \n";
	  }
	  
	$stmt->close();
	$conn->close();
	return $notice;
  } 

  function readpositiontoselect($selectedposition) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT position_id, position_name FROM position");
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_result($idfromdb, $namefromdb);
	$stmt->execute();
	$positions = "";
	  while($stmt->fetch()) {
		  $positions .= '<option value ="' .$idfromdb .'"';
		  if($idfromdb == $selectedposition) {
			  $positions .= " selected";
		  }
		  $positions .= ">" .$namefromdb ."</option> \n";
	  }
	  
	  if(!empty($positions)) {
		  $notice = '<select name="positioninput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali amet</option>' ."\n";
		  $notice .= $positions;
		  $notice .= "</select> \n";
	  }
	$stmt->close();
	$conn->close();
	return $notice;
  } 
  
  function readstudiotoselect($selectedstudio) {
	  $notice = "<p>Kahjuks stuudioid ei leitud!</p> \n";
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT production_company_id, company_name FROM production_company");
	  echo $conn->error; // <-- ainult õppimise jaoks!
	  $stmt->bind_result($idfromdb, $companyfromdb);
	  $stmt->execute();
	  $studios = "";
	  while($stmt->fetch()) {
		  $studios .= '<option value ="' .$idfromdb .'"';
		  if($idfromdb == $selectedstudio) {
			  $studios .= " selected";
		  }
		  $studios .= ">" .$companyfromdb ."</option> \n";
	  }
	  
	  if(!empty($studios)) {
		  $notice = '<select name="studioinput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali stuudio</option>' ."\n";
		  $notice .= $studios;
		  $notice .= "</select> \n";
	  }
	  
	  $stmt->close();
	  $conn->close();
	return $notice;
  }
  
  function readgenretoselect($selectedgenre) {
	  $notice = "<p>Kahjuks žanreid ei leitud!</p> \n";
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
	  echo $conn->error; // <-- ainult õppimise jaoks!
	  $stmt->bind_result($idfromdb, $namefromdb);
	  $stmt->execute();
	  $genres = "";
	  while($stmt->fetch()) {
		  $genres .= '<option value ="' .$idfromdb .'"';
		  if($idfromdb == $selectedgenre) {
			  $genres .= " selected";
		  }
		  $genres .= ">" .$namefromdb ."</option> \n";
	  }
	  
	  if(!empty($genres)) {
		  $notice = '<select name="genreinput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali žanr</option>' ."\n";
		  $notice .= $genres;
		  $notice .= "</select> \n";
	  }
	  
	  $stmt->close();
	  $conn->close();
	return $notice;
  } 
  
  function readquotetoselect($selectedquote) {
	  $notice = "<p>Kahjuks tsitaate ei leitud!</p> \n";
	  $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	  $stmt = $conn->prepare("SELECT quote_id, quote_text FROM quote");
	  echo $conn->error; // <-- ainult õppimise jaoks!
	  $stmt->bind_result($idfromdb, $textfromdb);
	  $stmt->execute();
	  $quotes = "";
	  while($stmt->fetch()) {
		  $quotes .= '<option value ="' .$idfromdb .'"';
		  if($idfromdb == $selectedquote) {
			  $quotes .= " selected";
		  }
		  $quotes .= ">" .$textfromdb ."</option> \n";
	  }
	  
	  if(!empty($quotes)) {
		  $notice = '<select name="quoteinput">' ."\n";
		  $notice .= '<option value="" selected disabled>Vali tsitaat</option>' ."\n";
		  $notice .= $quotes;
		  $notice .= "</select> \n";
	  }
	  
	  $stmt->close();
	  $conn->close();
	return $notice;
  } 
  
  function storenewpersonrelation($personinput, $movieinput, $positioninput, $roleinput) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT person_in_movie_id FROM person_in_movie WHERE person_id = ? AND movie_id = ? AND position_id = ?");
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_param("iii", $personinput, $movieinput, $positioninput);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()) {
		$notice = "Selline seos on juba olemas!";
	}
	else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id, role) VALUES(?, ?, ?, ?)");
		echo $conn->error; // <-- ainult õppimise jaoks!
		$stmt->bind_param("iiis", $personinput, $movieinput, $positioninput, $roleinput);
		if($stmt->execute()) {
			$notice = "Salvestatud!";
		}
		else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
  } 
  
  function storenewgenrerelation($movieinput, $genreinput) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_genre_id FROM movie_genre WHERE movie_id = ? AND genre_id = ?");
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_param("ii", $movieinput, $genreinput);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()) {
		$notice = "Selline seos on juba olemas!";
	}
	else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?, ?)");
		echo $conn->error; // <-- ainult õppimise jaoks!
		$stmt->bind_param("ii", $movieinput, $genreinput);
		if($stmt->execute()) {
			$notice = "Salvestatud!";
		}
		else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
  } 
  
  function storenewstudiorelation($selectedfilm, $selectedstudio) {
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	$stmt = $conn->prepare("SELECT movie_by_production_company_id FROM movie_by_production_company WHERE movie_movie_id = ? AND production_company_id = ?");
	echo $conn->error; // <-- ainult õppimise jaoks!
	$stmt->bind_param("ii", $selectedfilm, $selectedstudio);
	$stmt->bind_result($idfromdb);
	$stmt->execute();
	if($stmt->fetch()) {
		$notice = "Selline seos on juba olemas!";
	}
	else {
		$stmt->close();
		$stmt = $conn->prepare("INSERT INTO movie_by_production_company (movie_movie_id, production_company_id) VALUES(?, ?)");
		echo $conn->error; // <-- ainult õppimise jaoks!
		$stmt->bind_param("ii", $selectedfilm, $selectedstudio);
		if($stmt->execute()) {
			$notice = "Salvestatud!";
		}
		else {
			$notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
		}
	}
	$stmt->close();
	$conn->close();
	return $notice;
  }
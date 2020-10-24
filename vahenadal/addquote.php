<?php

  require("usesession.php");
  require("../../../config.php");
  require("fnc_common.php");
  require("fnc_quote.php");

  $notice = "";
  $selectedrole = "";
  $quote = "";
  
  if(isset($_POST["filmgenresubmit"])) {
	  if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$genrenotice .= " Vali film!";
	}
	if(!empty($_POST["genreinput"])){
		$selectedgenre = intval($_POST["genreinput"]);
	} else {
		$genrenotice .= " Vali žanr!";
	}
	if(!empty($selectedfilm) and !empty($selectedgenre)){
		$genrenotice = storenewgenrerelation($selectedfilm, $selectedgenre);
	}
  }
  
  if(isset($_POST["studiofilmsubmit"])) {
	  if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$studionotice .= " Vali film!";
	}
	if(!empty($_POST["studioinput"])){
		$selectedstudio = intval($_POST["studioinput"]);
	} else {
		$studionotice .= " Vali stuudio!";
	}
	if(!empty($selectedfilm) and !empty($selectedstudio)){
		$studionotice = storenewstudiorelation($selectedfilm, $selectedstudio);
	}
  }
  
  if(isset($_POST["personfilmsubmit"])) {
	if(!empty($_POST["filminput"])){
		$selectedfilm = intval($_POST["filminput"]);
	} else {
		$personnotice .= " Vali film!";
	}
	if(!empty($_POST["personinput"])){
		$selectedperson = intval($_POST["personinput"]);
	} else {
		$personnotice .= " Vali isik!";
	}
	if(!empty($_POST["positioninput"])){
		$selectedposition = intval($_POST["positioninput"]);
		if ($selectedposition == 1) {
			if(!empty($_POST["roleinput"])) {
				$insertedrole = test_input($_POST["roleinput"]);
			}
			else {
				$personnotice .= " Sisesta roll!";
			}
		} else {
			$selectedposition = intval($_POST["positioninput"]);
			$insertedrole = test_input($_POST["roleinput"]);
			$personnotice .= " Ainult näitlejal on roll!";
		}
	} else {
		$personnotice .= " Vali amet!";
	}
    if(!empty($selectedperson) and !empty($selectedfilm) and !empty($selectedposition)) {
		if ($selectedposition == 1 and !empty($insertedrole)) {
			$personnotice = storenewpersonrelation($selectedperson, $selectedfilm, $selectedposition, $insertedrole);
		}
		else if($selectedposition != 1 and empty($insertedrole)) {
			$personnotice = storenewpersonrelation($selectedperson, $selectedfilm, $selectedposition, $insertedrole);
		}
    }
  }
  
  $roleselect = readroletoselect($selectedrole);

  require("header.php");
  
  ?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See leht on tehtud veebiprogrammeerimise kursusel 2020. aasta sügissemestril <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
	<li><a href="home.php">Tagasi pealehele</a></li>
	<li><a href="?logout=1">Logi välja!</a></li>
  </ul>
  <hr />
  <h2>Lisame tsitaadi</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="filmdescriptioninput">Tsitaat</label>
  <br />
  <textarea rows="1" cols="39" name="quoteinput" id="quoteinput" placeholder="Tsitaat..."><?php echo $quote; ?></textarea>
  <br />
	<?php
		echo $roleselect;
	?>  
  <br />
  <input type="submit" name="quotesubmit" value="Salvesta tsitaat"><span><?php echo $notice; ?></span>
  </form>
</body>
</html>
<?php
	require("../../../config.php");
	require("fnc_films.php");
	require("usesession.php");
	//$database = "if20_sofia_ge_1";

//kui klikiti submit, siis...
$inputerror = "";
if(isset($_POST["filmsubmit"])){
	if(empty($_POST["titleinput"]) or empty($_POST["genreinput"]) or empty($_POST["studioinput"]) or empty($_POST["directorinput"])){
		$inputerror .= "Osa infot on sisestamata! ";
	}
	if($_POST["yearinput"] > date("Y") or $_POST["yearinput"] < 1895){
		$inputerror .= "Ebareaalne valmimisaasta";
	}
	if(empty($inputerror)){
		savefilm($_POST["titleinput"],$_POST["yearinput"],$_POST["durationinput"],$_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
	}
}

$username = "Sofia Geroiskaja";
require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<p>See veebileht on loodud oppetoo kaigus ning ei sisalda mingit tosiseltvoetavat sisu!</p>
<p>See veebieht on loodud veebiprogrammeerimise kursusel aasta 2020 sugissemestril<a href="http://www.tlu.ee"> Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
  <li><a href="home.php">Tagasi pealehele!</a></li>
  <li><a href="?logout=1">Logi välja</a>!</li>   
</ul>


<hr>
<form method="POST">

<label for="titleinput">Filmi pealkiri</label>
<input type="text" name="titleinput" id="titleinput" placeholder="Pealkiri">
<br>
<label for="yearinput">Filmi valmimisaasta</label>
<input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
<br>
<label for="durationinput">Filmi kestus minutites</label>
<input type="number" name="durationinput" id="durationinput" value="80">
<br>
<label for="genreinput">Filmi žanr</label>
<input type="text" name="genreinput" id="genreinput" placeholder="Žanr">
<br>
<label for="studioinput">Filmi tootja/Stuudio</label>
<input type="text" name="studioinput" id="studioinput" placeholder="Stuudio">
<br>
<label for="directorinput">Filmi lavastaja</label>
<input type="text" name="directorinput" id="directorinput" placeholder="Lavastaja nimi">
<br>
<input type="submit" name="filmsubmit" value="Salvesta filmi info">
<br>

</form>
<p><?php echo $inputerror; ?></p>



</body>
</html>


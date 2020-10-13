<?php
	require("../../../config.php");
	require("fnc_films.php");
	require("usesession.php");
	//$database = "if20_sofia_ge_1";

 //loen lehele kõik olemasolevad mõtted
   $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
   $stmt = $conn->prepare("SELECT * FROM film");
   //$stmt = $conn->prepare("SELECT peakiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
   
   echo $conn->error;
   //seome tulemuse muutujaga
   $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
   $stmt->execute(); //kasu kaivitamine
   $filmhtml = "\t <ol> \n "; //
   while($stmt->fetch()){
	   $filmhtml .= "\t \t <li>" .$titlefromdb ." \n";
	   $filmhtml .= "\t \t \t <ul> \n";
	   $filmhtml .= "\t \t \t \t <li>Valmimisaasta: " .$yearfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Kestus minutites: " .$durationfromdb ." minutit</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Zanr : " .$genrefromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
	   $filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
	   $filmhtml .= "\t \t \t </ul> \n";
	   $filmhtml .= "\t \t </li> \n";
   }
   $filmhtml .= "\t </ol> \n";
   
   $stmt->close();
   $conn->close();

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
  <h1>Filmi list:</h1>
  <hr>
  <?php echo readfilms(); ?>
  <?php echo $filmhtml; ?>
  <hr>




</body>
</html>
<?php
//var_dump($_POST);
require("../../../config.php");
require("usesession.php");
$database = "if20_sofia1";
//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	  //valmistan ette SQL käsu
	  $stmt = $conn->prepare("INSERT INTO if20_sofia1 (idea) VALUES(?)");
	  echo $conn->error;
	  //seome käsuga päris andmed
	  //i - integer, d - decimal, s - string
	  $stmt->bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  echo $stmt->error;
	  $stmt->close();
	  $conn->close();
	  
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

  <form method="POST">
  <label>Sisesta oma pahe tulnud mõte!</label>
  <input type="text" name="ideainput" placeholder="Kirjuta siia mõte">
  <input type="submit" name="ideasubmit" value="Saada mõte ara!">
  </form>

  
</body>
</html>
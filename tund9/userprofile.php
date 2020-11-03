<?php
	require("../../../config.php");
	require("fnc_user.php");
	require("usesession.php");
	require("fnc_common.php");
	
$notice = "";
$userdescription = "";
//kui klikiti submit, siis...
if(isset($_POST["profilesubmit"])){
	$userdescription = test_input($_POST["descriptioninput"]);
	
	$notice = storeuserprofile($userdescription, $_POST["bgcolorinput"], $_POST["txtcolorinput"]);
	$_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
	$_SESSION["usertxtcolor"] = $_POST["txtcolorinput"];
}


require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"] ?></h1>
<p>See veebileht on loodud oppetoo kaigus ning ei sisalda mingit tosiseltvoetavat sisu!</p>
<p>See veebieht on loodud veebiprogrammeerimise kursusel aasta 2020 sugissemestril<a href="http://www.tlu.ee"> Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
  <li><a href="home.php">Tagasi pealehele!</a></li>
  <li><a href="?logout=1">Logi välja</a>!</li>   
</ul>


<hr>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<label for="descriptioninput">Minu lühikirjeldus</label>
<br>
<textarea rows="10" cols="80" name="descriptioninput" id="descriptioninput" placeholder="Minu lühikirjeldus ..."><?php echo $userdescription; ?></textarea>
<br>
<label for="bgcolorinput">Minu valitud taustavärv</label>
<input type="color" name="bgcolorinput" id="bgcolorinput" value="<?php echo $_SESSION["userbgcolor"]; ?>">
<br>
<label for="txtcolorinput">Minu valitud tekstivärv</label>
<input type="color" name="txtcolorinput" id="txtcolorinput" value="<?php echo $_SESSION["usertxtcolor"]; ?>">
<br>

<input type="submit" name="profilesubmit" value="Salvesta profiil">
<br>

</form>
<p><?php echo $notice; ?></p>

</body>
</html>


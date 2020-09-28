<?php 
require("../../../config.php");

$firstname = ""; 
$lastname = ""; 
$email = "";
$gender = "";

$firstnameerror = ""; 
$lastnameerror = ""; 
$gendererror = ""; 
$emailerror = ""; 
$passworderror = ""; 
$confirmpassworderror = "";
$notice = "";

if(isset($_POST["submituserdata"])){
	
		if (empty($_POST["firstnameinput"])){
		  $firstnameerror = "Palun sisesta eesnimi!";
	  }
	  
	  if (empty($_POST["lastnameinput"])){
		  $lastnameerror = "Palun sisesta perekonnanimi!";
	  }
	  
	  if(empty($_POST["genderinput"])){
		  $gendererror = "Palun märgi sugu!";
	  }
	  
	  if (empty($_POST["emailinput"])){
		  $emailerror = "Palun sisesta e-postiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  
	  if (empty($_POST["confirmpasswordinput"])){
		$confirmpassworderror = "Palun sisestage salasõna kaks korda!";  
	  } else {
		  if($_POST["confirmpasswordinput"] != $_POST["passwordinput"]){
			  $confirmpassworderror = "Sisestatud salasõnad ei olnud ühesugused!";
		  }
	  }
	  if(empty($firstnameerror) and empty($lastnameerror) and empty($gendererror ) and empty($emailerror) and empty($passworderror) and empty($confirmpassworderror)){
		$result = signup($firstname, $lastname, $email, $gender, $_POST["passwordinput"]);
		//$notice = "Kõik korras!";
		if($result == "ok"){
			$firstname= "";
			$lastname = "";
			$gender = "";
			$email = null;
			$notice = "Kasutaja loomine õnnestus!";
		} else {
			$notice = "Kahjuks tekkis tehniline viga: " .$result;
		}
	  }
  }
	  
	
$username = "Sofia Geroiskaja";
require("header.php");

?>

 <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1>Uue kasutajakonto loomine</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursusel <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
    
  <ul>
    <li><a href="home.php">Tagasi pealehele</a></li>
  </ul>
  <hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="firstnameinput">Eesnimi:</label>
	  <br>
	  <input name="firstnameinput" id="firstnameinput" type="text" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
	  <br>
	  <br>
      <label for="lastnameinput">Perekonnanimi:</label><br>
	  <input name="lastnameinput" id="lastnameinput" type="text" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
	  <br>
	  <br>
	  <input type="radio" name="genderinput" id="genderfemaleinput" value="2" <?php if($gender == "2"){		echo " checked";} ?>><label for="genderfemaleinput">Naine</label>
	  <input type="radio" name="genderinput" id="gendermaleinput" value="1" <?php if($gender == "1"){		echo " checked";} ?>><label for="gendermaleinput">Mees</label>
	  <span><?php echo "&nbsp; &nbsp; &nbsp;" .$gendererror; ?></span>
	  <br>
	  <br>
	  <label for="emailinput">E-mail (kasutajatunnus):</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <br>
	  <label for="passwordinput">Salasõna (min 8 tähemärki):</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <label for="confirmpasswordinput">Korrake salasõna:</label>
	  <br>
	  <input name="confirmpasswordinput" id="confirmpasswordinput" type="password"><span><?php echo $confirmpassworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Loo kasutaja"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
	</form>
	
	
</body>
</html>
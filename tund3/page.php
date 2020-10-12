<?php
	//käivitame sessiooni
	require("../../../config.php");
	require("fnc_common.php");
	require("fnc_user.php");
	require("usesession.php");

	//$username = "Sofia Geroiskaja";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	
	//vaatame mida vormist saadetakse
	///var_dump($_POST);
	
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
    $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//echo $weekdaynameset;
    //var_dump($weekdaynameset);
	$weekdaynow = date("N");
	//echo $weekdaynow;
	//echo $monthnow;
	

	if($hournow < 6){
		$partofday = "magamise aeg";
	}//enne 6
	if($hournow >= 6 and $hournow < 8){
		$partofday = "hommikuste protseduuride aeg";
	}
	if($hournow >= 8 and $hournow < 18){
		$partofday = "õppimise aeg";
	}
	if($hournow >= 18 and $hournow < 22){
		$partofday = "kodutöö tegemise ja puhkamise aeg";
	}
	if($hournow >= 22){
		$partofday = "aeg magama minna";
	}
	
	//vaatame semestri kulgemist
	$semesterstart = new DateTime("2020-8-31");
	$semesterend = new DateTime("2020-12-13");
	$semesterduration = $semesterstart->diff($semesterend);
	$semesterdurationdays = $semesterduration->format("%r%a");
	$today = new DateTime("now");
	$fromsemesterstart = $semesterstart->diff($today);
    //saime aja erinevuse objektina, seda niisama näidata ei saa
    $fromsemesterstartdays = $fromsemesterstart->format("%r%a");
    $semesterpercentage = 0;
  
    $semesterinfo = "Semester kulgeb vastavalt akadeemilisele kalendrile.";
  if($semesterstart > $today){
	  $semesterinfo = "Semester pole veel peale hakanud!";
  }
  if($fromsemesterstartdays === 0){
	  $semesterinfo = "Semester algab täna!";
  }
  if($fromsemesterstartdays > 0 and $fromsemesterstartdays < $semesterdurationdays){
	  $semesterpercentage = ($fromsemesterstartdays / $semesterdurationdays) * 100;
	  $semesterinfo = "Semester on täies hoos, kestab juba " .$fromsemesterstartdays ." päeva, läbitud on " .$semesterpercentage ."%.";
  }
  if($fromsemesterstartdays == $semesterdurationdays){
	  $semesterinfo = "Semester lõppeb täna!";
  }
  if($fromsemesterstartdays > $semesterdurationdays){
	  $semesterinfo = "Semester on läbi saanud!";
  }
  
  //loen kataloogist piltide nimekirja
  //$allfiles = scandir("../vp_pics/");
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  //$allfiles = scandir("../vp_pics/");
  //var_dump($allfiles);
  $allpicfiles = [];
  $picfiletypes = ["image/jpeg", "image/png"];
  //loeme piltide kataloogi sisu ja näitame pilte
  //$picfiles = array_slice($allfiles, 2);
  foreach($allfiles as $file){
	 $fileinfo = getImagesize("../vp_pics/" .$file);
	 //var_dump($fileinfo);
	 if(in_array($fileinfo["mime"], $picfiletypes) == true){
		 array_push($allpicfiles, $file);
	 }
  }
  
  //paneme kõik pildid ekraanile
  $piccount = count($allpicfiles);
  $picnum = mt_rand(0, ($piccount - 1));
  //$picnum = mt_rand()
  //cho $piccount;
  //$i = $i + 1;
  //$i +=2;
  //$i ++;
  $imghtml = "";
  //<img src="../vp_pics/failinimi.png" alt="tekst">
  //for($i = 0; $i < $piccount; $i ++){
	  $imghtml .= '<img src="../vp_pics/' .$allpicfiles[$picnum] .'" ';
	  $imghtml .= '<alt = "Tallinna ülikool">';
	  
  $email = "";
  $emailerror = "";
  $passworderror = "";
  $notice = "";
  if(isset($_POST["submituserdata"])){
	  if (!empty($_POST["emailinput"])){
		//$email = test_input($_POST["emailinput"]);
		$email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		} else {
		  $emailerror = "Palun sisesta õige kujuga e-postiaadress!";
		}		
	  } else {
		  $emailerror = "Palun sisesta e-postiaadress!";
	  }
	  
	  if (empty($_POST["passwordinput"])){
		$passworderror = "Palun sisesta salasõna!";
	  } else {
		  if(strlen($_POST["passwordinput"]) < 8){
			  $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
		  }
	  }
	  
	  if(empty($emailerror) and empty($passworderror)){
		  echo "Juhhei!" .$email .$_POST["passwordinput"];
		  $notice = signin($email, $_POST["passwordinput"]);
	  }
  }
  
  require("header.php");

?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1>Tere tulemast veebilehele</h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See veebileht on tehtud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="http://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
 
 <hr>
  <h3>Logi sisse</h3>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="emailinput">E-mail:</label><br>
	  <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
	  <br>
	  <label for="passwordinput">Salasõna:</label>
	  <br>
	  <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
	  <br>
	  <br>
	  <input name="submituserdata" type="submit" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
  </form>
  <hr>
  <p>Loo <a href="register.php">kasutajakonto</a></p>
  <hr>
  <p>Lehe avamise aeg: <?php echo $weekdaynameset[$weekdaynow - 1] .", " .$fulltimenow; ?>. 
  
  
  <p><?php echo "Praegu on " .$partofday ."." ; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml;?>
  <hr>
  
</body>
</html>
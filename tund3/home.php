<?php
    //var_dump($_POST);
    require("../../../config.php");
	$database = "if20_sofia1";
	//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
	if(isset($_POST["ideasubmit"]) and !empty($_POST["ideasubmit"])){
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistan ette SQL käsu
    $stmt = $conn->prepare("INSERT INTO if20_sofia1(idea) VALUES(?)");
	echo $conn->error;
	//seome käsuga päris andmed
	//i - integer, d - decimal, s - string
	$stmt->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	}
	
	//loen lehele kõik olemas olevad mõtted
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	$stmt = $conn->prepare("SELECT idea FROM if20_sofia1");
	echo $conn->error;
	//seome tulemuse muutujaga
	$stmt->bind_result($ideafromdb);
	$stmt->execute();
	$ideahtml = "";
	while($stmt->fetch()){
		$ideahtml .= "<p>" .$ideafromdb ."</p>";
	}
	$stmt->close();
	$conn->close();
	
	$username = "Sofia Geroiskaja";
	$fulltimenow = date("d.m.Y H:i:s");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
    $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//echo $weekdaynameset;
    //var_dump($weekdaynameset);
	$weekdaynow = date("N");
	//echo $weekdaynow;
	
	$partofday = "lihtsalt aeg";
	if($hournow < 6){
		$partofday = "öö";
	}//enne 6
	if($hournow >= 6 and $hournow < 12){
		$partofday = "hommik";
	}
	if($hournow >= 12 and $hournow < 13){
		$partofday = "hommikupoolik";
	}
	if($hournow >= 13 and $hournow < 18){
		$partofday = "päev";
	}
	if($hournow >= 18 and $hournow <= 24){
		$partofday = "õhtu";
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
  
  //anna ette lubatud pildivormingute loendi
  $picfiletypes = ["image/jpeg", "image/png"];
  //loeme piltide kataloogi sisu ja näitame pilte
  //$allfiles = scandir("../vp_pics/");
  $allfiles = array_slice(scandir("../vp_pics/"), 2);
  //var_dump($allfiles);
  //$picfiles = array_slice($allfiles, 2);
  $picfiles = [];
  //var_dump($picfiles);
  foreach($allfiles as $thing){
	 $fileinfo = getImagesize("../vp_pics/" .$thing);
	 //var_dump($fileinfo);
	 if(in_array($fileinfo["mime"], $picfiletypes) == true){
		 array_push($picfiles, $thing);
	 }
  }
  
  //paneme kõik pildid ekraanile
  $piccount = count ($picfiles);
  //$i = $i + 1;
  //$i +=2;
  //$i ++;
  $imghtml = "";
  //<img src="../vp_pics/failinimi.png" alt="tekst">
  for($i = 0; $i < $piccount; $i ++){
	  $imghtml .= '<img src="../vp_pics/' .$picfiles[$i] .'" ';
	  $imghtml .= '<alt = "Tallinna ülikool">';
  }
  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1>Sofia Geroiskaja</h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See veebileht on tehtud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow - 1]
   .", " .$fulltimenow; ?>.</p>
  <p><?php echo "Praegu on " .$partofday ."." ; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml; ?>
  <hr>
  <form method="POST">
  <label>Sisesta oma pähe tulnud mõte!</label>
  <input type="text" name="ideainput" placeholder="Kirjuta siia mõte!">
  <input type="submit" name="ideasubmit" value="Saada mõte ära!">
  </form>
  <hr>
  <?php echo $ideahtml; ?>
</body>
</html>
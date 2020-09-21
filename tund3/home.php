<?php
	
	$username = "Sofia Geroiskaja";
	//$fulltimenow = date("d.m.Y H:i:s");
	$timenow = date("H:i:s");
	$daynow = date("d.");
	$yearnow = date("Y");
	$hournow = date("H");
	$partofday = "lihtsalt aeg";
	
	//vaatame mida vormist saadetakse
	var_dump($_POST);
	
	$weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
    $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//echo $weekdaynameset;
    //var_dump($weekdaynameset);
	$weekdaynow = date("N");
	$monthnow = date("n");
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
  
  require("header.php");

?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1>Sofia Geroiskaja</h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See veebileht on tehtud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="http://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow - 1]
   ." " .$daynow ." " .$monthnameset [$monthnow -1] ." " .$yearnow. ", kell on " .$timenow .", semestri algusest on möödunud " .$fromsemesterstartdays ." päeva";?>.
   <ul>
     <li><a href = "ideainput.php">Siia saad sisestada oma mõtte!</a></li>
     <li><a href="ideasubmit.php">Siit saad vaadata oma sisestatud mõtteid!</a></li>
    </ul>
  <p><?php echo "Praegu on " .$partofday ."." ; ?></p>
  <p><?php echo $semesterinfo; ?></p>
  <hr>
  <?php echo $imghtml;?>
  <?php echo $ideahtml; ?>
</body>
</html>
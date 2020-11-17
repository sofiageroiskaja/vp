<?php
	require("usesession.php");
	
	//klassi testimine
	//require("classes/First_class.php");
	//$myclassobject = new First(10);
	//echo "Salajane arv on: " .$myclassobject->mybusiness;
	//echo " Avalik arv on: " .$myclassobject->everybodysbusiness;
	//$myclassobject->tellMe();
	//unset($myclassobject);
	
	//tegelen küpsistega - cookies
	//setcookie   see funktsioon peab olema enne <html> elementi
	//küpsise nimi, väärtus, aegumistähtaeg, failitee (domeeni piires), domeen, https kasutamine
	setcookie("vpvisitorname", $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"], time() + (86400 * 8), "/~rinde/", "greeny.cs.tlu.ee", isset($_SERVER["HTTPS"]), true);
    $lastvisitor = null;
    if(isset($_COOKIE["vpvisitorname"])){
	    $lastvisitor = "<p>Viimati külastas lehte: " .$_COOKIE["vpvisitorname"] .".</p> \n";
    } else {
	    $lastvisitor = "<p>Küpsiseid ei leitud, viimane külastaja pole teada.</p> \n";
    }
    //küpsise kustutamine
    //kustutamiseks tuleb sama küpsis kirjutada minevikus aegumistähtajaga, näiteks time() - 3600
	
	
	require("header.php");

?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See veebileht on tehtud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="http://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>

  <li><a href="?logout=1">Logi välja</a>!</li> 
  <li><a href="page.php">Tagasi pealehele</a>!</li>
  
  <ul>
	 <li><a href="filminfo.php">Loe filmiinfot</a></li>
	 <li><a href="addfilminfo.php">Filmiinfo lisamine</a></li>
	 <li><a href="addfilmrelations.php">Seoste lisamine</a></li>
	 <li><a href="addquote.php">Tsitaadi lisamine</a></li>
	 <li><a href="vanadlingid.php">Vanad Failid</a></li>
	 <li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
	 <li><a href="photoupload.php">Galeriipiltide üleslaadimine</a></li>
	 <li><a href="photogallery_public.php">Avalike fotode galerii</a></li>
    </ul>

<hr>
	<h3>Viimane külastaja sellest arvutist</h3>
	<?php
		if(count($_COOKIE) > 0){
			echo "<p>Küpsised on lubatud! Leiti: " .count($_COOKIE) ." küpsist.</p> \n";
		}
		echo $lastvisitor;
	?>

</body>
</html>
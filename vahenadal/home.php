<?php
	require("usesession.php");
	require("header.php");

?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See veebileht on tehtud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="http://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <p><a href="?logout=1">Logi välja</a>!</p>   
  <ul>
     <li><a href="page.php">Tagasi pealehele</a></li>
	 <li><a href="filminfo.php">Loe filmiinfot</a></li>
	 <li><a href="addfilminfo.php">Filmiinfo lisamine</a></li>
	 <li><a href="addrelation.php">Seoste lisamine</a></li>
	 <li><a href="addquote.php">Tsitaadi lisamine</a></li>
	 <li><a href="vanadlingid.php">Vanad Failid</a></li>
	 <li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
    </ul>

  
</body>
</html>
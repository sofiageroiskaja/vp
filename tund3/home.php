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
     <li><a href = "ideainput.php">Siia saad sisestada oma mõtte!</a></li>
     <li><a href="ideasubmit.php">Siit saad vaadata oma sisestatud mõtteid</a></li>
	 <li><a href="filmsubmit.php">Filmid!</a></li>
	 <li><a href="addfilms.php">Filmiinfo lisamine!</a></li>
	 <li><a href="userprofile.php">Minu kasutajaprofiil</a></li>
	 <li><a href="addfilmrelationgenre.php">Filmi ja žanri seose määramine</a></li>
    </ul>

  
</body>
</html>
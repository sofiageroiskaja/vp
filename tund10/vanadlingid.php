<?php
  require("usesession.php");
  require("header.php");
  
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See leht on tehtud veebiprogrammeerimise kursusel 2020. aasta sügissemestril <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
	<li><a href="home.php">Tagasi pealehele</a></li>
	<li><a href="ideainput.php">Lisa oma mõte</a></li>
	<li><a href="ideasubmit.php">Loe varasemaid mõtteid</a></li>
	<li><a href="filmsubmit.php">Loe filmiinfot</a></li>
	<li><a href="addfilms.php">Filmide lisamine</a></li>
	<li><a href="listfilmpersons.php">Filmitegelased</a></li>
  <li><a href="?logout=1">Logi välja!</a></li>
  </ul>
  <hr>

</body>
</html>
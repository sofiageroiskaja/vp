<?php
	require("../../../config.php");
	require("fnc_films.php");
	//$database = "if20_sofia_ge_1";


//$filmhtml = readfilms();

$username = "Sofia Geroiskaja";
require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Sofia Geroiskaja</h1>
<p>See veebileht on loodud oppetoo kaigus ning ei sisalda mingit tosiseltvoetavat sisu!</p>
<p>See veebieht on loodud veebiprogrammeerimise kursusel aasta 2020 sugissemestril<a href="http://www.tlu.ee"> Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
  <li><a href="home.php">Tagasi pealehele!</a></li>
</ul>


<hr>
<?php echo readfilms(); ?>



</body>
</html>
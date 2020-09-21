<?php
	require("../../../config.php");
	$database = "if20_sofia1";
	//kui on idee sisestatud ja nuppu vajutatud, salvestame selle andmebaasi
	if(isset($_POST["ideasubmit"]) and !empty($_POST["ideasubmit"])){
	$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	//valmistan ette SQL kasu
    $stmt = $conn->prepare("INSERT INTO if20_sofia1 (idea) VALUES()");
	echo $conn->error;
	//seome kasuga paris andmed
	//i - integer, d - decimal, s - string
    $stmt->bind_param("s", $_POST["ideainput"]);
	$stmt->execute();
	$stmt->close();
	$conn->close();
}


//loeme andmebaasis
$ideahtml = "";
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
//valmistame ette SQL kasu
$stmt = $conn->prepare("SELECT FROM if20_sofia1");
echo $conn->error;
//seome tulemuse muutujaga
$stmt->bind_result($ideafromdb);
$stmt->execute();
$ideahtml = "";
while($stmt->fetch()) {
$ideahtml .= "<p>" .$ideafromdb ."</p>";
}
$stmt->close();
$conn->close();


$username = "Sofia Geroiskaja";
require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse banner">
<h1>Sofia Geroiskaja</h1>
<p>See veebileht on loodud oppetoo kaigus ning ei sisalda mingit tosiseltvoetavat sisu!</p>
<p>See veebieht on loodud veebiprogrammeerimise kursusel aasta 2020 sugissemestril<a href="http://www.tlu.ee">Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
  <li><a href="home.php">Tagasi pealehele!</a></li>
</ul>

<hr>
<?php echo $ideahtml; ?>


</body>
</html>
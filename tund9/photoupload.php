<?php
	require("../../../config.php");
	require("usesession.php");
	require("fnc_photo.php");
    require("fnc_common.php");
	require("classes/Photoupload_class.php");

//kui klikiti submit, siis...

$inputerror = "";
$notice = null;
$filetype = null;
$filesivelimit = 1048576;
$photouploaddir_orig = "../photoupload_orig/";
$photouploaddir_normal = "../photoupload_normal/";
$photouploaddir_thumb = "../photoupload_thumb/";
$watermark = "../img/vp_logo_w100_overlay.png";
$filenameprefix = "vp_";
$filename = null;
$photomaxwidth = 600;
$photomaxheight = 400;
$thumbsize = 100;
$privacy = 1;
$alttext = null;

if(isset($_POST["photosubmit"])){
	$privacy = intval($_POST["privinput"]);
	$alttext = test_input($_POST["altinput"]);
	//var_dump($_POST);
	//var_dump($_FILES);
	
	// võtame kasutusele klassi
	$myphoto = new Photoupload($_FILES["photoinput"]);
	
	// Kas on pilt
	if($myphoto->imageType() == 0){
		$inputerror = "Valitud fail ei ole pilt! ";
	}
	
	//kas on sobiva failisuurusega
	if(empty($inputerror) and $_FILES["photoinput"]["size"] > $filesivelimit){
		$inputerror = "Liiga suur fail!";
	}
	
	//loome uue failinime
	$timestamp = microtime(1) * 10000;
	$filename = $filenameprefix .$timestamp ."." .$filetype;
	
	//ega fail äkki olemas pole
	if(file_exists($photouploaddir_orig .$filename)){
		$inputerror = "Selle nimega fail on juba olemas";
	}
	
	//kui vigu pole
	if(empty($inputerror)){
		
		//võtame kasutusele klassi
		$myphoto = new Photoupload($_FILES["photoinput"], $filetype);
		
		//teeme pildi väiksemaks
		$myphoto->resizePhoto($photomaxwidth, $photomaxheight, true);
		//lisame vesimärgi
		$myphoto->addWatermark($watermark);
		
		//salvestame vähendatud pildi
		$result = $myphoto->saveimage($photouploaddir_normal .$filename);
			if($result == 1){
				$notice .= " Vähendatud pildi salvestamine õnnestus! ";
			} else {
				$inputerror .= " Vähendatud pildi salvestamisel tekkis tõrge! ";
			}
		
		//teeme pisipildi
		$myphoto->resizePhoto($thumbsize, $thumbsize);
		$result = $myphoto->saveimage($photouploaddir_thumb .$filename);
		
		if($result == 1){
			$notice .= " Pisipildi salvestamine õnnestus! ";
		} else {
			$inputerror .= " Pisipildi salvestamisel tekkis tõrge! ";
		}
		//eemaldan klassi
		unset($myphoto);
		//salvestame originaalpildi
		if(empty($inputerror)){
			if(move_uploaded_file($_FILES["photoinput"]["tmp_name"], $photouploaddir_orig .$filename)){
				$notice .= " Originaalfaili üleslaadimine õnnestus! ";
			} else {
				$inputerror .= " Originaalfaili üleslaadimisel tekkis tõrge! ";
			}
		}
		
		if(empty($inputerror)){
			$result = storePhotoData($filename, $alttext, $privacy);
			if($result == 1){
				$notice .= " Pildi info lisati andmebaasi! ";
				$privacy = 1;
				$alttext = null;
				
			} else {
				$inputerror .= " Pildi info andmebaasi salvestamisel tekkis tõrge! ";
			}
		} else {
			$inputerror .= " Tekkinud vigade tõttu pildi andmeid ei salvestatud! ";
		}
		
	}
  }

require("header.php");

?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<p>See veebileht on loodud oppetoo kaigus ning ei sisalda mingit tosiseltvoetavat sisu!</p>
<p>See veebieht on loodud veebiprogrammeerimise kursusel aasta 2020 sugissemestril<a href="http://www.tlu.ee"> Tallinna Ulikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
  <li><a href="home.php">Tagasi pealehele!</a></li>
  <li><a href="?logout=1">Logi välja</a>!</li>   
</ul>


<hr>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<label for="photoinput">Vali pildifail!</label>
<input id="photoinput" name="photoinput" type="file" required>
<br>
<label for="altinput">Lisa pildi lühikirjeldus (alternatiivtekst)</label>
<input id="altinput" name="altinput" type="text" value="<?php echo $alttext; ?>">
<br>
<label>Privaatsustase:</label>
<br>
<input id="privinput1" name="privinput" type="radio" value="1" <?php if($privacy == 1){echo " checked";} ?>>
<label for="privinput1">Privaatne (ainult ise näen)</label>
<input id="privinput2" name="privinput" type="radio" value="2" <?php if($privacy == 2){echo " checked";} ?>>
<label for="privinput2">Klubi liikmetele (sisseloginud kasutavad näevad)</label>
<input id="privinput3" name="privinput" type="radio" value="3" <?php if($privacy == 3){echo " checked";} ?>>
<label for="privinput3">Avalik (kõik näevad)</label>
<br>


<input type="submit" name="photosubmit" value="Lae foto üles">
</form>
<p>
<?php 
echo $inputerror; 
echo $notice; 
?>
</p>



</body>
</html>


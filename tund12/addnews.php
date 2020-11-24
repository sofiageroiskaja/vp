<?php
require("usesession.php");
require("../../../config.php");
require("fnc_news.php");
require("fnc_common.php");
//require("classes/Photoupload_class.php");
$tolink = "\t" .'<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>' ."\n";
$tolink .= "\t" .'<script>tinymce.init({selector:"textarea#newsinput", plugins: "link", menubar: "edit",});</script>' ."\n";
//$tolink = '<script src="javascript/checkfilesize.js" defer></script>' . "\n";

$inputerror = "";
$newstitle = null;
$notice = null;
$news= null;
$expire = null;


//kui klikiti submit, siis ...
if (isset($_POST["newssubmit"])) {
	if(!strlen($_POST["newstitleinput"])){
		$inputerror = "pealkiri puudu";
	} else {
		$newstitle = test_input($_POST["newstitleinput"]);
	}
	if(!strlen($_POST["newsinput"])){
		$inputerror .= "uudis puudub";
	} else {
		$news = test_input($_POST["newsinput"]);
	}
	if(!empty($_POST["newsexpireinput"])){
		$expire = $_POST["newsexpireinput"];
	}
	if(empty($inputerror)){
		//salvestame uudise
		$result = storeNewsData($newstitle, $news, $expire);
		$newstitle = $news = $expire = null;
	}
}


require("header.php");
?>
<h1><?php echo $_SESSION["userfirstname"] . " " . $_SESSION["userlastname"]; ?></h1>
<p>See veebileht on loodud õppetöö kaigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>See konkreetne leht on loodud veebiprogrammeerimise kursusel aasta 2020 sügissemestril <a href="https://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>

<ul>
	<li><a href="?logout=1">Logi välja</a>!</li>
	<li><a href="home.php">Avaleht</a></li>
</ul>

<hr>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
	<label for="newstitleinput">Pealkiri: </label>
	<input id="newstitleinput" name="newstitleinput" type="text" required value="<?php echo $newstitle;?>">
	<br>
	<label for="newsexpireinput">Aegumise kuupäev</label>
	<input id="newsexpireinput" name="newsexpireinput" type="date" required>
	<br>
	<label for="newsinput">Kirjuta uudis</label>
	<textarea id="newsinput" name="newsinput" placeholder="Uudise sisu"><?php echo $news; ?></textarea>
	<br>
	<input type="submit" name="newssubmit" id="newssubmit" value="Salvesta uudis üles">
</form>
<p id="notice">
	<?php
	echo $inputerror;
	echo $notice;
	?>
</p>

</body>

</html>
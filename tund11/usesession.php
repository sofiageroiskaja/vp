<?php
session_start();
	//$username = "Sofia Geroiskaja";
	
	//kas on sisse loginud
	if(!isset($_SESSION["userid"])){
		//jõuga suunatakse sisselogimise lehele
		header("Location: page.php");
		exit();
	}
  
  
	//Logime välja
	if(isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: page.php");
		exit();
	}
<?php

  require("usesession.php");
  require("../../../config.php");
  require("fnc_readfilminfo.php");
  

  $sortby = 0;
  $personsortby = 0;
  $filmsortby = 0;
  $genresortby = 0;
  $studiosortby = 0;
  $positionsortby = 0;

  $sortorder = 0;
  $personsortorder = 0;
  $filmsortorder = 0;
  $genresortorder = 0;
  $studiosortorder = 0;
  $positionsortorder = 0;
    

  require("header.php");
  
  ?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse bänner">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>See leht on tehtud veebiprogrammeerimise kursusel 2020. aasta sügissemestril <a href="https://www.tlu.ee" target="_blank">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
  <ul>
	<li><a href="home.php">Tagasi pealehele</a></li>
	<li><a href="?logout=1">Logi välja!</a></li>
  </ul>
  <hr>
  <div id="personmovie">
    <h2>Isikud Filmis</h2>
    <?php 
      if(isset($_GET["sortby"]) and isset($_GET["sortorder"])) {
        if($_GET["sortby"] >= 1 and $_GET["sortby"] <= 5) {
          $sortby = $_GET["sortby"];
        }
        if($_GET["sortorder"] == 1 or $_GET["sortorder"] == 2) {
          $sortorder = $_GET["sortorder"];
        }
      }
      echo readpersonsinfilm($sortby, $sortorder); 
    ?>
  </div>
  <div id="quotes">
    <h2>Tsitaadid</h2>
  </div>
  <div id="persons">
    <h2>Isikud</h2>
    <?php 
      if(isset($_GET["personsortby"]) and isset($_GET["personsortorder"])) {
        if($_GET["personsortby"] >= 1 and $_GET["personsortby"] <= 3) {
          $personsortby = $_GET["personsortby"];
        }
        if($_GET["personsortorder"] == 1 or $_GET["personsortorder"] == 2) {
          $personsortorder = $_GET["personsortorder"];
        }
      }
      echo readpersons($personsortby, $personsortorder); 
    ?>
  </div>
  <div id="films">
    <h2>Filmid</h2>
    <?php 
      if(isset($_GET["filmsortby"]) and isset($_GET["filmsortorder"])) {
        if($_GET["filmsortby"] >= 1 and $_GET["filmsortby"] <= 3) {
          $filmsortby = $_GET["filmsortby"];
        }
        if($_GET["filmsortorder"] == 1 or $_GET["filmsortorder"] == 2) {
          $filmsortorder = $_GET["filmsortorder"];
        }
      }
      echo readfilms($filmsortby, $filmsortorder); 
    ?>
  </div>
  <div id="genres">
    <h2>Žanrid</h2>
    <?php 
      if(isset($_GET["genresortby"]) and isset($_GET["genresortorder"])) {
        if($_GET["genresortby"] == 1) {
          $genresortby = $_GET["genresortby"];
        }
        if($_GET["genresortorder"] == 1 or $_GET["genresortorder"] == 2) {
          $genresortorder = $_GET["genresortorder"];
        }
      }
      echo readgenres($genresortby, $genresortorder); 
    ?>
  </div>
  <div id="studios">
    <h2>Filmistuudiod</h2>
    <?php 
      if(isset($_GET["studiosortby"]) and isset($_GET["studiosortorder"])) {
        if($_GET["studiosortby"] == 1) {
          $studiosortby = $_GET["studiosortby"];
        }
        if($_GET["studiosortorder"] == 1 or $_GET["studiosortorder"] == 2) {
          $studiosortorder = $_GET["studiosortorder"];
        }
      }
      echo readstudios($studiosortby, $studiosortorder); 
    ?>
  </div>
  <div id="positions">
    <h2>Ametikohad Filmis</h2>
    <?php 
      if(isset($_GET["positionsortby"]) and isset($_GET["positionsortorder"])) {
        if($_GET["positionsortby"] == 1) {
          $positionsortby = $_GET["positionsortby"];
        }
        if($_GET["positionsortorder"] == 1 or $_GET["positionsortorder"] == 2) {
          $positionsortorder = $_GET["positionsortorder"];
        }
      }
      echo readpositions($positionsortby, $positionsortorder); 
    ?>
  </div>

</body>
</html>
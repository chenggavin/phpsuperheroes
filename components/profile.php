<!DOCTYPE html>
<html>
<head>
  <title>HERO PROFILE</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="profile.css">
</head>
<body class="container">

<?php 

require('../database.php'); 

$id = intval(htmlentities($_GET["id"]));


function getHeroes($id) {
    $sql = "SELECT * FROM heroes WHERE id=".$id;
    $request = pg_query(getDb(), $sql);
    return pg_fetch_all($request);
  }


?>





<div>

      <?php foreach (getHeroes($id) as $heroes) { ?>
        
        <h1 class="heroname mb-5 <?=$heroes['name']?>">
          <?=$heroes['name']?>
        </h1>

        <div class="heropic ">
          <img style="width:200px;" src="<?=$heroes['profilepic']?>">
        </div>

      <?php } ?>





  <div class="mt-5">
    <a href="index.php">Return to list of palettes</a>
  </div>

</body>
</html>
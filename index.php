<!DOCTYPE html>
<html>
<head>
  <title>Super Hero Friday</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://use.fontawesome.com/14f1f2c704.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Orbitron:700" rel="stylesheet">
</head>

<body class="container">

<h1>SUPER HEROES</h1>

<!-- 	Including function to recieve heronames -->
<?php include('./components/heroname.php'); ?>

<!-- Displaying each heroes' name and profile picture -->
      <ul>
      <?php 
      	foreach (getHeroes() as $heroes) { 
      ?>
      <li><a href="./components/profile.php?id=<?=$heroes["id"]?>">
   			
   			<div class="heroname mb-5 <?=$heroes['name']?>">
          <?=$heroes['name']?>
        </div>

        <div class="heropic ">
					<img src="<?=$heroes['image_url']?>">
				</div>

				</a></li>
      <?php } ?>
      </ul>





</body>
</script>
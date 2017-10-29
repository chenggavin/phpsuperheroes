<!DOCTYPE html>
<html>
<head>
  <title>HERO PROFILE</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" href="profile.css">
  <script src="https://use.fontawesome.com/14f1f2c704.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
</head>
<body class="container">

<?php 

  require('../database.php'); 

    $id = intval(htmlentities($_GET["id"]));

    if (isset($_GET['postName'])) {
      $safeName = htmlentities($_GET['postName']);
      addPost($id ,$safeName);
    }

    if(isset($_GET['removePost'])) {
      $safeId = htmlentities($_GET['removePost']);
      removePost($safeId);
    
    }



  function getHeroes($id) {
      $sql = "SELECT * FROM heroes WHERE id=".$id;
      $request = pg_query(getDb(), $sql);
      return pg_fetch_assoc($request);
    }

  function getPower($id) {
      $sql = "SELECT * FROM abilities 
      JOIN ability_hero ON abilities.id = ability_hero.ability_id 
      JOIN heroes ON ability_hero.hero_id = heroes.id 
      WHERE heroes.id =".$id;
      $request = pg_query(getDb(), $sql);
      return pg_fetch_assoc($request);
    }

  function getPosts($id) {
    $sql = "SELECT * FROM posts WHERE hero_id=".$id. "ORDER BY id ASC;";
      $request = pg_query(getDb(), $sql);
      return pg_fetch_all($request);
  } 

  function addPost($id , $postToAdd) {
      $sql = "INSERT INTO posts (hero_id, post ) VALUES ("  . $id .  ", '"   . $postToAdd . "');";
      $request = pg_query(getDb(), $sql);
    }


  function removePost($id) {
      $sql = "DELETE FROM posts where id=".$id;
      $request = pg_query(getDb(), $sql);
    }
?> 





<div class="container bigdiv">
  <?php  $heroes = getHeroes($id) ?>  
    <div class="row">
      <div class="col-5">
        <div class="herodiv">
          <img class="heropic" src="<?=$heroes['profilepic']?>">
          <div class="heroname mb-5 <?=$heroes['name']?>">
            <?=$heroes['name']?>
          </div>
            <div class="mt-5 col">
              <a href="../index.php">Return to full Roster</a>
            </div>
        </div>
      </div>
   
      <div class="col-5">
        <div class="about container">
          <h5>About Me</h5>
          <?=$heroes['about_me']?>
          <h5 class="mt-5"> Biography </h5>
          <?=$heroes['biography']?>
          <h5 class="mt-5"> Abilities </h5>

            <?php $power = getPower($id); 
                echo $power['ability']."\n";
            ?>

        </div> 
        <div class="col">
          <form class="form-inline" method="get" >
            <label class="sr-only" for="postName">Post</label>
            <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="postName" name="postName" placeholder="Tell me something!">
            <input type="hidden" name="id" value="<?=$id?>" />
            <button type="submit" class="btn btn-secondary">Post</button>
          </form>
        </div>

        <div class="col mt-5">  
          <h4>Posts</h4>
            <ul class="postlist mt-3">
            <?php if ((getPosts($id))): 
               foreach (getPosts($id) as $post) { ?>
                <li class="mb-20 postli">
                  <div class="row">
                    <div class="col-3">
                      <form method="get">
                        <input name="removePost" value="<?=$post['id']?>" type="hidden">
                        <input name="id" value="<?=$id?>" type="hidden">
                        <button class="btn btn-sm btn-outline-secondary" type="submit">X</button>
                      </form>
                    </div>         
                    <div style="padding-left: 0px;">
                      <?=$post['post']?>
                    </div>
                  </div>
                </li>
                <?php } 

                else: ?>
                 <p>I have no posts yet, make me one!</p>

              <? endif; ?>
            </ul>
        </div>                    
      </div>
    </div>
</div>


    


















</body>
</html>
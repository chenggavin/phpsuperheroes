
<?php

require_once('database.php');




function getHeroes() {
    $sql = "SELECT name, image_url FROM heroes;";
    $request = pg_query(getDb(), $sql);
    return pg_fetch_all($request);
  }



















?>
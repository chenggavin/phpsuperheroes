
<?php

require('database.php');




function getHeroes() {
    $sql = "SELECT * FROM heroes;";
    $request = pg_query(getDb(), $sql);
    return pg_fetch_all($request);
  }



















?>
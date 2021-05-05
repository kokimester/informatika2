<?php
require_once "db.php";
$link = opendb();
if (isset($_GET['term'])) {
     
    $term = mysqli_real_escape_string($link,$_GET['term']);
    $query = "SELECT nev FROM user WHERE nev LIKE '$term%' LIMIT 25";
    $result = mysqli_query($link, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['nev'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>
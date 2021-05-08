<?php
session_start();
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';

if(!isset($_GET['match']))
{
    header('Location: pending_matches.php?error=Match not found.');
    mysqli_close($link);
}

//SESSIONBOL JON
$user['id'] = $_SESSION['userid'];


$matchid = mysqli_real_escape_string($link,$_GET['match']);

$matchid = mysqli_real_escape_string($link, $matchid);
$query = "SELECT * FROM merkozes WHERE (merkozes.id = $matchid) 
            AND (merkozes.player_1_id = '".$user['id']."' OR merkozes.player_2_id = '".$user['id']."') 
            AND (merkozes.player_1_confirmed = '0' OR merkozes.player_2_confirmed = '0')";
$eredmeny = mysqli_query($link,$query);
if($match = mysqli_fetch_assoc($eredmeny))
{
    $delete = "DELETE FROM merkozes WHERE merkozes.id = ".$match['id'];
    mysqli_query($link,$delete);
    mysqli_close($link);
    header('Location: pending_matches.php');
}
else{
header('Location: pending_matches.php?error=Match not found');
}
?>
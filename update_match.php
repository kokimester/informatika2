<?php

include_once 'check_if_logged_in.php';

$user['id'] = $_SESSION['userid'];

$matchid = mysqli_real_escape_string($link, $matchid);
$query = "SELECT * FROM merkozes WHERE (merkozes.id = $matchid) 
            AND (merkozes.player_1_id = '".$user['id']."' OR merkozes.player_2_id = '".$user['id']."') 
            AND (merkozes.player_1_confirmed = '0' OR merkozes.player_2_confirmed = '0')";
$eredmeny = mysqli_query($link,$query);
if($match = mysqli_fetch_assoc($eredmeny))
{

    $query = "SELECT * FROM user WHERE id = '".$match['player_1_id']."'";
    $eredmeny = mysqli_query($link,$query);
    if($player1 = mysqli_fetch_assoc($eredmeny))
    {
        $query = "SELECT * FROM user WHERE id = '".$match['player_2_id']."'";
    $eredmeny = mysqli_query($link,$query);
    if($player2 = mysqli_fetch_assoc($eredmeny))
    {
    }
    else
    {
        $error = "Couldnt find player 2";
        return;
    }
    }
    else{
        $error = "Couldnt find player 1";
        return;
    }

    if(isset($_POST['player1list']) &&
    isset($_POST['player2list']) &&
    isset($_POST['player1points']) &&
    isset($_POST['player2points'])
) {
    $error = "SAVING";
    $player_1_list = mysqli_real_escape_string($link, $_POST['player1list']);
    $player_2_list = mysqli_real_escape_string($link, $_POST['player2list']);
    $player_1_points = mysqli_real_escape_string($link, $_POST['player1points']);
    $player_2_points = mysqli_real_escape_string($link, $_POST['player2points']);

    $player_1_confirmed = 0;
    $player_2_confirmed = 0;
    ($user['id'] == $match['player_1_id']) ? $player_1_confirmed = 1 : $player_2_confirmed = 1;

    $update = "UPDATE merkozes SET player_1_list = '$player_1_list', player_2_list = '$player_2_list', player_1_points = '$player_1_points',
     player_2_points = '$player_2_points', player_1_confirmed = '$player_1_confirmed', player_2_confirmed = '$player_2_confirmed' WHERE (merkozes.id = $matchid);";
     mysqli_query($link,$update);
    header('Location: pending_matches.php?error=Save succesful.');
    return;
    }
}
else
{
    $error = "Match not found";
}


<?php 
session_start();
include 'db.php';
$link = opendb();

if(!isset($_GET['match']))
{
    header('Location: pending_matches.php?error=Match not found.');
    mysqli_close($link);
}

//SESSIONBOL JON
$user['id'] = $_SESSION['userid'];


$matchid = $_GET['match'];

$matchid = mysqli_real_escape_string($link, $matchid);
$query = "SELECT * FROM merkozes WHERE (merkozes.id = $matchid) 
            AND (merkozes.player_1_id = '".$user['id']."' OR merkozes.player_2_id = '".$user['id']."') 
            AND (merkozes.player_1_confirmed = '0' OR merkozes.player_2_confirmed = '0')";
$eredmeny = mysqli_query($link,$query);
if($match = mysqli_fetch_assoc($eredmeny))
{
    $player_1_confirmed = $match['player_1_confirmed'];
    $player_2_confirmed = $match['player_2_confirmed'];
    ($user['id'] == $match['player_1_id']) ? $player_1_confirmed = 1 : $player_2_confirmed = 1;
    $update = "UPDATE merkozes SET player_1_confirmed = $player_1_confirmed, player_2_confirmed = $player_2_confirmed WHERE (merkozes.id = ".$match['id'].");";
    mysqli_query($link,$update);

    $query = "SELECT * FROM user WHERE id = '".$match['player_1_id']."'";
    $eredmeny = mysqli_query($link,$query);
    if($player1 = mysqli_fetch_assoc($eredmeny))
    {
        $query = "SELECT * FROM user WHERE id = '".$match['player_2_id']."'";
        $eredmeny = mysqli_query($link,$query);
    if($player2 = mysqli_fetch_assoc($eredmeny))
    {
        $winner = ($match['player_1_points'] > $match['player_2_points']) ? $player1 : $player2 ;
        $change = $match['elo_change'];
        $player1_elo = ($winner === $player1 ? $player1['elo']+$change : $player1['elo']-$change);
        $player2_elo = ($winner === $player2 ? $player2['elo']+$change : $player2['elo']-$change);
        $update = "UPDATE user SET elo = $player1_elo WHERE user.id = ".$player1['id'];
        mysqli_query($link,$update);
        $update = "UPDATE user SET elo = $player2_elo WHERE user.id = ".$player2['id'];
        mysqli_query($link,$update);
        header('Location: mymatches.php');
    }
    else
    {
        header('Location: mymatches.php?error=Player 2 not found');
    }
    }
    else
    { 
    header('Location: mymatches.php?error=Player 1 not found');   
    }
}
mysqli_close($link);
header('Location: mymatches.php');
?>
<?php
include_once 'check_if_logged_in.php';

if( ($_SESSION['admin'] !== true)  )
    {
        header('Location: index.php?error=For admins only.');
    }

$matchid = mysqli_real_escape_string($link, $matchid);
$query = "SELECT * FROM merkozes WHERE (merkozes.id = $matchid)";
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
    isset($_POST['player2points']) &&
    isset($_POST['player1name']) &&
    isset($_POST['player2name'])
) {
    $player_1_list = mysqli_real_escape_string($link, $_POST['player1list']);
    $player_2_list = mysqli_real_escape_string($link, $_POST['player2list']);
    $player_1_points = mysqli_real_escape_string($link, $_POST['player1points']);
    $player_2_points = mysqli_real_escape_string($link, $_POST['player2points']);
    $player_1_name = mysqli_real_escape_string($link, $_POST['player1name']);
    $player_2_name = mysqli_real_escape_string($link, $_POST['player2name']);

    $player1_q = mysqli_query($link, "SELECT * FROM user WHERE nev = '$player_1_name'");
    $player2_q = mysqli_query($link, "SELECT * FROM user WHERE nev = '$player_2_name'");
    if($player2_qq = mysqli_fetch_assoc($player2_q))
    {
        if($player1_qq = mysqli_fetch_assoc($player1_q))
        {
        $player_2_id = $player2_qq['id'];
        $player_1_id = $player1_qq['id'];
        }
        else{
            header('Location: edit_match_admin.php?match='.$match['id'].'&error=Couldnt find player1.');
            exit;
        }  
    }
    else {
        header('Location: edit_match_admin.php?match='.$match['id'].'&error=Couldnt find player2.');
        exit;
    }
    if($player_1_id == $player_2_id)
    {
        header('Location: edit_match_admin.php?match='.$match['id'].'&error=Cant edit match againts same person.');
        exit;
    }

    $player_1_confirmed = 1;
    $player_2_confirmed = 1;

    $update = "UPDATE merkozes SET player_1_id = '$player_1_id',player_2_id = '$player_2_id', player_1_list = '$player_1_list', player_2_list = '$player_2_list', player_1_points = '$player_1_points',
     player_2_points = '$player_2_points', player_1_confirmed = '$player_1_confirmed', player_2_confirmed = '$player_2_confirmed' WHERE (merkozes.id = $matchid);";
     mysqli_query($link,$update);
    
     header('Location: admin.php');
     exit;
    }
}
else
{
    $error = "Match not found";
}
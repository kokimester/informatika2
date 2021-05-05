<?php

include_once 'check_if_logged_in.php';

if(isset($_POST['selfList']) &&
    isset($_POST['selfShotDown']) &&
    isset($_POST['opponentShotDown']) &&
    isset($_POST['opponentName'])
)
{

    //sessionbol jon
    $user['id'] = $_SESSION['userid'];

$sList = $_POST['selfList'];
$sShotDown = $_POST['selfShotDown'];
$oShotDown = $_POST['opponentShotDown'];
$oName = $_POST['opponentName'];

if($sShotDown > 200 || $oShotDown > 200 || $sShotDown < 0 || $oShotDown < 0)
{
    $error = isset($error) ? $error : 'Points cant exceed 200 and cant be negative.';
    return;
}
if($sShotDown === $oShotDown)
{
    $error = isset($error) ? $error : 'Match cannot end in stalemate. Provide 1 more point for the winner,or 1 less for the loser.';
    return;
}
$oName = mysqli_real_escape_string($link,$oName);
$query = "SELECT id,nev,discordid,steamid,elo FROM user WHERE nev LIKE '%$oName%';";
$eredmeny = mysqli_query($link,$query);
$opponent = mysqli_fetch_assoc($eredmeny);

if($opponent === null || ($eredmeny -> num_rows) > 1 )
{
    $error = isset($error) ? $error : 'Opponent cant be found. Check spelling.';
    return;
}

$foundOpponent="Opponent found: ".$opponent['nev'].(isset($opponent['discordid']) ? " Discord: ".$opponent['discordid'] : "").(isset($opponent['steamid']) ? " Steam: ".$opponent['steamid'] : "");

$query = "SELECT id,nev,elo FROM user WHERE id = ".$user['id'].";";
$eredmeny = mysqli_query($link,$query);
$self = mysqli_fetch_array($eredmeny);

$sList = mysqli_real_escape_string($link,$sList);
$sShotDown = mysqli_real_escape_string($link,$sShotDown);
$oShotDown = mysqli_real_escape_string($link,$oShotDown);

if($opponent['id'] == $self['id'])
{
    unset($foundOpponent);
    $error = isset($error) ? $error : 'You cant add a match against yourself!';
    return;
}

$player_1_id = $user['id'];
$player_2_id = $opponent['id'];

$winner = (($sShotDown > $oShotDown) ?  $user['id']   :   $opponent['id']);
$ret = EloRating($self['elo'], $opponent['elo'], 30, (($winner === $user['id']) ? 1 : 2));
$points_change = round($ret[2], 1);

$player_1_list = $sList;

$player_1_points = $sShotDown;
$player_2_points = $oShotDown;

$insert = "INSERT INTO merkozes(player_1_confirmed, player_1_id, player_2_id, player_1_list, player_1_points, player_2_points,elo_change) 
                        VALUES('1','{$player_1_id}','{$player_2_id}','{$player_1_list}','{$player_1_points}','{$player_2_points}','{$points_change}')";
mysqli_query($link, $insert);
mysqli_close($link);
header('Location: mymatches.php?error=Match added succesfully. '.$foundOpponent);
} 


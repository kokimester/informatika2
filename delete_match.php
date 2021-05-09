<?php
session_start();
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';

if (!isset($_GET['match'])) {
    header('Location: pending_matches.php?error=Match not found.');
    mysqli_close($link);
}
$user['id'] = $_SESSION['userid'];


$matchid = mysqli_real_escape_string($link, $_GET['match']);

$matchid = mysqli_real_escape_string($link, $matchid);
$query = "SELECT * FROM merkozes WHERE (merkozes.id = $matchid)";
$eredmeny = mysqli_query($link, $query);
if ($match = mysqli_fetch_assoc($eredmeny)) {

    if (isset($_SESSION['change_elo']) && $_SESSION['change_elo'] === true) {

        $query = "SELECT * FROM user WHERE id = '" . $match['player_1_id'] . "'";
        $eredmeny = mysqli_query($link, $query);
        if ($player1 = mysqli_fetch_assoc($eredmeny)) {
            $query = "SELECT * FROM user WHERE id = '" . $match['player_2_id'] . "'";
            $eredmeny = mysqli_query($link, $query);
            if ($player2 = mysqli_fetch_assoc($eredmeny)) {
                $winner = ($match['player_1_points'] > $match['player_2_points']) ? $player1 : $player2;
                $change = $match['elo_change'];
                $player1_elo = ($winner === $player1 ? $player1['elo'] - $change : $player1['elo'] + $change);
                $player2_elo = ($winner === $player2 ? $player2['elo'] - $change : $player2['elo'] + $change);
                $update = "UPDATE user SET elo = $player1_elo WHERE user.id = " . $player1['id'];
                mysqli_query($link, $update);
                $update = "UPDATE user SET elo = $player2_elo WHERE user.id = " . $player2['id'];
                mysqli_query($link, $update);
            } else {
                header('Location: admin.php?error=Player 2 not found');
            }
        } else {
            header('Location: admin.php?error=Player 1 not found');
        }
    }

    $delete = "DELETE FROM merkozes WHERE merkozes.id = " . $match['id'];
    mysqli_query($link, $delete);
    mysqli_close($link);
    if (isset($_SESSION['change_elo']) && $_SESSION['change_elo'] === true) {
        header('Location: admin.php');
    } else {
        header('Location: pending_matches.php');
    }
} else {
    header('Location: pending_matches.php?error=Match not found');
}

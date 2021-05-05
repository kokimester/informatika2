<?php 

include_once 'check_if_logged_in.php';

    if(isset($_POST['ezvajonmirejo']) &&
        isset($_POST['nev']) &&
        isset($_POST['email'])
        )
    {

    $id = mysqli_real_escape_string($link,$_POST['ezvajonmirejo']);
    $nev = mysqli_real_escape_string($link,$_POST['nev']);
    $email = mysqli_real_escape_string($link,$_POST['email']);

    if(isset($_POST['discordid']))
    {
        $discordid = mysqli_real_escape_string($link,$_POST['discordid']);
    }
    if(isset($_POST['steamid']))
    {
        $steamid = mysqli_real_escape_string($link,$_POST['steamid']);
    }

    $query = "UPDATE user SET ".(isset($discordid) ? "discordid = '".$discordid."', " : "").(isset($discordid) ? "steamid = '".$steamid."', " : "").
    "nev = '$nev', email = '$email' WHERE id = $id";
    mysqli_query($link, $query);
    mysqli_close($link);
    header('Location: profile.php');

    }

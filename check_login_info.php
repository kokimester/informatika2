<?php 
include_once 'db.php';
$link = opendb();

    if(
        isset($_POST['email']) && 
        isset($_POST['password'])
        )
    {
    $hashalgorithm = 'md5';
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $password = hash($hashalgorithm,$_POST['password']);

    $query = "SELECT * FROM user WHERE email='".$email."';";
    $eredmeny = mysqli_query($link,$query);
    if($user = mysqli_fetch_assoc($eredmeny))
    {
        if($user['jelszo'] === $password)
        {
            //belepes
            $_SESSION['belepve'] = true;
            $_SESSION['userid'] =$user['id'];
            $_SESSION['nev'] = $user['nev'];
            header('Location: index.php');
        }
        else
        {
            $error = "Wrong password.";
            return;
        }
    }
    else{
    $error="User not found.";
    return;
    }

    }

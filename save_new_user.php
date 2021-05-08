<?php 

    if(
        isset($_POST['nev']) &&
        isset($_POST['email']) &&
        isset($_POST['inputPassword1']) &&
        isset($_POST['inputPassword2'])
        )
    {

    $nev = mysqli_real_escape_string($link,$_POST['nev']);
    $email = mysqli_real_escape_string($link,$_POST['email']);
    $inNewPass1 = $_POST['inputPassword1'];
    $inNewPass2 = $_POST['inputPassword2'];

    $hashalgorithm = 'md5';
    $checker = mysqli_query($link, "SELECT * FROM user WHERE email='".$email."';");

    if (!$checker)
    {
        die('Error: ' . mysqli_error($link));
        return;
    }

    if(mysqli_num_rows($checker) > 0){

        $error = isset($error) ? $error : 'This email address is already taken. 1';
        return;
    }

    if($inNewPass1 !== $inNewPass2)
    {
        $error = isset($error) ? $error : 'Your passwords must match.';
        return;
    }
    if(strlen($inNewPass1) < 8)
    {
        $error = isset($error) ? $error : 'Your password must be at least 8 characters long.';
        return;
    }

    $pass = $inNewPass1;

    $hasUpperCase = preg_match('/[A-Z]/',$pass);
    $hasLowerCase = preg_match('/[a-z]/',$pass);
    $hasNumbers = preg_match('/\d/',$pass);

    if(!($hasLowerCase && $hasUpperCase && $hasNumbers))
    {
        $error = isset($error) ? $error : ''.' '.'Your password must contain small and capital letters and a number.';
        return;
    }
    
    $pass = hash($hashalgorithm,$pass);
    
   
    $query = "INSERT INTO user(nev, email, jelszo) VALUES('".$nev."','".$email."','".$pass."');";
    mysqli_query($link, $query);
    mysqli_close($link);
    header('Location: login.php?error=Succesfully registered.');
}
    

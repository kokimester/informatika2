<?php 
// usage: $newpassword = generatePassword(12); // for a 12-char password, upper/lower/numbers.
// functions that use rand() or mt_rand() are not secure according to the PHP manual.

function getRandomBytes($nbBytes = 32)
{
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if (false !== $bytes && true === $strong) {
        return $bytes;
    }
    else {
        throw new Exception("Unable to generate secure token from OpenSSL.");
    }
}

function generatePassword($length){
    return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
}

include_once 'db.php';
$link = opendb();

    if(
        isset($_POST['email'])
        )
    {
    $hashalgorithm = 'md5';
    $email = mysqli_real_escape_string($link,$_POST['email']);
    
    $query = "SELECT * FROM user WHERE email = '".$email."';";
    $eredmeny = mysqli_query($link,$query);
    if($user = mysqli_fetch_assoc($eredmeny))
    {
        $password = generatePassword(12);
        $hasUpperCase = preg_match('/[A-Z]/',$password);
        $hasLowerCase = preg_match('/[a-z]/',$password);
        $hasNumbers = preg_match('/\d/',$password);
    
        $userid = $user['id'];
        $newpass = hash($hashalgorithm,$password);
        $update = "UPDATE user SET jelszo = '".$newpass."' WHERE user.id = '".$userid."';";
        mysqli_query($link,$update);
        $error = "Your new password is: ".$password;
    }
    else{
    $error="User not found.";
    return;
    }
        mysqli_close($link);
    }

    ?>
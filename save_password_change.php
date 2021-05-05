<?php 

include_once 'check_if_logged_in.php';

if(isset($_POST['ezvajonmirejo']) &&
isset($_POST['inputOldPassword']) &&
isset($_POST['inputNewPassword1']) &&
isset($_POST['inputNewPassword2'])
)
{

    $id = $_POST['ezvajonmirejo'];
    $hashalgorithm = 'md5';
    $pass = $user['jelszo'];
    $inOldPass = $_POST['inputOldPassword'];
    $inNewPass1 = $_POST['inputNewPassword1'];
    $inNewPass2 = $_POST['inputNewPassword2'];

    $inOldPassHash = hash($hashalgorithm,$inOldPass);

    if($pass !== $inOldPassHash)
    {
        $error = (isset($error) ? $error : '').' '.'Old password wrong, try again.';
        return;
    }
    if($inNewPass1 !== $inNewPass2)
    {
        $error = isset($error) ? $error : ''.' '.'Your passwords must match.';
        return;
    }
    if(strlen($inNewPass1) < 8)
    {
        $error = isset($error) ? $error : ''.' '.'Your password must be at least 8 characters long.';
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

    $query = "UPDATE user SET jelszo = '$pass' WHERE id=$id";
    mysqli_query($link, $query);
    mysqli_close($link);
    header('Location: profile.php');
}
?>
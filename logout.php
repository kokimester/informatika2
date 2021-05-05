<?php 
session_start();

if( (isset($_SESSION) && (isset($_SESSION['belepve'])) && ($_SESSION['belepve'] === true) ) )
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy(); 
    header('Location: index.php');
}
else
{
    header('Location: index.php?error=You need to login to logout!');
}

?>
<?php 
session_start();

if( (isset($_SESSION) && (isset($_SESSION['belepve'])) && ($_SESSION['belepve'] === true) ) )
{
    session_unset();
    session_destroy(); 
    header('Location: index.php');
}
else
{
    header('Location: index.php?error=You need to login to logout!');
}

?>
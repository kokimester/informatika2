<?php 
    if( !(isset($_SESSION) && (isset($_SESSION['belepve'])) && ($_SESSION['belepve'] === true) ) )
    {
        header('Location: index.php?error=Please log in.');
    }
?>
<?php
include 'header.php';
include 'menu.php';
include 'db.php';
$link = opendb();

if( ($_SESSION['admin'] !== true)  )
{
    header('Location: index.php?error=For admins only.');
    exit;
}

if(!isset($_GET['user']))
{
    header('Location: admin.php?error=User not found.');
    mysqli_close($link);
}
$userid = $_GET['user'];

$meccsek = mysqli_query($link, "SELECT * FROM merkozes WHERE player_1_id = '$userid' OR player_2_id = '$userid'");
if(mysqli_num_rows($meccsek) > 0)
{
    header('Location: admin.php?error=This user still has matches.');
    exit;
}
mysqli_query($link, "DELETE FROM user WHERE id = '$userid'");

header('Location: admin.php?error=User deleted.');
exit;
?>
<?php

$sList = $_POST['selfList'];
$sShotDown = $_POSTp['selfShotDown'];
$oShotDown = $_POST['opponentShotDown'];

if($sShotDown > 200 || $oShotDown > 200)
{
    echo 'error cannot save match with more than 200 points';
}


?>
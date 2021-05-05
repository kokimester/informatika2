<?php
$pagetitle = "Edit match";
include 'header.php';
include 'menu.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';
?>

<?php
$user['id'] = $_SESSION['userid'];
$query = "SELECT * FROM user WHERE user.id = ".$user['id']." LIMIT 0, 1";
$eredmeny = mysqli_query($link, $query);
$user = mysqli_fetch_array($eredmeny);
if (!$user) {
    header("Location: index.php?error=no_user_found");
    mysqli_close($link);
}
if(!isset($_GET['match']))
{
    header('Location: pending_matches.php?error=Match not found.');
    mysqli_close($link);
}
$matchid = $_GET['match'];

include 'update_match.php';

if(isset($error)){
    echo "<script>alert('".$error."')</script>";
   }
?>



<div class="container align-self-center">
    <div class="row text-white">
        <div class="col-12">
        
            <h2 class="text-white"><?= (isset($foundOpponent)) ? $foundOpponent : '' ?> </h2>
            <form method="POST">
                <table class="card table table-striped table-borderless bg-secondary text-white align-middle text-center">
                    <tr class="text-white">
                        <th class="col-2">
                            Player 1
                        </th>
                        <th class="col-2">
                            List
                        </th>
                        <th class="col-1">
                            Points shot down
                        </th>
                        <th class="col-1 text-center">
                            VS.
                        </th>
                        <th class="col-1">
                            Points shot down
                        </th>
                        <th class="col-2">
                            List
                        </th>
                        <th class="col-2">
                            Player 2
                        </th>
                    </tr>
                    <tr>

                        <td>
                            <?php echo $player1['nev']; ?>
                        </td>
                        <td>
                        <a <?= $user['id'] == $player1['id'] ? "hidden" : "" ?> >Only your opponent can edit this.</a>
                            <input <?= $user['id'] != $player1['id'] ? "hidden" : "" ?> type="text" class="form-control" name="player1list" id="player1list" value="<?= $match['player_1_list'] ?>"/>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="player1points" id="player1points" value="<?= $match['player_1_points'] ?>"/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="player2points" id="player2points" value="<?= $match['player_2_points'] ?>"/>
                        </td>
                        <td>
                            <a <?= $user['id'] == $player2['id'] ? "hidden" : "" ?>>Only your opponent can edit this.</a>
                            <input <?= $user['id'] != $player2['id'] ? "hidden" : "" ?> type="text" class="form-control" name="player2list" id="player2list" value="<?= $match['player_2_list'] ?>"/>
                        </td>
                        <td>
                            <?php echo $player2['nev']; ?>
                        </td>
                    </tr>
                </table>

        </div>
    </div>
</div>

<div class="container">
    <div class="row text-center">
        <div class="col-12 align-self-center">
            <input type="submit" class="btn btn-lg btn-success" href="pending_matches.php" value="Save" />

            <a class="btn btn-lg btn-danger" href='mymatches.php'> Cancel</a>
        </div>
    </div>
</div>
</form>



<?php
include 'footer.php';
?>
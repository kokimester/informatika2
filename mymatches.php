<?php
$pagetitle = 'My matches';
include 'header.php';
include 'menu.php';
include 'calculate_elo.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';
?>

<?php


$user['id'] = $_SESSION['userid'];

$query = "SELECT * FROM merkozes WHERE (merkozes.player_1_id = '".$user['id']."' OR merkozes.player_2_id = '".$user['id']."');";
$eredmeny = mysqli_query($link, $query);

if(isset($_GET['error'])){
 echo "<script>alert('".$_GET['error']."')</script>";
}
?>

<div class="container p-2">
    <div class="row text-center">
        <div class="col-12">
            <form><a class="btn btn-lg btn-success" href="new_match.php" role="button"><i class="fas fa-plus-circle"></i> Add new match</a></form>
        </div>
    </div>
</div>

<div class="container align-self-center p-1">
    <div class="row text-black-50 justify-content-md-center">
        <div class="col-12">
            <table class="card table table-striped table-bordered bg-light align-middle text-center">
                <tr>
                    <th class="col-2">
                        Player 1
                    </th>
                    <th class="col-1">
                        ELO change
                    </th>
                    <th class="col-1">
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
                    <th class="col-1">
                        List
                    </th>
                    <th class="col-1">
                        ELO change
                    </th>
                    <th class="col-2">
                        Player 2
                    </th>
                </tr>

                <?php while ($row = mysqli_fetch_array($eredmeny)) : ?>

                    <?php
                    $query = "SELECT * FROM user WHERE user.id = " . $row['player_1_id'] . " LIMIT 0, 1";
                    $res = mysqli_query($link, $query);
                    $player1 = mysqli_fetch_array($res);
                    if (!$player1) {
                        header("Location: index.php?error=no_user_found");
                        mysqli_close($link);
                    }
                    $query = "SELECT * FROM user WHERE user.id = " . $row['player_2_id'] . " LIMIT 0, 1";
                    $res = mysqli_query($link, $query);
                    $player2 = mysqli_fetch_array($res);
                    if (!$player2) {
                        header("Location: index.php?error=no_user_found");
                        mysqli_close($link);
                    }

                    $winner = (($row['player_1_points'] > $row['player_2_points']) ?  $player1   :   $player2);
                    $loser = (($row['player_1_points'] > $row['player_2_points']) ?  $player2   :   $player1);

                    //$ret = EloRating($self['elo'], $opponent['elo'], 30, (($winner === $self) ? 1 : 2));
                    //$points_change = round($ret[2], 1);
                    $points_change = $row['elo_change'];
                    ?>
                    <tr>
                        <td>
                            <a class="btn btn-primary" 
                            href=<?= "profile.php?user=".$row['player_1_id'] ?> > <?= $player1['nev'] ?> </a>
                        </td>
                        <td>
                            <?php echo ($player1 === $winner ? "+" : "-") . $points_change; ?>
                        </td>
                        <td>
                            <?php if (isset($row['player_1_list']) && !empty($row['player_1_list'])) {

                                echo "<a href=" . $row['player_1_list'] . "> Link </a>";
                            } else {
                                echo '<a>List not found</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $row['player_1_points']; ?>
                        </td>
                        <td>
                            <a class="<?=($winner['id'] == $user['id'] ? "btn btn-success" : "btn btn-danger")?>" ><?=  ($winner['id'] == $user['id'] ? 'Win' : 'Lose') ?></a>
                            <br>
                            <?= ($row['player_1_confirmed'] && $row['player_2_confirmed']) ? '' : 'Awaiting confirmation'?>
                        </td>
                        <td>
                            <?php echo $row['player_2_points']; ?>
                        </td>
                        <td>
                            <?php if (isset($row['player_2_list']) && !empty($row['player_2_list'])) {

                                echo "<a href=".$row['player_2_list']."> Link </a>";
                            } else {
                                echo '<a>List not found</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo ($player2 === $winner ? "+" : "-") . $points_change; ?>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-primary" href="<?="profile.php?user=". $player2['id'] ?>"> <?= $player2['nev'] ?> </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>

<?php
mysqli_close($link);
include 'footer.php';
?>
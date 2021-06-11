<?php
$pagetitle = 'Pending matches';
include 'header.php';
include 'menu.php';
include 'calculate_elo.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';

if (($_SESSION['admin'] !== true)) {
    header('Location: index.php?error=For admins only.');
}

?>

<?php

$_SESSION['change_elo'] = true;
$user['id'] = $_SESSION['userid'];

if (isset($_POST['searchBy'])) {
    $searchBy = mysqli_real_escape_string($link, $_POST['searchBy']);
    $userquery = "SELECT * FROM user WHERE nev like '%$searchBy%';";
    $subquery = mysqli_query($link, "SELECT * FROM user WHERE nev like '%$searchBy%';");
    if ($searchForUser = mysqli_fetch_assoc($subquery)) {
        $query = "SELECT * FROM merkozes WHERE (player_1_id = '" . $searchForUser['id'] . "' OR player_2_id = '" . $searchForUser['id'] . "')
                                            AND player_1_confirmed = '1' AND player_2_confirmed = '1'";
    } else {
        header('Location: admin.php?error=No such user.');
    }
} else {
    $userquery = "SELECT * FROM user";
    $query = "SELECT * FROM merkozes WHERE player_1_confirmed = '1' AND player_2_confirmed = '1'";
}

$eredmeny = mysqli_query($link, $query);
$userek = mysqli_query($link, $userquery);

if (isset($_GET['error'])) {
    echo "<script>alert('" . $_GET['error'] . "')</script>";
}
?>


<div class="container align-self-center">
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
                    <th class="col-2">
                        &nbsp;
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

                    $points_change = $row['elo_change'];
                    ?>
                    <tr>
                        <td>
                            <a class="btn btn-primary" href=<?= "profile.php?user=" . $row['player_1_id'] ?>> <?= $player1['nev'] ?> </a>
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
                        </td>
                        <td>
                            <?php echo $row['player_2_points']; ?>
                        </td>
                        <td>
                            <?php if (isset($row['player_2_list']) && !empty($row['player_2_list'])) {

                                echo "<a href=" . $row['player_2_list'] . "> Link </a>";
                            } else {
                                echo '<a>List not found</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo ($player2 === $winner ? "+" : "-") . $points_change; ?>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-primary" href="<?= "profile.php?user=" . $player2['id'] ?>"> <?= $player2['nev'] ?> </a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="<?= "delete_match.php?match=" . $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this match?');"> Delete </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row text-black-50 justify-content-md-center">
        <div class="col-6">
            <table class="table table-striped table-bordered bg-light align-middle text-center">
                <tr>
                    <th class="col-6">
                        User name
                    </th>
                    <th class="col-6">
                        &nbsp;
                    </th>
                </tr>
                <?php while ($egyuser = mysqli_fetch_array($userek)) : ?>
                    <tr>
                        <td class="col-6">
                            <?= $egyuser['nev'] ?>
                        </td>
                        <td class="col-6">
                            <a class="btn btn-danger" href="<?= "delete_user.php?user=" . $egyuser['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');"> Delete user </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <div class="col-6">

            <h3 class="text-white">Search for a player</h3>
            <form method="POST">
                <input type="text" class="form-control" id="searchBy" name="searchBy">
                <input type="submit" class="btn-lg btn-primary mb-1 mt-2" value="Search" />
            </form>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(function() {
        $("#searchBy").autocomplete({
            source: 'quick_db_search.php',
        });
    });
</script>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>




<?php
include 'footer.php';
?>
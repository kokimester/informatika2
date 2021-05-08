<?php
include 'header.php';
include 'menu.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';
?>

<?php
$userid = $_SESSION['userid'];
$query = "SELECT * FROM user WHERE user.id = $userid LIMIT 0, 1";
$eredmeny = mysqli_query($link, $query);
$user = mysqli_fetch_array($eredmeny);
if (!$user) {
    header("Location: index.php?error=no_user_found");
    mysqli_close($link);
}
include 'calculate_elo.php';
include 'save_new_match.php';

if(isset($_GET['error'])){
    echo "<script>alert('".$_GET['error']."')</script>";
   }
if(isset($_GET['selfPoints']) && isset($_GET['opponentPoints'])){
    $opponentPoints = $_GET['opponentPoints'];
    $selfPoints = $_GET['selfPoints'];
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
                            <?php echo $user['nev']; ?>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="selfList" id="selfList" />
                        </td>
                        <td>
                            <input type="number" class="form-control" name="selfShotDown" id="selfShotDown" value="<?= isset($selfPoints) ? $selfPoints : '' ?>" required/>
                        </td>
                        <td>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="opponentShotDown" id="opponentShotDown" value="<?= isset($opponentPoints) ?$opponentPoints : ''?>" required/>
                        </td>
                        <td>
                            Only your opponent can edit this.
                        </td>
                        <td>
                            <input type="text" class="form-control" name="opponentName" id="opponentName" required/>
                        </td>
                    </tr>
                </table>

        </div>
    </div>
</div>

<div class="container">
    <div class="row text-center">
        <div class="col-12 align-self-center">
            <input type="submit" class="btn btn-lg btn-success" href="mymatches.php" value="Save" />

            <a class="btn btn-lg btn-danger" href='mymatches.php'> Cancel</a>
        </div>
    </div>
</div>
</form>


<script type="text/javascript">
  $(function() {
     $( "#opponentName" ).autocomplete({
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
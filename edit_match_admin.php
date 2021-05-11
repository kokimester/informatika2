<?php
$pagetitle = "Edit match";
include 'header.php';
include 'menu.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';

if( ($_SESSION['admin'] !== true)  )
    {
        header('Location: index.php?error=For admins only.');
    }
?>

<?php

if(!isset($_GET['match']))
{
    header('Location: admin.php?error=Match not found.');
    mysqli_close($link);
}
$matchid = mysqli_real_escape_string($link,$_GET['match']);

include 'save_match_admin.php';

if(isset($_GET['error'])){
    echo "<script>alert('".$_GET['error']."')</script>";
   }
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
                        <input type="text" class="form-control" name="player1name" id="player1name" value="<?= $player1['nev'] ?>" />
                       </td>
                        <td>
                            <input type="text" class="form-control" name="player1list" id="player1list" value="<?= $match['player_1_list'] ?>"/>
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
                            <input type="text" class="form-control" name="player2list" id="player2list" value="<?= $match['player_2_list'] ?>"/>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="player2name" id="player2name" value="<?= $player2['nev'] ?>"/>
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


<script type="text/javascript">
  $(function() {
     $( "#player1name" ).autocomplete({
       source: 'quick_db_search.php',
     });
  });
</script>

<script type="text/javascript">
  $(function() {
     $( "#player2name" ).autocomplete({
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
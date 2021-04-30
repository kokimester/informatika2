<?php
 error_reporting ( E_ALL );
 ini_set("display_errors", 1);
include 'header.php';
include 'menu.php';
include 'db.php';
?>

<?php
$dummy['name'] = 'Minta Janos';
$dummy['elo'] = 1500;
$dummy['match_count'] = 0;
?>
<div class="container">
    <div class="row text-black-50">
        <div class="col-9">
            <table class="table table-striped table-bordered bg-light">
                <tr>
                    <th>
                        Player name
                    </th>
                    <th>
                        ELO points
                    </th>
                    <th>
                        Match count
                    </th>
                    <th>
                        &nbsp;
                    </th>

                </tr>
                <!--  foreach resz-->
                <tr>
                    <td>
                        <?php echo $dummy['name'];
                        ?>
                    </td>
                    <td>
                        <?php echo $dummy['elo'];
                        ?>
                    <td>
                        <?php echo $dummy['match_count'];
                        ?>
                        </th>
                        <td class="col-3">
                        <button class="btn btn-sml btn-primary" href="profil.php">Check <?php echo $dummy['name']; ?>'s profile</button>
                        </td>
                </tr>
            </table>
        </div>

        <div class="col-3">
            <!--
          <h1 class="text-white">Search for a player</h1>
          <form method="POST">
            <input type="text" class="form-control" id="searchBy" name="searchBy">
            <input type="submit" class="btn-lg btn-primary mb-1 mt-2" value="Search"/>
          </form>
           -->
        </div>
    </div>
</div>

<?php 
    include 'footer.php';
?>
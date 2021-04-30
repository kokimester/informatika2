<?php
include 'header.php';
include 'menu.php';
?>

<?php
$self['name'] = 'Minta Janos';

?>



<div class="container align-self-center">
    <div class="row text-white">
        <div class="col-12">
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
                            <?php echo $self['name']; ?>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="selfList" id="selfList" />
                        </td>
                        <td>
                            <input type="number" class="form-control" name="selfShotDown" id="selfShotDown" />
                        </td>
                        <td>
                        </td>
                        <td>
                        <input type="number" class="form-control" name="opponentShotDown" id="opponentShotDown" /> 
                        </td>
                        <td>
                            Only your opponent can edit this.
                        </td>
                        <td>
                            <input type="text" class="form-control" name="opponentName" id="opponentName" />
                        </td>
                    </tr>
                </table>
            </form>
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



<?php
include 'footer.php';
?>
<?php
include 'header.php';
include 'menu.php';
include 'calculate_elo.php';
?>

<?php
$self['name'] = 'Minta Janos';
$self['elo'] = 1200;
$self['list'] = 'https://raithos.github.io/?f=Rebel%20Alliance&d=v8ZsZ200Z451XWW101WY463XWW99WY43XWW77W52W314WWW&sn=Lando%27s%20Hoes&obs=';
$self['shot-down'] = 123;

$opponent['name'] = 'Luke Skywalker';
$opponent['elo'] = 1000;
$opponent['shot-down'] = 145;

$winner = (($self['shot-down'] > $opponent['shot-down']) ?  $self   :   $opponent   );




$ret = EloRating($self['elo'],$opponent['elo'], 30, (($winner === $self) ? 1:2));
$points_change = round($ret[2],1);


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
                        Elo
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
                        Elo
                    </th>
                    <th class="col-2">
                        Player 2
                    </th>
                </tr>
                <!-- FOREACH IDE -->
                <tr>

                    <td>
                        <?php echo $self['name']; ?>
                    </td>
                    <td>
                        <?php echo $self['elo'] . (($winner === $self) ? " +" . $points_change : " -" . $points_change); ?>
                    </td>
                    <td>
                        <?php if (isset($self['list'])) {

                            echo "<a href=".$self['list']."> Link </a>";
                        } else {
                            echo '<a>List not found</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $self['shot-down'];?>
                    </td>
                    <td>
                    <?php echo (($winner === $self) ? "Win - Lose" : "Lose - Win"); ?>
                    </td>
                    <td>
                        <?php echo $opponent['shot-down'];?>
                    </td>
                    <td>
                        <?php if (isset($opponent['list'])) {

                            echo `<a href={$opponent['list']}> Link </a>`;
                        } else {
                            echo '<a>List not found</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $opponent['elo'] . (($winner === $opponent) ? " +" . $points_change : " -" . $points_change); ?>
                    </td>
                    <td class="text-right">
                        <?php echo $opponent['name']; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


<div class="container">
    <div class="row text-center">
        <div class="col-12">
            <form><a class="btn btn-lg btn-success" href="new_match.php" role="button"><i class="fas fa-plus-circle"></i> Add new match</a></form>
        </div>
    </div>
</div>

<?php 
    include 'footer.php';
?>
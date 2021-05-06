<?php
include 'header.php';
include 'menu.php';
include 'db.php';
init_db();
?>

<?php


$link = opendb();
if(!isset($_POST['searchBy'])){
$query = "SELECT sub3.id, sub3.nev,sub3.discordid, sub3.elo, sum(sub3.win) as 'win', sum(sub3.lose) as 'lose' from (
    (select mind.id, mind.nev,mind.discordid, mind.elo, 0 as 'win', 0 as 'lose' from user as mind) UNION
    (select sub1.id, sub1.nev,sub1.discordid, sub1.elo, sum(sub1.win) as 'win', 0 as 'lose' from (
    select user.id, nev,discordid, elo, count(user.id) as 'win'
    from user 
    left outer join merkozes as mk on mk.player_1_id = user.id
    where mk.player_1_points > mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id
    UNION
    select user.id, nev,discordid, elo, count(user.id) as 'win'
    from user 
    left outer join merkozes as mk on mk.player_2_id = user.id
    where mk.player_1_points < mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id) as sub1
    group by sub1.id)
    UNION
    (select sub2.id, sub2.nev,sub2.discordid, sub2.elo,0 as 'win', sum(sub2.lose) as 'lose' from (
    select user.id, nev,discordid, elo, count(user.id) as 'lose'
    from user 
    left outer join merkozes as mk on mk.player_1_id = user.id
    where mk.player_1_points < mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id
    UNION
    select user.id, nev,discordid, elo, count(user.id) as 'lose'
    from user 
    left outer join merkozes as mk on mk.player_2_id = user.id
    where mk.player_1_points > mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id) as sub2
    group by sub2.id)
    ) as sub3
    group by sub3.id
    order by sub3.elo desc;";
}
else{
$searchBy = mysqli_real_escape_string($link,$_POST['searchBy']);

$searchByName="sub3.nev";
$searchByDiscord="sub3.discordid";

$criteria = (strpos($searchBy,'#') === false ? $searchByName : $searchByDiscord);

$query = "SELECT sub3.id, sub3.nev,sub3.discordid, sub3.elo, sum(sub3.win) as 'win', sum(sub3.lose) as 'lose' from (
    (select mind.id, mind.nev,mind.discordid, mind.elo, 0 as 'win', 0 as 'lose' from user as mind) UNION
    (select sub1.id, sub1.nev,sub1.discordid, sub1.elo, sum(sub1.win) as 'win', 0 as 'lose' from (
    select user.id, nev,discordid, elo, count(user.id) as 'win'
    from user 
    left outer join merkozes as mk on mk.player_1_id = user.id
    where mk.player_1_points > mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id
    UNION
    select user.id, nev,discordid, elo, count(user.id) as 'win'
    from user 
    left outer join merkozes as mk on mk.player_2_id = user.id
    where mk.player_1_points < mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id) as sub1
    group by sub1.id)
    UNION
    (select sub2.id, sub2.nev,sub2.discordid, sub2.elo,0 as 'win', sum(sub2.lose) as 'lose' from (
    select user.id, nev,discordid, elo, count(user.id) as 'lose'
    from user 
    left outer join merkozes as mk on mk.player_1_id = user.id
    where mk.player_1_points < mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id
    UNION
    select user.id, nev,discordid, elo, count(user.id) as 'lose'
    from user 
    left outer join merkozes as mk on mk.player_2_id = user.id
    where mk.player_1_points > mk.player_2_points  and mk.player_1_confirmed = '1' and mk.player_2_confirmed = '1'
    group by user.id) as sub2
    group by sub2.id)
    ) as sub3 
    where ".$criteria." like '%$searchBy%'
    group by sub3.id
    order by sub3.elo desc;";
}
$eredmeny = mysqli_query($link, $query);
print_r($eredmeny);

if(isset($_GET['error'])){
    echo "<script>alert('".$_GET['error']."')</script>";
   }

?>
<div class="container">
    <div class="row text-black-50">
        <div class="col-9">
            <table class="card table rounded table-striped table-bordered bg-light align-middle text-center">
                <tr>
                    <th>
                        Player name
                    </th>
                    <th>
                        ELO points
                    </th>
                    <th class="col-2">
                        Win/Lose
                    </th>
                    <th class="col-2">
                        &nbsp;
                    </th>
                </tr>
                <?php while ($row = mysqli_fetch_array($eredmeny)) : ?>
                    <tr>
                        <td> <?= $row['nev'] ?></td>
                        <td> <?= $row['elo'] ?></td>
                        <td> <?= $row['win'].'/'.$row['lose']; ?> </td>
                        <td> 
                        <a class="btn btn-sml btn-primary" href=<?='profile.php?user='.$row['id']?>>Check <?php echo $row['nev']; ?>'s profile</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>

        <div class="col-3">
            
          <h3 class="text-white">Search for a player</h3>
          <form method="POST">
            <input type="text" class="form-control" id="searchBy" name="searchBy">
            <input type="submit" class="btn-lg btn-primary mb-1 mt-2" value="Search"/>
          </form>
           
        </div>
    </div>
</div>

<?php
mysqli_close($link);
include 'footer.php';
?>
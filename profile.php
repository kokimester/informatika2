<?php 
$pagetitle = 'My profile';
    include 'header.php';
    include 'menu.php';
    include 'db.php';
    $link = opendb();
?>

<?php 

if(isset($_GET['user'])){
$userid = $_GET['user'];
}
else{
  
  include_once 'check_if_logged_in.php';
  $userid = $_SESSION['userid'];
}
$query = "SELECT * FROM user WHERE user.id = $userid LIMIT 0, 1";
$eredmeny = mysqli_query($link, $query);
$user = mysqli_fetch_array($eredmeny);
if(!$user)
{
  header("Location: index.php?error=no_user_found");
  mysqli_close($link);
}


$showEdit = ( isset($_SESSION['userid']) &&($userid == $_SESSION['userid']) ? true : false) ;

?>
    <div class="container">
      <div class="row text-black-50">
        <div class="col-9">
          <table class="table table-striped table-borderless bg-transparent align-middle text-center">
            <tr >
              <th class="col-3">
                <h2 class="text-white">User data</h2>
              </th>
            </tr>
            <tr>
              <th class="bg-white">
                Name
              </th>
              <th>
                &nbsp;
              </th>
              <th class="bg-white col-3">
                Email
              </th>
              <th>
                &nbsp;
              </th>
              <th class="bg-white">
                Discord
              </th>
              <th>
                &nbsp;
              </th>
              <th class="bg-white">
                Steam
              </th>
              <th>
                &nbsp;
              </th>
              <th class="bg-white">
                ELO points
              </th>
              

            </tr>
            <tr>
              <td class="bg-white">
                <?php echo $user['nev']?>
              </td>
              <td>

              </td>
              <td class="bg-white">
                <?php echo $user['email'];?>
              </td>
              <td>

              </td>
              <td class="bg-white">
                <?php echo ( isset($user['discordid']) ? $user['discordid'] : 'Please provide your Discord ID');?>
              </td>
              <td>

              </td>
              <td class="bg-white">
                <?php echo ( isset($user['steamid']) ? $user['steamid'] : 'Please provide your Steam ID');?>
              </td>
              <td>

              </td>
              <td class="bg-white">
                <?php echo $user['elo'];?>
              </td>
            </tr>
            <tr>
            <?= ($showEdit) ? ('<td> <a class="btn btn-lg btn-success" href="profile_edit.php"> Edit data</a> </td> ') : ''
            ?>
            </tr>
          </table>
        </div>
      </div>
    </div>
    

    <?php 
    mysqli_close($link);
    include 'footer.php';
    ?>
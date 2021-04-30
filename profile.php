<?php 
    include 'header.php';
    include 'menu.php';
    include 'db.php';
?>

<?php 

$user['name'] = 'Minta Janos';
$user['email'] = 'mintajanos@freemail.hu';
?>
    <div class="container">
      <div class="row text-black-50">
        <div class="col-6">
          <table class="table table-striped table-borderless">
            <tr>
              <th>
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
              <th class="bg-white">
                Email
              </th>
              <th>
                &nbsp;
              </th>

            </tr>
            <tr>
              <td class="bg-white">
                <?php echo $user['name']?>
              </td>
              <td>

              </td>
              <td class="bg-white">
                <?php echo $user['email'];?>
              </td>
              <td>

              </td>
            </tr>
            <tr>
              <td>
                <a class="btn btn-success" href="profile_edit.php"> Edit data</a>>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    

    <?php include 'footer.php';?>
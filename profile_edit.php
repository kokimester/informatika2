<?php 
    include 'header.php';
    include 'menu.php'
?>

<?php 
    $user['id'] = 'xd';
    $user['name'] = 'Minta Janos';
    $user['email'] = 'jancsi@freemail.hu';

?>

        <div class="container">
            <div class="row text-black-50">
                <div class="col-6">
                    <form method="POST" >
                        <input type="hidden" name="ezvajonmirejo" value="<?= $user['id'] ?>"/>
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
                                    E-mail address
                                </th>
                                <th>
                                    &nbsp;
                                </th>

                            </tr>
                            <tr>
                                <div class="form-group">
                                    <td class="bg-white">
                                        <input type="text" class="form-control" id="name" name="name" 
                                        value='<?= $user['name'] ?>'>
                                      
                                    </td>
                                </div>
                                <td>

                                </td>
                                <div class="form-group">
                                    <td class="bg-white">
                                        <input type="text" class="form-control" id="phone" name="phone" 
                                        value='<?= $user['email'] ?>'>
                                        
                                    </td>
                                </div>
                                <td>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="btn btn-success" href='profile.php'
                                    value="Save changes"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a class="btn btn-danger" href='profile.php'> Cancel </a>>
                                </td>
                            </tr>
                        </table>
                        
                    </form>
                </div>
                <div class="col-6">
                    <br><br><br>
                    <h2 class="text-white"><?= (!isset($error)) ? '' : $error ?> </h2>
                </div>
            </div>
        </div>

        <br><br><br><br><br><br>

        <div class="container">
          <div class="row text-black-50">
            <div class="col-3">
              <table class="table table-borderless">
                <tr>
                  <th>
                    <h2 class="text-white">Change password</h2>
                  </th>
                </tr>
    
                <td class="bg-light">
                  <form method="POST">
                    <label for="inputOldPassword1" class="form-label mt-1">Old password</label>
                    <input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control mb-2" placeholder="Old password">
    
    
                    <label for="inputNewPassword1" class="form-label mt-1">New password</label>
                    <input type="password" id="inputNewPassword1" name="inputNewPassword1" class="form-control" placeholder="New password">
    
    
    
                    <label for="inputNewPassword2" class="form-label mt-2">New password again</label>
                    <input type="password" id="inputNewPassword2" name="inputNewPassword2" class="form-control mb-2"
                      placeholder="New password again" aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text m-auto p-1">
                        The password must contain at least 8 characters, small and capital letters and a number.
                    </div>
    
    
    
                    <input type="submit" class="btn btn-danger mt-2" href='profile.php' value="Save changed password"/>
                  </form>
                </td>
    
              </table>
            </div>
          </div>
        </div>

<?php 
    include 'footer.php';
?>
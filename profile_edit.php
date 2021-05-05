<?php
$pagetitle = 'Profile edit';
include 'header.php';
include 'menu.php';
include 'db.php';
$link = opendb();
include_once 'check_if_logged_in.php';
?>

<?php

// sessionbol kell majd lekerni
$userid = $_SESSION['userid'];


$query = "SELECT * FROM user WHERE user.id = $userid LIMIT 0, 1";
$eredmeny = mysqli_query($link, $query);
$user = mysqli_fetch_array($eredmeny);
if (!$user) {
    header("Location: index.php?error=no_user_found");
    mysqli_close($link);
}

include 'save_profile_changes.php';
include 'save_password_change.php';
?>
<div class="container">
    <div class="row text-black-50">
        <div class="col-9">
            <form method="POST">
                <input type="hidden" name="ezvajonmirejo" value="<?= $userid ?>"/>
                <table class="table table-striped table-borderless align-middle text-center">
                    <tr>
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
                            E-mail address
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th class="bg-white">
                            Discord ID
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th class="bg-white">
                            Steam ID
                        </th>
                        <th>
                            &nbsp;
                        </th>
                        <th class="bg-white">
                            ELO points(non-editable)
                        </th>

                    </tr>
                    <tr>
                        <div class="form-group">
                            <td class="bg-white">
                                <input type="text" class="form-control" id="nev" name="nev" value='<?= $user['nev'] ?>'>

                            </td>
                        </div>
                        <td>

                        </td>
                        <div class="form-group">
                            <td class="bg-white">
                                <input type="text" class="form-control" id="email" name="email" value='<?= $user['email'] ?>'>

                            </td>
                        </div>
                        <td>

                        </td>
                        </td>
                        <div class="form-group">
                            <td class="bg-white">
                                <input type="text" class="form-control" id="discordid" name="discordid" 
                                value='<?=  (isset($user['discordid']) ? $user['discordid'] : '') ?>'>

                            </td>
                        </div>
                        <td>

                        </td>
                        </td>
                        <div class="form-group">
                            <td class="bg-white">
                                <input type="text" class="form-control" id="steamid" name="steamid"
                                value='<?=  isset($user['steamid']) ? $user['steamid'] : '' ?>'>

                            </td>
                        </div>
                        <td>

                        </td>
                        <td class="bg-white">
                            <?php echo $user['elo'];?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-success" href='profile.php' value="Save changes" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a class="btn btn-danger" href='profile.php'> Cancel </a>
                        </td>
                    </tr>
                </table>

            </form>
        </div>
        <div class="col-6">
            <br>
            <h2 class="text-white"><?= (!isset($error)) ? '' : $error ?> </h2>
        </div>
    </div>
</div>

<br>

<div class="container">
    <div class="row text-black-50">
        <div class="col-3">
            <table class="card table table-borderless">
                <tr>
                    <th>
                        <h2 class="text-black">Change password</h2>
                    </th>
                </tr>

                <td class="bg-white">
                    <form method="POST">
                        <input type="hidden" name="ezvajonmirejo" value=<?= $user['id'] ?> />
                        <label for="inputOldPassword1" class="form-label mt-1">Old password</label>
                        <input type="password" id="inputOldPassword" name="inputOldPassword" class="form-control mb-2" placeholder="Old password">


                        <label for="inputNewPassword1" class="form-label mt-1">New password</label>
                        <input type="password" id="inputNewPassword1" name="inputNewPassword1" class="form-control" placeholder="New password">



                        <label for="inputNewPassword2" class="form-label mt-2">New password again</label>
                        <input type="password" id="inputNewPassword2" name="inputNewPassword2" class="form-control mb-2" placeholder="New password again" aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text m-auto p-1">
                            The password must contain at least 8 characters, small and capital letters and a number.
                        </div>



                        <input type="submit" class="btn btn-danger mt-2" href='profile.php' value="Save changed password" />
                    </form>
                </td>

            </table>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
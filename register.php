<?php 
$pagetitle = 'Register';
    include 'header.php';
    include 'menu.php';
    include 'db.php';
    $link = opendb();

    include 'save_new_user.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-6 bg-light align-self-auto m-auto mt-5 kerekitett">
                <form method="POST">
                    <div class="text-center">
                    <img class="mb-1 mt-2" src="./img/xwing_icon.png" alt="" width="230" height="70">
                    <h1><?= (isset($error)) ? $error : '' ?> </h1>
                </div>
                    <div class="mb-3">
                        <label for="name" class="form-label mt-2">Name</label>
                        <input type="text" class="form-control" id="nev" name="nev" placeholder="Max Gyula">

                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label mt-2">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="john@wick.com">

                    </div>
                    <div class="mb-3">
                        <label for="inputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="inputPassword1" name="inputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword2" class="form-label">Password again</label>
                        <input type="password" class="form-control" id="inputPassword2" name="inputPassword2" aria-describedby="passwordHelp">
                        <div id="passwordHelp" class="form-text m-auto p-1">
                        The password must contain at least 8 characters, small and capital letters and a number.
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" class="btn-lg btn-primary mb-1" value="Register"/>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-sm btn-outline-primary mb-3" href="login.php" role="button">Back to login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    mysqli_close($link);
    include 'footer.php';
?>
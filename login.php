<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
    crossorigin="anonymous">

    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
          background-image: url('./img/background.jpg');
        }
    </style>

    <link href="./css/signin.css" rel="stylesheet" type="text/css">
</head>

<?php 
    include 'check_login_info.php';
?>


<body class="text-center">
    <main class="form-signin">
        <form method="POST">
            <img class="mb-4" src="./img/xwing_icon.png" alt="" width="230" height="70">

            
            <h1 id="login-text" class="h3 mb-3 fw-normal"><?= (!isset($error)) ? 'Please log in' : $error ?></h1>

            <p class="text-dark mb-0">Not yet registered?</p>
            <a class="btn btn-lg btn-primary mb-1" href="register.php">Register</a>

            <label for="email" class="visually-hidden">Email address</label>
            <input type="email" id="email" name="email" class="form-control mt-1" placeholder="Email address" required
                autofocus>
            <label for="password" class="visually-hidden">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                required>
                <a href="forgotten.php">Forgotten password</a>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <input class="w-100 btn btn-lg btn-primary" type="submit" value="Login"/>
            <a class="btn btn-sm btn-outline-primary" href="index.php" role="button">Back to main page</a>
            <p class="mt-5 mb-3 text-muted">&copy; 2021-</p>
        </form>
    </main>
    
<?php include 'footer.php' ?>
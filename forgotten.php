<?php session_start();?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forgotten password</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" 
    crossorigin="anonymous">
    <!-- Favicons -->

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


    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
</head>

<?php include 'send_new_password.php'; ?>

<body class="text-center">

    <main class="form-signin">
        <form method="POST">
            <img class="mb-4" src="./img/xwing_icon.png" alt="" width="230" height="70">
            <h1 id="login-text" class="h3 mb-3 fw-normal"><?= (!isset($error)) ? 'Forgotten password' : $error ?> </h1>
        
            <label for="email" class="visually-hidden">Email address</label>
            <input type="email" id="email" name="email" class="form-control mt-1" placeholder="Email address" required
                autofocus>
            
            </div>
            <input type="submit" class="w-100 btn btn-lg btn-primary mt-2" value="New password"/>
            <a class="btn btn-sm btn-outline-primary" href="login.php" role="button">Back to login</a>
            <p class="mt-3 mb-3 text-muted">&copy; 2021-</p>
        </form>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>

</html>
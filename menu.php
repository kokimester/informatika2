<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">X-Wing ELO system</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="<?= ($activePage == 'index') ? 'active':''; ?> nav-link" 
                aria-current="page" href="index.php">Main page</a>
          </li>
          <li class="nav-item" <?= (isset($_SESSION) && isset($_SESSION['belepve']) && ($_SESSION['belepve'] === true)) ? '' : 'hidden' ?>>
            <a class="<?= ($activePage == 'profile') ? 'active':''; ?> nav-link"
                 aria-current="page" href="profile.php">My profile</a>
          </li>

          <li class="nav-item" <?= (isset($_SESSION) && isset($_SESSION['belepve']) && ($_SESSION['belepve'] === true)) ? '' : 'hidden' ?>>
            <a class="<?= ($activePage == 'mymatches') ? 'active':''; ?> nav-link"
                aria-current="page" href="mymatches.php">My matches</a>
          </li>
          <li class="nav-item" <?= (isset($_SESSION) && isset($_SESSION['belepve']) && ($_SESSION['belepve'] === true)) ? '' : 'hidden' ?>>
            <a class="<?= ($activePage == 'pending_matches') ? 'active':''; ?> nav-link"
                aria-current="page" href="pending_matches.php">Pending matches</a>
          </li>
          <li class="nav-item" <?= (isset($_SESSION) && isset($_SESSION['admin']) && ($_SESSION['admin'] === true)) ? '' : 'hidden' ?>>
            <a class="<?= ($activePage == 'admin') ? 'active':''; ?> nav-link"
                aria-current="page" href="admin.php">Admin</a>
          </li>
        </ul> 
        <?php if( !(isset($_SESSION) && (isset($_SESSION['belepve'])) && ($_SESSION['belepve'] === true) ) ){ 
         echo '<form><a class="btn btn-success" href="login.php" role="button">Login</a></form>';
          } else{   
         echo '<h4 class="text-white text-center mr-2 p-2"> Welcome, '.$_SESSION['nev'].'</h4><form><a class="ml-2 btn btn-danger" href="logout.php" role="button" onclick="return confirm(\'Are you sure you want to logout?\');">Logout</a></form>';
         } 

        ?>
        <!--<h1> Welcome, {$_SESSION['nev']}</h1> -->
        
      </div>
    </div>
  </nav>

   
         
  

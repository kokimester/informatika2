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
          <li class="nav-item">
            <a class="<?= ($activePage == 'profile') ? 'active':''; ?> nav-link"
                 aria-current="page" href="profile.php">My profile</a>
          </li>

          <li class="nav-item">
            <a class="<?= ($activePage == 'mymatches') ? 'active':''; ?> nav-link"
                aria-current="page" href="mymatches.php">My matches</a>
          </li>
        </ul>
        <form><a class="btn btn-success" href="login.php" role="button">Login</a></form>
        
        
      </div>
    </div>
  </nav>
<!--
  //   <% if((typeof session ==='undefined') || (typeof session.belepve === 'undefined') || (session.belepve !== true)){ %>
    //        <form><a class="btn btn-success" href="/login" role="button">Login</a></form>
      //      <% } else{ %>  
        //      <form><a class="btn btn-danger" href="/logout" role="button" onclick="return confirm('Biztos, hogy ki akarsz jelentkezni?');">Logout</a></form>
          //  <% } %>
            // -->
  

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" id="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
            <?php 
              if (isset($_SESSION['auth'])) {
                echo $_SESSION['auth_admin']['admin_username'];
              }
              else{
                echo "Not Logged In";
              } 
            ?>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <form action="code.php" method="POST">
              <button type="submit" name="logout_btn" class="dropdown-item las la-sign-out-alt">
                Logout
              </button>
            </form>
          </div>
        </div>
      </li>
      <!-- Admin Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="las la-user-circle"></i>
          <?php 
              if (isset($_SESSION['auth'])) {
                echo $_SESSION['auth_admin']['admin_username'];
              }
              else{
                echo "Not Logged In";
              } 
            ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="las la-user-circle mr-2"></i> Profile
          </a>
          <a href="#" class="dropdown-item">
            <i class="las la-user-plus mr-2"></i> Roles
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="las la-user-cog mr-2"></i> Settings
          </a>
          <form action="code.php" method="POST">
            <button type="submit" name="logout_btn" class="dropdown-item las la-sign-out-alt">Logout</button>
          </form>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
 
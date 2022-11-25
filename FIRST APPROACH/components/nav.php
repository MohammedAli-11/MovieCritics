<?php
// require_once('../database/admin.src.php');

if (!isset($_SESSION)) {
  session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- logo -->
    <a class="navbar-brand" href="http://localhost/projects/project/index.php">
      <img src="http://localhost/projects/project/images/logo.png" alt="Logo" height="50px" />
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- nav items -->
        <?php
        if (isset($_SESSION["email"])) {

          $admins = [];

          if (!in_array($_SESSION["email"], $admins)) {
            // dashboard
            // echo '<li class="nav-item">
            //         <a class="nav-link" href="http://localhost/projects/project/components/dashboard/dashboard.php">Dashboard</a>
            //       </li>';
          } else {
          }
          // dropdown
          echo sprintf('<li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hello, %s
                          </a>
                          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="left: -1.3rem;">
                            <li><a class="dropdown-item" href="http://localhost/projects/project/database/logout.src.php">Logout</a></li>
                          </ul>
                        </li>', $_SESSION['username']);
        } else {
          // about us 
          echo '<li class="nav-item">
                  <a class="nav-link" href="http://localhost/projects/project/pages/about_us.php">About us</a>
                </li>';

          // signup
          echo '<li class="nav-item">
                  <a class="nav-link" href="http://localhost/projects/project/components/auth/signup.php">Signup</a>
                </li>';

          // signin
          echo '<li class="nav-item">
                  <a class="nav-link" href="http://localhost/projects/project/components/auth/login.php">Login</a>
                </li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>

<!-- 

                            <li><a class="dropdown-item" href="http://localhost/projects/project/components/profile_edit.php">Edit Profile</a></li>


 -->
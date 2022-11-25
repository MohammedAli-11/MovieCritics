<?php

if (!isset($_SESSION)) {
  session_start();
}

?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
  <div class=" container gap-4">
    <!-- logo -->
    <a class="navbar-brand nav-logo" href="http://localhost/projects/project/index.php">
      MOVIECRITICS
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php
      if (str_contains($_SERVER['REQUEST_URI'], 'index.php')) {
      ?>
        <!-- <form class="d-flex" role="search"> -->
        <div class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search by movie name..." aria-label="Search" name="search" id="search" oninput="handleSearch(this.value)">
        </div>
        <!-- <button class="btn" style="color:white; border: 1px solid cyan;" type="submit">Search</button> -->
        <!-- </form> -->
      <?php
      }
      ?>

      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2 mt-4 mt-lg-0">
        <!-- nav items -->

        <li class="nav-item">
          <a class="nav-link" href="http://localhost/projects/project/payment/payment.php">Donate us</a>
        </li>
        <?php
        if (isset($_SESSION["email"])) {

          if ($_SESSION["type"] == "admin") {
            // post movie
            echo
            '<li class="nav-item">
              <a class="nav-link" href="http://localhost/projects/project/pages/post_movie.php">Post Movie</a>
            </li>';
          }

          if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "user") {
            // dropdown
            echo sprintf('<li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Hello, %s
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="left: -1.3rem;">
                  <li><a class="dropdown-item" href="http://localhost/projects/project/database/logout.src.php">Logout</a></li>
                </ul>
                </li>', $_SESSION['username']);
          }
        } else {
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
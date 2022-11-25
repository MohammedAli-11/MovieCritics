<!-- head -->
<?php require('../global/head.php');

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['email'])) {
?>
  <!-- login -->
  <div class="auth-wrapper d-flex flex-column justify-content-center align-items-center bg-light">
    <!-- auth logo -->
    <div class="auth-logo">
      <a href="http://localhost/projects/project/index.php">
        <img src="http://localhost/projects/project/images/logo.png" alt="Logo" height="50px" />
      </a>
    </div>
    <!-- form -->
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <h3 class="display-6 mb-4">Sign In.</h3>
      <form class="d-flex flex-column jusify-content-center" action="../../database/login.src.php" method="post">
        <!-- email -->
        <div class="mb-2">
          <label for="email" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        </div>
        <!-- password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <!-- submit button -->
        <button type="submit" name="submit" class="btn btn-success mb-2">Sign In</button>
      </form>
      <p class="text-muted">
        Not a member yet? <a href="http://localhost/projects/project/components/auth/signup.php">Sign up</a> instead.
      </p>
    </div>
    <!-- error/success messages -->
    <?php
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "wrongLoginDetails") {
        echo '<p style="color:red;font-weight:bold;">Incorrect login credentials!</p>';
      } else if ($_GET["error"] == "none") {
        echo '<p style="color:green;font-weight:bold;">Account created successfully!</p>';
      }
    }
    ?>
  </div>
<?php
} else {
  header("location: ../dashboard/dashboard.php");
  exit();
}

// foot
require('../global/foot.php') ?>
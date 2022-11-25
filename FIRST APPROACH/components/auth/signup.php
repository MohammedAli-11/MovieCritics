<!-- head -->
<?php require('../global/head.php');

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['email'])) {
?>
  <!-- signup -->
  <div class="auth-wrapper d-flex flex-column justify-content-center align-items-center bg-light">
    <!-- auth logo -->
    <div class="auth-logo">
      <a href="http://localhost/projects/project/index.php">
        <img src="http://localhost/projects/project/images/logo.png" alt="Logo" height="50px" />
      </a>
    </div>
    <!-- form -->
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <h3 class="display-6 mb-4">Create Account.</h3>
      <form class="d-flex flex-column jusify-content-center" action="../../database/signup.src.php" method="post">
        <!-- username -->
        <div class="mb-2">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" required>
        </div>
        <!-- email -->
        <div class="mb-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
        </div>
        <!-- password -->
        <div class="mb-2">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="password" required>
        </div>
        <!-- confirm password -->
        <div class="mb-3">
          <label for="password-confirmation" class="form-label">Confirm Password</label>
          <input type="password" name="confirmedPassword" class="form-control" id="password-confirmation" required>
        </div>
        <!-- submit button -->
        <button type="submit" name="submit" class="btn btn-success mb-2">Create Account</button>
      </form>
      <p class="text-muted">
        Already a member? <a href="http://localhost/projects/project/components/auth/login.php">Sign in</a> instead.
      </p>
    </div>
  <?php
} else {
  header("location: ../dashboard/dashboard.php");
  exit();
}

// error/success messages
if (isset($_GET["error"])) {
  if ($_GET["error"] == "stmtFailed") {
    echo '<p style="color:red;font-weight:bold;">Something went wrong! Please try again.</p>';
  } else if ($_GET["error"] == "userAlreadyExists") {
    echo '<p style="color:red;font-weight:bold;">User already exists!</p>';
  } else if ($_GET["error"] == "passwordsDidNotMatch") {
    echo '<p style="color:red;font-weight:bold;">Passwords did not match!</p>';
  } else if ($_GET["error"] == "none") {
    echo '<p style="color:green;font-weight:bold;">Successfully created account!</p>';
  }
}
  ?>
  </div>

  <!-- foot -->
  <?php require('../global/foot.php') ?>
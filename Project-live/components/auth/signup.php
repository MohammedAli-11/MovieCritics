<!-- head -->
<?php require('../global/head.php');

if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}

if (!isset($_SESSION['email'])) {
?>
  <!-- signup -->
  <div class="auth-wrapper d-flex flex-column justify-content-center align-items-center text-white" style="max-width: 340px; margin: 0 auto;">
    <!-- auth logo -->
    <div class="auth-logo">
      <a href="https://cse-482.000webhostapp.com/index.php" style="color: cyan; letter-spacing: 3px; font-weight: bold; font-size: 30px; font-family: 'Bangers', cursive;">
        MOVIECRITICS
      </a>
    </div>
    <!-- form -->
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <h3 class="mb-4">Create Account.</h3>
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
          <div style="display: none; color: red;" id="pass-error">Password must be at least 8 letters, with a symbol, a upper and a lower case letter and a number.</div>
        </div>
        <!-- confirm password -->
        <div class="mb-3">
          <label for="password-confirmation" class="form-label">Confirm Password</label>
          <input type="password" name="confirmedPassword" class="form-control" id="password-confirmation" required>
        </div>
        <!-- submit button -->
        <button type="submit" name="submit" class="btn mb-2" style="min-width: 150px; border: 1px solid cyan; color: white;" id="signup">Create Account</button>
      </form>
      <p class="text-white mt-2">
        Already a member? <a href="https://cse-482.000webhostapp.com/components/auth/login.php" style="color: cyan;">Sign in</a> instead.
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
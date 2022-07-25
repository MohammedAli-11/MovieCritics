<?php

require_once('./global/head.php');
require_once('./nav.php');

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['email'])) {
?>


  <!-- signup -->
  <div class="d-flex flex-column justify-content-center align-items-center mt-4">
    <!-- form -->
    <div class="container d-flex flex-column justify-content-center align-items-center">
      <h3 class="display-6 mb-4">Edit Profile</h3>
      <form class="d-flex flex-column jusify-content-center" action="../database/profile_edit.src.php" method="post">
        <!-- username -->
        <div class="mb-2">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" value="<?php echo $_SESSION['username'] ?>" required>
        </div>
        <!-- email -->
        <div class="mb-2">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?php echo $_SESSION['email'] ?>" required>
        </div>
        <!-- submit button -->
        <button type="submit" name="submit" class="btn btn-success mb-2">Update</button>
      </form>
    </div>


  <?php
} else {
  header("location: ./auth/login.php");
  exit();
}

// error/success messages
if (isset($_GET["error"])) {
  if ($_GET["error"] == "stmtFailed") {
    echo '<p style="color:red;font-weight:bold;">Something went wrong! Please try again.</p>';
  } else if ($_GET["error"] == "none") {
    echo '<p style="color:green;font-weight:bold;">Successfully updated profile!</p>';
  }
}

require_once('./global/foot.php');
  ?>
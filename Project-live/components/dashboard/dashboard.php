<?php

if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}
require_once('../global/head.php');
require_once('../nav.php');
// require_once('../../database/dashboard.src.php');

if (isset($_SESSION['email'])) {
  // if logged in
  if ($_SESSION['email']) {
?>

    <h2 class="text-center mt-3">Welcome to dashboard!</h2>

<?php
  }
  require_once('../global/foot.php');
} else {
  ob_start();
  header("location: ../auth/login.php");
  ob_end_flush();
  exit();
}
?>
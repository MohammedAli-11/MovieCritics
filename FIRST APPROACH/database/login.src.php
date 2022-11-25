<?php

if (isset($_POST["submit"])) {
  $inputEmail = $_POST["email"];
  $inputPassword = $_POST["password"];

  require_once("dbconn.src.php");
  require_once("functions.src.php");

  loginUser($conn, $inputEmail, $inputPassword);
} else {
  header("location: ../components/auth/login.php");
  exit();
}

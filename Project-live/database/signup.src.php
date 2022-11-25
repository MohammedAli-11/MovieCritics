<?php

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmedPassword = $_POST["confirmedPassword"];

  require_once("dbconn.src.php");
  require_once("functions.src.php");

  if (!isPasswordConfirmed($password, $confirmedPassword)) {
    ob_start();
    header("location: ../components/auth/signup.php?error=passwordsDidNotMatch");
    ob_end_flush();
    exit();
  }

  if (isAlreadyUser($conn, $email)) {
    ob_start();
    header("location: ../components/auth/signup.php?error=userAlreadyExists");
    ob_end_flush();
    exit();
  }

  createUser($conn, $username, $email, $password);
} else {
  ob_start();
  header("location: ../components/auth/signup.php");
  ob_end_flush();
  exit();
}

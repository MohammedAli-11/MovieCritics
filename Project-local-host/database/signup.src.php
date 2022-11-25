<?php

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmedPassword = $_POST["confirmedPassword"];

  require_once("dbconn.src.php");
  require_once("functions.src.php");

  if (!isPasswordConfirmed($password, $confirmedPassword)) {
    header("location: ../components/auth/signup.php?error=passwordsDidNotMatch");
    exit();
  }

  if (isAlreadyUser($conn, $email)) {
    header("location: ../components/auth/signup.php?error=userAlreadyExists");
    exit();
  }

  createUser($conn, $username, $email, $password);
} else {
  header("location: ../components/auth/signup.php");
  exit();
}

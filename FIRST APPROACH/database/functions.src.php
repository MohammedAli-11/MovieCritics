<?php

function isPasswordConfirmed($password, $confirmedPassword)
{
  return $password == $confirmedPassword;
}


function isAlreadyUser($conn, $email)
{
  $query = "SELECT * FROM users WHERE email = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/auth/signup.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  // die(var_dump(($row)));
  mysqli_stmt_close($stmt);
  if ($row) {
    return $row;
  }
  return false;
}


function createUser($conn, $username, $email, $password)
{
  $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/auth/signup.php?error=stmtFailed");
    exit();
  }
  // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../components/auth/login.php?error=none");
  exit();
}


function loginUser($conn, $inputEmail, $inputPassword)
{
  $isUser = isAlreadyUser($conn, $inputEmail);

  if (!$isUser) {
    header("location: ../components/auth/login.php?error=wrongLoginDetails");
    exit();
  }
  // $hashedUserPassword = $isUser["password"];
  // if (strlen($hashedUserPassword) == 60) {
  //   $passwordMatch = password_verify($inputPassword, $hashedUserPassword);
  // } else {
  //   $passwordMatch = $hashedUserPassword == $inputPassword;
  // }
  $passwordMatch = $isUser["password"] == strval($inputPassword);
  if (!$passwordMatch) {
    header("location: ../components/auth/login.php?error=wrongLoginDetails");
    exit();
  } else if ($passwordMatch) {
    if (!isset($_SESSION)) {
      session_start();
    }
    $_SESSION["id"] = $isUser["id"];
    $_SESSION["email"] = $isUser["email"];
    $_SESSION["username"] = $isUser["username"];
    // header("location: ../components/dashboard/dashboard.php");
    header("location: ../index.php");
    exit();
  }
}

function updateProfile($conn, $username, $email, $id)
{
  $query = "UPDATE users SET username = ?, email = ? WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/profile_edit.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $_SESSION["email"] = $_POST["email"];
  $_SESSION["username"] = $_POST["username"];

  header("location: ../components/profile_edit.php?error=none");
  exit();
}


function getUserInfo($conn, $uid)
{
  $query = "SELECT * FROM users WHERE id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $query)) {
    header("location: ../components/dashboard.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "i", $uid);
  mysqli_stmt_execute($stmt);
  $resultData = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($resultData);
  mysqli_stmt_close($stmt);
  return $row;
}

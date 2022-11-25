<?php


if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $uid = $_SESSION['id'];

  require_once("dbconn.src.php");
  require_once("functions.src.php");

  updateProfile($conn, $username, $email, $phone, $uid);
} else {
  header("location: ../components/item_upload.php");
  exit();
}

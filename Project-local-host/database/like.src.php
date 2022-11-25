<?php


if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST["submit-like"]) || isset($_POST["submit-unlike"])) {
  if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];
    $mid = $_GET['id'];

    require_once("dbconn.src.php");
    require_once("functions.src.php");

    if (isset($_POST["submit-like"])) {
      likeMoview($conn, (int)$uid, (int)$mid);
    } else if (isset($_POST["submit-unlike"])) {
      unlikeMoview($conn, $uid, $mid);
    }
  } else {
    header("location: ../components/auth/login.php");
  }
} else {
  header("location: ../pages/movie_details.php");
  exit();
}

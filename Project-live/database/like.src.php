<?php


if (!isset($_SESSION) && !headers_sent()) {
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
    ob_start();
    header("location: ../components/auth/login.php");
    ob_end_flush();
  }
} else {
  ob_start();
  header("location: ../pages/movie_details.php");
  ob_end_flush();
  exit();
}

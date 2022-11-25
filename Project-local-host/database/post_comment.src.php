<?php


if (!isset($_SESSION)) {
  session_start();
}

if (isset($_POST["submit-comment"])) {
  if (isset($_SESSION['id'])) {
    $text = $_POST["text"];
    $uid = $_SESSION['id'];
    $mid = $_GET['id'];

    require_once("dbconn.src.php");
    require_once("functions.src.php");

    postComment($conn, $text, (int)$uid, (int)$mid);
  } else {
    header("location: ../components/auth/login.php");
  }
} else {
  header("location: ../pages/movie_details.php");
  exit();
}

<?php


if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}

if (isset($_POST["submit-movie"]) && isset($_FILES["image"])) {
  $movie_name = $_POST["movie_name"];
  $genre = $_POST["genre"];
  $release_year = $_POST["release_year"];
  $description = $_POST['description'];
  $uid = $_SESSION['id'];

  $filename = $_FILES['image']["name"];
  $tmpname = $_FILES['image']["tmp_name"];
  $folder = "../images/movies/" . $filename;

  require_once("dbconn.src.php");
  require_once("functions.src.php");


  move_uploaded_file($tmpname, $folder);
  postMovie($conn, $movie_name, $genre, $release_year, $folder, $description, $uid);
} else {
  ob_start();
  header("location: ../pages/post_movie.php");
  ob_end_flush();
  exit();
}

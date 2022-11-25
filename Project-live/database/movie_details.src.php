<?php

require_once("dbconn.src.php");
require_once("functions.src.php");


if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}


$movie_details = getMovieDetails($conn, $_GET['id']);

$isAlreadyLiked = false;
if (isset($_SESSION['id'])) {
  $isAlreadyLiked = isAlreadyLiked($conn, $_SESSION['id'], $_GET['id'],);
}

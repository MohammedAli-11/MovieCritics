<?php

if (!isset($_SESSION)) {
  session_start();
}


require_once("dbconn.src.php");
require_once("functions.src.php");



$movies = getAllMovies($conn);
$query = NULL;

if (isset($_GET["q"])) {
  $query = $_GET["q"];
}

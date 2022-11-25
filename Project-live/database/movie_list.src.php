<?php

require_once("dbconn.src.php");
require_once("functions.src.php");


if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}

$movies = getAllMovies($conn);
$query = NULL;

if (isset($_GET["q"])) {
  $query = $_GET["q"];
}

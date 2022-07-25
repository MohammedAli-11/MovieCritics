<?php

$dbServer = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "project";

$conn = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

<?php

require_once("dbconn.src.php");
require_once("functions.src.php");


if (!isset($_SESSION) && !headers_sent()) {
  session_start();
}

$comments = getAllComments($conn, (int)$_GET['id']);

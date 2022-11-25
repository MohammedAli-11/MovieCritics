<?php 

$db_conn = mysqli_connect("localhost", "id19447602_root", ")%K604)PG$!S7zfe", "id19447602_cse482");
// Check connection
if($db_conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
error_reporting(E_ALL);
ini_set('display_errors','Off');

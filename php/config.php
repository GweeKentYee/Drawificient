<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "drawificient"; /* Database name */

$connect = new PDO("mysql:host=localhost;dbname=drawificient", "root", "");
$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con or !$connect) {
  die("Connection failed: " . mysqli_connect_error());
}



?>
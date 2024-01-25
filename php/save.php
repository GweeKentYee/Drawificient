<?php 

include("config.php");

$data = $_POST['data'];
$data = substr($data,strpos($data,",")+1);
$userID = $_POST['UserID'];

$query = "INSERT INTO user_image_storage (image, user_id) VALUES ('$data', '$userID')";
mysqli_query($con, $query);

?>
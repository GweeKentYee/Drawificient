<?php
include('config.php');
$user_id=$_POST["user_id"];
$feedback=$_POST["feedback"];
date_default_timezone_set("Asia/Kuala_Lumpur");
$time=date("Y-m-d H:i:s");
$query = "INSERT INTO feedback (time, user_id, user_feedback) VALUES ('$time', '$user_id', '$feedback')";
if(mysqli_query($con, $query)){
    echo '<script>alert("Your feedback have been sent. Thank You")</script>';
    echo '<script>location.replace(document.referrer);</script>';
    //echo '<script>window.location.href = "index.php";</script>';
    //echo '<script>window.history.back();</script>';
}else{
    echo '<script>location.replace(document.referrer);</script>';
    //echo '<script>alert("Your feedback failed to send. Please try again")</script>';
    //echo '<script>window.location.href = "feedback.php";</script>';
}

?>
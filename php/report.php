<?php
include('config.php');

    $id = $_POST["id"];
    $userID = $_POST["userID"];
    $report_issues = $_POST["reportIssues"];
    $status = "new";
    $report_type = $_POST["report_type"];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $time = date("Y-m-d H:i:s");
    $location = $_POST['location'];
    if($location == "index.php"){
        $redirect_id = " ";
    }elseif($location == "viewComment.php"){
        $redirect_id = $_POST["redirect_id"];
    }elseif($location == "profile.php"){
        $redirect_id = $_POST["redirect_id"];
    }

    if($report_type == "forum"){
    $sql = "INSERT INTO report_forum (issues, time, status, user_id, forum_id) VALUES ('$report_issues','$time','$status','$userID','$id')";
    }
    if($report_type == "comment"){
        $sql = "INSERT INTO report_comment (issues, time, status, user_id, comment_id) VALUES ('$report_issues','$time','$status','$userID','$id')";
    }
	if($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("Report successfully.");';
        echo '</script>';
    }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed to report, please try again.");';
        echo '</script>';
    }
    
    if($location == "index.php"){
        header("Refresh:0; url=$location");
    }elseif($location == "viewComment.php"){
        header("Refresh:0; url=$location?id=$redirect_id");
    }elseif($location == "profile.php"){
        header("Refresh:0; url=$location?id=$redirect_id");
    }
?>
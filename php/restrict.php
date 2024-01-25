<?php
include('config.php');

    $id = $_POST["id"];
    $status = "Restrict";
    $restrict_type = $_POST["restrict_type"];
    $location = $_POST['location'];
    if($location == "index.php"){
        $redirect_id = " ";
    }elseif($location == "viewComment.php"){
        $redirect_id = $_POST["redirect_id"];
    }elseif($location == "profile.php"){
        $redirect_id = $_POST["redirect_id"];
    }
    if($restrict_type == "forum"){
        $sql = "UPDATE forum SET status='".$status."' WHERE forum_id='".$id."';";
    }
    if($restrict_type == "comment"){
        $sql = "UPDATE comment SET status='".$status."' WHERE comment_id='".$id."';";
    }
	if($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("Restricted successfully.");';
        echo '</script>';
    }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed to restrict, please try again.");';
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
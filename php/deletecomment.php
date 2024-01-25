<?php
include('config.php');

    $comment_id = $_POST["comment_id"];
    $location = $_POST["location"];
    if($location == "index.php"){
        $id = " ";
    }elseif($location == "viewComment.php"){
        $id = $_POST['forum_id'];
    }elseif($location == "profile.php"){
        $id = $_POST['id'];
    }
    $sql = "DELETE FROM comment WHERE comment_id = '".$comment_id."'";
	if($con->query($sql) === TRUE) {
        echo '<script type="text/javascript">';
        echo 'alert("Delete successfully.");';
        echo '</script>';
    }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed to delete, please try again.");';
        echo '</script>';
    }

    if($location == "index.php"){
        header("Refresh:0; url=$location");
    }elseif($location == "viewComment.php"){
        header("Refresh:0; url=$location?id=$id");
    }elseif($location == "profile.php"){
        header("Refresh:0; url=$location?id=$id");
    }
?>
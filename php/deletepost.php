<?php
    if (isset($_POST['deleteSubmit'])){
        include('config.php');
        $forum_id = $_POST["forum_id"];
        $location = $_POST["location"];
        if($location == "profile.php"){
            $id = $_POST['id'];
        }
        $sql = "DELETE FROM forum WHERE forum_id = '".$forum_id."'";
        if ($con->query($sql) === TRUE) {
            echo '<script type="text/javascript">';
            echo 'alert("Deleted successfully.");';
            echo '</script>';
        }
        else {
            echo '<script type="text/javascript">';
            echo 'alert("Failed to delete, please try again.");';
            echo '</script>';
        }
        
        mysqli_close($con);
        if($location == "index.php"){
            header("Refresh:0; url=$location");
        }elseif($location == "viewComment.php"){
            header("Refresh:0; url=index.php");
        }elseif($location == "profile.php"){
            header("Refresh:0; url=$location?id=$id");
        }
    }
    
?>
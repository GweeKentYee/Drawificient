<?php
    $location = $_POST['location'];
    if($location == "index.php"){
        $id = $_POST['forum_id'];
    }elseif($location == "viewComment.php"){
        $id = $_POST['forum_id'];
    }elseif($location == "profile.php"){
        $id = $_POST['id'];
    }
    $forum_id = $_POST['forum_id'];
    if (isset($_POST['commentPost'])){
        include 'config.php';
        
        $user_id = $_POST['user_id'];
        $comment = $_POST['comment'];
        
        $status = "Show";
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $time = date("Y-m-d H:i:s");

        if (empty($comment)){
            echo '<script>alert("Enter comment.")</script>';
            header("Refresh:0; url=$location?id=$id");
            exit();
        }
        else {
            $query = "INSERT INTO comment (caption, comment_name, time, forum_id, user_id, status) VALUES ('$comment', 'null', '$time', '$forum_id', '$user_id', '$status')";
            mysqli_query($con, $query);
            $comment_id = mysqli_insert_id($con);
            $comment_name = "comment".$comment_id;
            $sql = "UPDATE comment SET comment_name = '$comment_name' WHERE comment_id = '$comment_id';";
            if (mysqli_query($con, $sql)){
                echo '<script>alert("Comment added successfully.")</script>';
                header("Refresh:0; url=$location?id=$id");
                exit();
            }
            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                exit();
            }
        }
        mysqli_close($con);
        
    }
    
?>
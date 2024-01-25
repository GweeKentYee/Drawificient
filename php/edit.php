<?php
include('config.php');
if(isset($_POST["save"])){

    $id = $_POST["id"];
    $examType = $_POST["examType"];
    if($examType == "SPM"){
        $subjectName = $_POST["spmSubject"];
        
    }elseif($examType == "PT3"){
        $subjectName = $_POST["pt3Subject"];
    }
    if($_POST['editType'] == "editPost"){
        $newCaption = $_POST["edit_caption"];
        $query = "UPDATE forum SET caption='".$newCaption."', exam_type='".$examType."', subject_name='".$subjectName."' WHERE forum_id='".$id."';";
    }elseif($_POST['editType'] == "editCategory"){
        $query = "UPDATE forum SET exam_type='".$examType."', subject_name='".$subjectName."' WHERE forum_id='".$id."';";
    }
    
    if($con->query($query) === TRUE){
        echo '<script type="text/javascript">';
        echo 'alert("Updated successfully.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }else{
        echo '<script type="text/javascript">';
        echo 'alert("Failed to update, please try again.");';
        echo 'window.location.href = "index.php";';
        echo '</script>';
    }

}

?>
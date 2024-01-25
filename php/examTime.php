<?php

include("config.php");
$arrayDateNum=0;
foreach($_POST['examDate'] as $_POST['examDate']){
    $date[$arrayDateNum]=$_POST['examDate'];
    $arrayDateNum = $arrayDateNum + 1;
}
$arrayEDateNum=0;
foreach($_POST['examEndDate'] as $_POST['examEndDate']){
    $endDate[$arrayEDateNum]=$_POST['examEndDate'];
    $arrayEDateNum = $arrayEDateNum + 1;
}
$num=0;
foreach($_POST['examType'] as $_POST['examType']){
    
    
    
    $Type = $_POST['examType'];

    $query = "UPDATE exam SET exam_date='$date[$num]', exam_end_date='$endDate[$num]' WHERE exam_type='$Type';";
    $num = $num + 1;
    if($con->query($query) === TRUE){
        if($num == 2){
            echo '<script>alert("Updated successfully.")</script>';
        }
    }else{
        if($num == 2){
        echo '<script>alert("Failed to update, please try again.")</script>';
        }
    }
    
    header("refresh:1; url='index.php'");
}


?>
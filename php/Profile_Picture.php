<?php
include('config.php');
//$conn = mysqli_connect('localhost', 'root','', 'drawificient');

if(isset($_POST["insert"]))
{
    $file= addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $Sql_u = "UPDATE user SET profile = '$file' WHERE username = '".$_SESSION['username']."'";
    $sql_p = "SELECT profile FROM user WHERE username = '".$_SESSION['username']."'";
    $res_p = mysqli_query($con, $sql_p);
    
        if(mysqli_query($con, $Sql_u))
        {
            echo '<script>alert("Successfully updated.")</script>';
            echo '<script>window.location.href = "Profile_edit.php";</script>';

            exit();
        
        }
        
}

if(isset($_POST["deleteprofile"]))
{
    $image = "";
    $Sql_u = "UPDATE user SET profile = '$image' WHERE username = '".$_SESSION['username']."'";
    $sql_p = "SELECT profile FROM user WHERE username = '".$_SESSION['username']."'";
    $res_p = mysqli_query($con, $sql_p);
    
        if(mysqli_query($con, $Sql_u))
        {
            echo '<script>alert("Successfully deleted.")</script>';
            echo '<script>window.location.href = "Profile_edit.php";</script>';

            exit();
        
        }
}
mysqli_close($con);
?>
<?php

include("config.php");

if(isset($_POST['reset']))
{
    $username =  $_SESSION['passreset'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    $sql_p = "SELECT * FROM user WHERE username='$username' OR email = '$username'";

      $res_p = mysqli_query($con, $sql_p);
    
    if ($row = mysqli_fetch_assoc($res_p))
    {
        if($password != $password_confirmation)
        {
                //validated   
                echo '<script>alert("passwords do not match.")</script>';
        }
        else
        {
            $newpassword = password_hash($password, PASSWORD_DEFAULT);
            $sql_u = "UPDATE user SET password = '$newpassword' WHERE username = '".$_SESSION['passreset']."'";
            $results = mysqli_query($con, $sql_u);

            echo '<script>alert("Password changed, you may now use yor new password to login")</script>';
            unset($_SESSION["passreset"]);
            header("Refresh:1; url=loginpage.php");
      
            exit();
                
        }
    }
    
}

mysqli_close($con);
?>

<?php
include('config.php');

if(isset($_POST['ChangePassword']))
{
$NewPassword = $_POST['NewPassword'];
$ConfirmNewPassword = $_POST['ConfirmNewPassword'];   
$OldPassword = $_POST['OldPassword'];   
$sql_p = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
$res_p = mysqli_query($con, $sql_p);

if ($row = mysqli_fetch_assoc($res_p))
{
    $pwdCheck = password_verify($OldPassword, $row['password']);

    if ($pwdCheck == true)
    {
        if($NewPassword != $ConfirmNewPassword)
        {

            echo '<script>alert("The new passwords do not match")</script>';
            header("Refresh:0; url=Profile_edit.php");

            exit();
        }
        else
        {
            $UpdatedPassword = password_hash($NewPassword, PASSWORD_DEFAULT);
            $Sql_u = "UPDATE user SET password = '$UpdatedPassword' WHERE username = '".$_SESSION['username']."'";
            $results = mysqli_query($con, $Sql_u);
            echo '<script>alert("Successfully updated.")</script>';
            header("Refresh:0; url=Profile_edit.php");

            exit();
        }

    }
    else 
    {
        echo '<script>alert("The old password entered is wrong")</script>';
        header("Refresh:0; url=Profile_edit.php");
        exit();
    }
}

}


mysqli_close($con);

?>
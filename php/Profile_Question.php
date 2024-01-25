<?php

include('config.php');

if(isset($_POST['ChangeQuestion']))
{
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $password = $_POST['questionpassword'];
    $sql_q = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
    $res_q = mysqli_query($con, $sql_q);

    if($row = mysqli_fetch_assoc($res_q))
    {
        $pwdCheck = password_verify($password, $row['password']);

        if($pwdCheck == true)
        {
            $sql_q = "UPDATE user SET security_question = '$question', answer = '$answer' WHERE username = '".$_SESSION['username']."'";
            $results = mysqli_query($con, $sql_q);
            echo '<script>alert("Successfully updated.")</script>';
            header("Refresh:0; url=Profile_edit.php");

            exit();
        }
        else
        {
            echo '<script>alert("Wrong password entered.")</script>';
            header("Refresh:0; url=Profile_edit.php");

            exit();
        }
    }
    else
    {
        //validated
    }
}

mysqli_close($con);

?>
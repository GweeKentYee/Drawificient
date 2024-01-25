<?php


include("config.php");

if(isset($_POST['forgot']))
{
    $username =  isset($_POST['username']) ? $_POST['username'] : '';
    $question = $_POST['question'] ? $_POST['question'] : '';
    $answer = $_POST['answer'] ? $_POST['answer'] : '';

    $sql_u = "SELECT * FROM user WHERE username='$username' OR email = '$username'";

  	$res_u = mysqli_query($con, $sql_u);
    
    if($row = mysqli_fetch_assoc($res_u))
    {
        if(mysqli_num_rows($res_u) > 0) 
        {   
            if($row['user_status'] != "Restrict")
            {
                if($row['username'] == $username AND $row['security_question'] == $question AND $row['answer'] == $answer)
                {
                    echo '<script>("You will now be redirected to password reset page.")</script>';
                    session_start();
                    $_SESSION['passreset'] = $row['username'];
                    header('refresh:0;url=resetpassword.php');
                }
                else
                {
                    echo '<script>alert("Wrong username, question or answer")</script>';
                }
            }
            else
            {
                echo '<script>alert("This user has been restricted and no further action can be done until this account restriction gets removed")</script>';
            }
        }
    }
    else
    {
        echo '<script>alert("User not found")</script>';
        header('refresh:0;url=forgotpass.php');
        exit();
    }
}

mysqli_close($con);
?>
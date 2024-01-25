<?php

    if (isset($_POST['loginbutton']))
    {
        include("config.php");

        $username = $_POST['user_name'];
        $password = $_POST['pass_word'];
        
        $sql_u = "SELECT * FROM user WHERE username='$username' OR email='$username'";
  	    $res_u = mysqli_query($con, $sql_u);

        if (empty($username) Or empty($password))
        {
            //validated
        }
        if(mysqli_num_rows($res_u) == 0)
        {
            //VALIDATED
        }
        else
        {
            if ($row = mysqli_fetch_assoc($res_u))
            {
                if($row['user_status'] != "Restrict")
                {
                    $pwdCheck = password_verify($password, $row['password']);

                    if ($pwdCheck == true)
                    {
                        session_start();
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['id'] = $row['user_id'];
                        $_SESSION['role'] = $row['role'];
                        header('refresh:2;url=index.php');
                        exit();
                    }
                    else 
                    {
                        //validated
                    }
                }
                else
                {
                    //validated
                    echo "<script>alert('This user has been restricted and can not log in.')</script>";
                    header('refresh:0;url=Loginpage.php');
                    exit();
                }
            }
        }

    }


?>
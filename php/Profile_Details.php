<?php

include('config.php');

if(isset($_POST['ChangeDetails']))
{
$Username = $_POST['username'];
$FirstName = $_POST['FirstName'];   
$LastName = $_POST['LastName'];
$Email = $_POST['NewEmail'];
$Password = $_POST['BasicPassword'];   
$sql_email="SELECT * FROM user WHERE email = '$Email'";
$res_email = mysqli_query($con, $sql_email);
$sql_p = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
$res_p = mysqli_query($con, $sql_p);
$sql_user = "SELECT * FROM user WHERE username = '$Username'";
$res_user = mysqli_query($con, $sql_user);

if ($row = mysqli_fetch_assoc($res_p))
            {
                $pwdCheck = password_verify($Password, $row['password']);

                if ($pwdCheck == true)
                {
                    if($Email == $row['email'] AND $Username == $row['username'])
                    {
                        $Sql_u = "UPDATE user SET first_name = '$FirstName', last_name = '$LastName' WHERE user_id = '".$_SESSION['id']."'";
                        $results = mysqli_query($con, $Sql_u);
                        echo '<script>alert("Successfully updated.")</script>';
                        header("Refresh:0; url=Profile_edit.php");

                        exit();
                        
                        
                    }

                    else if(mysqli_num_rows($res_email)==0 AND $Username == $row['username'])

                    {   $Sql_e = "UPDATE user SET first_name = '$FirstName', last_name = '$LastName' WHERE user_id = '".$_SESSION['id']."'";
                        $results = mysqli_query($con, $Sql_e);
                        $Sql_email = "UPDATE user SET email = '$Email' WHERE user_id = '".$_SESSION['id']."'";
                        $results2 = mysqli_query($con, $Sql_email);
                        echo '<script>alert("Successfully updated.")</script>';
                        header("Refresh:0; url=Profile_edit.php");

                        exit();
                        
                    }

                    else if(mysqli_num_rows($res_user)==0 AND $Email == $row['email'])
                    {
                        $Sql_u = "UPDATE user SET first_name = '$FirstName', last_name = '$LastName' WHERE user_id = '".$_SESSION['id']."'";
                        $results = mysqli_query($con, $Sql_u);
                        $Sql_user = "UPDATE user SET username = '$Username' WHERE user_id = '".$_SESSION['id']."'";
                        $results2 = mysqli_query($con, $Sql_user);
                        $_SESSION['username'] = $Username;
                        echo '<script>alert("Successfully updated.")</script>';
                        header("Refresh:0; url=Profile_edit.php");

                        exit();
                        
                    }
                    else if(mysqli_num_rows($res_email)==0 AND mysqli_num_rows($res_user)==0)
                    {
                        $Sql_u = "UPDATE user SET first_name = '$FirstName', last_name = '$LastName' WHERE user_id = '".$_SESSION['id']."'";
                        $results = mysqli_query($con, $Sql_u);
                        $Sql_email = "UPDATE user SET email = '$Email' WHERE user_id = '".$_SESSION['id']."'";
                        $results2 = mysqli_query($con, $Sql_email);
                        $Sql_user = "UPDATE user SET username = '$Username' WHERE user_id = '".$_SESSION['id']."'";
                        $results3 = mysqli_query($con, $Sql_user);
                        $_SESSION['username'] = $Username;
                        echo '<script>alert("Successfully updated.")</script>';
                        header("Refresh:0; url=Profile_edit.php");

                        exit();
                        

                    }

                    else
                    {
                        //validate
                    }
                }
                else
                {
                    //validated
                }
            }
}

mysqli_close($con);

?>
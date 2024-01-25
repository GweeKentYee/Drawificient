<?php session_start();

include("config.php");

if(isset($_POST['register']))
 {
    $username =  isset($_POST['username']) ? $_POST['username'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $image = "";
    $question = $_POST['question'] ? $_POST['question'] : '';
    $answer = $_POST['answer'] ? $_POST['answer'] : '';

    $sql_u = "SELECT * FROM user WHERE username='$username'";
  	$sql_e = "SELECT * FROM user WHERE email='$email'";
  	$res_u = mysqli_query($con, $sql_u);
    $res_e = mysqli_query($con, $sql_e);

    if (mysqli_num_rows($res_u) > 0)
    {
      //validated
    }
    else if(mysqli_num_rows($res_e) > 0)
    {
      //validated
    }
    else if($password != $password_confirmation)
    {
      echo '<script>alert("The passwords do not match.")</script>';
    }
    else
    {
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user (username, first_name, last_name, email, password, role, user_status, profile, security_question, answer) VALUES
         ('$username','$first_name','$last_name','$email','$hashedPwd', 'user','Show', '$image', '$question', '$answer')";
        $results = mysqli_query($con, $query);
        echo '<script>alert("You have successfully registered! you can now proceed to login.")</script>';
        header('refresh:2;url=loginpage.php');
        exit(); 
  	}
  }


mysqli_close($con);
?>
<?php include('loginVerify.php') ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   </head>
   <body>
      <header class="sticky-top">
         <nav class="navbar navbar-expand-lg navbar-light">
            <div class="Drawificient">
               <a class="navbar-brand" href="index.php">
               <img src="../img/Drawificient.png" alt="DRAWIFICIENT">
               </a>
            </div>
         </nav>
      </header>
      <br><br><br>
      <div class="container">
         <div class="row">
            <div class="col-lg-6 col-md-7 mx-auto">
               <form action="loginpage.php" id="loginform" method="POST" class = "form-register-login" style="border:1px solid black;border-radius:10px;">
                  <p class = "h4 text-center py-4">Login</p>
                  <?php
                     if (isset($_POST['loginbutton']))
                     {
                       require 'config.php';
                     
                       $username = $_POST['user_name'];
                       $password = $_POST['pass_word'];
                     
                       $sql_u = "SELECT * FROM user WHERE username='$username' OR email='$username'";
                       $res_u = mysqli_query($con, $sql_u);
                       
                       if(mysqli_num_rows($res_u) == 0)
                       {
                         echo "<span id = 'UserError' style='color:red'>Wrong username/email or password, please re-enter</span>";
                       }
                     
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
                             header('refresh:1;url=index.php');
                           }
                           else 
                           {
                             echo "<span id = 'PasswordError' style='color:red'>Wrong username/email or password, please re-enter</span>";
                           }
                         }
                         else
                         {
                           echo "<span id = 'StatusError' style='color:red'>You have been restricted from login</span>";
                         }
                       }
                     } 
                     
                     ?>
                  <div class="form-floating">
                     <input type = "text" name = "user_name" id = "user_name" class = "form-control" placeholder = "Username" required pattern=".*\S+.*" autofocus = "" minlength = "2">
                     <label for ='user_name'>Username or Email address</label>
                  </div>
                  <div class="form-floating input-group">
                     <input type="password" name="pass_word" id = "pass_word" class = "form-control" placeholder = "Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for ='pass_word'>Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowPassword()"><i id="PasswordState" class="fa fa-eye"></i></button>
                     </div>
                  </div>
                  <div class="d-flex justify-content-center">
                     <button type="submit" name="loginbutton" id="loginbutton" class= "btn btn-primary">Sign In</button>
                  </div>
                  <div class="d-flex justify-content-center" style = "padding-top:20px;margin-bottom:none">
                     <p>Don't have an account? create one <a href="registerpage.php" class="text-primary"> here</a></p>
                  </div>
                  <div class="d-flex justify-content-center" style = "margin-bottom:none">
                     <p><a href="forgotpass.php" class="text-primary">Forgot password</a></p>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script>
   function ShowPassword()
   {
      var pass = document.getElementById("pass_word");
      if (pass.type === "password" ) 
      {
         pass.type = "text";
         document.getElementById("PasswordState").className = "fa fa-eye-slash";
         
      } 
      else
      {
         pass.type = "password";
         document.getElementById("PasswordState").className ="fa fa-eye";


      }
   }
   </script>
   <?php
      if (!isset($_GET['error'])){
          exit();
      }
      else{
          $loginCheck = $_GET['error'];
          if ($loginCheck == "emptyfields"){
              echo '<p>Fill in all fields!</p>';
          }
          else if ($loginCheck == "wrongpassword"){
              echo '<p>Wrong password!</p>';
          }
          else if ($loginCheck == "usernotfound"){
              echo '<p>Invalid user!</p>';
          }
      }
      ?>
   
</html>
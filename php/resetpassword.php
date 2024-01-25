<?php 
session_start();
include('resetpasswordverify.php');
include("config.php");
?>

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
      <script src="https://kit.fontawesome.com/9a1f6f3b85.js" crossorigin="anonymous"></script>

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
               <form action="resetpassword.php" id="resetpassword" method="POST" class = "form-forgotpass" style="border:1px solid black;border-radius:10px;">
                  <span class = "text-center">
                  <p class = "h4 py-4" style = "text-align:center">Reset password</p>
                  </span>
                  <div class="text-center" style="text-align:center">
                  
                  <?php
                     $sql_c = "SELECT * FROM user WHERE username = '".$_SESSION['passreset']."'";
                     $res_c = mysqli_query($con, $sql_c);
                     //C means check
               
                     if (mysqli_num_rows($res_c) > 0)
                     {
                     
                        while($row = mysqli_fetch_array($res_c))
                        {
                           $username = $row['username'];
                           $ProfilePic = $row['profile'];
                           $FirstName = $row['first_name'];
                           $LastName = $row['last_name'];
                           $Email = $row['email'];
                        
                           if(empty($row['profile']))
                           {
                              
                              echo '<img id = "profile_picture" class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "/>';
                              
                           }
                           else
                           {
                              
                              echo '<img id = "profile_picture" class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"/>';
                              
                           }
                        }
                     }     
                     ?>
                  <p class= "h2" id = "reset_username"><?php echo $_SESSION['passreset'] ?></p>

                  </div>

                  <p class="text-center lead">This will reset your password, you must use this new password that you set to login.</p>
                  
                  <div class="form-floating input-group">
                     <input type="password" name="password" id = "password" class = "form-control" placeholder = "Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for='password'>New Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowPassword()"><i id="PasswordState" class="fa fa-eye"></i></button>
                     </div>
                  </div>

                  <div class="form-floating input-group">
                     <input type="password" name="password_confirmation" id = "password_confirmation" class = "form-control" placeholder = "Confirm password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for='password_confirmation'>Confirm New Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowPasswordConfirmation()"><i id="PasswordConfirmationState" class="fa fa-eye"></i></button>
                     </div>
                  </div>
                  
                  <?php

                     if(isset($_POST['reset']))
                     {
                        $password = $_POST['password'];
                        $password_confirmation = $_POST['password_confirmation'];
                     
                        if($password != $password_confirmation)
                        {
                            echo "<span id='NewPasswordError' style='color:red'>The new passwords do not match</span><br>";
                        }
                    }
                    ?>


                  <span id="passwordmatch"></span><br>

                  <div class="d-flex justify-content-center">
                    <button type="submit" name="reset" id="reset" class= "btn btn-primary">Confirm</button>
                  </div>

               </form>
               <br>
            </div>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   
</html>

<script>
      $('#password, #password_confirmation').on('keyup', function () {
        if ($('#password').val() == $('#password_confirmation').val()) {
          $("#passwordmatch").hide();
        } else
          $("#passwordmatch").show();
          $('#passwordmatch').html('Passwords does not match').css('color', 'red');
      });

      function ShowPassword()
   {
      var pass = document.getElementById("password");
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

   function ShowPasswordConfirmation()
   {
      var pass = document.getElementById("password_confirmation");
      if (pass.type === "password" ) 
      {
         pass.type = "text";
         document.getElementById("PasswordConfirmationState").className = "fa fa-eye-slash";
         
      } 
      else
      {
         pass.type = "password";
         document.getElementById("PasswordConfirmationState").className ="fa fa-eye";


      }
   }
   </script>
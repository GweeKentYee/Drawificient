<?php
include('config.php');
include('registerVerify.php') 
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
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
               <form action = "registerpage.php" method = "POST" class = "form-register-login" style="border:1px solid black;border-radius:10px;">
                  <p class = "h4 text-center py-4">Register</p>
                  <div class="form-floating">      
                     <input type = "text" name = "username" id = "username" value = "<?php echo $_POST['username'] ?? ''; ?>" class = "form-control" placeholder = "Username" required pattern=".*\S+.*" autofocus = "" maxlength = "20" minlength = "2">
                     <label for ='username'>Username</label>
                     <?php
                        if(isset($_POST['register']))
                        {
                            $username =  isset($_POST['username']) ? $_POST['username'] : '';
                            $con = mysqli_conect('localhost', 'root','', 'drawificient');
                            $sql_u = "SELECT * FROM user WHERE username='$username'";
                            $res_u = mysqli_query($con, $sql_u);
                        
                          if (mysqli_num_rows($res_u) > 0)
                          {
                            echo "<span id = 'UserExist' style='color:red'>Username already exists, please enter another name</span>";
                          }
                        }
                        ?>
                  </div>
                  <div class="form-floating">
                     <input type = "text" name = "first_name" id = "first_name" value = "<?php echo $_POST['first_name'] ?? ''; ?>" class = "form-control" placeholder = "First name" required pattern = ".*\S+.*" autofocus = "" maxlength = "20" minlength = "2" onkeypress=" return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                     <label for = 'first_name'>First name</label>
                  </div>
                  <div class="form-floating">
                     <input type = "text" name = "last_name" id = "last_name" value = "<?php echo $_POST['last_name'] ?? ''; ?>" class = "form-control" placeholder = "Last name" required pattern = ".*\S+.*" autofocus = "" maxlength = "20" minlength = "2" onkeypress=" return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                     <label for = 'last_name'>Last name</label>
                  </div>
                  <div class="form-floating">
                     <input type="email" name="email" id = "email" value = "<?php echo $_POST['email'] ?? ''; ?>" class = "form-control" placeholder = "Email" required pattern=".*\S+.*" autofocus = "">
                     <label for='email'>Email</label>
                     <?php
                        if(isset($_POST['register']))
                        {
                            $email =  isset($_POST['email']) ? $_POST['email'] : '';
                            $con = mysqli_conect('localhost', 'root','', 'drawificient');
                            $sql_e = "SELECT * FROM user WHERE email='$email'";
                            $res_e = mysqli_query($con, $sql_e);
                        
                          if (mysqli_num_rows($res_e) > 0)
                          {
                            echo "<span id='EmailExist' style='color:red'>This email has already been used, please pick another email</span>"; 	
                          }
                        }
                        ?>
                  </div>

                  <div class="form-floating input-group">
                     <input type="password" name="password" id = "password" class = "form-control" placeholder = "Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for='password'>Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowPassword()"><i id="PasswordState" class="fa fa-eye"></i></button>
                     </div>
                  </div>

                  <div class="form-floating input-group">
                     <input type="password" name="password_confirmation" id = "password_confirmation" class = "form-control" placeholder = "Confirm password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for='password_confirmation'>Confirm Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowPasswordConfirmation()"><i id="PasswordState" class="fa fa-eye"></i></button>
                     </div>
                     
                  </div>
                  <span id="passwordmatch"></span>
                  <div class="form-floating">      
                  
                     <select name = "question" id = "question" class = "form-select" required>
                        <option value="" disabled selected hidden>Choose one...</option>
                        <option value="question1">What is your first job?</option>
                        <option value="question2">What is your first pet's name?</option>
                        <option value="question3">What was the location of the house you lived in?</option>
                        <option value="question4">What is the name of your little brother?</option>
                        <option value="question5">What is your dream location to visit?</option>
                     </select>
                     <label for ='question'>Security question</label>
                  </div>

                  <div class="form-floating">
                     <input type="text" name="answer" id = "answer" class = "form-control" placeholder = "answer" required pattern=".*\S+.*" autofocus = "" minlength="2">
                     <label for='answer'>Answer</label>
                  </div>

                  <div class="d-flex justify-content-center">
                     <button type="submit" class="btn btn-primary" name="register" id="register">Register</button>
                  </div>
                  <div class="d-flex justify-content-center" style = "padding-top:20px;margin-bottom:none">
                     <p>Already have an account?  <a href="loginpage.php" class="text-primary">click here</a></p>
                  </div>
               </form>
               <br><br><br>
            </div>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script>
      $('#password, #password_confirmation').on('keyup', function () {
        if ($('#password').val() == $('#password_confirmation').val()) {
          $("#passwordmatch").hide();
        } else
          $("#passwordmatch").show();
          $('#passwordmatch').html('Passwords does not match').css('color', 'red');
      });
      
      $('#username').on('keyup', function () {
        if ($('#username').val().length > 0 )
          {
              $("#UserExist").hide();
          } 
      });
      
      $('#email').on('keyup', function () {
        if ($('#email').val().length > 0 )
          {
              $("#EmailExist").hide();
          } 
      });
   </script>
   <script>
      var $username = $("#username");
      
      $username.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
      });
      
      var $first_name = $("#first_name");
      
      $first_name.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
      });
      
      var $last_name = $("#last_name");
      
      $last_name.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
      });

      var $answer = $("#answer");
      
      $answer.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
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
</html>
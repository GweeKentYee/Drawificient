<?php include('forgotpassverify.php');?>
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
               <form action="forgotpass.php" id="forgotpass" method="POST" class = "form-forgotpass" style="border:1px solid black;border-radius:10px;">
                  <p class = "h4 text-center py-4">Forgot password</p>

                  <p class="text-center lead">Forgot your password? Don't worry, as long as you remember the questions and answers you selected, you can reset it</p>
                  
                  <div class="form-floating">
                     <input type = "text" name = "username" id = "username" class = "form-control" placeholder = "Username" required pattern=".*\S+.*" autofocus = "" maxlength = "20" minlength = "2">
                     <label for ='username'>Username or Email address</label>
                  </div>

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
                     <button type="submit" name="forgot" id="forgot" class= "btn btn-primary">Confirm</button>
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
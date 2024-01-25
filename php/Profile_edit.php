<?php
         session_start();
         include('Profile_Details.php'); 
         include('Profile_Password.php'); 
         include('Profile_Picture.php'); 
         include('Profile_Question.php');
         include('config.php');
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php 
            if(isset($_SESSION['role'])){
               if($_SESSION['role'] == "admin"){
            ?>
            <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                     <a class="nav-link" href="index.php">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="datatable" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Datatable
                     </a>
                     <div class="dropdown-menu" aria-labelledby="datatable">
                        <a class="dropdown-item" href="user_table.php">USER</a>
                        <a class="dropdown-item" href="forum_table.php">FORUM</a>
                        <a class="dropdown-item" href="comment_table.php">COMMENT</a>
                        <a class="dropdown-item" href="forum_image_table.php">FORUM IMAGE</a>
                        <a class="dropdown-item" href="news_table.php">NEWS</a>
                        <a class="dropdown-item" href="report_forum_table.php">REPORT FORUM</a>
                        <a class="dropdown-item" href="report_comment_table.php">REPORT COMMENT</a>
                     </div>
                  </li>
               </ul>
               <?php
                  }
               }
               ?>
               <ul class="navbar-nav mr-auto w-100 justify-content-end">


                  <?php
                     if(isset($_SESSION['id'])){
                         $sql = "SELECT * FROM user WHERE user_id = '".$_SESSION['id']."'";
                         $res = mysqli_query($con, $sql);
                         ?>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <span class="username">
                     <?php
                        if (mysqli_num_rows($res) > 0)
                        {
                        
                            while($row = mysqli_fetch_array($res))
                            {
                                $ProfilePic = $row['profile'];   
                        
                                if(empty($row['profile']))
                                {
                                    echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "style="width:40px; height:40px;""/>';
                                }
                                else
                                {
                                    echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"style="width:40px; height:40px;""/>';
                                }
                            }
                        }  
                        
                        ?>
                     <?php echo $_SESSION['username'];?>
                     </span>
                     </a>
                     <div class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['id'] ?>"><i class="fas fa-user"></i> View Profile</a>
                        <a class="dropdown-item active" href = 'Profile_edit.php'><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a class="dropdown-item" href="Account_gallery.php"><i class="fas fa-images"></i> Account Gallery</a>
                        <?php
                        if($_SESSION['role'] == "user"){
                        ?>
                        <button class="dropdown-item" data-toggle="modal" data-target="#feedback"><i class="far fa-comment-dots"></i> Feedback</button>
                        
                        <?php
                        }elseif($_SESSION['role'] == "admin"){
                        ?>
                        <a class="dropdown-item" href="feedback.php"><i class="far fa-comment-dots"></i> Feedback</a>
                        <?php
                        }
                        ?>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" onclick="logoutConfirm()"><i class="fas fa-sign-out-alt"></i> Logout</button>
                     </div>
                  </li>
                  <?php
                     }else{
                         ?>
                  <li class="nav-item">
                     <a href="loginpage.php">Login</a>&nbsp;&nbsp;
                  </li>
                  <li class="nav-item">
                     <a href="registerpage.php">Sign Up</a>&nbsp;
                  </li>
                  <?php
                     }
                         ?>
               </ul>
            </div>
         </nav>
      </header>
      <div class="modal fade" id="feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header modal-drawificolor">
                              <h5 class="modal-title" id="exampleModalCenterTitle">Feedback</h5>
                              <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form action="feedback_upload.php" method="post">
                              <div class="modal-body">
                                 <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']?>">
                              <div class="feedback">
                              <br>
                              <textarea name="feedback" id="feedback" placeholder="Write your feedback here (Suggestions, bugs, etc)."required></textarea>
                              </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                 <input type="submit" class="btn btn-outline-success" name="feedback_btn" id="user_feedback" value="Submit">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
      <h2 id = "profile_title" >Edit Profile</h2>
      <div id="profile_back">
         
         <button onclick="goBack()" class = "btn btn-outline-dark">Back</button>
            <script>
            function goBack(){
               window.history.back();
            }
         </script>
      </div>
      <br>
      <div id="profile_form_area" class="container col-xl-11 col-lg-11 col-md-11 col-sm-11 border border-dark rounded">
         
         <div class ="row">
            <div class= "cols-xl">
               <?php
               $sql_c = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
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
               
                  <h2 id = "profile_username"><?php echo $username ?></h2>
            </div>
            
            <!--might add padding top to center it-->
         </div>
         <!--Closingpfp row-->
         <div class = "container-fluid row row-cols-1">
            <!--form row start-->
            <!--FNLN and Email Section starts here-->
            <div class = "col-xl col-lg col-md col-sm col">
               <h2 class="profile_form_title">General</h2>
               <hr class = "my-4">
               <form action = 'Profile_edit.php' method='POST'>

                  <div class="form-floating">
                     <input type = "text" name = "username" id = "username" value = "<?php echo $username ?? ''; ?>" class = "form-control" placeholder = "Username" required pattern=".*\S+.*" autofocus = "" maxlength = "20" minlength = "2">
                     <label for ='username'>Username</label>
                  </div>

                  <div class="form-floating">
                     <input type = "text" name = "FirstName" id = "FirstName" value = "<?php echo $FirstName ?? ''; ?>" class = "form-control" placeholder = "First name" required pattern = ".*\S+.*" autofocus = "" maxlength = "20" minlength = "2" onkeypress=" return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                     <label for = 'FirstName'>First name</label>
                  </div>

                  <div class="form-floating">
                     <input type = "text" name = "LastName" id = "LastName" value = "<?php echo $LastName ?? ''; ?>" class = "form-control" placeholder = "Last name" required pattern = ".*\S+.*" autofocus = "" maxlength = "20" minlength = "2" onkeypress=" return (event.charCode > 64 && 
                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                     <label for = 'LastName'>Last name</label>
                  </div>

                  <div class="form-floating">
                     <input type="Email" name="NewEmail" id = "NewEmail" value = "<?php echo $Email ?? ''; ?>" class = "form-control" placeholder = "Email" required pattern=".*\S+.*" autofocus = "">
                     <label for='NewEmail'>Email</label>
                  </div>

                  <div class="form-floating input-group">
                     <input type="password" name="BasicPassword" id = "BasicPassword" class = "form-control" placeholder = "Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                     <label for='BasicPassword'>Password</label>
                     <div class="input-group-text">
                        <button class="btn btn-default" type="button" onclick="ShowBasicPassword()"><i id="BasicPasswordState" class="fa fa-eye"></i></button>
                     </div>
                  </div>

                  <?php
                     if(isset($_POST['ChangeDetails']))
                     {
                       $Username = $_POST['username'];
                       $Email = $_POST['NewEmail'];
                       $Password = $_POST['BasicPassword'];   
                       $sql_e="SELECT * FROM user WHERE email = '$Email'";
                       $res_e = mysqli_query($con, $sql_e);
                       $sql_p = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
                       $res_p = mysqli_query($con, $sql_p);
                     
                       if ($row = mysqli_fetch_assoc($res_p))
                       {
                         $pwdCheck = password_verify($Password, $row['password']);
                         if ($pwdCheck == true)
                         {
                           if($Email == $row['email'])
                           {
                             //VALIDATED
                           }
                           else
                           {
                             echo "<span id='EmailTakenError' style='color:red'>Email is taken by other users</span><br>";
                           }
                         }
                         else
                         {
                           echo "<span id='EmailPasswordError' style='color:red'>Wrong password entered</span><br>";
                         }
                       }
                     }
                     ?>
                  <button name='ChangeDetails' class = "btn btn-outline-success">Confirm Changes</button>
               </form>
               <br><!--create spacing for changedetails button-->
            </div>
            <!--FNLN and Email Section ends here-->
            
            <!--avatar Section starts here-->
            <div class="col-xl col-lg col-md col-sm col">
               <h2 class="profile_form_title">User Picture</h2>
               <hr class = "my-4">
               <form action="profile_edit.php" id = "ImageForm" method="post" enctype="multipart/form-data">
                  <input type="file" name="image" id="image" required="" onchange="preview()"><br>
                  <img src = "" class = "rounded-circle" width="100px" height="100px" id="frame" name="frame" style = "display:none"><br>
                  <button class = "btn btn-outline-success" name="insert" id="insert">Upload</button>
               </form>
               <?php
                  $sql_p = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
                  $res_p = mysqli_query($con, $sql_p);
                  
                  if ($row = mysqli_fetch_assoc($res_p))
                  {
                    if(!empty($row['profile']))
                    {
                      ?>
               <form action="profile_edit.php" id="DeleteProfileForm" method="post">
                  <button class = "btn btn-outline-danger" name="deleteprofile" id="deleteprofile" onclick="return confirm('Are you sure you want to delete your profile picture?')">Delete</button>
               </form>
               <?php
                  }
                  }
                    ?>
            </div>
            
            <!--avatar Section ends here-->

            <!--Password Section starts here-->
            <div class = "col-xl col-lg col-md col-sm col">
               <h2 class="profile_form_title">Privacy</h2>
               <hr class = "my-4">
               
               <div class = "btn-toolbar">
                  <button type="button" class="btn btn-outline-primary drawificolor form-control" data-bs-toggle="modal" data-bs-target="#passwordmodal"><i class = "fa fa-unlock-alt"></i><br> Change Password </button>
                  <button type="button" class="btn btn-outline-primary drawificolor form-control" data-bs-toggle="modal" data-bs-target="#questionmodal"><i class = "fa fa-question"></i><br> Change Security Question </button>
               </div>
               <!--Password modal start-->
               <div class="modal fade" id="passwordmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="passwordmodallabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header modal-drawificolor">
                           <h5 class="modal-title" id="passwordmodallabel">Change Password</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class = "modal-body">
                        <form action = 'Profile_edit.php' method='POST' id='PasswordForm'>
                           <div class="form-floating input-group">
                                 <input type="password" name="NewPassword" id = "NewPassword" class = "form-control" placeholder = "New Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                                 <label for='NewPassword'>New Password</label>
                                 <div class="input-group-text">
                                    <button class="btn btn-default" type="button" onclick="ShowNewPassword()"><i id="NewPasswordState" class="fa fa-eye"></i></button>
                                 </div>
                           </div>
                           
                           <div class="form-floating input-group">
                              <input type="password" name="ConfirmNewPassword" id = "ConfirmNewPassword" class = "form-control" placeholder = "Confirm New Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                              <label for='ConfirmNewPassword'>Confirm New Password</label>
                              <div class="input-group-text">
                                 <button class="btn btn-default" type="button" onclick="ShowNewPasswordConfirmation()"><i id="NewPasswordConfirmationState" class="fa fa-eye"></i></button>
                              </div>
                           </div>
                           <span id = "passwordmatch"></span>
                           <div class="form-floating input-group">
                              <input type="password" name="OldPassword" id = "OldPassword" class = "form-control" placeholder = "Current Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                              <label for='OldPassword'>Current Password</label>
                              <div class="input-group-text">
                                 <button class="btn btn-default" type="button" onclick="ShowOldPassword()"><i id="OldPasswordState" class="fa fa-eye"></i></button>
                              </div>
                           </div>
                           <?php
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
                                    echo "<span id='NewPasswordError' style='color:red'>The new passwords do not match</span><br>";
                                    }
                                    else
                                    {
                                       //validated
                                       }
                                 
                                    }
                                    else 
                                    {
                                       echo "<span id='OldPasswordError' style='color:red'>The old password entered is wrong</span><br>";
                                    }
                                 }
                                 }
                                 ?>
                              </div>
                              <div class = "modal-footer">
                                 <button class = "btn btn-outline-success" name = 'ChangePassword'>Confirm Changes</button>
                                 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                              </div>
                     </div>
                  </div>
               </div><!--Password modal end-->

               <!--Question modal start-->
               <div class="modal fade" id="questionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="passwordmodallabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                     <div class="modal-content">
                        <div class="modal-header modal-drawificolor">
                           <h5 class="modal-title" id="passwordmodallabel">Change Security Question</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class = "modal-body">
                           <form action = 'Profile_edit.php' method='POST' id='QuestionForm'>
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

                              <div class="form-floating input-group">
                                 <input type="password" name="questionpassword" id = "questionpassword" class = "form-control" placeholder = "Password" required pattern=".*\S+.*" autofocus = "" minlength="6">
                                 <label for='password'>Password</label>
                                 <div class="input-group-text">
                                 <button class="btn btn-default" type="button" onclick="ShowSecurityPassword()"><i id="SecurityPasswordState" class="fa fa-eye"></i></button>
                              </div>
                              </div>

                              <?php
                              if(isset($_POST['ChangeQuestion']))
                              {
                                 $Password = $_POST['questionpassword'];   
                                 $sql_p = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
                                 $res_p = mysqli_query($con, $sql_p);
                              
                                 if ($row = mysqli_fetch_assoc($res_p))
                                 {
                                    $pwdCheck = password_verify($Password, $row['password']);
                              
                                    if ($pwdCheck == true)
                                    {
                                       //Validated
                                    }
                                    else 
                                    {
                                       echo "<span id='PasswordError' style='color:red'>Wrong password entered</span><br>";
                                    }
                                 }
                                 }
                                 ?>

                              </div>
                              <div class = "modal-footer">
                                 <button class = "btn btn-outline-success" name = 'ChangeQuestion'>Confirm Changes</button>
                                 <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                           </form>
                              </div>
                     </div>
                  </div>
               </div><!--Question modal end-->

            </div>
            <!--Password Section ends here-->
         </div>

         
         
         <!--closing for forms row-->
         <?php 
            mysqli_close($con);
            ?>
      </div>
      <!--For first container-->
      <br><br><br>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script>
      function readURL(input)
      {
        if (input.files && input.files[0])
        {
          var reader = new FileReader();
      
          reader.onload = function(e)
          {
            $("#frame").show();
            $('#frame').attr('src', e.target.result);
          }
      
          reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
      }
      
      $("#image").change(function()
      {
        readURL(this);
      });
   </script>
   <script>
      $("#image").change(function() 
      {
        var val = $(this).val();
      
        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
          case 'gif': case 'jpg': case 'png': case 'jpeg':
            
            break;
            default:
            $(this).val('');
            alert("Please select image only.");
            break;
      }
      });
   </script>
   <script>
      $('#NewPassword, #ConfirmNewPassword').on('keyup', function () {
        if ($('#NewPassword').val() == $('#ConfirmNewPassword').val()) {
          $("#passwordmatch").hide();
        } else
          $("#passwordmatch").show();
          $('#passwordmatch').html('Passwords does not match').css('color', 'red');
      });
   </script>
   <script>
      var $first_name = $("#FirstName");
      
      $first_name.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
      });
      
      var $last_name = $("#LastName");
      
      $last_name.on("keydown keypress", function() {    
          var $this = $(this),
              val = $(this).val()
                           .replace(/(\r\n|\n|\r)/gm," ") // replace line breaks with a space
                           .replace(/ +(?= )/g,''); // replace extra spaces with a single space
      
          $this.val(val);
      });
      function logoutConfirm(){
               if(confirm('Logout now?')){
                  window.location.href = "logout.php";
               }
            }
      
      function ShowBasicPassword()
      {
         var pass = document.getElementById("BasicPassword");
         if (pass.type === "password" ) 
         {
            pass.type = "text";
            document.getElementById("BasicPasswordState").className = "fa fa-eye-slash";
            
         } 
         else
         {
            pass.type = "password";
            document.getElementById("BasicPasswordState").className ="fa fa-eye";


         }
      }

      function ShowNewPassword()
      {
         var pass = document.getElementById("NewPassword");
         if (pass.type === "password" ) 
         {
            pass.type = "text";
            document.getElementById("NewPasswordState").className = "fa fa-eye-slash";
            
         } 
         else
         {
            pass.type = "password";
            document.getElementById("NewPasswordState").className ="fa fa-eye";


         }
      }

      function ShowNewPasswordConfirmation()
      {
         var pass = document.getElementById("ConfirmNewPassword");
         if (pass.type === "password" ) 
         {
            pass.type = "text";
            document.getElementById("NewPasswordConfirmationState").className = "fa fa-eye-slash";
            
         } 
         else
         {
            pass.type = "password";
            document.getElementById("NewPasswordConfirmationState").className ="fa fa-eye";


         }
      }

      function ShowOldPassword()
      {
         var pass = document.getElementById("OldPassword");
         if (pass.type === "password" ) 
         {
            pass.type = "text";
            document.getElementById("OldPasswordState").className = "fa fa-eye-slash";
            
         } 
         else
         {
            pass.type = "password";
            document.getElementById("OldPasswordState").className ="fa fa-eye";


         }
      }

      function ShowSecurityPassword()
      {
         var pass = document.getElementById("questionpassword");
         if (pass.type === "password" ) 
         {
            pass.type = "text";
            document.getElementById("SecurityPasswordState").className = "fa fa-eye-slash";
            
         } 
         else
         {
            pass.type = "password";
            document.getElementById("SecurityPasswordState").className ="fa fa-eye";


         }
      }


   </script>
</html>
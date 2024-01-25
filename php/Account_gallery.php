<?php
   session_start();
   include("config.php");
   
   if(!isset($_SESSION['username']))
                  {
                  header("location:loginpage.php");
                  }
   
   // Check connection
   if (!$con) {
     die("Connection failed: " . mysqli_connect_error());
   }
   
   if(isset($_POST['Remove'])){
   
       foreach ($_POST['StorageImages'] as $_POST['StorageImages']){
   
           $query1 = "DELETE FROM user_image_storage where storage_id = '".$_POST['StorageImages']."'";
           
           mysqli_query($con,$query1);
       }
   
           echo'<script>alert("Image removed from gallery.")</script>';
           header('refresh:0;url=Account_gallery.php');
   
   }
   
   if(isset($_POST["Insert"])){
   
       $userID= $_SESSION['id'];
   
       foreach ($_FILES['ImportImage']["tmp_name"] as $_FILES['ImportImage']["tmp_name"]){
           
            $file = addslashes(base64_encode(file_get_contents($_FILES['ImportImage']["tmp_name"])));
            $query2 = "INSERT INTO user_image_storage (image, user_id) VALUES ('$file', '$userID')";
        
            mysqli_query($con, $query2);     
            
       }
       
            echo '<script>alert("Image imported successfully.")</script>';
            header('refresh:0;url=Account_gallery.php'); 
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <script src="../_js_libs/jquery.magnific-popup.js"></script>
      <link rel="stylesheet" href="../_assets/magnific-popup.css">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <style>
         body {
            height:100%;
         }
      </style>
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
                     <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php?id=<?php echo $_SESSION['id'] ?>"><i class="fas fa-user"></i> View Profile</a>
                        <a class="dropdown-item" href = 'Profile_edit.php'><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a class="dropdown-item active" href="Account_gallery.php"><i class="fas fa-images"></i> Account Gallery</a>
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
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
      <div class = "UserGallery col">
         <div class = "UserGalleryContent1 col-xl-9 col-12">
            <h2 style = "float:left;">Account Gallery</h2>
            <div class = "BreakLineGallery">
               <br>
            </div>
            <button onclick = "window.location.href = 'upload.php';" class = "btn btn-outline-success" style = "float:right;">Create New Post</button>
            
            <button onclick="goBack()" class = "btn btn-outline-dark" style = "float:right; margin-right: 5px;">Back</button>
            <script>
            function goBack(){
               window.history.back();
            }
         
         </script>
            <div class="imgBox" style = "text-align:center">
               <img src="">
               <p id = "NoImage">No image is selected.</p>
            </div>
         </div>
         <div class = "UserGalleryContent2 col-xl-4 col-12">
            <div class = "ImportImageForm">
               <form action ="#" method = "post" multiple enctype = "multipart/form-data">
                  <input type ="file" name = "ImportImage[]"  id = "ImageImport" multiple required accept="image/jpg, image/jpeg, image/png" >
                  <button type = "submit" name = "Insert" class = "btn btn-outline-success" >Import</button>
               </form>
            </div>
            <div class = "RemoveImageForm">
               <label for ="Remove" class = "btn btn-outline-success" id = "RemoveBTN" tabindex="0">Remove From Gallery</label>
               <div class = "ImageDisplay">
                  <form action = "#" method = "POST" enctype="multipart/form-data">
                     <input type = "submit" name = "Remove" id = "Remove" class = "RemoveHidden"/>
                     <div class="hidden-checkboxes">
                        <ul>
                           <?php
                              $userID = $_SESSION['id'];
                              $sql = "SELECT * FROM user_image_storage where user_id = '$userID'";
                              $result = $con->query($sql);
                                 while($row = $result->fetch_assoc()){
                              ?>
                           <li>
                              <input type="checkbox" name = "StorageImages[]" value= "<?php echo $row['storage_id'];?>">
                              <?php
                                 echo '<label for = "StorageImages"><div class = "Enlarge"><img src="data:image;base64,'.$row['image'].' "alt="Image"></div></label>';  
                                 }?>
                           </li>
                        </ul>
                     </div>
                  </form> 
               </div>       
            </div>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script type= "text/javascript">
      $(document).ready(function(){
          $('#Insert').click(function(){
              var image_name == $('#ImportImage').val();
              if(image_name == '')
              {
                  alert("Please Select Image");
                  return false;
              }
              else
              {
                  var extension = $('#ImportImage').val().split('.').pop().toLowerCase();
                  if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
                  {
                      alert('Invalid Image File');
                      $('#ImportImage').val('');
                      return false;
                  }
              }
          })
      
      })
      
   </script> 
   <script type="text/javascript">
      $(document).ready(function () {
          $('#RemoveBTN').click(function() {
          checked = $("input[type=checkbox]:checked").length;
      
          if(!checked) {
              alert("You must check at least one checkbox.");
              return false;
          } else {
              var confirmation = confirm('Remove this image from gallery?');
      
              if (confirmation == false){
                  return false;
                  }
      
          }
      
          });
      
          $('.Enlarge').click(function(e){
            e.preventDefault();
             $('.imgBox img').attr('src', $(e.target).attr("src")).css({"border": "1px solid black"});
             document.getElementById("NoImage").style.display = "none";
          });
      });
      
   </script>
   <script>
        function logoutConfirm(){
           if(confirm('Logout now?')){
              window.location.href = "logout.php";
           }
        }

   </script>
</html>
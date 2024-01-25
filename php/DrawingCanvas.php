<?php 
   session_start();
   include("config.php");
   
   if(!isset($_SESSION['username']))
                  {
                  header("location:loginpage.php");
                  }
   ?>
<!doctype html>
<html>
   <head>
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <script src="../_js_libs/react-0.14.3.js"></script>
      <script src="../_js_libs/literallycanvas.js"></script>
      <link href="../_assets/literallycanvas.css" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="../_js_libs/FileSaver.js"></script>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no" />
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
      <div class = "DrawingCanvas col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
         <div class="fs-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h2 style = "text-align:left;">Drawing Board</h2>
            <button onclick="location.href='index.php'" style = "float:left;" class = "btn btn-outline-dark">Back</button>
            <button onclick="location.href='Account_gallery.php'" style = "margin-bottom:20px;" class = "btn btn-outline-success">Account Gallery</button>
            <div id="lc"></div>
            <br>
            <button onClick="saveToFile()" class = "btn btn-outline-success">Save As Image</button>
            <?php
               if(isset($_SESSION['username'])){
                 ?>
            <button onclick="UploadtoDB()" name = "upload" id = "insert" value = "insert" class = "UploadGallery btn btn-outline-success">Upload To Gallery</button>
            <?php
               }
               ?>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script type="text/javascript">
      var lc = LC.init(document.getElementById("lc"),{
        imageURLPrefix: '../_assets/lc-images',
        toolbarPosition: 'bottom',
        defaultStrokeWidth: 2,
        strokeWidths: [1, 2, 3, 5, 30]
      });
      
      function saveToFile(){
        var imageBounds = {
          top: 50, bottom: 50, right: 100, left: 100
        };
        var filename = prompt("Save your drawing as:","drawing.png");
        if(filename){
          filename = "drawing.png";
          lc.getImage({margin: imageBounds}).toBlob(function(blob){
            saveAs(blob,filename);})
        }
      };
      
      function UploadtoDB(){
        
        var imageBounds = {
          top: 50, bottom: 50, right: 100, left: 100
        };
        
        var confirmation = confirm("Save this drawing to your gallery?");
      
        if(confirmation){
          var UserID = "<?php print $_SESSION['id'] ?>";
          
          var dataURI = lc.getImage({margin: imageBounds}).toDataURL();
          console.log(dataURI);
          $.ajax({
            url:'save.php',
            type: 'POST',
            data: {
              data:dataURI, UserID
              }
              
          });
      
          alert("Your drawing has been saved.");
      
        }
      }
      
      window.onbeforeunload = function (e) {
        return "";
      };
   </script>
   <script>
      function logoutConfirm(){
            if(confirm('Logout now?')){
               window.location.href = "logout.php";
            }
         }
   </script>
</html>
<?php 
   session_start();
   include("config.php");
   
   if(!isset($_SESSION['username']))
                 {
                 header("location:loginpage.php");
                 }
                 
   if(isset($_POST["editSubmit"])){
       $forum_id = $_POST["forum_id"];
       $editType = $_POST["editType"];
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://kit.fontawesome.com/9a1f6f3b85.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="../_js_libs/jquery.magnific-popup.js"></script>
      <link rel="stylesheet" href="../_assets/magnific-popup.css">
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
      <main>
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
                              <h6>Leave your feedback here. We will make it better.</h6>
                              <br>
                              <textarea name="feedback" id="feedback" placeholder="Let us know your feedback." required></textarea>
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
         <div class="container">
         <div class="edit_area col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12">
            <h2>Edit Post</h2>
            <button onclick="goBack()" class = "btn btn-outline-dark">Back</button>
            <script>
            function goBack(){
               window.history.back();
            }
         
         </script>
            <?php
               if(isset($_SESSION['username'])){
                   $username = $_SESSION['username'];
               }
               //$forum_id = $_POST['forum_id'];
               $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id WHERE forum_id = $forum_id";
               $resultForum = $con->query($sqlForum);
               
                   while ($row = $resultForum->fetch_assoc()){
                       ?>
            <div class="forumstyle">
               <?php
                  $ProfilePic = $row['profile']; 
                  $forum_status = $row['status'];
                  $caption = $row['caption'];
                  $time = $row['time'];
                  $exam_type = $row['exam_type'];
                  if($exam_type == "SPM"){
                      $spmDisplay = "block";
                      $pt3Display = "none";
                  }else{
                      $spmDisplay = "none";
                      $pt3Display = "block";
                  }
                  $subject_name = $row['subject_name'];
                  $user_forum = $row['username'];
                  ?>
               <div class="post_header">
                  <div class="user_profile">
                     <?php
                        if(empty($row['profile']))
                        {
                            echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "/>';
                        }
                        else
                        {
                            echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"/>';
                        }
                        ?>
                  </div>
                  <div class="post_detail">
                     <span class="username_forum"><?php echo $user_forum; ?></span><br>
                     <span class="time_forum"><?php echo $time; ?></span><br>
                  </div>
               </div>
               <hr class="border border-bottom">
               <div class="content">
                  <div class="caption">
                     <form action="edit.php" onsubmit="return editConfirm(this);" method="post">
                        <input type="hidden" name="editType" value="<?php echo $editType; ?>">
                        <input type="hidden" name="id" value="<?php echo $forum_id;?>">
                        <button type="submit" name="save" value="Save" class="saveEdit btn btn-outline-success">Save</button>
                        <div class="exam">
                           <p style="float:left;">Exam Type :</p>
                           <select name="examType" class="examType" id="examType" onchange="checkExamType(this);" style="float:left; margin-left:5px;">
                              <option value="<?php echo $exam_type;?>" hidden><?php echo $exam_type;?></option>
                              <option value="SPM">SPM</option>
                              <option value="PT3">PT3</option>
                           </select>
                           <br>
                           <br>
                        </div>
                        <div id="Subjectpt3" class="Subjectpt3" style="display:<?php echo $pt3Display; ?>;">
                           <p style="float:left;">Subject Name : </p>
                           <select id="pt3" name="pt3Subject" style="float:left;margin-left:5px;">
                           <?php
                              if($exam_type == "PT3"){
                           ?>
                              <option value="<?php echo $subject_name;?>" hidden><?php echo $subject_name;?></option>
                           <?php
                              }
                           ?>
                              <option value="BM">BM</option>
                              <option value="BI">BI</option>
                              <option value="MM">MM</option>
                              <option value="SN">SN</option>
                              <option value="SEJ">SEJ</option>
                              <option value="GEO">GEO</option>
                              <option value="KH">KH</option>
                           </select>
                           <br>
                        </div>
                        <div id="Subjectspm" class="Subjectspm" style="display:<?php echo $spmDisplay; ?>;">
                           <p style="float:left;">Subject Name : </p>
                           <select id="spm" name="spmSubject" style="float:left; margin-left:5px;">
                           <?php
                              if($exam_type == "SPM"){
                           ?>
                              <option value="<?php echo $subject_name;?>" hidden><?php echo $subject_name;?></option>
                           <?php
                              }
                           ?>
                              <option value="BM">BM</option>
                              <option value="BI">BI</option>
                              <option value="MM">MM</option>
                              <option value="SN">SN</option>
                              <option value="SEJ">SEJ</option>
                              <option value="GEO">GEO</option>
                              <option value="MT">MT</option>
                              <option value="FZ">FZ</option>
                              <option value="KM">KM</option>
                              <option value="BIO">BIO</option>
                              <option value="PN">PN</option>
                              <option value="ACC">ACC</option>
                              <option value="EKO">EKO</option>
                           </select>
                           <br>
                        </div>
                        <br>
                        <?php
                           if($editType == "editPost"){
                           ?>
                        <textarea name="edit_caption" id="caption" class="caption_box" ><?php echo $caption;?></textarea>
                        <?php
                           }
                           if($editType == "editCategory"){
                           ?>
                        <div class="caption">
                           <?php
                              echo $caption;
                              ?>
                        </div>
                        <?php
                           }
                           ?>
                     </form>
                  </div>
                  <br>
                  <div class="post_image">
                     <div id="forumImage" class="carousel slide">
                        <ol class="carousel-indicators">
                           <?php
                              $count = 0;
                              $sqlImage = "SELECT * FROM forum_image WHERE forum_id=$forum_id ORDER BY image_id ASC";
                              $resultImage = $con->query($sqlImage);
                              while ($row = $resultImage->fetch_assoc()){
                                  if($count == 0)
                                  {
                                      ?>
                           <li data-target="#forumImage" data-slide-to="<?php echo $count; ?>" class="active"></li>
                           <?php
                              }
                              else
                              {
                                  ?>
                           <li data-target="#forumImage" data-slide-to="<?php echo $count; ?>"></li>
                           <?php
                              }
                              $count = $count + 1;
                              }
                              ?>
                        </ol>
                        <div class="carousel-inner">
                           <?php
                              $count = 0;
                              $sqlImage = "SELECT * FROM forum_image WHERE forum_id=$forum_id ORDER BY image_id ASC";
                              $resultImage = $con->query($sqlImage);
                                  while ($row = $resultImage->fetch_assoc()){
                                      if($count == 0)
                                      {
                                          ?>
                           <div class="carousel-item active">
                              <?php
                                 echo '<div class = "PopUp"><img class="d-block w-100" src="data:image;base64,'.$row['image'].'"/></div>';
                                 ?>
                           </div>
                           <?php
                              }
                              else
                              {
                                  ?>
                           <div class="carousel-item ">
                              <?php
                                 echo '<div class = "PopUp"><img class="d-block w-100" src="data:image;base64,'.$row['image'].'"/></div>';
                                 ?>
                           </div>
                           <?php
                              }
                              $count = $count + 1;
                              }
                              ?>
                        </div>
                        <a class="carousel-control-prev" href="#forumImage" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#forumImage" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
         </div>
      </main>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script type="text/javascript">
      function checkExamType(that) {
      if (that.value == "SPM") {
          document.getElementById("Subjectspm").style.display = "block";
          document.getElementById("Subjectpt3").style.display = "none";
      } else if (that.value == "PT3"){
          document.getElementById("Subjectspm").style.display = "none";
          document.getElementById("Subjectpt3").style.display = "block";
      }
      }
      function editConfirm(){
          return confirm('Do you want to make changes to this post?');
      }
      function logoutConfirm(){
           if(confirm('Logout now?')){
              window.location.href = "logout.php";
           }
        }
   </script>
   <script>
      var magnific = $(".PopUp").magnificPopup({
      delegate: 'img',
      type:'image',
      callbacks: {
          elementParse: function(item) { item.src = item.el.attr('src'); }
      }
      });
      
      
      
   </script>
</html>
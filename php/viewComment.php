<?php 
   session_start();
   include('config.php');
   if(isset($_GET["forum_id"])){
    
     $forum_id = $_GET["forum_id"];
   }
   if(isset($_GET["id"])){
      $forum_id = $_GET["id"];
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
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="https://kit.fontawesome.com/9a1f6f3b85.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
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
         <div class="container">
         <div class="view_area col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <br>
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
               
               $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id WHERE forum_id=$forum_id";
               $resultForum = mysqli_query($con, $sqlForum);
               $CheckForum = mysqli_num_rows($resultForum);
               if ($CheckForum > 0){
               
                   while ($row = mysqli_fetch_assoc($resultForum)){
                       ?>
            <div class="forumstyle">
               <?php
                  $ProfilePic = $row['profile']; 
                  $forum_status = $row['status'];
                  $forum_id = $row['forum_id'];
                  $forum_name = $row['forum_name'];
                  $caption = nl2br($row['caption']);
                  $time = $row['time'];
                  $exam_type = $row['exam_type'];
                  $subject_name = $row['subject_name'];
                  $user_forum = $row['username'];
                  $user_id = $row['user_id'];
                  if($exam_type == "SPM"){
                     $spmDisplay = "block";
                     $pt3Display = "none";
                  }else{
                     $spmDisplay = "none";
                     $pt3Display = "block";
                  }
                  ?>
               <div class="post_header">
                  <a href="Profile.php?id=<?php echo $user_id; ?>" >
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
                        <span class="username_forum"><?php echo $user_forum; ?></span>
                  </a>
                  <br>
                  <span class="time_forum"><?php echo date("d-m-Y H:i:s", strtotime($time)); ?></span><br>
                  </div>
                  <div class="post_type badge badge-primary">
                     <?php
                        echo "$exam_type  |  $subject_name <br>";
                        ?>
                  </div>
               </div>
               <hr class="border border-bottom">
               <div class="content">
                  <?php
                     if($forum_status == "Show"){
                     if(isset($_SESSION['username'])){
                             ?>
                  <div class="dropdown">
                     <button class="btn dropdown-toggle drop-btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <?php
                           if($_SESSION['username'] == $user_forum){
                               ?>
                        <form method="POST" action="editpost.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id;?>">
                           <input type="hidden" name="editType" value="editPost">
                           <button type="submit" class="dropdown-item" name="editSubmit">Edit</button>
                        </form>
                        <form method="POST" onsubmit="return deletePost(this);" action="deletepost.php">
                           <input type="hidden" name="location" value="viewComment.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id;?>">
                           <button type="submit" class="dropdown-item" name="deleteSubmit">Delete</button>
                        </form>
                        <?php
                           }
                           if($_SESSION['role'] == "user" and $user_forum != $_SESSION['username'] ){
                               ?>
                        <button class="dropdown-item" data-toggle="modal" data-target="#<?php echo $forum_name."Report"; ?>">Report</button>
                        <?php
                           }
                           if($_SESSION['role'] == "admin" and $user_forum != $_SESSION['username'] ){
                           ?>
                        <form method="POST" action="editpost.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id;?>">
                           <input type="hidden" name="editType" value="editCategory">
                           <button type="submit" class="dropdown-item" name="editSubmit">Edit</button>
                        </form>
                        <button class="dropdown-item" data-toggle="modal" data-target="#<?php echo $forum_name."Restrict"; ?>">Restrict</button>
                        <?php
                           }
                           ?>
                     </div>
                  </div>
                  <div class="modal fade" id="<?php echo $forum_name."Report"; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header modal-drawificolor">
                              <h5 class="modal-title" id="exampleModalCenterTitle">REPORT</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form action="report.php" method="post">
                              <div class="modal-body">
                                 What type issues you want to report to this post?
                                 <select id="reportIssues" name="reportIssues" >
                                    <option value="Sensitive content">Sensitive content</option>
                                    <option value="Discriminatory content">Discriminatory content</option>
                                    <option value="Insulting content">Insulting content</option>
                                    <option value="Irrelevant content">Irrelevant content</option>
                                 </select>
                                 <input type="hidden" name="location" value="viewComment.php">
                                 <input type="hidden" name="redirect_id" value="<?php echo $forum_id;?>">
                                 <input type="hidden" name="id" id="id" value="<?php echo $forum_id;?>">
                                 <input type="hidden" name="userID" id="userID" value= "<?php echo $_SESSION['id']; ?>">
                                 <input type="hidden" name="report_type" id="report_type" value= "forum">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                 <input type="submit" class="btn btn-outline-success" name="report_forum" id="report_forum" value="Report Forum">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="modal fade" id="<?php echo $forum_name."Restrict"; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header modal-drawificolor">
                              <h5 class="modal-title" id="exampleModalCenterTitle">RESTRICT</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form action="restrict.php" method="post">
                              <div class="modal-body">
                                 Are you sure you want to restrict this post?
                                 <input type="hidden" name="id" id="id" value="<?php echo $forum_id;?>">
                                 <input type="hidden" name="restrict_type" id="restrict_type" value= "forum">
                                 <input type="hidden" name="location" value="viewComment.php">
                                 <input type="hidden" name="redirect_id" value="<?php echo $forum_id;?>">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                 <input type="submit" class="btn btn-outline-success" name="restrict_forum" id="restrict_forum" value="Yes">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <script>
                     function dltForum(){confirm('Confirm to delete the post?');}
                  </script>
                  <?php
                     }
                     }
                     if($forum_status == "Restrict"){
                        echo "<div class='restrict'>"; 
                        echo "This post has been restricted.<br>";
                        echo "<small><i>DRAWIFICIENT</i></small>";
                        echo "</div>";
                     }else{
                     ?>
                  <div class="caption wrapword">
                     <?php
                        
                        echo $caption;
                        
                        ?>
                  </div>
                  <br>
                  <div class="post_image">
                     <div id="<?php echo $forum_name; ?>" class="carousel slide">
                        <ol class="carousel-indicators">
                           <?php
                              $count = 0;
                              $sqlImage = "SELECT * FROM forum_image WHERE forum_id=$forum_id AND status='Show' ORDER BY image_id ASC";
                              $resultImage = $con->query($sqlImage);
                              while ($row = $resultImage->fetch_assoc()){
                                  if($count == 0)
                                  {
                                      ?>
                           <li data-target="#<?php echo $forum_name; ?>" data-slide-to="<?php echo $count; ?>" class="active"></li>
                           <?php
                              }
                              else
                              {
                                  ?>
                           <li data-target="#<?php echo $forum_name; ?>" data-slide-to="<?php echo $count; ?>"></li>
                           <?php
                              }
                              $count = $count + 1;
                              }
                              ?>
                        </ol>
                        <div class="carousel-inner">
                           <?php
                              $count = 0;
                              $sqlImage = "SELECT * FROM forum_image WHERE forum_id=$forum_id AND status='Show' ORDER BY image_id ASC";
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
                        <a class="carousel-control-prev" href="#<?php echo $forum_name; ?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#<?php echo $forum_name; ?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
               </div>
               <?php 
                  if($forum_status == "Show"){
                  ?>
               <div class="border-top"></div>
               <div class="comment_area">
                  <?php
                     $sqlComment = "SELECT * FROM comment join user on comment.user_id = user.user_id WHERE forum_id=$forum_id ORDER BY time ASC";
                     $resultComment = $con->query($sqlComment);
                     if($resultComment -> num_rows > 0){
                         while($row = $resultComment->fetch_assoc()){
                             ?>
                  <div class="commentstyle">
                     <?php
                        if($row['status'] == "Show"){
                                  
                              
                        if(isset($_SESSION['username'])){
                           ?>
                     <div class="dropdown">
                        <button class="btn dropdown-toggle drop-btn" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                           <?php
                              if($_SESSION['username'] == $row['username']){
                                  ?>
                           <form method="POST" onsubmit="return deleteComment(this);" action="deletecomment.php">
                              <input type="hidden" name="location" value="viewComment.php">
                              <input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">
                              <input type="hidden" name="comment_id" value="<?php echo $row['comment_id'];?>">
                              <button type="submit" class="dropdown-item" name="deleteSubmit">Delete</button>
                           </form>
                           <?php
                              }
                              if($_SESSION['role'] == "user" and $_SESSION['username'] != $row['username']){
                                  ?>
                           <button class="dropdown-item" data-toggle="modal" data-target="#<?php echo $row['comment_name']."Report";?>">Report</button>
                           <?php
                              }
                              if($_SESSION['role'] == "admin" and $_SESSION['username'] != $row['username']){
                              ?>
                           <button class="dropdown-item" data-toggle="modal" data-target="#<?php echo $row['comment_name']."Restrict";?>">Restrict</button>
                           <?php
                              }
                              ?>
                        </div>
                     </div>
                     <?php
                        }
                        }
                        ?>
                     <div class="modal fade" id="<?php echo $row['comment_name']."Report";?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header modal-drawificolor">
                                 <h5 class="modal-title" id="exampleModalCenterTitle">REPORT</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="report.php" method="post">
                                 <div class="modal-body">
                                    What type of issues you want to report to this comment?
                                    <select id="reportIssues" name="reportIssues" >
                                       <option value="Sensitive content">Sensitive content</option>
                                       <option value="Discriminatory content">Discriminatory content</option>
                                       <option value="Insulting content">Insulting content</option>
                                       <option value="Irrelevant content">Irrelevant content</option>
                                    </select>
                                    <input type="hidden" name="location" value="viewComment.php">
                                    <input type="hidden" name="redirect_id" value="<?php echo $forum_id;?>">
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['comment_id'];?>">
                                    <input type="hidden" name="userID" id="userID" value= "<?php echo $_SESSION['id'] ?>">
                                    <input type="hidden" name="report_type" id="report_type" value= "comment">
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-outline-success" name="report_comment" id="report_comment" value="Report Comment">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="modal fade" id="<?php echo $row['comment_name']."Restrict";?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                              <div class="modal-header modal-drawificolor">
                                 <h5 class="modal-title" id="exampleModalCenterTitle">RESTRICT</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="restrict.php" method="post">
                                 <div class="modal-body">
                                    Are you sure you want to restrict this comment?
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['comment_id'];?>">
                                    <input type="hidden" name="restrict_type" id="restrict_type" value= "comment">
                                    <input type="hidden" name="location" value="viewComment.php">
                                    <input type="hidden" name="redirect_id" value="<?php echo $forum_id;?>">
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                    <input type="submit" class="btn btn-outline-success" name="restrict_comment" id="restrict_comment" value="Yes">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <script>
                        function dltComment(){confirm('Confirm to delete the comment?');}
                     </script>
                     <div class="comment_profile">
                        <a href="profile.php?id=<?php echo $row['user_id']; ?>" >
                           <?php
                              $CommentProfile = $row['profile'];
                                 if(empty($row['profile']))
                                 {
                                     echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "/>';
                                 }
                                 else
                                 {
                                     echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($CommentProfile).'"/>';
                                 }
                                 ?>
                     </div>
                     <div class="comment_detail">
                     <span class="username_comment"><?php echo $row['username']; ?></span></a>
                     <span class="time_comment"><?php echo date("d-m-Y H:i:s", strtotime($row['time'])); ?></span><br>
                     </div>
                     <br>
                     <div class="comment_content">
                        <?php
                           if($row['status'] == "Restrict"){
                              echo "<div class='restrict'>"; 
                              echo "This comment has been restricted.<br>";
                              echo "<small><i>DRAWIFICIENT</i></small>";
                              echo "</div>";
                           }else{
                              echo "<div class='scroll'>";
                                  echo "<span class='wrapword'>";
                                  echo nl2br($row['caption']);
                                  echo "</span>";
                                  echo "</div>";
                           }
                           ?>
                     </div>
                     <br class="breakLine">
                  </div>
                  <br class="breakLine">
                  <br class="breakLine">
                  <?php
                     } 
                     }else{
                     echo "<div class='commentstyle'>";
                     echo "No comment yet";
                     echo "</div>";
                     }
                     ?>
                  <?php
                     if(isset($_SESSION['username'])){
                         ?>
                  <div class="commentstyle">
                     <form method="POST" action="insertcomment.php">
                        <button type="submit" name="commentPost" class="commentBtn btn btn-outline-primary far fa-comments"></button>
                        <div class="comment_profile">
                           <?php
                              $sqlCurrent = "SELECT * FROM user WHERE username='$username'";
                              $resultCurrent = $con->query($sqlCurrent);
                              while($row = $resultCurrent->fetch_assoc())
                              {
                                 $ProfilePic = $row['profile'];
                                 if(empty($row['profile']))
                                 {
                                     echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "/>';
                                 }
                                 else
                                 {
                                     echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"/>';
                                 }
                              }
                              ?>
                        </div>
                        <div class="comment_content">
                           <input type="hidden" name="location" value="viewComment.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id ;?>">
                           <input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ;?>">
                           <textarea id="comment" name="comment" class="comment_box border-primary" placeholder="Enter your comment" required></textarea>
                        </div>
                     </form>
                     <br>
                     <br>
                  </div>
                  <?php
                     }
                     
                     ?>
               </div>
               <br>
               <?php
                  }//temparory for restrict function
                      echo "</div>";
                  
                  }
                  }
                  else {
                  echo "";
                  }
                  ?>
            </div>
         </div>
      </main>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script>
      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }
      
      $('.dropdown-toggle').dropdown()
      
      function deletePost(){
               return confirm('Do you really want to delete this post?');
            }
            function deleteComment(){
               return confirm('Do you really want to delete this comment?');
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
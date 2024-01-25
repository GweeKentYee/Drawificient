<?php
   session_start();
   include('config.php');
   if(isset($_POST["remove"])){
      $num = count($_POST['remove_feedback']);
      $final_num = 0;
      foreach($_POST['remove_feedback'] as $_POST['remove_feedback']){
         $remove_feedback = $_POST['remove_feedback'];
         $query = "DELETE FROM feedback WHERE feedback_id='".$remove_feedback."'";
         $final_num = $final_num + 1;
         if($con->query($query) === TRUE){
            if($final_num == $num){
               echo '<script>alert("Removed successfully.")</script>';
            }
         }else{
            if($final_num == $num){
               echo '<script>alert("Removed unsuccessful.")</script>';
            }
            
         }
               
            
            
         
         
      }
      header("refresh:1; url='feedback.php'");
   }
   function call_user($user_id){
    include('config.php');
    $userSql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = $con->query($userSql);
    $row = $result->fetch_assoc();
    if(empty($row['profile']))
    {
        echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg "style="width:40px; height:40px; margin-right:10px""/>';
    }
    else
    {
        echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($row['profile']).'"style="width:40px; height:40px; margin-right:10px""/>';
    }
    echo  $row['username'];
}


   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>DRAWIFICIENT</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
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
                        <a class="dropdown-item active" href="feedback.php"><i class="far fa-comment-dots"></i> Feedback</a>
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
      <div class="feedback_area">
      
      
                         
                                    <div class="display_feedback" >
                                    <form action="#"  onsubmit="return deleteFeedback(this);" method="post">
                                       <div class="display_header">
                                       <button class="remove_btn btn btn-outline-dark" name="remove" type="submit" style="float:right;"><i class="far fa-trash-alt"></i></button>
                                       <button onclick="goBack()" class = "btn btn-outline-dark" type="button" style="float:left;">Back</button>
                                       <script>
                                          function goBack(){
                                             window.history.back();
                                          }
                                       </script>
                                       <h2 style="text-align:center;">Feedback</h2>
                                       
                                       </div>
                                       <div class="display_content">
                                       <?php
                            $sql = "SELECT * FROM feedback ORDER BY time DESC";
                            $resultSql = $con->query($sql);
                            if($resultSql -> num_rows > 0){
                              while($row = $resultSql->fetch_assoc())
                              {
                                  ?> 
                                            
                                      <div class="feedback_card">
                                      <div class="feedback-checkbox" style="float:right;">
                                         <input type="checkbox" name = "remove_feedback[]" value= "<?php echo $row['feedback_id'];?>">
                                      </div>
                                      <div class="feedback_user">
                                          
                                          <?php echo call_user($row['user_id']); ?>
                                          
                                      </div>
                                      <div class="feedback_content">
                                          <?php echo nl2br($row['user_feedback']); ?>
                                      </div>
  
                                      </div>         
                                            
                                      
                                      
                                      <?php } 
                            }else{
                               echo "No Feedback Yet.";
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
   <script>
      $('.dropdown-toggle').dropdown()

      function deleteFeedback(){
         return confirm('Delete the selected feedbacks?');
      }

      function logoutConfirm(){
         if(confirm('Logout now?')){
            window.location.href = "logout.php";
         }
      }
   </script>
</html>
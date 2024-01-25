<?php
   session_start();
   include("config.php");
   
   if(!isset($_SESSION['username']))
                  {
                  header("location:loginpage.php");
                  }
   
      if(isset($_POST["InsertWithStorage"]))
      {
         $num = count($_POST['StorageImages']);
         $final_num = 0;

          $caption=$_POST["caption"];
          $exam_type = $_POST["exam_type"];
          if($exam_type == "SPM"){
            $subject_name = $_POST["spmSubject"];
         }elseif($exam_type == "PT3"){
            $subject_name = $_POST["pt3Subject"];
         }
          $status=$_POST["status"];
          $userID= $_SESSION['id'];
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $time = date("Y-m-d H:i:s");
          $query = "INSERT INTO forum (caption, forum_name, time, exam_type, subject_name, status, user_id) VALUES ('$caption', 'null', '$time','$exam_type','$subject_name','$status','$userID')";
      
          mysqli_query($con, $query);
          $forum_id = mysqli_insert_id($con);
          $forum_name = "forum".$forum_id;
   
          $sql = "UPDATE forum SET forum_name = '$forum_name' WHERE forum_id = '$forum_id';";
          mysqli_query($con,$sql);
          foreach ($_POST['StorageImages'] as $_POST['StorageImages']){

              $final_num = $final_num + 1;
              $Checked = $_POST['StorageImages'];
              $query1 = "SELECT TO_BASE64(image) as image FROM user_image_storage where storage_id = '$Checked'";
              
              $result1 = mysqli_query($con, $query1) or die( mysqli_error($con));
              
              while($row = mysqli_fetch_array($result1)){
                   $file = base64_decode($row['image']);
              }
   
              $query2 = "INSERT INTO forum_image (image, user_id, forum_id, status) VALUES ('$file','$userID','$forum_id', 'Show')";

              if($con->query($query2) === TRUE){
               if($final_num == $num){
                  echo '<script>alert("Post uploaded successfully.")</script>';
               }
            }else{
               if($final_num == $num){
                  echo '<script>alert("Upload unsuccessful.")</script>';
               }
               
            }
   
          }
          
          echo '<script>window.location.href = "index.php";</script>';
      }
      
      if(isset($_POST["InsertManual"]))
      {
         $num = count($_FILES['ManualImage']["tmp_name"]);
         $final_num = 0;

          $caption=$_POST["caption"];
          $exam_type = $_POST["exam_type"];
          if($exam_type == "SPM"){
            $subject_name = $_POST["spmSubject"];
         }elseif($exam_type == "PT3"){
            $subject_name = $_POST["pt3Subject"];
         }
          $status=$_POST["status"];
          $userID= $_SESSION['id'];
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $time = date("Y-m-d H:i:s");
          $query = "INSERT INTO forum (caption, forum_name, time, exam_type, subject_name, status, user_id) VALUES ('$caption', 'null','$time','$exam_type','$subject_name','$status','$userID')";
      
          mysqli_query($con, $query);
          $forum_id = mysqli_insert_id($con);
          $forum_name = "forum" .$forum_id;
   
          $sql = "UPDATE forum SET forum_name = '$forum_name' WHERE forum_id = '$forum_id';";
          mysqli_query($con,$sql);
      
          foreach ($_FILES['ManualImage']["tmp_name"] as $_FILES['ManualImage']["tmp_name"]){
              $final_num = $final_num + 1;
              $file = addslashes(base64_encode(file_get_contents($_FILES['ManualImage']["tmp_name"])));
              $query1 = "INSERT INTO forum_image (image, user_id, forum_id, status) VALUES ('$file','$userID','$forum_id', 'Show')";
              if($con->query($query1) === TRUE){
               if($final_num == $num){
                  echo '<script>alert("Post uploaded successfully.")</script>';
               }
            }else{
               if($final_num == $num){
                  echo '<script>alert("Upload unsuccessful.")</script>';
               }
               
            }
          
          }
          echo '<script>window.location.href = "index.php";</script>';
          
      }
      ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <script src="../_js_libs/jquery.magnific-popup.js"></script>
      <link rel="stylesheet" href="../_assets/magnific-popup.css">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
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
      <div class = "StorageInsertForm col-lg-11 col-md-11 col-sm-11 col-12" id = "HideStorageForm">
         <h2>New Post</h2>
         <div class="btn-toolbar justify-content-between" role="toolbar">
            <div>
            <button onclick="goBack()" class = "btn btn-outline-dark">Back</button>
            <script>
            function goBack(){
               window.history.back();
            }
         
         </script>
               <button id = "StorageInsert" onclick = "ShowStorageInsert()" class = "btn btn-outline-success">Account Gallery</button>
               <button id = "ManualInsert" onclick = "ShowManualInsert()" class = "btn btn-outline-success">Import</button>
            </div>
            <div>
               <form action="#" method="post" enctype="multipart/form-data">
                  <button type="submit" name="InsertWithStorage" id="insert" class = "btn btn-outline-success">Post</button>
            </div>
         </div>
         <div class="forumstyle">
            <?php
               $profileQuery = "SELECT * FROM user WHERE user_id = '".$_SESSION['id']."'";
               $res2 = mysqli_query($con, $profileQuery);
               if (mysqli_num_rows($res2) > 0)
                  {      
                     while($row = mysqli_fetch_array($res2))
                        {
                           $ProfilePic = $row['profile']; 
                           $user_forum = $row['username'];
               
               ?>
            <div class="post_header">
               <div class="user_profile">
                  <?php
                     if(empty($row['profile']))
                     {
                        echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg ""/>';
                     }
                     else
                     {
                        echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"style=""/>';
                     }
                     ?>
               </div>
               <div class="post_detail">
                  <span class="username_forum">
                  <?php echo $user_forum;  
                     } 
                     }?>
                  </span>
               </div>
               <div class = "Exam_Subject_type input-group-append">
                  <div class = "Exam_Type">
                     <p id = "ExamLabel">Exam type:</p>
                     <select id="exam_type" name="exam_type" onchange="checkExamType(this);">
                        <option value="SPM">SPM</option>
                        <option value="PT3">PT3</option>
                     </select>
                     
                  </div>
                  <br class = "BreakLineExamSubject">
                  <div class = "Subject_Type">
                     <p id = "SubjectLabel">Subject Name:</p>
                     <div id="spmSubject">
                        <select id="subject_name" name="spmSubject">
                           <option value="BM">BM</option>
                           <option value="BI">BI</option>
                           <option value="MM">MM</option>
                           <option value="SN">SN</option>
                           <option value="SEJ">SEJ</option>
                           <option value="GEO">GEO</option>
                           <option value="KH">KH</option>
                           <option value="MT">MT</option>
                           <option value="FZ">FZ</option>
                           <option value="KM">KM</option>
                           <option value="BIO">BIO</option>
                           <option value="PN">PN</option>
                           <option value="ACC">ACC</option>
                           <option value="EKO">EKO</option>
                        </select>
                     </div>
                     <div id="pt3Subject" style="display:none;">
                        <select id="subject_name" name="pt3Subject">
                           <option value="BM">BM</option>
                           <option value="BI">BI</option>
                           <option value="MM">MM</option>
                           <option value="SN">SN</option>
                           <option value="SEJ">SEJ</option>
                           <option value="GEO">GEO</option>
                           <option value="KH">KH</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="border border-bottom">
            <div class = "StorageInsertContent">
               <div class = "CaptionSection">
                  <textarea name="caption" placeholder="Write some caption here...."></textarea>
               </div>
               <hr class="border border-bottom">
               <p class = "ImageStorageTitle">Account Gallery</p>
               <div class = "ImageStorage">
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
                              echo '<label for = "StorageImages"><div class = "PopUp"><img src="data:image;base64,'.$row['image'].' "alt="Image"></div></label>';  
                              }?>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <input type="hidden" name="status" id="status" value="Show">  
            </form>
         </div>
      </div>
      <div class = "ManualInsertForm col-lg-11 col-md-11 col-sm-11 col-12" id = "HideManualForm" style = "display:none;">
         <h2>New Post</h2>
         <div class="btn-toolbar justify-content-between" role="toolbar">
            <div>
            <button onclick="goBack()" class = "btn btn-outline-dark">Back</button>
            <script>
            function goBack(){
               window.history.back();
            }
         
         </script>
               <button id = "StorageInsert" onclick = "ShowStorageInsert()" class = "btn btn-outline-success">Account Gallery</button>
               <button id = "ManualInsert" onclick = "ShowManualInsert()" class = "btn btn-outline-success">Import</button>
            </div>
            <div>
               <form action="#" method="post" enctype="multipart/form-data">
                  <button type="submit" name="InsertManual" id="insert" class = "btn btn-outline-success" onclick = "ConfirmationMessage()">Post</button>
            </div>
         </div>
         <div class="forumstyle">
            <?php
               $profileQuery = "SELECT * FROM user WHERE user_id = '".$_SESSION['id']."'";
               $res2 = mysqli_query($con, $profileQuery);
               if (mysqli_num_rows($res2) > 0)
                  {      
                     while($row = mysqli_fetch_array($res2))
                        {
                           $ProfilePic = $row['profile']; 
                           $user_forum = $row['username'];
               
               ?>
            <div class="post_header">
               <div class="user_profile">
                  <?php
                     if(empty($row['profile']))
                     {
                        echo '<img class = "rounded-circle" alt="Profile Pic " src = "https://icon-library.com/images/default-profile-icon/default-profile-icon-6.jpg ""/>';
                     }
                     else
                     {
                        echo '<img class = "rounded-circle" alt="Profile Pic " src="data:image/jpeg;base64, '.base64_encode($ProfilePic).'"style=""/>';
                     }
                     ?>
               </div>
               <div class="post_detail">
                  <span class="username_forum">
                  <?php echo $user_forum;  
                     } 
                     }?>
                  </span>
               </div>
               <div class = "Exam_Subject_type input-group-append">
                  <div class = "Exam_Type">
                     <p id = "ExamLabel">Exam type:</p>
                     <select id="exam_type" name="exam_type" onchange="checkExamType1(this);">
                        <option value="SPM">SPM</option>
                        <option value="PT3">PT3</option>
                     </select>
                  </div>
                  <br class = "BreakLineExamSubject">
                  <div class = "Subject_Type">
                     <p id = "SubjectLabel">Subject Name:</p>
                     <div id="spmSubject1"  style="display: block;">
                        <select id="subject_name" name="spmSubject">
                           <option value="BM">BM</option>
                           <option value="BI">BI</option>
                           <option value="MM">MM</option>
                           <option value="SN">SN</option>
                           <option value="SEJ">SEJ</option>
                           <option value="GEO">GEO</option>
                           <option value="KH">KH</option>
                           <option value="MT">MT</option>
                           <option value="FZ">FZ</option>
                           <option value="KM">KM</option>
                           <option value="BIO">BIO</option>
                           <option value="PN">PN</option>
                           <option value="ACC">ACC</option>
                           <option value="EKO">EKO</option>
                        </select>
                     </div>
                     <div id="pt3Subject1" style="display:none;">
                        <select id="subject_name" name="pt3Subject">
                           <option value="BM">BM</option>
                           <option value="BI">BI</option>
                           <option value="MM">MM</option>
                           <option value="SN">SN</option>
                           <option value="SEJ">SEJ</option>
                           <option value="GEO">GEO</option>
                           <option value="KH">KH</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <hr class="border border-bottom">
            <div class = "ManualInsertContent">
               <div class = "CaptionSection">
                  <textarea name="caption" placeholder="Write some caption here...."></textarea>
               </div>
               <hr class="border border-bottom">
               <div class = "ImportFile">
                  <p>Import Picture/Drawing</p>
                  <input id="file-input" type="file" name="ManualImage[]" multiple required accept="image/jpg, image/jpeg, image/png">
                  <br>
                  <br>
                  <div class="preview"></div>
               </div>
               <input type="hidden" name="status" id="status" value="Show">
            </div>
            </form>
         </div>
      </div>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script type="text/javascript">
      $(document).ready(function(){
          $('#InsertManual').click(function(){
              var image_name == $('#ManualImage').val();
              if(image_name == '')
              {
                  alert("Please Select Image");
                  return false;
              }
              else
              {
                  var extension = $('#ManualImage').val().split('.').pop().toLowerCase();
                  if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
                  {
                      alert('Invalid Image File');
                      $('#ManualImage').val('');
                      return false;
                  }
              }
          })
      });
      
   </script>
   <script type="text/javascript">
      function checkExamType(that) {
      if (that.value == "SPM") {
          document.getElementById("spmSubject").style.display = "block";
          document.getElementById("pt3Subject").style.display = "none";
      } else {
          document.getElementById("spmSubject").style.display = "none";
          document.getElementById("pt3Subject").style.display = "block";
      }
      }
      
      function checkExamType1(that) {
      if (that.value == "SPM") {
          document.getElementById("spmSubject1").style.display = "block";
          document.getElementById("pt3Subject1").style.display = "none";
      } else {
          document.getElementById("spmSubject1").style.display = "none";
          document.getElementById("pt3Subject1").style.display = "block";
      }
      
      }
      
      function previewImages() {
      
          var $preview = $('.preview').empty();
          if (this.files) $.each(this.files, readAndPreview);
      
          function readAndPreview(i, file) {
      
          if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
              return alert(file.name +" is not an image");
          }
      
          var reader = new FileReader();
      
          $(reader).on("load", function() {
              $preview.append($("<img/>", {src:this.result, height:120}).css({"margin":"10px","border": "1px solid black"}));
          });
      
          reader.readAsDataURL(file);
          
          }
          
      }
      
      $('#file-input').on("change", previewImages);
      
      function ShowStorageInsert(){
          
          document.getElementById("HideStorageForm").style.display = "block";
          document.getElementById("HideManualForm").style.display = "none";
      
      }
      
      function ShowManualInsert(){
          
          document.getElementById("HideStorageForm").style.display = "none";
          document.getElementById("HideManualForm").style.display = "block";
      }
      
   </script>
   <script>
      var magnific = $(".PopUp").magnificPopup({
        delegate: 'img',
        gallery: {
           enabled:true
        },
        type:'image',
        callbacks: {
           elementParse: function(item) { item.src = item.el.attr('src'); }
      }
      });
      
   </script>
   <script>
      $(".preview").magnificPopup({
         delegate: 'img',
         gallery: {
            enabled:true
         },
         type:'image',
         callbacks: {
            elementParse: function(item) { item.src = item.el.attr('src'); }
      }
      
      });
      
   </script>
   <script type="text/javascript">
      $(document).ready(function () {
          $('#insert').click(function() {
          checked = $("input[type=checkbox]:checked").length;
      
          if(!checked) {
              alert("You must check at least one checkbox.");
              return false;
          } else {
              var confirmation = confirm('Are you sure you want to post this?');
      
              if (confirmation == false){
                  return false;
                  }
               window.onbeforeunload = null;
          }
          });
      
      }); 
      
      window.onbeforeunload = function (e) {
        return "";
      };
      
      function logoutConfirm(){
         if(confirm('Logout now?')){
            window.location.href = "logout.php";
         }
      }
      
      function ConfirmationMessage(){
      
         var CfmMsg = confirm('Are you sure you want to post this?');
      
         if (CfmMsg == false){
            event.preventDefault();
         } else if (CfmMsg == true) {
            if(document.getElementById("file-input").files.length != 0 ){
               window.onbeforeunload = null;
            }
         }
      
      }
   </script>
</html>
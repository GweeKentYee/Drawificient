<?php
   session_start();
   include("config.php");
   if(!isset($_SESSION['username']))
                     {
                     header("location:loginpage.php");
                     }
   
   if($_SESSION['role'] == "user"){
         header("Location:index.php");
         }
   
      if(isset($_POST["InsertWithStorage"]))
      {
          $remark=$_POST["remark"];
          $status = $_POST["status"];
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $time = date("Y-m-d H:i:s");
          $sequence=$_POST["sequence"];
   
           $Checked = $_POST['StorageImages'];
           $query1 = "SELECT TO_BASE64(image) as image FROM user_image_storage where storage_id = '$Checked'";
           
           $result1 = mysqli_query($con, $query1) or die( mysqli_error($con));
           
           while($row = mysqli_fetch_array($result1)){
               $file = base64_decode($row['image']);
           }
           
          $query = "INSERT INTO news (remark, image, time, status, sequence) VALUES ('$remark', '$file', '$time','$status','$sequence')";
      
          if(mysqli_query($con, $query))
          {
              echo '<script>alert("Upload successfully")</script>';
          }
          else
          {
              echo '<script>alert("Upload unsuccessfully")</script>';
          }
      }
      
      if(isset($_POST["InsertManual"]))
      {
          $remark=$_POST["remark"];
          $status=$_POST["status"];
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $time = date("Y-m-d H:i:s");
          $sequence=$_POST["sequence"];
              $file = addslashes(base64_encode(file_get_contents($_FILES['ManualImage']["tmp_name"])));
              $query = "INSERT INTO news (remark, image, time, status, sequence) VALUES ('$remark', '$file', '$time','$status','$sequence')";
              if(mysqli_query($con, $query))
              {
                  echo '<script>alert("Upload successfully")</script>';
              }
              else
              {
                  echo '<script>alert("Upload image unsuccessfully")</script>';
              }
          
          
      }
      ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="../_assets/style.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="../_js_libs/jquery.magnific-popup.js"></script>
      <link rel="stylesheet" href="../_assets/magnific-popup.css">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <script src="../_js_libs/jquery.magnific-popup.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
                        <a class="dropdown-item" href="feedback.php"><i class="far fa-comment-dots"></i> Feedback</a>
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
      <div id = "StorageInsert_news">
         <h2>Add News</h2>
         
         
         <form action="#" method="post" enctype="multipart/form-data">
         <div class="btn-toolbar justify-content-between" role="toolbar" style = "margin-bottom:10px;" aria-label="Toolbar with button groups">
            <div>
         <button onclick="location.href='news_table.php'" class = "btn btn-outline-dark">Back</button>
                  
         <button id = "StorageInsert" onclick = "ShowStorageInsert()" class="btn btn-outline-success">Account Gallery</button>
         <button id = "ManualInsert" onclick = "ShowManualInsert()" class="btn btn-outline-success">Import</button>
         </div>
         <div>
            <button type="submit" name="InsertWithStorage" id="insert" class = "btn btn-outline-success" >Insert</button></div>
            </div>
            <div class = "StorageInsertContent_News">

               <div class = "remarkSection">
                  <p style = "float:left;">Remark :</p>
                  <textarea name="remark" placeholder="Write some caption here...." required></textarea>
               </div>
               <div class = "news_status">
                     <input type="hidden" name="sequence" value="0">
                     <p style = "float:left; margin-right: 5px;">Status :</p>
                     <select id="status" name="status">
                        <option value="Show">Show</option>
                        <option value="Restrict">Restrict</option>
                     </select>
                     <br>
                     <br>
               </div>
               <div class = "ImageStorage_news">
                  <p>Account Gallery</p>
                  <div class="hidden-checkboxes">
                     <ul>
                        <?php
                           $user_id = $_SESSION['id'];
                           $sql = "SELECT * FROM user_image_storage where user_id = '$user_id'";
                           $result = $con->query($sql);
                               while($row = $result->fetch_assoc()){
                           ?>  
                        <li>
                           <input type="checkbox" name = "StorageImages" value= "<?php echo $row['storage_id'];?>">
                           <?php
                              echo '<label for = "StorageImages"><div class = "PopUp"><img src="data:image;base64,'.$row['image'].' "alt="Image" style="width: 150px; height: 100px; border:1px solid black;"></div></label>';  
                              }?>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </form>
      </div>
      <div id = "ManualInsert_news"  style = "display:none;">
         <h2>Add News</h2>
         
         <form action="#" method="post" enctype="multipart/form-data" id = "ManualImport">
         <div class="btn-toolbar justify-content-between" role="toolbar" style = "margin-bottom:10px;" aria-label="Toolbar with button groups">
         <div>
         <button onclick="location.href='news_table.php'" class = "btn btn-outline-dark">Back</button>
         <button id = "StorageInsert" onclick = "ShowStorageInsert()" class="btn btn-outline-success">Account Gallery</button>
         <button id = "ManualInsert" onclick = "ShowManualInsert()" class="btn btn-outline-success">Import</button>
         </div>
            <div><button type="submit" name="InsertManual" id="InsertManual" class = "btn btn-outline-success">Insert</button></div>
                           </div>
            <div class = "ManualInsertContent_News">
               <div class = "remarkSection">
                  <p style = "float:left;">Remark :</p>
                  <textarea name="remark" cols="30" rows="10" placeholder="Write some caption here...." required></textarea>
               </div>
               <div class = "news_status">
                     <input type="hidden" name="sequence" value="0">
                     <p style = "float:left; margin-right:5px;">Status :</p>
                     <select id="status" name="status">
                        <option value="Show">Show</option>
                        <option value="Restrict">Restrict</option>
                     </select>
                     <br>
                     <br>
               </div>
               <div class = "ImportFile_news">
                  <p>Import Picture/Drawing</p>
                  <input id="file-input" type="file" name="ManualImage" id = "hehe" required >
                  <br>
                  <br>
                  <div class="preview"></div>
               </div>
            </div>
         </form>
      </div>
   </body>
   <footer>
      <p>&copy;2020 DRAWIFICIENT</p>
   </footer>
   <script></script>
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
      $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
        });
      
      function previewImages() {
      
          var $preview = $('.preview').empty();
          if (this.files) $.each(this.files, readAndPreview);
      
          function readAndPreview(i, file) {
      
          if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
              return alert(file.name +" is not an image");
          } 
      
          var reader = new FileReader();
      
          $(reader).on("load", function() {
              $preview.append($("<img/>", {src:this.result, height:150}).css({"margin":"10px","border": "1px solid black"}));
          });
      
          reader.readAsDataURL(file);
          
          }
          
      }
      
      $('#file-input').on("change", previewImages);  
      
      function ShowStorageInsert(){
          
          document.getElementById("StorageInsert_news").style.display = "block";
          document.getElementById("ManualInsert_news").style.display = "none";
      
      }
      
      function ShowManualInsert(){
          
          document.getElementById("StorageInsert_news").style.display = "none";
          document.getElementById("ManualInsert_news").style.display = "block";
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
          }
          });
      });
      
   </script>
</html>
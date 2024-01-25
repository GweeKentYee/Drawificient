<?php 
   session_start();
   include("config.php");
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
      <link rel="stylesheet" type="text/css" href="../style/style.css">
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
      <?php
         $sql = "SELECT * FROM news WHERE status='show'";
         $result = $con->query($sql);
         if($result -> num_rows > 0){
      ?>
         <div class="news_slider col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <?php
               $count = 0;
               $sql = "SELECT * FROM news WHERE status='show' ORDER BY sequence ASC";
               $result = $con->query($sql);
               ?>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <?php
                     while($row = $result->fetch_assoc()){
                         if($count == 0)
                         {
                             ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <?php
                     }
                     else
                     {
                         ?>
                  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $count; ?>"></li>
                  <?php
                     }
                     $count = $count + 1;
                     }
                     ?>
               </ol>
               <?php
                  $count = 0;
                  $sql = "SELECT * FROM news WHERE status='show' ORDER BY sequence ASC";
                          $result = $con->query($sql);
                          ?>
               <div class="carousel-inner">
                  <?php
                     while($row = $result->fetch_assoc()){
                         if($count == 0)
                         {
                     ?>
                  <div class="carousel-item active">
                     <?php
                        echo '<img class="d-block w-100" src="data:image;base64,'.$row['image'].'"alt="Image" >';
                        ?>
                  </div>
                  <?php
                     }
                     else
                     {
                         ?>
                  <div class="carousel-item">
                     <?php
                        echo '<img class="d-block w-100" src="data:image;base64,'.$row['image'].'"alt="Image" >';
                        ?>
                  </div>
                  <?php
                     }
                     $count = $count + 1;
                     } 
                     ?>  
               </div>
               <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      <?php 
         }
      ?>
         <br>
         
         <div class="side-bar col-xl-3 col-lg-3 col-md-11 col-sm-11 col-11">
            
            <div class="collapseArea accordion" id="filtering">
                  <div class="card">
                     <div class="card-header" id="headingOne">
                        <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-filter"></i> Filter
                        </button>
                     </div>
                     <div id="filter" class="collapse show" aria-labelledby="headingOne" data-parent="#filtering">
                        <div class="card-body">
                              <!-- Forum Filtering dropdown system starts here-->
                              <!--Forum filtering dropdownlist starts here-->
                              <div class="filtering">
                                 <?php  
                                    $Type = isset($_POST['Type']) ? $_POST['Type'] : '';
                                    
                                    if($Type == "")
                                    {
                                    ?>
                                 <form action = "index.php" method="POST">
                                    <label for="Type">Type</label>
                                    <Select name="Type" id = "Type">
                                       <option value="">All</option>
                                       <option value="PT3">PT3</option>
                                       <option value="SPM">SPM</option>
                                    </Select>
                                    <br>
                                    <label for="Subject">Subject</label>
                                    <Select name="Subject" id="Subject">
                                       <option value="">All</option>
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
                                    </Select>
                                    <br>
                                    <button type="submit " class="btn btn-outline-success" name="submit">Submit</button>
                                 </form>
                                 <?php
                                    }
                                    else if($Type == "SPM")
                                    {
                                    ?>
                                 <form action = "index.php" method="POST">
                                    <label for="Type">Type</label>
                                    <Select name="Type" id = "Type">
                                       <option value="">All</option>
                                       <option value="PT3">PT3</option>
                                       <option value="SPM">SPM</option>
                                    </Select>
                                    <br>
                                    <label for="Subject">Subject</label>
                                    <Select name="Subject" id="Subject">
                                       <option value="">All</option>
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
                                    </Select>
                                    <br>
                                    <button type="submit " class="btn btn-outline-success" name="submit">Submit</button>
                                 </form>
                                 <?php
                                    }
                                    else if($Type == "PT3")
                                    {
                                    ?>
                                 <form action = "index.php" method="POST">
                                    <label for="Type">Type</label>
                                    <Select name="Type" id = "Type">
                                       <option value="">All</option>
                                       <option value="PT3">PT3</option>
                                       <option value="SPM">SPM</option>
                                    </Select>
                                    <br>
                                    <label for="Subject">Subject</label>
                                    <Select name="Subject" id="Subject">
                                       <option value="">All</option>
                                       <option value="BM">BM</option>
                                       <option value="BI">BI</option>
                                       <option value="MM">MM</option>
                                       <option value="SN">SN</option>
                                       <option value="SEJ">SEJ</option>
                                       <option value="GEO">GEO</option>
                                       <option value="KH">KH</option>
                                    </Select>
                                    <br>
                                    <button type="submit " class="btn btn-outline-success" name="submit">Submit</button>
                                 </form>
                                 <?php
                                    }
                                    ?>
                              </div>
                              <script type="text/javascript">
                                 document.getElementById('Subject').value =  value = "<?php echo $_POST['Subject'] ?? ''; ?>";
                                 document.getElementById('Type').value =  value = "<?php echo $_POST['Type'] ?? ''; ?>";
                              </script>
                              <script>
                                 $(document).ready(function()
                                 {
                                 
                                    $("#Type").change(function()
                                    {
                                 
                                       var el = $(this) ;
                                       if(el.val() === "SPM")
                                       {
                                             $("option[value='SJ']").remove();
                                             $("option[value='GEO']").remove();
                                             $("option[value='KH']").remove();
                                             $("option[value='MT']").remove();
                                             $("option[value='FZ']").remove();
                                             $("option[value='KM']").remove();
                                             $("option[value='BIO']").remove();
                                             $("option[value='PN']").remove();
                                             $("option[value='ACC']").remove();
                                             $("option[value='EKO']").remove();
                                             $("#Subject").append("<option value='SJ'>SJ</option>");
                                             $("#Subject").append("<option value='GEO'>GEO</option>");
                                             $("#Subject").append("<option value='MT'>MT</option>");
                                             $("#Subject").append("<option value='FZ'>FZ</option>");
                                             $("#Subject").append("<option value='KM'>KM</option>");
                                             $("#Subject").append("<option value='BIO'>BIO</option>");
                                             $("#Subject").append("<option value='PN'>PN</option>");
                                             $("#Subject").append("<option value='ACC'>ACC</option>");
                                             $("#Subject").append("<option value='EKO'>EKO</option>");
                                 
                                       }
                                       else if(el.val() === "PT3" )
                                       {
                                             $("option[value='SJ']").remove();
                                             $("option[value='GEO']").remove();
                                             $("option[value='KH']").remove();
                                             $("option[value='MT']").remove();
                                             $("option[value='FZ']").remove();
                                             $("option[value='KM']").remove();
                                             $("option[value='BIO']").remove();
                                             $("option[value='PN']").remove();
                                             $("option[value='ACC']").remove();
                                             $("option[value='EKO']").remove();
                                             $("#Subject").append("<option value='KH'>KH</option>");
                                 
                                       }
                                       else if(el.val() === "" )
                                       {
                                             $("option[value='SJ']").remove();
                                             $("option[value='GEO']").remove();
                                             $("option[value='KH']").remove();
                                             $("option[value='MT']").remove();
                                             $("option[value='FZ']").remove();
                                             $("option[value='KM']").remove();
                                             $("option[value='BIO']").remove();
                                             $("option[value='PN']").remove();
                                             $("option[value='ACC']").remove();
                                             $("option[value='EKO']").remove();
                                             $("#Subject").append("<option value='SJ'>SJ</option>");
                                             $("#Subject").append("<option value='GEO'>GEO</option>");
                                             $("#Subject").append("<option value='KH'>KH</option>");
                                             $("#Subject").append("<option value='MT'>MT</option>");
                                             $("#Subject").append("<option value='FZ'>FZ</option>");
                                             $("#Subject").append("<option value='KM'>KM</option>");
                                             $("#Subject").append("<option value='BIO'>BIO</option>");
                                             $("#Subject").append("<option value='PN'>PN</option>");
                                             $("#Subject").append("<option value='ACC'>ACC</option>");
                                             $("#Subject").append("<option value='EKO'>EKO</option>");
                                 
                                       }
                                    });
                                 
                                 });
                              </script>
                              <!--Forum filtering dropdown list ends here-->
                        </div>
                     </div>
                  </div>
            </div>   
            <div class="collapseArea accordion" id="displayCountDown">
               <div class="card">
                  <div class="card-header" id="headingOne">
                     <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#countDown" aria-expanded="true" aria-controls="collapseTwo">
                     <i class="far fa-calendar-alt"></i> Count Down Exam Date
                     </button>
                  </div>
                  <div id="countDown" class="collapse show" aria-labelledby="headingOne" data-parent="#displayCountDown">
                     <div class="card-body">
                        <?php
                           if(isset($_SESSION['username'])){
                              if($_SESSION['role'] == "admin"){
                                 
                              ?>
                        <button class="editBtn btn-outline-success btn far fa-edit" onclick="editDate()"></button>
                        <?php
                           }
                           }
                           ?>
                        <form action="examTime.php" onsubmit="return changeDate(this);" method="post">
                           <div class="editExam" id="editExam" style="display: none;">
                              <button type="submit" class="submitBtn btn btn-outline-success" id="saveButton" style="display: none;">Save</button>
                              <?php
                                 $exam=0;
                                 $sqlExam = "SELECT * FROM exam";
                                 $resultExam = $con->query($sqlExam);
                                 while($row = $resultExam->fetch_assoc()){
                                    echo "<br>";
                                    echo $row['exam_type'] ."<br>";
                                    echo "Start date: <br>";
                                    echo date("d-m-Y", strtotime($row['exam_date'])) ."<br>";
                                    echo "<input type='hidden' name='examType[]' value='".$row['exam_type']."'>";
                                    echo "<input type='date' name='examDate[]' value='".$row['exam_date']."'> <br>";
                                    echo "End Date: <br>";
                                    echo date("d-m-Y", strtotime($row['exam_end_date'])) ."<br>";
                                    echo "<input type='date' name='examEndDate[]' value='".$row['exam_end_date']."'> <br>";
                                    echo "<input type='hidden' name='exam[]' value='".$exam."'>";
                                    $exam = $exam + 1;
                                 }
                                 ?>
                           </div>
                        </form>
                        <div class="displayCountdown" id="displayCountdown" style="display: block;">
                           <?php
                              $sqlExam = "SELECT * FROM exam WHERE exam_type='SPM'";
                              $resultExam = $con->query($sqlExam);
                              while($row = $resultExam->fetch_assoc()){
                                 echo $row['exam_type'] ." exam date: <br>";
                                 date_default_timezone_set("Asia/Kuala_Lumpur");
                                 $currentDate = date("Y-m-d");
                                 $end_date = date("Y-m-d", strtotime($row['exam_end_date']));
                                 if($currentDate <= $end_date){
                                    $var = $row['exam_date'];
                                    echo date("d-m-Y", strtotime($var))."<br>";
                                 
                                 
                              ?>
                           Time left: 
                           <p id="SPM"></p>
                           <script>
                              // Set the date we're counting down to
                              var countDownDate = new Date("<?php echo $row['exam_date']; ?>").getTime();
                              
                              // Update the count down every 1 second
                              var x = setInterval(function() {
                              
                              // Get today's date and time
                              var now = new Date().getTime();
                                 
                              // Find the distance between now and the count down date
                              var distance = countDownDate - now;
                                 
                              // Time calculations for days, hours, minutes and seconds
                              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                 
                              // Output the result in an element with id="ptthree"
                              document.getElementById("SPM").innerHTML = days + "d " + hours + "h "
                              + minutes + "m " + seconds + "s ";
                                 
                              // If the count down is over, write some text 
                                 if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById("SPM").innerHTML = "On Going";
                                 }
                              }, 1000);
                           </script>
                           <?php
                           }else{
                              echo "<p>Released Soon</p>";
                              
                           }
                              }
                              ?>
                           <?php
                              $sqlExam = "SELECT * FROM exam WHERE exam_type='PT3'";
                              $resultExam = $con->query($sqlExam);
                              while($row = $resultExam->fetch_assoc()){
                                 echo $row['exam_type'] ." exam date: <br>";
                                 date_default_timezone_set("Asia/Kuala_Lumpur");
                                 $currentDate = date("Y-m-d");
                                 $end_date = date("Y-m-d", strtotime($row['exam_end_date']));
                                 if($currentDate <= $end_date){
                                    $var = $row['exam_date'];
                                    echo date("d-m-Y", strtotime($var))."<br>";
                              ?>
                           Time left: 
                           <p id="PT3"></p>
                           <script>
                              // Set the date we're counting down to
                              var countDownDateTwo = new Date("<?php echo $row['exam_date']; ?>").getTime();
                              
                              // Update the count down every 1 second
                              var xTwo = setInterval(function() {
                              
                              // Get today's date and time
                              var nowTwo = new Date().getTime();
                                 
                              // Find the distance between now and the count down date
                              var distanceTwo = countDownDateTwo - nowTwo;
                                 
                              // Time calculations for days, hours, minutes and seconds
                              var daysTwo = Math.floor(distanceTwo / (1000 * 60 * 60 * 24));
                              var hoursTwo = Math.floor((distanceTwo % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                              var minutesTwo = Math.floor((distanceTwo % (1000 * 60 * 60)) / (1000 * 60));
                              var secondsTwo = Math.floor((distanceTwo % (1000 * 60)) / 1000);
                                 
                              // Output the result in an element with id="ptthree"
                              document.getElementById("PT3").innerHTML = daysTwo + "d " + hoursTwo + "h "
                              + minutesTwo + "m " + secondsTwo + "s ";
                                 
                              // If the count down is over, write some text 
                                 if (distanceTwo < 0) {
                                    clearInterval(xTwo);
                                    document.getElementById("PT3").innerHTML = "On Going";
                                 }
                              }, 1000);
                           </script>
                           <?php
                           }else{
                              echo "<p>Released Soon</p>";
                              
                           }
                              }
                              ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="container1 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
         
         <div class="forum_area col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php
                  if(isset($_SESSION['username'])){
                     ?>
               <div class="function">
                     
                     <a href="DrawingCanvas.php"><button><i class="fas fa-palette"></i><br> Draw Your Note Here</button></a>
                     <a href="upload.php"><button><i class="fas fa-plus-square"></i><br> Create New Post</button></a>
                     
               </div>
               <?php
                  }
                  
                  ?>
            <?php
               //Forum filtering queries start here
               $Subject = isset($_POST['Subject']) ? $_POST['Subject'] : '';   
               $Type = isset($_POST['Type']) ? $_POST['Type'] : '';
               
               if($Subject == "" and $Type == "")
               {
                   $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id ORDER BY time DESC";
               }
               
               else if($Subject == "" and !empty($Type))
               {
                   $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id WHERE (exam_type = '$Type') ORDER BY time DESC";
               }
               
               else if(!empty($Subject) and $Type == "" )
               {
                   $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id WHERE (subject_name = '$Subject') ORDER BY time DESC";
               }
               
               if(!empty($Subject and $Type))
               {
                   $sqlForum = "SELECT * FROM forum join user on forum.user_id = user.user_id WHERE (subject_name = '$Subject' AND exam_type = '$Type') ORDER BY time DESC";
               }
               //Forum filtering queries end here
               //Forum filtering system ends here
               if(isset($_SESSION['id'])){
                   $username = $_SESSION['username'];
                   $user_id = $_SESSION['id'];
               }
               
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
                  $user_forum = $row['user_id'];
                  $user_name = $row['username'];
                  if($exam_type == "SPM"){
                     $spmDisplay = "block";
                     $pt3Display = "none";
                  }else{
                     $spmDisplay = "none";
                     $pt3Display = "block";
                  }
                  ?>
               <div class="post_header">
                  <div class="user_profile">
                     <a href="Profile.php?id=<?php echo $user_forum; ?>" >
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
                  <span class="username_forum"><?php echo $user_name; ?></span></a><br>
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
                           if($_SESSION['id'] == $user_forum){
                               ?>
                        <form method="POST" action="editpost.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id;?>">
                           <input type="hidden" name="editType" value="editPost">
                           <button type="submit" class="dropdown-item" name="editSubmit">Edit</button>
                        </form>
                        <form method="POST" onsubmit="return deletePost(this);" action="deletepost.php">
                           <input type="hidden" name="location" value="index.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id;?>">
                           <button type="submit" class="dropdown-item" name="deleteSubmit">Delete</button>
                        </form>
                        <?php
                           }
                           if($_SESSION['role'] == "user" and $user_forum != $_SESSION['id'] ){
                               ?>
                        <button class="dropdown-item" data-toggle="modal" data-target="#<?php echo $forum_name."Report"; ?>">Report</button>
                        <?php
                           }
                           if($_SESSION['role'] == "admin" and $user_forum != $_SESSION['id'] ){
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
                  <br>
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
                                 <input type="hidden" name="location" value="index.php">
                                 <input type="hidden" name="id" id="id" value="<?php echo $forum_id;?>">
                                 <input type="hidden" name="userID" id="userID" value= "<?php echo $user_id; ?>">
                                 <input type="hidden" name="report_type" id="report_type" value= "forum">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                 <input type="submit" class="btn btn-outline-success" name="report_forum" id="report_forum" value="Report Post">
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
                                 <input type="hidden" name="location" value="index.php">
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                 <input type="submit" class="btn btn-outline-success" name="restrict_forum" id="restrict_forum" value="Yes">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
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
               <?php
                  $sqlComment = "SELECT * FROM comment WHERE forum_id=$forum_id";
                  $resultComment = $con->query($sqlComment);
                  if($resultComment -> num_rows > 3){
                  ?>
               <form action="viewComment.php" method="get">
                  <input type="hidden" name="forum_id" value="<?php echo $forum_id; ?>">
                  <button type="submit" class="btn btn-link"><span class="viewComment">View More Comment</span> </button>
               </form>
               <?php
                  }
                  ?>
               <div class="comment_area">
                  <?php
                     $sqlComment = "SELECT * FROM (SELECT * FROM comment WHERE forum_id=$forum_id ORDER BY time DESC LIMIT 3) comment join user on comment.user_id = user.user_id ORDER BY time ASC" ;
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
                              if($_SESSION['id'] == $row['user_id']){
                                  ?>
                           <form method="POST" onsubmit="return deleteComment(this);" action="deletecomment.php">
                              <input type="hidden" name="location" value="index.php">
                              <input type="hidden" name="comment_id" value="<?php echo $row['comment_id'];?>">
                              <button type="submit" class="dropdown-item" name="deleteSubmit" >Delete</button>
                           </form>
                           <?php
                              }
                              if($_SESSION['role'] == "user" and $_SESSION['id'] != $row['user_id']){
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
                                    What type issues you want to report to this comment?
                                    <select id="reportIssues" name="reportIssues" >
                                       <option value="Sensitive content">Sensitive content</option>
                                       <option value="Discriminatory content">Discriminatory content</option>
                                       <option value="Insulting content">Insulting content</option>
                                       <option value="Irrelevant content">Irrelevant content</option>
                                    </select>
                                    <input type="hidden" name="location" value="index.php">
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['comment_id'];?>">
                                    <input type="hidden" name="userID" id="userID" value= "<?php echo $_SESSION['id']; ?>">
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
                                    <input type="hidden" name="location" value="index.php">
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                    <input type="submit" class="btn btn-outline-success" name="restrict_comment" id="restrict_comment" value="Yes">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="comment_profile">
                        <a href="Profile.php?id=<?php echo $row['user_id']; ?>" >
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
                     if(isset($_SESSION['id'])){
                     ?>
                  <div class="commentstyle">
                     <form method="POST" action="insertcomment.php">
                        <button type="submit" name="commentPost" class="commentBtn btn btn-outline-primary far fa-comments"></button>
                        <div class="comment_profile">
                           <?php
                              $sqlCurrent = "SELECT * FROM user WHERE user_id='$user_id'";
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
                           <input type="hidden" name="location" value="index.php">
                           <input type="hidden" name="forum_id" value="<?php echo $forum_id ;?>">
                           <input type="hidden" name="user_id" value="<?php echo $user_id ;?>">
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
               <?php
                  }//temparory for restrict function
                      
                  echo "</div>";
                  }
                  
                  }
                  else{
                     echo "";
                  }
                  ?>
               <p class="endPost">---You have reached the end. Come back for more later---</p>
            </div>
         </div>
         
      </div>   
         <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
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
      
      function editDate(){
          var save = document.getElementById("saveButton");
          var editExam = document.getElementById("editExam");
          var displayCountdown = document.getElementById("displayCountdown");
          if(save.style.display === "none"){
              save.style.display = "block";
              editExam.style.display = "block";
              displayCountdown.style.display = "none";
              
          }else{
              save.style.display = "none";
              editExam.style.display = "none";
              displayCountdown.style.display = "block";
              
          }
      }
       
      
   </script>
   <script>
      
      function deletePost(){
         return confirm('Do you really want to delete this post?');
      }
      function deleteComment(){
         return confirm('Do you really want to delete this comment?');
      }
      function changeDate(){
         return confirm('Make changes to the exam date?');
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
   <script>
      //Get the button
      var mybutton = document.getElementById("myBtn");
      
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function() {scrollFunction()};
      
      function scrollFunction() {
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
         mybutton.style.display = "block";
      } else {
         mybutton.style.display = "none";
      }
      }
      
      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
      }
   </script>
</html>
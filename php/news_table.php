<?php
   session_start();
   include('config.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Drawificient</title>
      <link rel = "icon" href = "../img/Ew_pencil-removebg-preview.png" type = "image/icontype">
      <script src="https://kit.fontawesome.com/9a1f6f3b85.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
      <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>  
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../style/style.css">
     
   </head>
   <body>
      <header class="sticky-top">
         <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php">
               <h1><img src="../img/Drawificient.png" alt="DRAWIFICIENT" width="250px" height="50px"></h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                        <a class="dropdown-item active" href="news_table.php">NEWS</a>
                        <a class="dropdown-item" href="report_forum_table.php">REPORT FORUM</a>
                        <a class="dropdown-item" href="report_comment_table.php">REPORT COMMENT</a>
                     </div>
                  </li>
               </ul>
               <ul class="navbar-nav mr-auto w-100 justify-content-end">
                  <?php
                     if(isset($_SESSION['username'])){
                        if($_SESSION['role'] == "user"){
                            header("Location:index.php");
                            }
                         $sql = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
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
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
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
                        header("Location:loginpage.php");
                     }
                         ?>
               </ul>
            </div>
         </nav>
      </header>
      <main>
         <div class="container">
            <br/>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <a href="insertnews.php"><button class="btn btn-outline-success">Add New</button></a>
                  <h2>NEWS TABLE</h2>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table id="sample_data" class="table table-bordered table-striped border border-primary table-hover">
                        <thead>
                           <tr>
                              <th>NEWS ID</th>
                              <th>REMARK</th>
                              <th>IMAGE</th>
                              <th>POST DATE & TIME</th>
                              <th>STATUS</th>
                              <th>SEQUENCE</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         <hr>
      </main>
      <footer>
         <p>&copy;2020 DRAWIFICIENT</p>
      </footer>
   </body>
   <script>
      $('.dropdown-toggle').dropdown()
   </script>
   
    
</html>
<script type="text/javascript" language="javascript">
   $(document).ready(function(){
       var dataTable = $('#sample_data').DataTable({
           "processing" : true,
           "serverSide" : true,
           "order" : [],
           "ajax" : {
               url:"fetch_news.php",
               type:"POST"
           }
       });
   
       $('#sample_data').on('draw.dt', function(){
           $('#sample_data').Tabledit({
               url: 'news_action.php',
               dataType: 'json',
               buttons: {
   				edit: {
   					class: 'btn btn-outline-primary',
   					html: '<span class="fas fa-edit"></span>',
                       action: 'edit'
   				},
                   save: {
                       class:'btn btn-outline-success',
                       html:'save'
                   },
   				delete: {
   					class: 'btn btn-outline-danger',
   					html: '<span class="fa fa-trash"></span>',
                       action: 'delete'
   				},
                   confirm:{
                       class: 'btn btn-outline-danger',
                       html:'confirm'
                   }
                   },
               columns:{
                   
                   identifier : [0, 'news_id'],
                   editable:[[1, 'remark'], [4, 'status', '{"Show":"Show","Restrict":"Restrict"}'], [5, 'sequence']]
               },
               restoreButton:false,
               onSuccess:function(data, textStatus, jqXHR)
               {   
                   if(data.action == 'delete')
                   {
                       alert("Record deleted successfully.");
                       $('#' + data.id).remove();
                       $('#sample_data').DataTable().ajax.reload();
                   }else if(data.action == 'edit')
                   {
                       alert("Record updated successfully.");
                   }
               },
               onFail:function(jqXHR, textStatus, err)
               {
                   alert("Action performed failed, please try again.");
                   location.reload(); 
               }
           });
       });
   });
   function logoutConfirm(){
            if(confirm('Logout now?')){
               window.location.href = "logout.php";
            }
         }
</script>
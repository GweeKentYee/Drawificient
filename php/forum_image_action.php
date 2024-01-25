<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':image_id'    => $_POST['image_id']
 );

 $query = "
 UPDATE forum_image 
 SET status = :status
 WHERE image_id = :image_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>
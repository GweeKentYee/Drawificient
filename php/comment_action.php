<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':comment_id'    => $_POST['comment_id']
 );

 $query = "
 UPDATE comment 
 SET status = :status
 WHERE comment_id = :comment_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>
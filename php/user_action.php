<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':user_status'  => $_POST['user_status'],
  ':user_id'    => $_POST['user_id']
 );

 $query = "
 UPDATE user 
 SET user_status = :user_status
 WHERE user_id = :user_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>
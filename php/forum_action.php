<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':forum_id'    => $_POST['forum_id']
 );

 $query = "
 UPDATE forum 
 SET status = :status
 WHERE forum_id = :forum_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>
<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':rc_id'    => $_POST['rc_id']
 );

 $query = "
 UPDATE report_comment 
 SET status = :status
 WHERE rc_id = :rc_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>
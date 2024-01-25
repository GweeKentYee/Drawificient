<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':status'  => $_POST['status'],
  ':rf_id'    => $_POST['rf_id']
 );

 $query = "
 UPDATE report_forum 
 SET status = :status
 WHERE rf_id = :rf_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}


?>

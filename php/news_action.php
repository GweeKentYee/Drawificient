<?php

include('config.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':remark'  => $_POST['remark'],
  ':status'  => $_POST['status'],
  ':sequence'   => $_POST['sequence'],
  ':news_id'    => $_POST['news_id']
 );
 $query = "
 UPDATE news 
 SET remark = :remark, 
 status = :status, 
 sequence = :sequence 
 WHERE news_id = :news_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM news 
 WHERE news_id = '".$_POST["news_id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}


?>
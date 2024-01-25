<?php

include('config.php');

$column = array("rf_id", "issues", "time", "user_id", "forum_id", "status");

$query = "SELECT * FROM report_forum ";

if(isset($_POST["search"]["value"]))
{
    $query .= '
    WHERE rf_id LIKE "%'.$_POST["search"]["value"].'%" OR issues LIKE "%'.$_POST["search"]["value"].'%" OR time LIKE "%'.$_POST["search"]["value"].'%" OR  status LIKE "%'.$_POST["search"]["value"].'%" OR user_id LIKE "%'.$_POST["search"]["value"].'%" OR forum_id LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY rf_id ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$result = $connect->query($query . $query1);

$data = array();

foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $row['rf_id'];
    $sub_array[] = $row['issues'];
    $sub_array[] = $row['time'];
    $sub_array[] = "<a class='btn btn-link' href='Profile.php?id=".$row['user_id']."'>".call_user($row['user_id'])."</a>";
    $sub_array[] = "<form action='viewComment.php' method='get'>
    <input type='hidden' name='forum_id' value='".$row['forum_id']."'>
    <button type='submit' class='btn btn-link'><span class='viewComment'>".$row['forum_id']."</span></button>
 </form>";
    $sub_array[] = $row['status'];
    $data[] = $sub_array;
}

function call_user($user_id){
    include('config.php');
    $userSql = "SELECT * FROM user WHERE user_id = '$user_id'";
    $result = $con->query($userSql);
    $row = $result->fetch_assoc();
    return $row['username'];
}

function count_all_data($connect)
{
    $query = "SELECT * FROM report_forum";

    $statement = $connect->prepare($query);

    $statement->execute();

    return $statement->rowCount();

}

$output = array(
    'draw'  => intval($_POST['draw']),
    'recordsTotal'  => count_all_data($connect),
    'recordsFiltered'   => $number_filter_row,
    'data'  => $data
);

echo json_encode($output);

?>
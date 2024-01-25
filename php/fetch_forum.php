<?php

include('config.php');

$column = array("forum_id", "caption", "time", "subject_name", "exam_type", "user_id", "status", "viewPost");

$query = "SELECT * FROM forum ";

if(isset($_POST["search"]["value"]))
{
    $query .= '
    WHERE forum_id LIKE "%'.$_POST["search"]["value"].'%" OR caption LIKE "%'.$_POST["search"]["value"].'%" OR time LIKE "%'.$_POST["search"]["value"].'%" OR subject_name LIKE "%'.$_POST["search"]["value"].'%" OR exam_type LIKE "%'.$_POST["search"]["value"].'%" OR status LIKE "%'.$_POST["search"]["value"].'%" OR user_id LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY forum_id ASC ';
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
    $sub_array[] = $row['forum_id'];
    $sub_array[] = "<div class='scroll'><span class='wrapword'>".nl2br($row['caption'])."</span></div>";
    $sub_array[] = $row['time'];
    $sub_array[] = $row['subject_name'];
    $sub_array[] = $row['exam_type'];
    $sub_array[] = "<a class='btn btn-link' href='Profile.php?id=".$row['user_id']."'>".call_user($row['user_id'])."</a>";
    $sub_array[] = $row['status'];
    $sub_array[] = "<form action='viewComment.php' method='get'>
    <input type='hidden' name='forum_id' value='".$row['forum_id']."'>
    <button type='submit' class='btn btn-link'><span class='viewComment'>View This Post</span></button>
 </form>";
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
    $query = "SELECT * FROM forum";

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
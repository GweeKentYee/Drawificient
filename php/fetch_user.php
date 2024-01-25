<?php

include('config.php');

$column = array("user_id", "username", "first_name", "last_name", "email", "profile", "user_status");

$query = "SELECT * FROM user WHERE role='user' ";

if(isset($_POST["search"]["value"]))
{
    $query .= '
    AND (user_id LIKE "%'.$_POST["search"]["value"].'%" OR username LIKE "%'.$_POST["search"]["value"].'%" OR first_name LIKE "%'.$_POST["search"]["value"].'%" OR last_name LIKE "%'.$_POST["search"]["value"].'%" OR  email LIKE "%'.$_POST["search"]["value"].'%" OR user_status LIKE "%'.$_POST["search"]["value"].'%")';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY user_id ASC ';
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
    $image = '';
    if($row["profile"] != '')
    {
        $image = '<img src="data:image;base64,'.base64_encode($row['profile']).'"alt="Image" style="width: 100px; height: 100px;" >';
    }
    else
    {
        $image = '';
    }
    $sub_array = array();
    $sub_array[] =  $row['user_id'];
    $sub_array[] = $row['username'];
    $sub_array[] = $row['first_name'];
    $sub_array[] = $row['last_name'];
    $sub_array[] = $row['email'];
    //$sub_array[] = $row['role'];
    $sub_array[] = $image;
    $sub_array[] = $row['user_status'];
    $sub_array[] =  "<a class='btn btn-link' href='Profile.php?id=".$row['user_id']."'>View User Profile</a>";
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM user WHERE role='user' ";

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
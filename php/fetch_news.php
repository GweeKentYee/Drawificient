<?php

include('config.php');

$column = array("news_id", "remark", "image", "time", "status", "sequence");

$query = "SELECT * FROM news ";

if(isset($_POST["search"]["value"]))
{
    $query .= '
    WHERE news_id LIKE "%'.$_POST["search"]["value"].'%" OR remark LIKE "%'.$_POST["search"]["value"].'%" OR time LIKE "%'.$_POST["search"]["value"].'%" OR  status LIKE "%'.$_POST["search"]["value"].'%" OR sequence LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"]))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY news_id ASC ';
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
    if($row["image"] != '')
    {
        $image = '<img src="data:image;base64,'.$row['image'].'"alt="Image" style="width: 150px; height: 100px;" >';
    }
    else
    {
        $image = '';
    }
        $delete = '<button type="button" name="delete_btn data-id="'.$row["news_id"].'" class="btn_delete"> REMOVE</button>';
    $sub_array = array();
    $sub_array[] = $row['news_id'];
    $sub_array[] = "<div class='scroll'><span class='wrapword'>".nl2br($row['remark'])."</span></div>";
    $sub_array[] = $image;
    $sub_array[] = $row['time'];
    $sub_array[] = $row['status'];
    $sub_array[] = $row['sequence'];
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM news";

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
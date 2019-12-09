<?php
include('function.php');
include('../db.php');

$query = '';
$output = array();
$query .= "SELECT * FROM `item` ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE itemid LIKE "%'.$_POST["search"]["value"].'%" ';
	//$query .= 'OR name LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
	$query .= 'ORDER BY itemid DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = '<button type = "button" name = "update" id="'.$row["itemid"].'" class="btn btn-warning btn-xs update">Editar</button>';
	$sub_array[] = $row["itemid"];
	$sub_array[] = $row["prodid"];
	$sub_array[] = $row["pedid"];
	$sub_array[] = $row["quantidade"];
	$sub_array[] = $row["id_cliente"];
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records_pedido(),
	"data"				=>	$data
);

echo json_encode($output);
?>
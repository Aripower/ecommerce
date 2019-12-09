<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM produtos ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE id LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR nome LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
} else {
	$query .= 'ORDER BY id ASC ';
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
	$image = '';
	if($row["image"] != '')
	{
		$image = '<img src="../upload/'.$row["image"].'" class="img-thumbnail" type="button" id="zoomImg" name="zoomImg" width="50" height="35" />';
	} else {
		$image = '';
	}
	$sub_array = array();
	$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Editar</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Deletar</button>';
	$sub_array[] = $row["nome"];
	$sub_array[] = $row["id_categoria"];
	$sub_array[] = $row["preco"];
	$sub_array[] = $row["quantidade"];
	$sub_array[] = $image;
	$sub_array[] = $row["descricao"];
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);

echo json_encode($output);
?>
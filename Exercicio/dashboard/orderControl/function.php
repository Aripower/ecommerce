<?php

function get_total_all_records_pedido()
{
	include('../db.php');
	$statement = $connection->prepare("SELECT * FROM item");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>
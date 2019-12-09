<?php

function get_total_all_records_user()
{
	include('../db.php');
	$statement = $connection->prepare("SELECT * FROM users");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

?>
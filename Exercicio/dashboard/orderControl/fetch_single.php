<?php
include('../db.php');

if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM item 
		WHERE itemid = '".$_POST["user_id"]."' 
		LIMIT 1"
	);

	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["itemid"] = $row["itemid"];
	}
	echo json_encode($output);
}
?>
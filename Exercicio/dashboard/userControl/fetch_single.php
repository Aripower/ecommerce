<?php
include('../db.php');

if(isset($_POST["user_id"]))
{
	
	$statement = $connection->prepare("SELECT situacao FROM `users` WHERE id = :id ");
	$statement->bindParam(':id', $_POST["user_id"]);
	$statement->execute();
	$row = $statement->fetch();
	
	if($row[0] == 1) {
		$situacao = 0;
	} else {
		$situacao = 1;
	}

	$sql = 	"UPDATE `users` SET `situacao` = ".$situacao." WHERE id = ".$_POST["user_id"]." ";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	

	$output = json_encode(
		array(
			'type' => 'Sucess',
			'text' => 'Okay'
	));

	echo json_encode($output);
}
?>
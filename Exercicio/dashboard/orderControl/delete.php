<?php

include('../db.php');

if(isset($_POST["user_id"]))
{
	$statement = $connection->prepare(
		"DELETE FROM produtos WHERE id = :id"
	);
	
	$result = $statement->execute(
		array(
			':id'	=>	$_POST["user_id"]
		)
	);
	
	if(!empty($result))
	{
		echo 'Produto deletado com sucesso!';
	}
}



?>
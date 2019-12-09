<?php

include('db.php');
include("function.php");

if(isset($_POST["user_id"]))
{
	$image = get_image_name($_POST["user_id"]);
	$image = exist_imagem($image);

	if($image != "")
	{
		unlink("../upload/" . $image);
	}
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
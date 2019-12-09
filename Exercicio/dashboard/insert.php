<?php
include('db.php');
include('function.php');

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("
			INSERT INTO produtos (nome, preco, image, descricao, id_categoria, quantidade) 
			VALUES (:nome, :preco, :image, :descricao, :id_categoria, :quantidade)
		");
		$result = $statement->execute(
			array(
				':nome'			=>	$_POST["nome"],
				':preco'		=>	$_POST["preco"],
				':image'		=>	$image,
				':descricao'	=>	$_POST["descricao"],
				':id_categoria'	=>	$_POST["id_categoria"],
				':quantidade'	=>	$_POST["quantidade"]
			)
		);
		if(!empty($result))
		{
			echo 'Registro inserido com sucesso';
		}
	}

	if($_POST["operation"] == "Editar")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$old_imag = '';

			//Deleta a imagem antiga e substitui para a nova
			delete_old_image();

			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE produtos 
			SET nome = :nome, preco = :preco, image = :image , descricao = :descricao , id_categoria = :id_categoria, quantidade = :quantidade
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':nome'			=>	$_POST["nome"],
				':preco'		=>	$_POST["preco"],
				':image'		=>	$image,
				':descricao'	=>	$_POST["descricao"],
				':id_categoria'	=>	$_POST["id_categoria"],
				':quantidade'	=>	$_POST["quantidade"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Registro atualizado com sucesso!!';
		}
	}
}

?>
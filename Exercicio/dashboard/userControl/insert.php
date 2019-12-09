<?php
include('db.php');
include('function.php');

if(isset($_POST["operation"]))
{
	
	if($_POST["operation"] == "Editar") {
		
		$statement = $connection->prepare(
			"UPDATE users 
			SET situacao = :situacao
			WHERE id = :id
			"
		);

		$result = $statement->execute(
			array(
				':situacao'		=>	$_POST["situacao"],
				':id'			=>	$_POST["id"]
			)
		);

		if(!empty($result)) {
			echo 'Registro atualizado com sucesso!!';
		}
	}
}

?>
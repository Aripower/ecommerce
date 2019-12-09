<?php

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = '../upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($imageid)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM produtos WHERE id = '$imageid'");
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row["image"];
	}
}

function get_total_all_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM produtos");
	$statement->execute();
	$result = $statement->fetchAll();
	return $statement->rowCount();
}

function exist_imagem($image)
{
	include('db.php');
	$statement = $connection->prepare("SELECT count(image) FROM produtos WHERE image = '$image'");
	$statement->execute();
	$row = $statement->fetchColumn();

	if( $row == 1 ) {
		return $image;
	} else {
		return "";
	}
	
}

function delete_old_image()
{
	include('db.php');
	$image = get_image_name($_POST["user_id"]);
	
	if($image != '')
	{
		unlink("../upload/" . $image);
	}
}

?>
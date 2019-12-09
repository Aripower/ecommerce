<?php 

if(!isset($_SESSION['produto'])) {
	$_SESSION['produto'] = array();
}

function addListaProd($id, $quantity) {
	if(!isset($_SESSION['produto'][$id])){ 
		$_SESSION['produto'][$id] = $quantity; 
	}
}

function ObterProduto($pdo, $lista) {
	
	$sql = "SELECT * FROM produtos where id = ".$lista." ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

?>
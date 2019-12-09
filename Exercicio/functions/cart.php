<?php 

function inserir_produto($pdo, $idProd, $clientId, $pedidoVenda) {

	$sql = 	"INSERT INTO `item`( `itemid`, `prodid`, `pedid`, `quantidade`, `id_cliente`) ".
			" VALUES (null ,".$idProd." , ".$pedidoVenda.", 1, ".$clientId.")";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}

function deleteCart($pdo, $id) {
	$sql = 	"DELETE FROM `item` WHERE itemid = ".$id." ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}

function updateCart($pdo, $id, $quantity) {

	if($quantity > 0) {
		$sql = 	"UPDATE `item` SET `quantidade` = ".$quantity." WHERE itemid = ".$id." ";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	}

	
}

function ObterCarrinho($pdo) {
	
	$results = array();
	
	if(isset($_SESSION['name'])) {
		
		$products =  getProductsByIds($pdo, (int) $_SESSION['clientId']);

		foreach($products as $product) {
			$results[] = array(
							  'id' 		 => $product['itemid'],
							  'name' 	 => $product['nome'],
							  'price'	 => $product['preco'],
							  'quantity' => $product['quantidade'],
							  'subtotal' => $product['quantidade'] * $product['preco'],
							  'idprod'	 => $product['prodid']
						);
		}
	}
	
	return $results;
}

function getTotalCart($pdo) {
	
	$total = 0;
	foreach(ObterCarrinho($pdo) as $product) {
		$total += $product['subtotal'];
	} 
	return $total;
}
?>
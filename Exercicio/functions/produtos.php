<?php 
function getProdutos($pdo){
	$sql = "SELECT * FROM produtos ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByIds($pdo, $id_cliente) {
	
	$sql =  "SELECT produtos.nome, produtos.preco, ".
			"		item.itemid,   item.quantidade, item.prodid ". 
			"FROM pedidos ".
			"inner join item on (pedidos.id_pedido = item.pedid) ".
			"inner join produtos on (item.prodid = produtos.id) ".
			"inner join users on (item.id_cliente = users.id and item.id_cliente = ".$id_cliente." )";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getLastProducts($pdo){
	$sql = "SELECT * FROM produtos order by id DESC ";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function existProductByIds($pdo, $id_cliente , $id_produto) {
	
	$exist = $pdo->prepare( "SELECT produtos.nome, produtos.preco, ".
							"		item.itemid,   item.quantidade, item.prodid ". 
							"FROM pedidos ".
							"inner join item on (pedidos.id_pedido = item.pedid) ".
							"inner join produtos on (item.prodid = produtos.id and produtos.id = ".$id_produto.") ".
							"inner join users on (item.id_cliente = users.id and item.id_cliente = ".$id_cliente." ) ");
	$exist->execute();
	$exist = (int) $exist->fetch();
	return $exist;
}

?>
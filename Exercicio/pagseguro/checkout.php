<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");
require_once "../functions/produtos.php";
require_once "../functions/cart.php";

$pdoConnection = require_once "../connection.php";

session_start();
$PagSeguro = new PagSeguro();

$totalCarts  = getTotalCart($pdoConnection);
$preco = number_format($totalCarts, 2, ',', '.');

//EFETUAR PAGAMENTO	
$venda = array("codigo"=>$_SESSION['pedido_venda'],
			   "valor"=>(int) $preco,
			   "descricao"=>"BAITA BROWNIE",
			   "nome"=>$_SESSION['name'],
			   "email"=>$_SESSION['email'],
			   "telefone"=>"(47) 9993-4614",
			   "rua"=>"rua luiz spézia",
			   "numero"=>"47",
			   "bairro"=>"jaraguá esquerdo",
			   "cidade"=>"Jaraguá do sul",
			   "estado"=>"SC", //2 LETRAS MAIÚSCULAS
			   "cep"=>"89-253-210",
			   "codigo_pagseguro"=>"");

$PagSeguro->executeCheckout($venda,"http://localhost/php_work/Exercicio/carrinho.php ");

//----------------------------------------------------------------------------


//unset();
//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
		
	}else{
		//ATUALIZAR NA BASE DE DADOS
	}
}

?>
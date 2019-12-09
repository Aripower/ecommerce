<?php 
	session_start();
	require_once "functions/produtos.php";
	require_once "functions/cart.php";
	require_once "dashboard/function.php";
	require_once 'functions/login.php';

	$pdoConnection = require_once "connection.php";
	

	if(isset($_SESSION['name'])) {
		if(isset($_GET['acao']) && in_array($_GET['acao'], array('add', 'del', 'up', 'upPlus', 'upMinus'))) {
			
			if($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) { 
				if(existProductByIds($pdoConnection, $_SESSION['clientId'] , $_GET['id'], $_SESSION['pedido_venda']) == 0) {
					inserir_produto($pdoConnection, (int) $_GET['id'], (int) $_SESSION['clientId'], (int) $_SESSION['pedido_venda']);
				}
			}

			if($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {
				deleteCart($pdoConnection, $_GET['id']);
			}

			if($_GET['acao'] == 'upPlus') {
				if(isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) {

					$quantity= $_GET['quantidade'];
					$qtd = intval($quantity) + 1;

					updateCart($pdoConnection, $_GET['id'], $qtd);

				}
			}

			if($_GET['acao'] == 'upMinus') {
				if(isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])) { 
					$quantity= $_GET['quantidade'];
					$qtd = intval($quantity);
						if($qtd != 1) {
							$qtd = $qtd - 1;
							updateCart($pdoConnection ,$_GET['id'], $qtd);
						}
					
				}
			}

			header('location: carrinho.php');
		}
		
	}

	$resultsCarts = ObterCarrinho($pdoConnection);
	$totalCarts  = getTotalCart($pdoConnection);
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>

<body>
	<header id="header">
		<div class="header_top">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> telefone 3445-4075</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> email baitaBrownie@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://pt-br.facebook.com/pg/baitabrowniefloripa/posts/"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://www.instagram.com/baitabrowniefloripa/"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="header-middle">
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>			
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<?php if (isset($_SESSION['name']) ): ?>
									<li><a href="carrinho.php">Carrinho</a></li>
								<?php else :?>
									<li><a href="login.php">Carrinho</a></li>
								<?php endif;?>

								<!-- <li><a href=""><i class="fa fa-star"></i> Lista de desejos</a></li>  -->

								<?php if(!isset($_SESSION['name'])): ?>
									<li><a href="login.php"><i class="fa fa-lock"></i> Cadastro</li>
								<?php endif?>

								<li><a href="sobre.php"><i class="fa fa-user"></i> Sobre</a></li>
								
								<?php if (isset($_SESSION['name'])): ?>
									<li><a href="logout.php"><i class="fa fa-crosshairs"></i> Sair</a></li>
								<?php endif?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Navegação</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li><a href="shop.php">Produtos</a></li>
								<?php if (isset($_SESSION['name']) ): ?>
									<li><a href="carrinho.php">Carrinho</a></li>
								<?php else :?>
									<li><a href="login.php">Carrinho</a></li>
								<?php endif;?>

								<?php if(!isset($_SESSION['name'])): ?>
									<li><a href="login.php">Login</a></li>
								<?php endif?>

								<?php if (isset($_SESSION['name']) && isAdmin($_SESSION['pass']) ): ?>
									<li><a href="dashboard/index.php">Portal do administrador</a></li>
									<li><a><?php echo "Olá ", $_SESSION['name'], "!";?></a></li>
								<?php elseif ( isset($_SESSION['name']) ): ?>
									<li><a><?php echo "Olá ", $_SESSION['name'];?></a></li>
								<?php endif;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Carrinho</li>
				</ol>
			</div>
			
			<!-- SE PRODUTO EXISTE, EXECUTA O TRECHO HTML -->
			<?php if($resultsCarts) : ?> 
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description"></td>
								<td class="price">Preço</td>
								<td class="quantity">Quantidade</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<!-- TODO -->
							<!-- PARA CADA PRODUTO, EXECUTA O TRECHO HTML -->
							<?php foreach($resultsCarts as $result) : ?>
								<tr>
									<?php
										$image = "";
										$image = get_image_name($result['idprod']);
									?>

									<td class="cart_product">
										<a><img src= "upload/<?php echo $image?>"  style="width:110px;height:110px;" /></a>
									</td>
									<td class="cart_description">
										<h4><a><?php echo $result['name']?></a></h4>
									</td>
									<td class="cart_price">
										<p>R$<?php echo number_format($result['price'], 2, ',', '.')?></p>
									</td>
									<td class="cart_quantity">
										<div class="cart_quantity_button">
											<a type= "button" class="cart_quantity_up" href="carrinho.php?acao=upPlus&id=<?php echo $result['id']?>&quantidade=<?php echo $result['quantity']?>" style="cursor:pointer"> + </a>
											<input  class="cart_quantity_input" type="text" name="prod[<?php echo $result['id']?>]" value="<?php echo $result['quantity']?>"                                                                                                " autocomplete="off" size="2">
											<a  type= "button" class="cart_quantity_down " href="carrinho.php?acao=upMinus&id=<?php echo $result['id']?>&quantidade=<?php echo $result['quantity']?>" style="cursor:pointer"> - </a>
										</div>
									</td>
									<td class="cart_total">
										<p class="cart_total_price">R$<?php echo number_format($result['subtotal'], 2, ',', '.')?></p>
									</td>
									<td class="cart_delete">
										<a class="cart_quantity_delete" href="carrinho.php?acao=del&id=<?php echo $result['id']?>" ><i class="fa fa-times"></i></a>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			<?php else: ?>
				<div class="table-responsive cart_info">
					<table class="table table-condensed">
						<thead>
							<tr class="cart_menu">
								<td class="image">Item</td>
								<td class="description"></td>
								<td class="price">Preço</td>
								<td class="quantity">Quantidade</td>
								<td class="total">Total</td>
								<td></td>
							</tr>
						</thead>
					</table>
				</div>
			<?php endif?>
		</div>
	</section>

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>O que você gostaria de fazer agora?</h3>
				<p>Verifique o valor de frete!.</p>
			</div>

			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Desconto <span>R$</span></li>
							<li>Frete <span>Free</span></li>
							<li>Total <span>R$<?php echo number_format($totalCarts, 2, ',', '.')?></span></li>
						</ul>

						<a class="btn btn-default update" href="pagseguro/checkout.php">Comprar</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-Produtos</h2>
							<p>Veja os vídeos de nossos produtos</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-4">
							<div class="video-gallery text-center">
								<a>
									<div class="iframe-img">
										<video width="180" height="60" controls>
											<source src="video/video_1.mp4" type="video/mp4">
										</video>
									</div>
								</a>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="video-gallery text-center">
								<a>
									<div class="iframe-img">
										<video width="180" height="60" controls>
											<source src="video/video_2.mov" type="video/mp4">
										</video>
									</div>
								</a>
							</div>
						</div>
						
						<div class="col-sm-4">
							<div class="video-gallery text-center">
								<a>
									<div class="iframe-img">
										<video width="180" height="60" controls>
											<source src="video/video_3.mov" type="video/mp4">
										</video>
									</div>
								</a>
							</div>
						</div>
					
					</div> 
					<div class="col-sm-3 ">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p> Santa Catarina (SC) · Jaraguá do Sul</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2020 Baita brownie Inc. All rights reserved.</p>
				</div>
			</div>
		</div>
		
	</footer>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/count.js"></script>
    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
	<script	src="js/redirect.js"></script>
</body>
</html>
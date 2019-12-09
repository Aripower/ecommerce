<?php 
	session_start();
	require_once "functions/produtos.php";
	require_once "dashboard/function.php";
	require_once 'functions/login.php';
	$pdoConnection = require_once "connection.php";
	$products = getProdutos($pdoConnection);
	$contador = 0;
	$contador1 = 0;
	$contador2 = 0;

	$last_products = getLastProducts($pdoConnection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
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
	
	<style>
		.card {
			/* Add shadows to create the "card" effect */
			box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			transition: 0.3s;
		}

		/* On mouse-over, add a deeper shadow */
		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
		}

	</style>

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
	
	<section id="slider">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<!-- <li data-target="#slider-carousel" data-slide-to="2"></li> -->
						</ol>
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1>Baita brownie</h1>
									<h2>Top brownies</h2>
									<p>HMMMM uma delicia... </p>
									<a type="button" href="shop.php" class="btn btn-default get">Obter agora</a>
								</div>
								<div class="col-sm-6">
									<img src="sliderimg/DSCN7501.JPG" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1>Baita brownie</h1>
									<h2>Top brownies</h2>
									<p>De uma olhada em nossos top brownies! </p>
									<a type="button" href="shop.php?acao=filterCategoria&filtroCat=3" class="btn btn-default get">Obter agora</a>
								</div>
								<div class="col-sm-6">
									<img src="sliderimg/DSCN7505.JPG" class="girl img-responsive" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="brands_products">
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<div class="container">
										<h4><b>TIPOS</b></h4>
									</div>
									<li><a href="shop.php"> <span class="pull-right"></span>Todos</a></li>
									<li><a href="shop.php?acao=filterCategoria&filtroCat=1"> <span class="pull-right"></span>Brownie Tradicional</a></li>
									<li><a href="shop.php?acao=filterCategoria&filtroCat=2"> <span class="pull-right"></span>Brownie Especial</a></li>
									<li><a href="shop.php?acao=filterCategoria&filtroCat=3"> <span class="pull-right"></span>Brownie Premium</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">ITENS EM DESTAQUE</h2>
						<?php foreach($products as $product) : ?>
							<div class="col-sm-4">
								<div class="product-image-wrapper" >
									<div class="single-products " >
										<div class="productinfo text-center" >
											<?php
												$image = "";
												$image = get_image_name($product['id']);
											?>
											<div class="view-product">
												<a href="product-details.php?acao=add&id=<?php echo $product['id']?>"> <img src= "upload/<?php echo $image?>" style="cursor: pointer" /> </a>
											</div>
											<h2>R$<?php echo number_format($product['preco'], 2, ',', '.')?></h2>
											<p><?php echo $product['nome']?></p>
											<?php if(isset($_SESSION['name'])): ?>
												<a class="btn btn-default add-to-cart" href="carrinho.php?acao=add&id=<?php echo $product['id']?>"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
											
											<?php else: ?>
												<a class="btn btn-default add-to-cart" href="login.php"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
											
											<?php endif?>
										</div>
									</div>
									<!-- <div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Adicionar a lista de desejos</a></li>
										</ul>
									</div> -->
								</div>
							</div>
						<?php $contador++?>
						<?php if($contador==6): break?>
						<?php endif?>

						<?php endforeach;?>
					</div><!--features_items-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">items recomendados</h2>
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<?php foreach($products as $product) : ?>
										<div class="col-sm-4">
											<div class="product-image-wrapper">

												<div class="single-products">
													
													<div class="productinfo text-center">
													<?php
														$image = "";
														$image = get_image_name($product['id']);
													?>
													<div class="view-product">
														<a href="product-details.php?acao=add&id=<?php echo $product['id']?>"> <img src= "upload/<?php echo $image?>" style="cursor: pointer" /> </a>
													</div>		
														<h2>R$<?php echo number_format($product['preco'], 2, ',', '.')?></h2>
														<p><?php echo $product['nome']?></p>
														<?php if(isset($_SESSION['name'])): ?>
															<a class="btn btn-default add-to-cart" href="carrinho.php?acao=add&id=<?php echo $product['id']?>"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
														<?php else : ?>
															<a class="btn btn-default add-to-cart" href="login.php"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
														<?php endif?>
													</div>
												</div>
											</div>
										</div>
										<?php $contador1++?>
										<?php if($contador1==3): break?>
									<?php endif?>
									<?php endforeach;?>
								</div>
								
								<!-- Class item do bootstrap para o carrousel dar roll  -->
								<div class="item">
									<?php foreach($last_products as $last_product) : ?>
										<div class="col-sm-4">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">
														<?php
															$image = "";
															$image = get_image_name($last_product['id']);
														?>
														<div class="view-product">
															<a href="product-details.php?acao=add&id=<?php echo $last_product['id']?>"> <img src= "upload/<?php echo $image?>" style="cursor: pointer" /> </a>
														</div>

														<h2>R$<?php echo number_format($last_product['preco'], 2, ',', '.')?></h2>
														<p><?php echo $last_product['nome']?></p>
														<?php if(isset($_SESSION['name'])): ?>
															<a class="btn btn-default add-to-cart" href="carrinho.php?acao=add&id=<?php echo $product['id']?>"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
														<?php else: ?>
															<a class="btn btn-default add-to-cart" href="login.php"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
														<?php endif?>
													</div>
												</div>
											</div>
										</div>
									<?php $contador2++?>
									<?php if($contador2==3): break?>
									<?php endif?>
									<?php endforeach;?>
								</div>
							</div>
							

							<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>			
						</div>
					</div><!--/recommended_items-->
					
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

    <script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
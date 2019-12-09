<?php 
	session_start();
	require_once "functions/produtos.php";
	require_once "functions/prod_detail.php";
	require_once "dashboard/function.php";
	require_once 'functions/login.php';

	$pdoConnection = require_once "connection.php";
	
	$resultado = ObterProduto($pdoConnection, $_GET['id']);
	$produtos_shift = array_shift($resultado);

	$products = getProdutos($pdoConnection);
	$last_products = getLastProducts($pdoConnection);

	$contador1 = 0;
	$contador2 = 0;

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
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

	<style>
		
		#zoomImg {
		border-radius: 5px;
		cursor: pointer;
		transition: 0.3s;
		}

		#zoomImg:hover {opacity: 0.7;}

		/* The Modal (background) */
		.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
		}

		/* Caption of Modal Image */
		#caption {
		margin: auto;
		display: block;
		width: 80%;
		max-width: 700px;
		text-align: center;
		color: #ccc;
		padding: 10px 0;
		height: 150px;
		}

		/* Add Animation */
		.modal-content, #caption {  
		-webkit-animation-name: zoom;
		-webkit-animation-duration: 0.6s;
		animation-name: zoom;
		animation-duration: 0.6s;
		}

		@-webkit-keyframes zoom {
		from {-webkit-transform:scale(0)} 
		to {-webkit-transform:scale(1)}
		}

		@keyframes zoom {
		from {transform:scale(0)} 
		to {transform:scale(1)}
		}

		/* The Close Button */
		.close {
		position: absolute;
		top: 15px;
		right: 35px;
		color: #f1f1f1;
		font-size: 40px;
		font-weight: bold;
		transition: 0.3s;
		}

		.close:hover,
		.close:focus {
		color: #bbb;
		text-decoration: none;
		cursor: pointer;
		}

		/* 100% Image Width on Smaller Screens */
		@media only screen and (max-width: 700px){
		.modal-content {
			width: 100%;
		}
	}
	</style>
	
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
					<div class="product-details">
						<div class="col-sm-5">
							
							<?php
								$image = "";
								$image = get_image_name($produtos_shift['id']);
							?>
							<div class="view-product">
								<img src= "upload/<?php echo $image?>" id="zoomImg" alt="" />
							</div>
							
						</div>
						<div class="col-sm-7">
							<div class="product-information">
								
								<h2><?php echo $produtos_shift['nome']?></h2>

								<span>
									<span>R$<?php echo number_format($produtos_shift['preco'], 2, ',', '.')?></span>
									
									<?php if(isset($_SESSION['name'])): ?>
										<a type="button" class="btn btn-fefault cart" href="carrinho.php?acao=add&id=<?php echo $produtos_shift['id']?>">
											<i class="fa fa-shopping-cart"></i>
											Adicionar o carrinho
										</a>
									<?php else: ?>
										<a type="button" class="btn btn-fefault cart" href="login.php">
											<i class="fa fa-shopping-cart"></i>
											Adicionar o carrinho
										</a>
									<?php endif?>
								</span>
								<!-- <p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<a><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a> -->
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Detalhes</a></li>
							</ul>
						</div>
						< <div class="tab-content">
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<p><?php echo $produtos_shift['descricao']?></p>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
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
														<?php else: ?>
															<a class="btn btn-default add-to-cart" href="login.php"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
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
															<a class="btn btn-default add-to-cart" href="login.php"><i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
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

	<!-- The Modal -->
	<div id="modalImg" class="modal">
		<span class="close">&times;</span>
		<img class="modal-content" id="imagem">
		<div id="caption"></div>
	</div>

    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
	<script src="js/main.js"></script>
	
	<script>
	// Get the modal
	var modal = document.getElementById("modalImg");

	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var img = document.getElementById("zoomImg");
	var modalImg = document.getElementById("imagem");
	var captionText = document.getElementById("caption");
	img.onclick = function() {
		modal.style.display = "block";
		modalImg.src = this.src;
		captionText.innerHTML = this.alt;
	}

	// Close modal
	var span = document.getElementsByClassName("close")[0];
	span.onclick = function() { 
		modal.style.display = "none";
	}
	</script>

</body>
</html>
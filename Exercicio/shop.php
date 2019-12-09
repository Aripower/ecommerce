<?php
	session_start();
	require_once "dashboard/function.php";
	require_once 'functions/login.php';

	$pdoConnection = require_once "connection.php";
	
	$results = 0;
	
	if(isset($_GET['acao']) && in_array($_GET['acao'], array('filterProd', 'filterCategoria'))) {

		if($_GET['acao'] == 'filterProd' && isset($_POST['filtro']) ) {
			$limit = 6;
			
			$s = $pdoConnection->prepare('SELECT * FROM produtos WHERE nome like "%'.$_POST['filtro'].'%" ');
			
			$s->execute();
			$allResp = $s->fetchAll(PDO::FETCH_ASSOC);
			$total_results = $s->rowCount();
			$total_pages = ceil($total_results/$limit);
			
			if (!isset($_GET['page'])) {
				$page = 1;
			} else{
				$page = $_GET['page'];
			}

			$start = ($page-1)*$limit;

			$stmt = $pdoConnection->prepare(' SELECT * FROM produtos WHERE nome like "%'.$_POST['filtro'].'%" ORDER BY id ASC LIMIT '.$start.', '.$limit.' ');
			$stmt->execute();

			// set the resulting array to associative
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			
			$conn = null;

			$no = $page > 1 ? $start + 1 : 1;
		} else if(($_GET['acao'] == 'filterCategoria' && isset($_GET['filtroCat']) )) {
			$limit = 6;
			
			$s = $pdoConnection->prepare("SELECT * FROM produtos where id_categoria = :categoria");
			$s->bindParam(':categoria',$_GET['filtroCat']);
			$s->execute();
			$allResp = $s->fetchAll(PDO::FETCH_ASSOC);
			$total_results = $s->rowCount();
			$total_pages = ceil($total_results/$limit);
			
			if (!isset($_GET['page'])) {
				$page = 1;
			} else{
				$page = $_GET['page'];
			}

			$start = ($page-1)*$limit;

			$stmt = $pdoConnection->prepare("SELECT * FROM produtos where id_categoria = :categoria ORDER BY id ASC LIMIT $start, $limit");
			$stmt->bindParam(':categoria',$_GET['filtroCat']);
			$stmt->execute();

			// set the resulting array to associative
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			
			$conn = null;

			$no = $page > 1 ? $start + 1 : 1;
		}

	} else {
		$limit = 6;
		
		$s = $pdoConnection->prepare("SELECT * FROM produtos");
		$s->execute();
		$allResp = $s->fetchAll(PDO::FETCH_ASSOC);
		$total_results = $s->rowCount();
		$total_pages = ceil($total_results/$limit);
		
		if (!isset($_GET['page'])) {
			$page = 1;
		} else{
			$page = $_GET['page'];
		}

		$start = ($page-1)*$limit;

		$stmt = $pdoConnection->prepare("SELECT * FROM produtos ORDER BY id ASC LIMIT $start, $limit");
		$stmt->execute();

		// set the resulting array to associative
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$results = $stmt->fetchAll();
		
		$conn = null;

		$no = $page > 1 ? $start + 1 : 1;
	};

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Shop | E-Shopper</title>
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
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<div class="brands_products">
							<h2>Tipos</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
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
					<div class="features_items">
						<h2 class="title text-center">Produtos</h2>
						<?php if($results) : ?> 
							<?php foreach($results as $result) {?>
								<div class="col-sm-4">
									<div class="product-image-wrapper" style="width:250px;">
										<div class="single-products">
											<div class="productinfo text-center">
												<?php
													$image = "";
													$image = get_image_name($result['id']);
												?>
												<div class="view-product">
													<a href="product-details.php?acao=add&id=<?php echo $result['id']?>"> <img src= "upload/<?php echo $image?>" style="cursor: pointer" /> </a>
												</div>
												<h2>R$<?php echo number_format($result['preco'], 2, ',', '.')?></h2>
												<p><?php echo $result['nome']?></p>
												<?php if(isset($_SESSION['name'])): ?>
													<a class="btn btn-default add-to-cart" href="carrinho.php?acao=add&id=<?php echo $result['id']?>"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
												<?php else: ?>
													<a class="btn btn-default add-to-cart" href="login.php"> <i class="fa fa-shopping-cart"></i>Adicionar ao carrinho</a>
												<?php endif?>
											</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												
												<!-- <li><a href=""><i class="fa fa-plus-square"></i>Adicionar a lista de desejos</a></li> -->
											</ul>
										</div>
									</div>
								</div>
							<?php $no++; } ?>
						<?php endif?>
					</div>
					<?php if($results) : ?>
						<ul class="pagination">
							<li><a href="?page=1">Próximo</a></li>

							<?php for($p=1; $p<=$total_pages; $p++){?>
								<li class="<?= $page == $p ? 'active' : ''; ?>"><a href="<?= '?page='.$p; ?>"><?= $p; ?></a></li>
							<?php } ?>
						
							<li><a href="?page=<?= $total_pages; ?>">Anterior</a></li>
						</ul>
					<?php endif?>

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
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
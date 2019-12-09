

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
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			transition: 0.3s;
		}

		/* On mouse-over, add a deeper shadow */
		.card:hover {
			box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
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

	<div id="contact-page" class="container">
		<div class="bg">
			<div class="row"> 
				<div class="col-sm-12">
					<h2 class="title text-center">BAITA BROWNIE <img src="fotos/B.png"></h2>
					<div id="gmap" class="contact-map">
					<h4>
							Meu nome é Anne, sou estudante de nutrição. Vinda de Jaraguá do Sul para Florianópolis para estudar,
							me vi naquele momento como uma universitária sem dinheiro precisando pagar as contas.
					<h4>

					<h4>
							Lembrei que meu pai, que sempre gostou de cozinhar também fazia brownies maravilhosos para a gente comer. Não
							pensei duas vezes e pedi a receita pra ele e quando tentei reproduzil-los os brownies não ficaram da
							mesma forma... 
					<h4>
						Meu namorado, também universitário, resolveu me ajudar e me deu de presente alguns
						cursos de confeitaria - minha paixão
					<h4>
						e a partir disso (depois de muitos testes) o brownie começou a se tornar o que é hoje: Um pedacinho de amor. 
						Assim que surgiu o Baita Brownie Floripa!.
					<h4> 
						Uma
						receita caseira feita com muito amor (afinal, toda a ideia surgiu do amor que meu pai sempre colocou
						nos brownies dele).
					</h4>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="contact-form">
						<h2 class="title text-center"> Sobre</h2>
						<div class="view-product">
							<img src= "fotos/imagem_sobre.png" >
						</div>		
					</div>
				</div>

				<div class="col-sm-4">
					<div class="contact-info">
						<h2 class="title text-center">INFO</h2>
						<address>
							<h4>
								Baita Brownie - O melhor brownie da região!
							<h4>
							<h4>
								baitabrownie.com.br
							<h4>
						</address>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- <div id="contact-page" class="container">
		<div class="row">

			<p class="col-sm-5">
				Meu nome é Anne, sou estudante de nutrição. Vinda de Jaraguá do Sul para Florianópolis para estudar,
				me vi naquele momento como uma universitária sem dinheiro precisando pagar as contas. Lembrei que
				meu pai, que sempre gostou de cozinhar também fazia brownies maravilhosos para a gente comer. Não
				pensei duas vezes e pedi a receita pra ele e quando tentei reproduzil-los os brownies não ficaram da
				mesma forma... Meu namorado, também universitário, resolveu me ajudar e me deu de presente alguns
				cursos de confeitaria - minha paixão - e a partir disso (depois de muitos testes) o brownie começou
				a se tornar o que é hoje: Um pedacinho de amor. Assim que surgiu o Baita Brownie Floripa! Uma
				receita caseira feita com muito amor (afinal, toda a ideia surgiu do amor que meu pai sempre colocou
				nos brownies dele).
				
			</p>
			<div class="container col-sm-5">
				<div class="contact-info">
					<h2 class="title text-center"><img src="ADESIVO-CARTAO-FIDELIDADE (esperar a Anne mandar)"> Sobre</h2>
					<address>
						<h4>
							Olá! Meu nome é Anne, sou estudante de nutrição e vim de Jaraguá do Sul para Florianópolis para estudar. 
							Em Agosto de 2018 me vi uma universitária sem dinheiro precisando pagar as contas. 
							Lembrei que meu pai - que também sempre gostou de cozinhar - fazia brownies maravilhosos para a gente comer... 
							Não pensei duas vezes e pedi a receita para ele, quando tentei reproduzi-la os brownies não ficaram da mesma forma... 
							Meu namorado, também universitário, me vendo frustrada resolveu me ajudar e me deu de presente alguns cursos de confeitaria - minha paixão - 
							e a partir disso (depois de muitos testes) o brownie começou a se tornar o que é hoje: um pedacinho de amor! E dessa forma surgiu o Baita Brownie Floripa, com uma receitinha feita com muito amor! 
							Hoje não vendemos só para Florianópolis como também para Jaraguá do Sul e, assim, seguimos por um caminho de muita dedicação e amor.
						</h4>
						
						<br>
						<h4>INFO: </h4>
						<h4>Baita Brownie - O melhor brownie da região!</h4>
						<h4>baitabrownie.com.br</h4>
					</address>
				</div>
			</div>
		</div>
	</div> -->

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
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

</body>

</html>
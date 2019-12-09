<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">      
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
	<!-- <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet"> -->

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
	
	<section id="slider"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"> <!--login form-->
						<h2>Já tem uma conta?</h2>
						<form method="post">
							<input type="text" id="emailUp" name="emailUp" placeholder="Nome" />
							<input type="password" id="passUp" name="passUp" placeholder="Senha" />
							<button type="submit" id= "entrar" name="entrar" value="SIGN IN" class="btn btn-default get">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OU</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>É novo? Se registre aqui!</h2>
						<form method="post" >
							<input type="text" 		id="name" name="name" placeholder="Nome"/>
							<input type="text" 		id="email" name="email" placeholder="Email"/>
							<input type="password" 	id="pass" name="pass" placeholder="Senha"/>
							<input type="text" 		id="telefone" name="telefone" placeholder="telefone"/>
							<input type="text" 		id="numero" name="numero" placeholder="numero da casa"/>
							<input type="text" 		id="cep" 	name="cep" placeholder="cep" />
							<input type="text" 		id="rua"	name="rua" placeholder="rua" readonly="readonly"/>
							<input type="text" 		id="bairro" name="bairro" placeholder="bairro" readonly="readonly"/>
							<input type="text" 		id="cidade" name="cidade" placeholder="cidade" readonly="readonly"/>
							
							<a type="submit" id="cadastrar" name="cadastrar" value="SIGN UP" class="btn btn-default get" >Registrar</a>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
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
    
	<!-- <script src="js/price-range.js"></script> -->
    <!-- <script src="js/jquery.scrollUp.min.js"></script> -->
	<!-- <script src="js/jquery.prettyPhoto.js"></script> -->
	<!-- <script src="js/main.js"></script> -->
	
	<!-- <script src="js/jquery.min.js"></script> -->

	<!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript" language="javascript">

		$(document).ready(function() {
			
			$("#entrar").click(function( event ) {
				event.preventDefault();

				//get input field values
				var emailUp  = $('#emailUp').val();
				var passUp   = $('#passUp').val();
				var id		 = $(this).attr('id');
				
				$.ajax({
					type: 'post',
					url: "validaForm.php",
					dataType: 'json',
					data: 'email='+emailUp+'&pass='+passUp+'&id='+id,
					
					success: function(data)
					{
						if(data.type == 'sucessSing') {
							window.location.href = "index.php";
						}

						if(data.type == 'nullFields')
						{
							alert("Informe os campos de login");
						}

						if(data.type == 'errorSing') {
							alert("Credenciais inválidas")
						}  
					}
				});
				
			});

			function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });

			$("#cadastrar").click(function( e ) {
				e.preventDefault();
				
				//get input field values
				var email   	= $('#email').val();
				var name   	 	= $('#name').val();
				var pass    	= $('#pass').val();
				var telefone   	= $('#telefone').val();
				var rua    		= $('#rua').val();
				var numero    	= $('#numero').val();
				var bairro   	= $('#bairro').val();
				var cidade    	= $('#cidade').val();
				var cep    		= $('#cep').val();

				var id		= $(this).attr('id');	
				var flag 	 = true;
				
				/********Validar os field e não dar submit no form***********/
				/* Deixar os campos */
				if(name == "") {
					
					$("#name").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#name").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (email == "") {
					$("#email").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#email").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (pass == "") {
					$("#pass").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#pass").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (telefone == "") {
					$("#telefone").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#telefone").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (rua == "") {
					$("#rua").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#rua").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (numero == "") {
					$("#numero").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#numero").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (bairro == "") {
					$("#bairro").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#bairro").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if (cidade == "") {
					$("#cidade").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#cidade").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}

				if (cep == "") {
					$("#cep").change(function () {
    
						$(this).css("border", "5px solid red");
						
					}).trigger("change");

					flag = false;
				} else {
					$("#cep").change(function () {
    
						$(this).css("border", "none");
						
					}).trigger("change");
				}
				
				if(flag) {
					$.ajax({

						type: 'post',
						url: "validaForm.php",
						dataType: 'json',

						data: 'email='+email+'&pass='+pass+'&id='+id+'&name='+name+'&telefone='+telefone+'&rua='+rua+'&numero='+numero+'&bairro='+bairro+'&cidade='+cidade+'&cep='+cep,
						
						complete: function() 
						{
							$('.wait').remove();
						},

						success: function(data)
						{

							if(data.type == 'nullFields')
							{
								alert("Informe os campos");
							}
							
							if(data.type == 'existEmail')
							{
								alert("Email já cadastrado");
							}

							if(data.type == 'errorUp' || data.type == 'invalidPass')
							{
								alert("Credenciais inválidas");
							}
						
							if(data.type == 'sucessSing'){
								alert("Usuario cadastrado com sucesso")
							}

							if(data.type == 'errorSing'){
								alert("Credenciais inválidas")
							}
						}
					});
				} else {
					alert("Preencha os campos")
				}
			});

		});

    </script>
</body>
</html>
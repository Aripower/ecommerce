<html>
	<head>
		<title>Dashboard | E-Shopper</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		
		<!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				
		<!-- Our Custom CSS -->
		<link rel="stylesheet" href="../css/style3.css">

		<!-- Scrollbar Custom CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

	</head>
	<body>
		 
		<div class="wrapper">
			<!-- Sidebar Holder -->
			<nav id="sidebar">
				<div id="dismiss">
					<i class="glyphicon glyphicon-arrow-left"></i>
				</div>

				<div class="sidebar-header">
					<h3>E-Comerce</h3>
				</div>

				<ul class="list-unstyled components">
					<p>Opçoes</p>
					<li class="active">
						<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Pagina</a>
						<ul class="collapse list-unstyled" id="homeSubmenu">
							<li><a href="../../index.php">Home</a></li>
							<li><a href="../../shop.php">Produtos</a></li>
							<li><a href="../../carrinho.php">Carrinho</a></li>
							<li><a href="../../logout.php">Sair</a></li>
						</ul>
					</li>

					<li>
						<a href="../userControl/index.php">Usuarios</a>
					</li>

					<li>
						<a href="../index.php">Produtos</a>
					</li>

					<li>
						<a href="index.php">Historico de pedidos</a>
					</li>
				</ul>
			</nav>

			<div id="content">
				<nav class="navbar navbar-default">
					<div class="container-fluid">

						<div class="navbar-header">
							<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
								<i class="glyphicon glyphicon-align-left"></i>
								<span>OPÇÕES</span>
							</button>
						</div>

						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="../../index.php">Home</a></li>
								<li><a href="../../shop.php">Produtos</a></li>
								<li><a href="../../carrinho.php">Carrinho</a></li>
								<li><a href="../../logout.php">Sair</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>

		</div>

		<div class="overlay"></div>

		<div class="container box">
			<h1 >Controle dos Pedidos</h1>
			<br />
			<div class="table-responsive">
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="35%">Codigo</th>
							<th width="35%">prodid</th>
							<th width="35%">Pedido</th>
							<th width="35%">quantidade</th>
							<th width="35%">id_cliente</th>
							
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</body>
</html>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<!-- jQuery Plugin Foi colocado aqui pois estava dando sobrescrita de versão -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Por algum motivo alguma classe não deixava a mesma funcionar por isso foi colocado antes -->
<script type="text/javascript" language="javascript" >

	$(document).ready(function() {
	
		var dataTable = $('#user_data').DataTable({
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{
				url:"fetch.php",
				type:"POST"
			},
			"columnDefs":[
				{
					"targets":[0, 2, 3, 4],
					"orderable":false,
				},
			],

			"language": {
				"lengthMenu": "Total de _MENU_ registros por página",
				"zeroRecords": "Não foram encontrador registro - SORRY :/",
				"info": "Total de _MAX_ registros",
				"infoEmpty": "Não há registros cadastrados",
				"infoFiltered": "(filtro de _MAX_ registros)",
				"search":         "Busca:",
				"processing":     "Carregando...",
				
				"paginate": {
					"first":      "Primeiro",
					"last":       "Ultimo",
					"next":       "Proximo",
					"previous":   "Anterior"
				},

				},
			
		});

		$(document).on('click', '.update', function() {
			var user_id = $(this).attr("id");
			$.ajax({
				url:"fetch_single.php",
				method:"POST",
				data:{user_id:user_id},
				dataType:"json",
				success:function(data) {

				
					
				}
			})
		});
	});
	
</script>

<!-- Menu Overlay/dismiss Script -->
<script type="text/javascript" language="javascript">
	$(document).ready(function () {
		$("#sidebar").mCustomScrollbar({
			theme: "minimal"
		});

		$('#dismiss, .overlay').on('click', function () {
			$('#sidebar').removeClass('active');
			$('.overlay').fadeOut();
		});

		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').addClass('active');
			$('.overlay').fadeIn();
			$('.collapse.in').toggleClass('in');
			$('a[aria-expanded=true]').attr('aria-expanded', 'false');
		});
	});
</script>



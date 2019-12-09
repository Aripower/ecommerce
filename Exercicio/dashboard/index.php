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
		<link rel="stylesheet" href="css/style3.css">

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
							<li><a href="../index.php">Home</a></li>
							<li><a href="../shop.php">Produtos</a></li>
							<li><a href="../carrinho.php">Carrinho</a></li>
							<li><a href="../logout.php">Sair</a></li>
						</ul>
					</li>

					<li>
						<a href="userControl/index.php">Usuarios</a>
					</li>

					<li>
						<a href="index.php">Produtos</a>
					</li>

					<li>
						<a href="orderControl/index.php">Historico de pedidos</a>
					</li>
				</ul>
			</nav>

			<!-- Page Content Holder -->
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
								<li><a href="../index.php">Home</a></li>
								<li><a href="../shop.php">Produtos</a></li>
								<li><a href="../carrinho.php">Carrinho</a></li>
								<li><a href="../logout.php">Sair</a></li>
							</ul>
						</div>
					</div>
				</nav>

			</div>
		</div>

        <div class="overlay"></div>

		<div class="container box">
			<h1>Controle dos produtos</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div >
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-info btn-lg">Add</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">Editar</th>
							<th width="10%">Deletar</th>
							<th width="35%">nome</th>
							<th width="35%">categoria</th>
							<th width="35%">preco</th>
							<th width="35%">quantidade</th>
							<th width="10%">imagem</th>
							<th width="35%">descricao</th>
							
						</tr>
					</thead>
				</table>
			</div>
		</div>
		
	</body>
</html>

<!-- User Modal -->
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Produto</h4>
				</div>
				<div class="modal-body">
					<label>Digite o nome do produto</label>
					<input type="text" name="nome" id="nome" class="form-control" />
					<br />
					<label>Digite a categoria do produto</label>
					<input type="text" name="id_categoria" id="id_categoria" class="form-control" />
					<br />
					<label>Digite o preço do produto</label>
					<input type="text" name="preco" id="preco" class="form-control" />
					<br />
					<label>Digite a quantidade disponivel do produto</label>
					<input type="text" name="quantidade" id="quantidade" class="form-control" />
					<br />
					<label>Digite a descricao do produto</label>
					<input type="text" name="descricao" id="descricao" class="form-control" />
					<br />
					<label>Informe e link da imagem do produto</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Image Modal -->
<div id="modalImg" class="modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Imagem</h4>
			</div>
			<div class="modal-body">
				
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Sair</button>
			</div>
		</div>
	</div>
</div>
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

	$(document).ready(function(){
	
		$('#add_button').click(function(){
			$('#user_form')[0].reset();
			$('.modal-title').text("Add Produto");
			$('#action').val("Add");
			$('#operation').val("Add");
			$('#user_uploaded_image').html('');
		});
		
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

		$(document).on('submit', '#user_form', function(event){
			event.preventDefault();
			var firstName 	= $('#nome').val();
			var lastName  	= $('#preco').val();
			var id_categoria = $('#id_categoria').val();
			var quantidade 	= $('#quantidade').val();
			var descricao 	= $('#descricao').val();
			var extension 	= $('#user_image').val().split('.').pop().toLowerCase();
			if(extension != '')
			{
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
				{
					alert("Imagem invalida");
					$('#user_image').val('');
					return false;
				}
			}	
			if(firstName != '' && lastName != '')
			{
				$.ajax({
					url:"insert.php",
					method:'POST',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data)
					{
						alert(data);
						$('#user_form')[0].reset();
						$('#userModal').modal('hide');
						dataTable.ajax.reload();
					}
				});
			} else {
				alert("Ambos os campos são requeridos");
			}
		});

		$('body').on('click','img',function(){
   			alert("entrou")
			$('#modalImg').modal('show');
			//$('#zoomImg').val('zoomImg');
		});

		$(document).on('click', '.update', function(){
			var user_id = $(this).attr("id");
			$.ajax({
				url:"fetch_single.php",
				method:"POST",
				data:{user_id:user_id},
				dataType:"json",
				success:function(data)
				{
					$('#userModal').modal('show');
					$('#nome').val(data.nome);
					$('#id_categoria').val(data.id_categoria);
					$('#preco').val(data.preco);
					$('#quantidade').val(data.quantidade);
					$('#descricao').val(data.descricao);
					$('.modal-title').text("Edit User");
					$('#user_id').val(user_id);
					$('#user_uploaded_image').html(data.user_image);
					$('#action').val("Editar");
					$('#operation').val("Editar");
				}
			})
		});
		
		$(document).on('click', '.delete', function(){
			var user_id = $(this).attr("id");
			if(confirm("Você tem certeza que deseja deletar este produto?"))
			{
				$.ajax({
					url:"delete.php",
					method:"POST",
					data:{user_id:user_id},
					success:function(data)
					{
						alert(data);
						dataTable.ajax.reload();
					}
				});
			} else {
				return false;	
			}
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



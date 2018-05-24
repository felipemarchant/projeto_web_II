<?php
session_start();
if(!isset($_SESSION)){
	header('Location: logout.php');
}
$dadosUsu = $_SESSION['dadosUsu'];
$dados = $_SESSION['dados'];
$nivel = (int)$dadosUsu->usu_nivel;
if($nivel != 1){
	header('Location: logout.php');
}

	//header("location:login.php");
require '../app/core/DB.php';
require '../app/core/config.php';
$conn = DB::getConexao();
$listMaterias = $conn->query("SELECT * FROM materias");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gerenciar Materias</title>
	<link rel="stylesheet" href="../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="skin/css/admin.css">
</head>
<body id="admin_materia">	
	<!-- Include Menu -->
	<?php require 'templates/header.php' ?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm dataTable-all">
				<div class="data-table table-responsive">
					<table class="table table-striped table-bordered table-fixed">
						<thead>
							<tr>
								<th>Nome</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while($materia = $listMaterias->fetch(PDO::FETCH_OBJ)){
								echo "<tr><td>" . $materia->mat_nome . "</td></tr>";
							}
							?>
					</tbody>

					<tfoot>
						<tr>
							<th>Nome</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</div>
</div>
<?php require 'templates/footer.php'; ?>
</body>
</html>
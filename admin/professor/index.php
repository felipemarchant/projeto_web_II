<?php
require "../templates/inc.php";
$alunoRepo = new AlunoRepository;
$alunoList = $alunoRepo->getCollection(['alunos.alu_id','usuarios.usu_ra','usuarios.usu_nome'], null, true);
	//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gerenciar Alunos</title>
	<link rel="stylesheet" href="../../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="../skin/css/admin.css">
	<script type="text/javascript" src="../../lib/skin/js/easyHTTP.js"></script>
	<script type="text/javascript" src="../skin/js/professor_index.js"></script>
</head>
<body id="admin_professor_index">	
	<!-- Include Menu -->
	<?php require '../templates/header.php' ?>
	<br>
	<div class="container">
		<h1 class="lead text-title text-center">Computação Básica</h1>
		<div class="row">
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm">
						<p class="">Nome:</p>
					</div>
					<div class="col-sm">
						<p class="">Sobrenome:</p>
					</div>
					<div class="col-sm">
						<p class="">RA:</p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<p class="">E-Mail:</p>
					</div>
				</div>
				<div class="row">
					<div class="form-group row">
						<div class="col-sm-10">
							<label for="b1" class="col-sm-2 col-form-label">B1</label>
							<input type="password" class="form-control" id="b1" placeholder="Nota B1">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-10">
							<label for="b2" class="col-sm-2 col-form-label">B2</label>
							<input type="password" class="form-control" id="b2" placeholder="Nota B2">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group row">
						<div class="col-sm-6">
							<p class="text-center">DATA: 17/08/2018</p>
						</div>
						<div class="col-sm-6">
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-success active">Presente</button>
								<button type="button" class="btn btn-danger">Ausente</button>
							</div>
						</div>
					</div>
				</div>
				<hr/>
				<br/>
				<h6>Lista de Presenças</h6>
				<div class="row">
					<div class="col-sm">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-fixed">
								<thead>
									<tr>
										<th>Data</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?php echo date('d/m/Y') ?></td>
										<td><div class="btn-group" role="group" aria-label="">
											<button type="button" class="btn btn-success active">Presente</button>
										</div></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<th>Data</th>
										<th></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-5 offset-sm-1">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-fixed">
						<thead>
							<tr>
								<th>RA</th>
								<th>Nome</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($alunoList as $aluno): ?>
								<tr>
									<td onclick="findOnly(<?php echo $aluno->alu_id; ?>)"><?php echo $aluno->usu_ra; ?></td>
									<td><?php echo $aluno->alu_nome; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th>RA</th>
								<th>Nome</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php require '../templates/footer.php' ?>
</body>
</html>
<?php
require "../templates/inc.php";
$idMat = 1;
$alunoRepo = new AlunoRepository;
$alunoList = $alunoRepo->getCollectionByMateria($idMat);
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
		<div class="row" id="area_aluno">
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm">
						<p class="">Nome:</p>
						<p id="aluno_nome"></p>
					</div>
					<div class="col-sm">
						<p class="">Sobrenome:</p>
						<p id="aluno_sobrenome"></p>
					</div>
					<div class="col-sm">
						<p class="">RA:</p>
						<p id="aluno_ra"></p>
					</div>
				</div>
				<div class="row">
					<div class="col-sm">
						<p class="">E-Mail:</p>
						<p id="aluno_email"></p>
					</div>
				</div>
				<div class="row">
					<div class="form-group row">
						<div class="col-sm-6">
							<p class="text-center"><?php echo date('d/m/Y'); ?></p>
						</div>
						<div class="col-sm-6">
							<div class="btn-group" role="group" aria-label="Basic example">
								<select id="select_presente" name="presenca" class="form-control">
									<option value="1">Presente</option>
									<option value="0">Ausente</option>
								</select>
							</div>
						</div>
					</div>
					<input type="hidden" value="<?php echo $idMat; ?>" id="_id_mat"  />
					<input type="hidden" value="<?php echo date('Y-m-d H:i:s'); ?>" id="_dataAtual"  />
					<input type="hidden" value="" id="_id_alu"  />
					<input type="button" onclick="insertAluPresencaNota()" value="Enviar" class="ml-5 btn btn-primary" />
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
								<tbody id="tbody_presenca">
									<tr>
										<td></td>
										<td><div class="btn-group" role="group" aria-label="">
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
								<th></th>
								<th>Nome</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($alunoList as $aluno): ?>
								<tr>
									<td colspan="2" onclick="findOnly(<?php echo $aluno->alu_id; ?>)"><?php echo $aluno->alu_nome ." "; ?><?php echo $aluno->alu_sobrenome; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th></th>
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
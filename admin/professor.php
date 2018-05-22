<?php
require 'templates/admin_inc.php';

$materia = new MateriaRepository();
$materiaList = $materia->getCollection(
	[
		'mat_id',
		'mat_nome'
	]
);
$professor = new ProfessorRepository();
$professorList = $professor->getCollection(
	[
		'usuarios.usu_id',
		'usuarios.usu_ra',
		'usuarios.usu_email',
		'professores.pro_nome',
		'professores.pro_sobrenome',
		'materias.mat_nome'
	]
);
	//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gerenciar Professores</title>
	<link rel="stylesheet" href="../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="skin/css/admin.css">
	<script type="text/javascript" src="../lib/skin/js/easyHTTP.js"></script>
	<script type="text/javascript" src="skin/js/dataTable.js"></script>
	<script type="text/javascript" src="skin/js/formSearch.js"></script>
	<script type="text/javascript" src="skin/js/professor.js"></script>
</head>
<body id="admin_professor">	
	<!-- Include Menu -->
	<?php require 'templates/header.php' ?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-addUser-all">
				<h1 class="lead text-title text-center">Adicionar Professor</h1>
				<form class="" method="POST" action="">
					<div class="col-sm-10 offset-sm-1 form-inline">
						<label class="mr-2" for="nome">Nome</label>
						<div class="input-group mb-2 mr-sm-2">
							<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" required>
						</div>

						<label class="mr-2" for="sobrenome">Sobrenome</label>
						<div class="input-group mb-2 mr-sm-2">
							<input type="text" name="sobrenome" class="form-control" id="sobrenome" placeholder="Sobrenome" required>
						</div>
						<label class="mr-2" for="email">E-Mail</label>
						<div class="input-group mb-2 mr-sm-2">
							<input type="email" name="email" class="form-control" id="email" placeholder="E-Mail" required>
						</div>

					</div>
					<div class="col-sm-10 offset-sm-1 form-inline">
						<label class="mr-2" for="nome" style="padding-right: 24px;">RA</label>
						<div class="input-group mb-2 mr-sm-2">
							<input type="text" name="ra" class="form-control" id="ra" placeholder="RA" required>
						</div>

						<label class="mr-2" for="sobrenome">Senha</label>
						<div class="input-group mb-2 mr-sm-1">
							<input type="text" name="senha" class="form-control" id="senha" placeholder="Senha" required>
						</div>
						<div class="input-group mb-2 mr-sm-1">
							<div class="input-group-prepend">
								<label class="input-group-text" for="materia">Materia</label>
							</div>
							<select class="custom-select" id="materia">
								<?php foreach ($materiaList as $materia): ?>
									<option value="<?php echo $materia->mat_id; ?>"><?php echo $materia->mat_nome; ?></option>
								<?php endforeach;?>
							</select>
						</div>
						<input type="submit" class="btn btn-success mb-2 mr-sm-1" value="Cadastrar" />
					</div>
				</form>	
			</div>
		</div>
		<div class="row col-searchUser-all">
			<div class="col-sm-2">
				<div class="input-group">
					<select id="formSearch_select" class="custom-select">
						<option value="ra">RA</option>
						<option value="nome" selected>Nome</option>
						<option value="email">E-Mail</option>
						<option value="materia">Matéria</option>
					</select>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="input-group">
					<input id="formSearch_searchInput" type="text" placeholder="Nome" class="form-control" required>
					<div class="input-group-append">
						<button id="formSearch_submit" class="btn btn-primary" type="button">Pesquisar</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm dataTable-all">
				<div class="data-table table-responsive">
					<table id="dataTable_table" class="table table-striped table-bordered table-fixed">
						<thead>
							<tr>
								<th>RA</th>
								<th>Nome</th>
								<th>E-Mail</th>
								<th>Matéria</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="dataTable_tbody">
							<?php foreach ($professorList as $key => $professor): ?>
								<tr>
									<td><?php echo $professor->usu_ra; ?></td>
									<td><?php echo $professor->pro_nome." ".$professor->pro_sobrenome; ?></td>
									<td><?php echo $professor->usu_email; ?></td>
									<td><?php echo $professor->mat_nome; ?></td>
									<?php if($professor->pro_ativo == 0):?>
										<td><div class="action"><button class="btn btn-primary btn-small">Editar</button> | <button onclick="deleteProfessor(<?php echo $professor->pro_id; ?>,<?php echo $professor->pro_ativo; ?>)" class="btn btn-success btn-small">Ativar</button></div></td>
										<?php else:?>
											<td><div class="action"><button class="btn btn-primary btn-small">Editar</button> | <button onclick="deleteProfessor(<?php echo $professor->pro_id; ?>,<?php echo $professor->pro_ativo; ?>)" class="btn btn-danger btn-small">Desativar</button></div></td>
										<?php endif; ?>
									</tr>
								<?php endforeach; ?>
							</tbody>
							<tfoot>
								<tr>
									<th>RA</th>
									<th>Nome</th>
									<th>E-Mail</th>
									<th>Matéria</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

			</div>
		</div>
		<?php require 'templates/footer.php' ?>
	</body>
	</html>
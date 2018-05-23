<?php
require '../admin/templates/admin_inc.php';
$alunoRepo = new AlunoRepository();
$alunoRepos = $alunoRepo->getCollection();
	//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gerenciar Alunos</title>
	<link rel="stylesheet" href="../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="skin/css/admin.css">
	<script type="text/javascript" src="../lib/skin/js/easyHTTP.js"></script>
	<script type="text/javascript" src="skin/js/dataTableA.js"></script>
	<script type="text/javascript" src="skin/js/formSearch.js"></script>
	<script type="text/javascript" src="skin/js/aluno.js"></script>
</head>
<body id="admin_aluno">	
	<!-- Include Menu -->
	<?php require 'templates/header.php' ?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-addUser-all">
				<div id="alunoForm_add_all">				
					<h1 class="lead text-title text-center">Adicionar Aluno</h1>
					<form class="" method="POST" action="">
						<div class="col-sm-10 offset-sm-1 form-inline">
							<label class="mr-2" for="nome">Nome</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="nome" class="form-control"  placeholder="Nome" required>
							</div>

							<label class="mr-2" for="sobrenome">Sobrenome</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="sobrenome" class="form-control"  placeholder="Sobrenome" required>
							</div>
							<label class="mr-2" for="email">E-Mail</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="email" name="email" class="form-control"  placeholder="E-Mail" required>
							</div>

						</div>
						<div class="col-sm-10 offset-sm-1 form-inline">
							<label class="mr-2" for="nome" style="padding-right: 24px;">RA</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="ra" class="form-control"  placeholder="RA" required>
							</div>

							<label class="mr-2" for="sobrenome">Senha</label>
							<div class="input-group mb-2 mr-sm-1">
								<input type="text" name="senha" class="form-control"  placeholder="Senha" required>
							</div>
							<input type="submit" class="btn btn-success mb-2 mr-sm-1" value="Cadastrar" />
						</div>
					</form>	
				</div>
				<div id="alunoForm_edit_all">
					<h1 class="lead text-title text-center">Editar Aluno</h1>
					<form class="" method="POST" action="">
						<div class="col-sm-10 offset-sm-1 form-inline">
							<label class="mr-2" for="nome">Nome</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="nome" class="form-control"  placeholder="Nome" required>
							</div>

							<label class="mr-2" for="sobrenome">Sobrenome</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="sobrenome" class="form-control"  placeholder="Sobrenome" required>
							</div>
							<label class="mr-2" for="email">E-Mail</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="email" name="email" class="form-control"  placeholder="E-Mail" required>
							</div>

						</div>
						<div class="col-sm-10 offset-sm-1 form-inline">
							<label class="mr-2" for="nome" style="padding-right: 24px;">RA</label>
							<div class="input-group mb-2 mr-sm-2">
								<input type="text" name="ra" class="form-control"  placeholder="RA" required>
							</div>

							<label class="mr-2" for="sobrenome">Senha</label>
							<div class="input-group mb-2 mr-sm-1">
								<input type="text" name="senha" class="form-control"  placeholder="Senha" required>
							</div>
							<input type="button" class="btn btn-danger mb-2 mr-sm-1" value="Cancelar" />
							<input type="submit" class="btn btn-success mb-2 mr-sm-1" value="Cadastrar" />
						</div>
					</form>	
				</div>
			</div>
		</div>
		<div class="row col-searchUser-all">
			<div class="col-sm-2">
				<div class="input-group">
					<select id="formSearch_select" class="custom-select">
						<option value="ra">RA</option>
						<option value="nome" selected>Nome</option>
						<option value="email">E-Mail</option>
					</select>
				</div>
			</div>
			<div class="col-sm-10">
				<div class="input-group">
					<input id="formSearch_searchInput" type="text" placeholder="Nome" class="form-control" required>
					<div class="input-group-append">
						<button class="btn btn-primary" id="formSearch_submit" type="button">Pesquisar</button>
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
								<th>Frequência</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="dataTable_tbody">
							<?php foreach ($alunoRepos as $aluno): ?>
								<?php 
								$presencas = $alunoRepo->getPresencas($aluno->alu_id);
								$faltas    = $alunoRepo->getFaltas($aluno->alu_id);
								?>
								<tr>
									<td><?php echo $aluno->usu_ra; ?></td>
									<td><?php echo $aluno->alu_nome." ".$aluno->alu_sobrenome; ?></td>
									<td><?php echo $aluno->usu_email; ?></td>
									<td class="frequencia"><p class="frequencia bg-success text-light"><?php echo $presencas; ?></p> | <p class="falta bg-warning"><?php echo $faltas;?></p></td>
									<td><div class="action"><button class="btn btn-primary btn-small">Editar</button> | 

										<?php if($aluno->alu_ativo == 0):?>
											<button ativo="<?php echo $aluno->alu_ativo; ?>" id="<?php echo $aluno->alu_id ?>" onclick="deleteAluno(<?php echo $aluno->alu_id; ?>,<?php echo $aluno->alu_ativo; ?>)" class="btn btn-success btn-small">Ativar</button></div></td>
											<?php else:?>
												<button ativo="<?php echo $aluno->alu_ativo; ?>" id="<?php echo $aluno->alu_id ?>" onclick="deleteAluno(<?php echo $aluno->alu_id; ?>,<?php echo $aluno->alu_ativo; ?>)" class="btn btn-danger btn-small">Desativar</button></div></td>

											<?php endif;?>

										</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<th>RA</th>
										<th>Nome</th>
										<th>E-Mail</th>
										<th>Frequência</th>
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
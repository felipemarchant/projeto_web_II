<?php 

require '../templates/inc.php';

$alunoRepo = new AlunoRepository;
$materiasLista = $alunoRepo->getMateriasCollection(2,
	[
		'alunos_materias.mat_id',
		'alunos_materias.alu_id',
		'mat_nome',
		'not_b1',
		'not_b2',
		'pro_id'
	]
);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Gerenciar Materias</title>
	<link rel="stylesheet" href="../../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="../skin/css/admin.css">
</head>
<body id="admin_materia">	
	<!-- Include Menu -->
	<?php require '../templates/header.php' ?>
	<br>
	<div class="container">
		<h4 class="text-center">Matérias</h4>
		<div class="row">
			<div class="col-sm dataTable-all">
				<div class="data-table table-responsive">
					<table class="table table-striped table-bordered table-fixed">
						<thead>
							<tr>
								<th>Matéria</th>
								<th>Professor</th>
								<th>B1</th>
								<th>B2</th>
								<th>Média</th>
								<th>Frequência</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($materiasLista as $materia):  ?>
								<?php

								$proRepo = new ProfessorRepository;
								$prof = $proRepo->findOnly($materia->pro_id);

								$b1 = (float) $materia->not_b1;
								$b2 = (float) $materia->not_b2;
								$media = (float) ($b1 + $b2)/2;

								$presenca = $alunoRepo->getPresencas($materia->alu_id, $materia->mat_id);
								$faltas = $alunoRepo->getFaltas($materia->alu_id, $materia->mat_id);

								?>
								<tr>
									<td><?php echo $materia->mat_nome; ?></td>
									<td><?php echo $prof->pro_nome . " " . $prof->pro_sobrenome; ?></td>
									<td><?php echo $b1; ?></td>
									<td><?php echo $b2; ?></td>
									<td><?php echo $media; ?></td>
									<td><p class="frequencia bg-success text-light"><?php echo $presenca; ?></p> | <p class="falta bg-warning"><?php echo $faltas; ?></p></td>
								</tr>
							<?php endforeach; ?>

						</tbody>

						<tfoot>
							<tr>
								<th>Matéria</th>
								<th>Professor</th>
								<th>B1</th>
								<th>B2</th>
								<th>Média</th>
								<th>Frequência</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

		</div>
	</div>
	<?php require '../templates/footer.php'; ?>
</body>
</html>
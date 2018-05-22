<?php

	require 'templates/admin_inc.php';

	$aluno = new AlunoRepository();
	$alunoTotal = $aluno->getTotal();

	$materia = new MateriaRepository();
	$materiaTotal = $materia->getTotal();

	$professor = new ProfessorRepository();
	$professorTotal = $professor->getTotal();


	//header("location:login.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Home</title>
	<link rel="stylesheet" href="../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="skin/css/admin.css">
</head>
<body id="admin_index">	
	<!-- Include Menu -->
	<?php require 'templates/header.php' ?>
	<br>
	<div class="container">
		<div class="row admin_menu">
			<div class="col-sm-12 col-md-3 col-lg-2">
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Professor</div>
					<div class="card-body">
						<h1 class="h3"><?php echo $professorTotal; ?></h1><a class="btn btn-secondary btn-sm" href="professor.php">Professores</a>
					</div>
				</div>
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Aluno</div>
					<div class="card-body">
						<h1 class="h3"><?php echo $alunoTotal; ?></h1> <a class="btn btn-secondary btn-sm" href="aluno.php">Alunos</a>
					</div>
				</div>
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Matéria</div>
					<div class="card-body">
						<h1 class="h3"><?php echo $materiaTotal; ?></h1> <a class="btn btn-secondary btn-sm" href="materia.php">Matérias</a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-8">
				<div class="img-wrapper-banner">
					<img class="img-fluid img-thumbnail" src="skin/images/admin_index_banner.jpg" alt="UNG"/>
				</div>
			</div>
			<div class="col-sm-12 col-md-3 col-lg-2">
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Sair</div>
					<div class="card-body">
						<p class="card-text">Deseja Sair?</p>
						<a class="btn btn-secondary btn-sm" href="logout.php">Sair</a>
					</div>
				</div>
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Administrador</div>
					<div class="card-body">
						<p class="card-text">Nome</p>
						<p class="card-text">E-Mail</p>
					</div>
				</div>
				<!-- Card 1 -->
				<div class="card border-dark">
					<div class="card-header">Hoje</div>
					<div class="card-body">
						<?php 
						$dAr = array(
							"Sunday"    =>"Dom",
							"Monday"    =>"Seg",
							"Tuesday"   =>"Ter",
							"Wednesday" =>"Quar",
							"Thursday"  =>"Quinta",
							"Friday"    =>"Sex",
							"Saturday"  =>"Sáb"
						);
						$date = new DateTime('NOW');
						$dia = $date->format('d');
						$sem = $dAr[$date->format('l')];
						$dia_sem = $dia." ".$sem;
						$mes = $date->format("M");
						$ano = $date->format("Y");
						$mes_ano = $mes." de ".$ano;
						?>
						<h1 class=""><?php echo $dia_sem; ?></h1> <p class="card-text"><?php echo $mes_ano; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require 'templates/footer.php' ?>
</body>
</html>
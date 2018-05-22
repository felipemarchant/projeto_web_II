<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	$criteria = '';
	if(isset($_POST['valor']) && isset($_POST['valor'])){
		$criteria = 'AND ';
		$valor = trim($_POST['valor']);
		$map = array(
			'ra' => "LOWER(usuarios.usu_ra) LIKE '%$valor%'",
			'nome' => "LOWER(professores.pro_nome) LIKE '%$valor%' OR LOWER(professores.pro_sobrenome) LIKE '%$valor%'",
			'email' => "LOWER(usuarios.usu_email) LIKE '%$valor%'",
			'materia' => "LOWER(materias.mat_nome) LIKE '%$valor%'"
		);
		$criteria = $criteria."(".$map[$_POST['filtro']].")";
	}

	$professor = new ProfessorRepository;
	$professor->setFetchType(PDO::FETCH_ASSOC);
	$professorList = $professor->getCollection(
		[
			'usuarios.usu_id',
			'usuarios.usu_ra',
			'usuarios.usu_email',
			'professores.pro_nome',
			'professores.pro_sobrenome',
			'materias.mat_nome'
		], $criteria
	);

	echo json_encode($professorList);	
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

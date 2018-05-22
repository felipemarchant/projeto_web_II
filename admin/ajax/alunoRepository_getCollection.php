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
			'nome' => "LOWER(alunos.alu_nome) LIKE '%$valor%' OR LOWER(alunos.alu_sobrenome) LIKE '%$valor%'",
			'email' => "LOWER(usuarios.usu_email) LIKE '%$valor%'"
		);
		$criteria = $criteria."(".$map[$_POST['filtro']].")";
	}

	$alunoRepo = new AlunoRepository;
	$alunoRepo->setFetchType(PDO::FETCH_ASSOC);
	$alunoList = $alunoRepo->getCollection(array(), $criteria);
	$alunoListFinal = array();
	foreach ($alunoList as $aluno) {
		$presencas = $alunoRepo->getPresencas($aluno['alu_id']);
		$faltas    = $alunoRepo->getFaltas($aluno['alu_id']);
		$alunoFinal = $aluno;
		$alunoFinal['presencas'] = $presencas;
		$alunoFinal['faltas']    = $faltas;
		array_push($alunoListFinal, $alunoFinal);
	}
	echo json_encode($alunoListFinal);	
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

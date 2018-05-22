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

	$aluno = new AlunoRepository;
	$aluno->setFetchType(PDO::FETCH_ASSOC);
	$alunoList = $aluno->getCollection(array(), $criteria);
	echo json_encode($alunoList);	
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(!in_array('', $_POST)){
		$id = $_POST['aluno']['id'];
		$dadosAluno = $_POST['aluno'];
		$dadosUsuario 	= $_POST['usuario'];

		$aluRepo = new AlunoRepository;
		$aluRepo->editAluno($id, $dadosAluno);
		$aluRepo->editUser($id, $dadosUsuario);
		echo json_encode(array());
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
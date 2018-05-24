<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(!in_array('', $_POST)){
		$id = $_POST['professor']['id'];
		$dadosProfessor = $_POST['professor'];
		$dadosUsuario 	= $_POST['usuario'];

		$proRepo = new ProfessorRepository;
		$proRepo->editProfessor($id, $dadosProfessor);
		$proRepo->editUser($id, $dadosUsuario);
		echo json_encode(array());
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
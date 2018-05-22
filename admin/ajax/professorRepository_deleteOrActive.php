<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if((isset($_POST['id']) && !empty($_POST['id'])) && isset($_POST['action'])){
		$professorRepo =  new ProfessorRepository;
		$professorRepo->deleteOrActive($_POST['id'], $_POST['action']);
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

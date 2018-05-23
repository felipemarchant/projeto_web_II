<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(!in_array('', $_POST)){
		$professor = $_POST['professor'];
		$usuario   = $_POST['usuario'];
		$idMat = $professor['materia'];
		$proRepo = new ProfessorRepository;
		$matRepo = new MateriaRepository;
		$id = $proRepo->add($professor);
		$proRepo->addUser($id, $usuario);
		$matRepo->setProfessor($id,$idMat);
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

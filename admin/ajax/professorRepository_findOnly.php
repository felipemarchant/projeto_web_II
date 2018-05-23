<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(isset($_POST['id'])){
		$proRepo = new ProfessorRepository;
		$proRepo->setFetchType(PDO::FETCH_ASSOC);
		$prof = $proRepo->findOnly($_POST['id']);
		echo json_encode($prof);
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
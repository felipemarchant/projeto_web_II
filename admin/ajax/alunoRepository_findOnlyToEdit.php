<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(isset($_POST['id'])){
		$alunoRepo = new AlunoRepository;
		$alunoRepo->setFetchType(PDO::FETCH_ASSOC);
		$alu = $alunoRepo->findOnly($_POST['id']);
		echo json_encode($alu);
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
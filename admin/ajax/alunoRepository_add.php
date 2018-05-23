<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(!in_array('', $_POST)){
		$aluno = $_POST['aluno'];
		$usuario   = $_POST['usuario'];
		$mats = $aluno['materia'];
		if(verificaRA($usuario['ra'])){
			$newRa = geraRA();
			echo json_encode(array(
				"erro_ra" => "RA já em uso. Use outro :D",
				"ra" => $newRa
			));
		}else{		
			$aluRepo = new AlunoRepository;
			$matRepo = new MateriaRepository;
			$id = $aluRepo->add($aluno);
			$aluRepo->addUser($id, $usuario);
			$matRepo->addBingMaterias($id, $mats);

			echo json_encode(array());
		}
	}
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}


function verificaRA($ra){
	require_once('../../app/core/DB.php');
	$conn = DB::getConexao();
	$sql = "SELECT COUNT(*) FROM usuarios WHERE usu_ra = '$ra'";
	$total = $conn->query($sql)->fetchColumn();
	return (int)$total > 0;
}
function geraRA(){
	$ra = rand(10000000, 99999999);
	if(verificaRA($ra)){
		geraRA();
	}
	return $ra;
}
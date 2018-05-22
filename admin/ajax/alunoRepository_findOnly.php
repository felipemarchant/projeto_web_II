<?php
/*

SELECT * FROM professores 
INNER JOIN materias ON materias.pro_id = professores.pro_id 
INNER JOIN frequencias ON frequencias.mat_id = materias.mat_id 
WHERE professores.pro_id = '1' AND frequencias.alu_id = '1'

*/
require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');

if(true){
	if(isset($_POST['id'])){
		$resp = array();
		$alunoRepo = new AlunoRepository;
		$alunoRepo->setFetchType(PDO::FETCH_ASSOC);
		$professorRepo = new ProfessorRepository;
		$professorRepo->setFetchType(PDO::FETCH_ASSOC);
		$aluno = $alunoRepo->findOnly($_POST['id']);
		$resp['aluno'] = $aluno;
		$listFrequencia = $professorRepo->getFrequenciaCollection($aluno['alu_id'],1);
		$resp['frequencia'] = $listFrequencia;
		echo json_encode($resp);
	}

}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
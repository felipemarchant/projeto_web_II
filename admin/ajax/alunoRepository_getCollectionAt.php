
<?php

require '../templates/inc.php';
if(true){
	$aluno = new AlunoRepository;
	$aluno->setFetchType(PDO::FETCH_ASSOC);
	$alunoList = $alunoRepo->getCollection(
		[
			'alunos.alu_id',
			'usuarios.usu_ra',
			'usuarios.usu_nome'
		]
	);
	echo json_encode($alunoList);	
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

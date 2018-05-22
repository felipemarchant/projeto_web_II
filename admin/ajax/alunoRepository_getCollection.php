<?php

require '../templates/inc.php';
if(true){
	$aluno = new AlunoRepository;
	$aluno->setFetchType(PDO::FETCH_ASSOC);
	$alunoList = $aluno->getCollection();
	echo json_encode($alunoList);	
}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}

<?php

require '../templates/inc.php';
$headers = getallheaders();
if ($headers["Content-type"] == "application/json"){
	$_POST = json_decode(file_get_contents("php://input"), true) ?: [];
}
header('Content-Type: application/json');
if(true){
	if(!in_array('', $_POST)){
		$con = DB::getConexao();

		$sql = "INSERT INTO frequencias(alu_id, mat_id, fre_presenca, fre_data) VALUES (:alu_id,:mat_id,:fre_presenca,:fre_data)";
		$sth = $con->prepare($sql);
		$sth->bindParam(':alu_id', $_POST['id'], PDO::PARAM_INT);
		$sth->bindParam(':mat_id', $_POST['matId'], PDO::PARAM_INT);
		$sth->bindParam(':fre_presenca', $_POST['presenca'], PDO::PARAM_INT);
		$sth->bindParam(':fre_data', $_POST['dateHJ'], PDO::PARAM_STR);
		$sth->execute(); 		

		echo json_encode(array("s"=>true));
	}

}else{
	echo json_encode(array(
		"erro" => "acesso não permitido"
	));
}
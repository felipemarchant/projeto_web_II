<?php

class MateriaRepository extends DAO
{
	private $fetch_type = PDO::FETCH_OBJ;
	public function __construct()
	{
		parent::__construct();
	}
	public function getTotal()
	{
		$cCount = 0;
		$sql = "SELECT COUNT(*) FROM materias;";
		$cCount = $this->conn->query($sql)->fetchColumn();
		return $cCount;
	}
	public function addBingMaterias($id,$mats)
	{
		$id = (int)$id;
		$sql = '';
		foreach ($mats as $mat) {
			$sql = '';
			$sql = "INSERT INTO alunos_materias(alu_id, mat_id) VALUES (:id,:mat)";
			$sth = $this->conn->prepare($sql);
			$sth->bindParam(':id', $id, PDO::PARAM_INT);
			$sth->bindParam(':mat', $mat, PDO::PARAM_INT);
			$sth->execute();

		}
	}
	public function setProfessor($idProf, $idMat){
		$idProf = (int) $idProf;
		$idMat= (int) $idMat;
		$sql = "UPDATE materias SET pro_id = :pro_id WHERE mat_id = :mat_id";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':pro_id', $idProf, PDO::PARAM_INT);
		$sth->bindParam(':mat_id', $idMat, PDO::PARAM_INT);
		$sth->execute(); 
	}
	public function getCollection($fields = array(), $noProf = false)
	{
		if(empty($fields)){
			$fields = '*';
		}else{
			$fields = implode(", ", $fields);
		}
		$result = null;

		$sql =  "SELECT DISTINCT $fields FROM materias";
		if($noProf === 2){
			$sql .=" WHERE pro_id IS NOT NULL ORDER BY mat_nome;";	
		}else if($noProf){
			$sql .=" WHERE pro_id IS NULL ORDER BY mat_nome;";
		}
		$sth = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll($this->fetch_type);
		return $result;
	}
	public function setFetchType($type){
		$ar = array(PDO::FETCH_OBJ, PDO::FETCH_ASSOC);
		if(in_array($type, $ar)){
			$this->fetch_type = $type;
		}
	}

}

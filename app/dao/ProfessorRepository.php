<?php

class ProfessorRepository extends DAO
{
	private $fetch_type = PDO::FETCH_OBJ;
	public function __construct()
	{
		parent::__construct();
	}
	public function getTotal()
	{
		$cCount = 0;

		$sql    = "SELECT COUNT(*) FROM professores WHERE pro_ativo = 1;";
		$cCount = $this->conn->query($sql)->fetchColumn();

		return $cCount;
	}
	public function add($professor)
	{
		$ativo = 1;
		$sql = "INSERT INTO professores(pro_nome, pro_sobrenome, pro_ativo) VALUES (:nome,:sobrenome,:ativo)";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':nome', $professor['nome'], PDO::PARAM_STR);
		$sth->bindParam(':sobrenome', $professor['sobrenome'], PDO::PARAM_STR);
		$sth->bindParam(':ativo', $ativo, PDO::PARAM_INT);
		$sth->execute();
		return $this->conn->lastInsertId();

	}
	public function addUser($profId, $usuario)
	{
		$nivel = 2;
		$profId = (int)$profId;
		$senha = sha1($usuario['senha']);
		$sql = "INSERT INTO usuarios(usu_usu_id, usu_ra, usu_email, usu_senha, usu_nivel) VALUES (:usu_id,:usu_ra,:usu_email,:usu_senha,:usu_nivel)";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':usu_id', $profId, PDO::PARAM_INT);
		$sth->bindParam(':usu_ra', $usuario['ra'], PDO::PARAM_INT);
		$sth->bindParam(':usu_email', $usuario['email'], PDO::PARAM_STR);
		$sth->bindParam(':usu_senha', $senha, PDO::PARAM_STR);
		$sth->bindParam(':usu_nivel', $nivel, PDO::PARAM_INT);
		$sth->execute();

	}
	public function getFrequenciaCollection($idAluno, $idProfessor)
	{

		$result = null;

		$sql  = "SELECT * FROM professores ";
		$sql .= "INNER JOIN materias ON materias.pro_id = professores.pro_id ";
		$sql .= "INNER JOIN frequencias ON frequencias.mat_id = materias.mat_id ";
		$sql .= "WHERE professores.pro_id = '$idProfessor' AND frequencias.alu_id = '$idAluno' ";
		$sth  = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll($this->fetch_type);

		return $result;	
	}
	public function findOnly($id)
	{
		$result = null;

		$sql  =  "SELECT * FROM professores WHERE pro_id = '$id' AND pro_ativo = 1";
		$sth  = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetch($this->fetch_type);

		return $result;	
	}
	public function deleteOrActive($id, $action){
		$action = (int) $action;
		$id = (int) $id;
		$sql = "UPDATE professores SET pro_ativo = :action WHERE pro_id = :id";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':action', $action, PDO::PARAM_INT);
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute(); 
	}
	public function getCollection($fields = array(), $criteria = null)
	{

		if(empty($fields)){
			$fields = '*';
		}else{
			$fields = implode(", ", $fields);
		}


		$result = null;

		$nivelUsu = Usuario::Professor;
		$sql  = "SELECT * FROM usuarios ";
		$sql .= "INNER JOIN professores ON usuarios.usu_usu_id = professores.pro_id ";
		$sql .= "INNER JOIN materias ON materias.pro_id = professores.pro_id ";
		$sql .= "WHERE usuarios.usu_nivel = $nivelUsu ";
		if($criteria){
			$sql .= $criteria; 
		}
		$sql .= " ;";
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

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
	public function findOnly($id)
	{
		$result = null;

		$sql  =  "SELECT * FROM professores WHERE pro_id = '$id' AND pro_ativo = 1";
		$sth  = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetch($this->fetch_type);

		return $result;	
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

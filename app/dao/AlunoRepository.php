<?php 

class AlunoRepository extends DAO
{
	private $fetch_type = PDO::FETCH_OBJ;
	public function __construct()
	{
		parent::__construct();
	}
	public function getTotal()
	{
		$cCount = 0;
		$sql    = "SELECT COUNT(*) FROM alunos WHERE alu_ativo = 1;";
		$cCount = $this->conn->query($sql)->fetchColumn();
		return $cCount;
	}
	public function deleteOrActive($id, $action){
		$action = (int) $action;
		$id = (int) $id;
		echo "$id $action";
		$sql = "UPDATE alunos SET alu_ativo = :action WHERE alu_id = :id";
		echo $sql;
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':action', $action, PDO::PARAM_INT);
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute(); 
	}
	public function getCollection($fields = array(), $criteria = null, $desativados = false)
	{
		if(empty($fields)){
			$fields = '*';
		}else{
			$fields = implode(", ", $fields);
		}

		$result = null;

		$nivelUsu = Usuario::Aluno;
		$sql  = "SELECT * FROM usuarios ";
		$sql .= "INNER JOIN alunos ON usuarios.usu_usu_id = alunos.alu_id ";
		$sql .= "WHERE usuarios.usu_nivel = $nivelUsu ";
		if($desativados){
			$sql .= "AND alunos.alu_ativo = 1 ";
		}
		if($criteria){
			$sql .= $criteria; 
		}
		$sql .= " ;";
		$sth = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll($this->fetch_type);

		return $result;
	}


	public function findOnly($id)
	{
		$result = null;

		$sql  =  "SELECT * FROM alunos WHERE alu_id = '$id' AND alu_ativo = 1";
		$sth  = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetch($this->fetch_type);

		return $result;	
	}

	public function getPresencas($id,$matId = 0)
	{
		$cCount     = 0;
		$materiaSQL = ";";
		if($matId){
			$materiaSQL = " AND frequencias.mat_id = $matId;";
		}	
		$sql  = "SELECT COUNT(*) FROM frequencias ";
		$sql .= "INNER JOIN alunos ON alunos.alu_id = frequencias.alu_id ";
		$sql .= "WHERE fre_presenca = 1 AND alunos.alu_id = $id";
		$sql .= $materiaSQL;

		$cCount = $this->conn->query($sql)->fetchColumn();

		return $cCount;
	}

	public function getFaltas($id,$matId = 0)
	{
		$cCount = 0;
		$materiaSQL = ";";
		if($matId){
			$materiaSQL = " AND frequencias.mat_id = $matId;";
		}
		$sql  = "SELECT COUNT(*) FROM frequencias ";
		$sql .= "INNER JOIN alunos ON alunos.alu_id = frequencias.alu_id ";
		$sql .= "WHERE fre_presenca = 0 AND alunos.alu_id = $id";
		$sql .= $materiaSQL;
		$cCount = $this->conn->query($sql)->fetchColumn();

		return $cCount;
	}
	public function getMateriasCollection($id, $fields)
	{
		if(empty($fields)){
			$fields = '*';
		}else{
			$fields = implode(", ", $fields);
		}

		$result = null;

		$sql  = "SELECT $fields FROM alunos ";
		$sql .= "INNER JOIN alunos_materias ON alunos_materias.alu_id = alunos.alu_id ";
		$sql .= "INNER JOIN materias ON materias.mat_id = alunos_materias.mat_id ";
		$sql .= "LEFT JOIN notas ON notas.alu_id = alunos_materias.alu_id AND notas.mat_id = alunos_materias.mat_id ";
		$sql .= "WHERE alunos.alu_id = $id AND alunos.alu_ativo = 1 ORDER BY materias.mat_nome;";
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
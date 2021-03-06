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
	public function editAluno($id, $dados)
	{
		$sql  = "UPDATE alunos SET ";
		$sql .= "alu_nome = :nome, ";
		$sql .= "alu_sobrenome = :sobrenome ";
		$sql .= "WHERE alu_id = :id ;";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
		$sth->bindParam(':sobrenome', $dados['sobrenome'], PDO::PARAM_STR);
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute(); 
	}
	public function editUser($id, $dados)
	{
		$senha = sha1($dados['senha']);
		$sql  = "UPDATE usuarios SET ";
		$sql .= "usu_ra = :ra, ";
		$sql .= "usu_email = :email, ";
		$sql .= "usu_senha = :senha ";
		$sql .= "WHERE usu_usu_id = :id AND usu_nivel = 2 ;";

		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':ra', $dados['ra'], PDO::PARAM_STR);
		$sth->bindParam(':email', $dados['email'], PDO::PARAM_STR);
		$sth->bindParam(':senha', $senha, PDO::PARAM_STR);
		$sth->bindParam(':id', $id, PDO::PARAM_INT);
		$sth->execute(); 
	}
	public function add($aluno)
	{
		$ativo = 1;
		$sql = "INSERT INTO alunos (alu_nome, alu_sobrenome, alu_ativo) VALUES (:nome,:sobrenome,:ativo)";
		$sth = $this->conn->prepare($sql);
		$sth->bindParam(':nome', $aluno['nome'], PDO::PARAM_STR);
		$sth->bindParam(':sobrenome', $aluno['sobrenome'], PDO::PARAM_STR);
		$sth->bindParam(':ativo', $ativo, PDO::PARAM_INT);
		$sth->execute();
		return $this->conn->lastInsertId();

	}
	public function addUser($profId, $usuario)
	{
		$nivel = 3;
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
	public function getCollectionByMateria($matId){
		$result = null;

		$sql  = "SELECT * FROM alunos ";
		$sql .= "INNER JOIN alunos_materias ON alunos.alu_id =  alunos_materias.alu_id ";
		$sql .= "INNER JOIN materias ON alunos_materias.mat_id = materias.mat_id ";
		$sql .= "WHERE alunos_materias.mat_id = $matId";

		$sql .= " ;";
		$sth = $this->conn->prepare($sql);
		$sth->execute();
		$result = $sth->fetchAll($this->fetch_type);

		return $result;

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

		$sql  =  "SELECT * FROM alunos ";
		$sql .=  "INNER JOIN usuarios ON usuarios.usu_usu_id = alunos.alu_id ";
		$sql .=  "WHERE alu_id = '$id' AND alu_ativo = 1 AND usu_nivel = 3";
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
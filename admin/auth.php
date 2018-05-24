<?php
require '../app/core/DB.php';
session_start();
if(!in_array('',$_POST)){
	$con = DB::getConexao();
	$em = trim($_POST['email']);
	$se = trim($_POST['password']);
	$se = sha1($se);

	$cCount = 0;
	$sql = "SELECT COUNT(*) FROM usuarios WHERE usu_email = '$em' AND usu_senha = '$se';";
	$cCount = $con->query($sql)->fetchColumn();
	if($cCount > 0 ){
		$con = DB::getConexao();
		$sql = "SELECT * FROM usuarios WHERE usu_email = '$em' AND usu_senha = '$se';";
		$sth = $con->prepare($sql);
		$sth->execute();
		$dadosUsu = $sth->fetch(PDO::FETCH_OBJ);
		$dados = null;

		$id = (int)$dadosUsu->usu_usu_id;
		$nivel = (int)$dadosUsu->usu_nivel;

		if( $nivel === 1){
			$sql = "SELECT * FROM admin WHERE adm_id = $id AND adm_ativo = 1";
			$sth = $con->prepare($sql);
			$sth->execute();
			$dados = $sth->fetch(PDO::FETCH_OBJ);
			$ss = !isset($dados->adm_nome);
			$header = 'Location: index.php';
		}else if($nivel === 2){
			$sql = "SELECT * FROM professores WHERE pro_id = $id AND pro_ativo = 1";
			$sth = $con->prepare($sql);
			$sth->execute();
			$dados = $sth->fetch(PDO::FETCH_OBJ);
			$ss = !isset($dados->pro_nome);
			$header = 'Location: professor/index.php';
		}else if($nivel === 3){
			$sql = "SELECT * FROM alunos WHERE alu_id = $id AND alu_ativo = 1";
			$sth = $con->prepare($sql);
			$sth->execute();
			$dados = $sth->fetch(PDO::FETCH_OBJ);
			$ss = !isset($dados->alu_nome);
			$header = 'Location: aluno/index.php';
		}
		if($ss){
			header('Location: login.php');
			die;	
		}
		$_SESSION['dadosUsu'] = $dadosUsu;
		$_SESSION['dados'] = $dados;

		header($header);
	}else{
		header('Location: login.php');
	}
}else{
	header('Location: login.php');
}

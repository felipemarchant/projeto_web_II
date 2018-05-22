<?php

class Aluno
{

	private $alunoRepo = null;

	private $id;
	private $ra;
	private $nome;
	private $sobrenome;
	private $email;
	private $senha;
	private $ativo;
	private $criado_em;
	private $alterado_em;

	public function __construct()
	{
		$this->alunoRepo = new AlunoRepository;
	}

	public function load($id)
	{
		$obj = $this->alunoRepo->findOnly($id);
		$this->id 			 = $obj->usu_id;
		$this->ra 			 = $obj->usu_ra;
		$this->nome 		 = $obj->usu_nome;
		$this->sobrenome 	 = $obj->usu_sobrenome;
		$this->email 		 = $obj->usu_email;
		$this->senha 		 = $obj->usu_senha;
		$this->ativo 		 = $obj->usu_ativo;
		$this->criado_em     = $obj->usu_criado_em;
		$this->alterado_em = $obj->usu_alterado_em;
	}

	public function getPresencas()
	{
		$result = 0;
		if($this->id){
			$result = (int)$this->alunoRepo->getPresenca($this->id);
		}
	}

	public function getFaltas()
	{
		$result = 0;
		if($this->id){
			$result = (int)$this->alunoRepo->getFalta($this->id);
		}
	}
}
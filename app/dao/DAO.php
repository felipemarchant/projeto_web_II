<?php

class DAO 
{
	protected $conn;

	public function __construct()
	{
		$this->conn = DB::getConexao();
	}
}

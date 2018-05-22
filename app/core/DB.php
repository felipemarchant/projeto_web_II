<?php

class DB 
{
  private static $dbName  = "ung_portal";
  private static $usuario = "root";
  private static $senha   = "";  
  private static $conexao = null;

  public static function getConexao()
  {
    if(self::$conexao == null){
      try{
        self::$conexao = new PDO("mysql:host=localhost;dbname=".self::$dbName, self::$usuario, self::$senha);
      }catch(PDOException $erro){
        die("ERRO ao acessar o Banco de Dados : " . $erro->getMessage());
      }
    }
    self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return self::$conexao;
  }
}

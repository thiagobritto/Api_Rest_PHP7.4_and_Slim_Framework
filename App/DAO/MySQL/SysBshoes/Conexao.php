<?php

namespace App\DAO\MySql\SysBshoes;

abstract class Conexao
{
  /**
   * @var \PDO
   */
  protected $pdo;

  public function __construct()
  {
    $host = getenv("SYS_BSHOES_MYSQL_HOST");
    $port = getenv("SYS_BSHOES_MYSQL_PORT");
    $user = getenv("SYS_BSHOES_MYSQL_USER");
    $pass = getenv("SYS_BSHOES_MYSQL_PASS");
    $dbName = getenv("SYS_BSHOES_MYSQL_DBNAME");

    $dsn = "mysql: host={$host}; dbname={$dbName}; port={$port}";    
    
    $this->pdo = new \PDO($dsn, $user, $pass);
    $this->pdo->setAttribute(
      \PDO::ATTR_ERRMODE,
      \PDO::ERRMODE_EXCEPTION
    );
  }
}
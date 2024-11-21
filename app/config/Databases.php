<?php
namespace App\Config;

use PDO;
use PDOException;

class Databases
{
    private $host = 'localhost'; 
    private $port = '5432';
    private $dbName = 'sistema-viagem'; 
    private $username = 'postgres'; 
    private $password = '123';
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Erro de conexão: " . $e->getMessage());
            echo "Erro ao conectar-se ao banco de dados. Tente novamente mais tarde.";
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
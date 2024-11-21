<?php

namespace App\Config;

use PDO;
use PDOException;

class Databases
{
    private string $host = 'localhost'; 
    private string $port = '5432';
    private string $dbName = 'sistema-viagem'; 
    private string $username = 'postgres'; 
    private string $password = '123';
    private ?PDO $connection = null;

    public function __construct()
    {
        $this->connect();
    }

    /**
     * Método responsável por estabelecer a conexão com o banco de dados.
     */
    private function connect(): void
    {
        try {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbName}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->handleConnectionError($e);
        }
    }

    /**
     * Método para tratar erros de conexão.
     */
    private function handleConnectionError(PDOException $e): void
    {
        error_log("Erro de conexão: " . $e->getMessage());
        die("Erro ao conectar-se ao banco de dados. Por favor, tente novamente mais tarde.");
    }

    /**
     * Retorna a conexão ativa com o banco de dados.
     *
     * @return PDO|null
     */
    public function getConnection(): ?PDO
    {
        if (!$this->connection) {
            $this->connect();
        }
        return $this->connection;
    }
}

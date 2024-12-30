<?php
require_once __DIR__ . '/config.php';
require_once ROOT . '/Core/functionModel.php';
class ModelConfig 
{
    protected $db;

    public function getDatabaseConnection()
    {
        try {
            //$this->db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PWD);
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
            $pdo = new PDO($dsn, DB_USER, DB_PWD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) 
        {
            die('Erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public function selectRecord($table, $columns = ['*'], $conditions = [], $orderby = [])
    {
        try {
            $db = $this->getDatabaseConnection();
            $a = new CoreFunctionModel();
            $sql = "SELECT " . $a->traitColumn($columns) . " FROM $table";
    
            if (!empty($conditions)) 
            {
                $sql .= ' WHERE ' . implode(' AND ', array_map(fn($key) => "$key = :$key", array_keys($conditions)));
            }

            if (!empty($orderby)) 
            {
                $sql .= " ORDER BY $orderby";
            }
    
            $stmt = $db->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll();
        } catch (Exception $e) 
        {
            die('Erro ao buscar registros: ' . $e->getMessage());
        }
    }

    public function updateRecord($table, $data, $conditions)
    {
        try {
            $db = $this->getDatabaseConnection();
            $setClause = implode(', ', array_map(fn($key) => "$key = :$key", array_keys($data)));
            $whereClause = implode(' AND ', array_map(fn($key) => "$key = :where_$key", array_keys($conditions)));
    
            $sql = "UPDATE $table SET $setClause WHERE $whereClause";
            $stmt = $db->prepare($sql);
    
            // Vincular os valores para SET
            foreach ($data as $key => $value) 
            {
                $stmt->bindValue($key, $value);
            }
    
            // Vincular os valores para WHERE
            foreach ($conditions as $key => $value) 
            {
                $stmt->bindValue("where_$key", $value);
            }
    
            return $stmt->execute();
        } catch (Exception $e) 
        {
            $db = null;
            die('Erro ao atualizar registro: ' . $e->getMessage());
        }
    }

    function insertRecord($table, $data) 
    {
        try {
            $db = $this->getDatabaseConnection();
            $columns = implode(', ', array_keys($data));
            $placeholders = implode(', ', array_map(fn($key) => ":$key", array_keys($data)));
    
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $db->prepare($sql);
    
            // Vincular os valores para INSERT
            foreach ($data as $key => $value)
            {
                $stmt->bindValue($key, $value);
            }
    
            return $stmt->execute();
        } catch (Exception $e) 
        {
            $db = null;
            die('Erro ao inserir registro: ' . $e->getMessage());
        }
    }

    public function stringSql($query)
    {
        try {
            $db = $this->getDatabaseConnection();
            $stmt = $db->prepare($query);
            return $stmt->execute();
        } catch (Exception $e) 
        {
            $db = null;
            die('Erro ao atualizar registro: ' . $e->getMessage());
        }
    }
}


// Exemplo de uso das funções
// $registros = fetchAll('tabela_exemplo', ['status' => 'ativo']);
// var_dump($registros);

// $atualizado = updateRecord('tabela_exemplo', ['nome' => 'Novo Nome'], ['id' => 1]);
// echo $atualizado ? 'Registro atualizado com sucesso!' : 'Erro ao atualizar.';

// $inserido = insertRecord('tabela_exemplo', ['nome' => 'Exemplo', 'status' => 'ativo']);
// echo $inserido ? 'Registro inserido com sucesso!' : 'Erro ao inserir.';
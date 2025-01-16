<?php

namespace App\Models;

class Database {
    protected ?string $table = null;

    protected static function getConnection() {
        $host = $_ENV['MARIADB_HOST'] ?? 'localhost';
        $user = $_ENV['MARIADB_USER'] ?? 'root';
        $pass = $_ENV['MARIADB_PASS'] ?? '';
        $database = $_ENV['MARIADB_DATABASE'] ?? 'template';

        $connection = new \PDO("mysql:dbname=$database;host=$host", $user, $pass, [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
        ]);

        return $connection;
    }

    protected function insert(array $data) {
        try {
            $connection = self::getConnection();

            $connection->beginTransaction();

            $fields = self::getFields($data);
            $values = self::getValues($data);
            $sql = "INSERT INTO `" . $this->table . "` ({$fields}) VALUES ({$values})";
            
            $query = $connection->prepare($sql);
            $query->execute();

            $lastInsertId = (int) $connection->lastInsertId(); 
            $connection->commit();
            return $lastInsertId; 
        } catch (\PDOException $exception) {
            $connection->rollBack();
            return false;
        }
    }

    protected function update(array $data, string $conditions) {
        try {
            $connection = self::getConnection();

            $connection->beginTransaction();

            $values = self::prepareUpdate($data);
            if (empty($conditions)) {
                throw new \Exception("Conditions for update are required.");
            }
            
            $sql = "UPDATE `" . $this->table . "` SET {$values} WHERE $conditions";
            $query = $connection->prepare($sql);
            $query->execute();

            $connection->commit();
            return (int) $query->rowCount(); 
        } catch (\PDOException $exception) {
            $connection->rollBack();
            throw new \Exception("{$exception->getMessage()}");
        }
    }

    protected function delete(int $id) {
        try {
            $connection = self::getConnection();

            $connection->beginTransaction();

            $sql = "DELETE FROM `" . $this->table . "` WHERE id = $id";
            
            $query = $connection->prepare($sql);
            $query->execute();

            $connection->commit();
            return (int) $query->rowCount(); 
        } catch (\PDOException $exception) {
            $connection->rollBack();
            return false;
        }
    }

    public function fetch(string $fields = '*', string $conditions = null) {
        try {
            $connection = self::getConnection();
            $sql = "SELECT {$fields} FROM `" . $this->table . "`";

            if($conditions) {
                $sql .= " WHERE {$conditions}";
            }

            $query = $connection->query($sql);
            return $query->fetchAll();
        } catch (\PDOException $exception) {
            throw new \Exception("{$exception->getMessage()}");
        }
    }

    public function fetchById(int $id, string $fields = "*") {
        try {
            $connection = self::getConnection();
            $sql = "SELECT {$fields} FROM `" . $this->table . "` WHERE `id` = {$id}";

            $query = $connection->query($sql);
            return $query->fetch();
        } catch (\PDOException $exception) {
            throw new \Exception("{$exception->getMessage()}");
        }
    }

    private function getFields(array $data): string {
        return "`" . implode("`, `", array_keys($data)) . "`";
    }

    private function getValues(array $data): string {
        return "'" . implode("', '", array_values($data)) . "'";
    }

    private function prepareUpdate(array $data): string {
        $preparedString = '';
        foreach($data as $field => $value) {
            $preparedString .= "`{$field}`='{$value}', ";
        }
       $preparedString = substr($preparedString, 0, -2);

        return $preparedString;
    }
}
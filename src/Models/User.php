<?php

namespace App\Models;

class User extends Database {
    protected ?string $table = 'user';

    public function store(array $data) {
        return $this->insert($data);
    }

    public function destroy(int $id) {
        return $this->delete($id);
    }

    public function renovate(int $id, array $data) {
        return $this->update($data, "id = $id");
    }

    public function permissions(int $idUser, string $module) {
        try {
            $stmt = self::getConnection()->prepare("SELECT can_create, can_read, can_update, can_delete FROM permission WHERE id_user = :id AND module = :module");
            $stmt->execute([
                'id' => $idUser,
                'module' => $module
            ]);

            return (array) $stmt->fetch();
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function fetchByToken(string $token) {
        try {
            $stmt = self::getConnection()->prepare("SELECT * FROM `" . $this->table . "` WHERE token = '{$token}'");
            $stmt->execute();

            return $stmt->fetch();
        } catch (\PDOException $e) {
            return false;
        }
    }
    
    public function fetchUser(string $conditions) {
        try {
            $stmt = self::getConnection()->prepare("SELECT * FROM `" . $this->table . "` WHERE {$conditions}");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            return false;
        }
    }
}
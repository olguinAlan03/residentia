<?php
namespace App\Models;

class Administrador {
    private \mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByCredentials(string $correo, string $password): ?array {
        $stmt = $this->db->prepare(
            "SELECT id_administrador, nombre, apellido_paterno, correo
             FROM administrador
             WHERE correo = ? AND passwor = ?
             LIMIT 1"
        );
        $stmt->bind_param('ss', $correo, $password);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function all(): array {
        $result = $this->db->query(
            "SELECT id_administrador, nombre, apellido_paterno, apellido_materno, telefono, correo
             FROM administrador"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

<?php
namespace App\Models;

class Administrador {
    private \mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByCorreo(string $correo): ?array {
        $stmt = $this->db->prepare(
            "SELECT id_administrador, nombre, apellido_paterno, correo, passwor
             FROM administrador
             WHERE correo = ?
             LIMIT 1"
        );
        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function updatePassword(int $id, string $hash): bool {
        $stmt = $this->db->prepare("UPDATE administrador SET passwor = ? WHERE id_administrador = ?");
        $stmt->bind_param('si', $hash, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function create(int $idRol, string $nombre, string $apPat, ?string $apMat, ?string $tel, string $correo, string $password): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO administrador (id_rol, nombre, apellido_paterno, apellido_materno, telefono, correo, passwor)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('issssss', $idRol, $nombre, $apPat, $apMat, $tel, $correo, $hash);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function all(): array {
        $result = $this->db->query(
            "SELECT id_administrador, nombre, apellido_paterno, apellido_materno, telefono, correo
             FROM administrador"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

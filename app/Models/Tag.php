<?php
namespace App\Models;

class Tag {
    private \mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function findByVehiculo(int $idVehiculo): array {
        $stmt = $this->db->prepare(
            "SELECT id_tag, codigo_tag, f_registro, f_vencimiento FROM tag WHERE id_vehiculo = ?"
        );
        $stmt->bind_param('i', $idVehiculo);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }

    public function create(string $codigoTag, int $idVehiculo, string $fRegistro, string $fVencimiento): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO tag (codigo_tag, id_vehiculo, f_registro, f_vencimiento) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('siss', $codigoTag, $idVehiculo, $fRegistro, $fVencimiento);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

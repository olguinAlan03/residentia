<?php
namespace App\Models;

class Vehiculo {
    private \mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all(): array {
        $result = $this->db->query(
            "SELECT v.id_vehiculo, v.marca, v.modelo, v.color, v.num_matricula,
                    CONCAT(r.nombre, ' ', r.apellido_paterno) as residente_nombre,
                    u.numero as numero_unidad
             FROM vehiculo v
             LEFT JOIN residente r ON v.id_residente = r.id_residente
             LEFT JOIN unidad u ON r.id_unidad = u.id_unidad
             ORDER BY r.apellido_paterno, v.marca"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create(string $marca, string $modelo, string $color, string $matricula, ?int $idResidente = null): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO vehiculo (id_residente, marca, modelo, color, num_matricula) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('issss', $idResidente, $marca, $modelo, $color, $matricula);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM vehiculo WHERE id_vehiculo = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

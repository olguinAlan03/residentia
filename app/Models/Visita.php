<?php
namespace App\Models;

class Visita {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT v.id_visita as id, v.nombre_visitante, v.motivo,
                    v.hora_entrada, v.hora_salida,
                    u.numero as numero_unidad
             FROM visita v
             JOIN unidad u ON v.id_unidad = u.id_unidad
             ORDER BY v.hora_entrada DESC
             LIMIT 100"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hoy(): int {
        return (int)$this->db->query(
            "SELECT COUNT(*) FROM visita WHERE DATE(hora_entrada) = CURDATE()"
        )->fetch_row()[0];
    }

    public function create(string $nombre, int $idUnidad, string $motivo): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO visita (nombre_visitante, id_unidad, motivo) VALUES (?, ?, ?)"
        );
        $stmt->bind_param('sis', $nombre, $idUnidad, $motivo);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function registrarSalida(int $id): bool {
        $stmt = $this->db->prepare(
            "UPDATE visita SET hora_salida = NOW() WHERE id_visita = ? AND hora_salida IS NULL"
        );
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

<?php
namespace App\Models;

class Reserva {
    private \mysqli $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all(): array {
        $result = $this->db->query(
            "SELECT r.id_reserva as id,
                    r.area_comun as nombre_area,
                    r.fecha_reserva as fecha,
                    r.horario,
                    r.id_comprobante_pago,
                    r.fecha_registro,
                    CONCAT(res.nombre, ' ', res.apellido_paterno) as residente_nombre,
                    u.numero as numero_unidad
             FROM reserva r
             LEFT JOIN residente res ON r.id_residente = res.id_residente
             LEFT JOIN unidad u ON res.id_unidad = u.id_unidad
             ORDER BY r.fecha_reserva DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function byResidente(int $idResidente): array {
        $stmt = $this->db->prepare(
            "SELECT id_reserva as id, area_comun as nombre_area,
                    fecha_reserva as fecha, horario, fecha_registro
             FROM reserva
             WHERE id_residente = ?
             ORDER BY fecha_reserva DESC"
        );
        $stmt->bind_param('i', $idResidente);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }

    public function areas(): array {
        $result = $this->db->query(
            "SELECT id_area, nombre, capacidad FROM area_comun ORDER BY nombre"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create(string $area, string $fecha, string $horario, string $comprobante = '', ?int $idResidente = null): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO reserva (area_comun, fecha_reserva, horario, id_comprobante_pago, id_residente)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssssi', $area, $fecha, $horario, $comprobante, $idResidente);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

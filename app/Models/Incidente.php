<?php
namespace App\Models;

class Incidente {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT i.id_incidente as id, i.titulo, i.descripcion, i.estado, i.prioridad,
                    i.fecha_reporte, i.fecha_cierre,
                    u.numero as numero_unidad,
                    CONCAT(r.nombre, ' ', r.apellido_paterno) as residente_nombre
             FROM incidente i
             LEFT JOIN unidad u ON i.id_unidad = u.id_unidad
             LEFT JOIN residente r ON r.id_unidad = i.id_unidad
             ORDER BY FIELD(i.prioridad,'alta','media','baja'), i.fecha_reporte DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function byUnidad(int $idUnidad): array {
        if (!$idUnidad) return $this->all();
        $stmt = $this->db->prepare(
            "SELECT i.id_incidente as id, i.titulo, i.descripcion, i.estado, i.prioridad,
                    i.fecha_reporte
             FROM incidente i
             WHERE i.id_unidad = ?
             ORDER BY i.fecha_reporte DESC"
        );
        $stmt->bind_param('i', $idUnidad);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $rows;
    }

    public function abiertos(): int {
        return (int)$this->db->query(
            "SELECT COUNT(*) FROM incidente WHERE estado NOT IN ('cerrado','resuelto')"
        )->fetch_row()[0];
    }

    public function create(int $idUnidad, string $titulo, string $desc, string $prioridad): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO incidente (id_unidad, titulo, descripcion, prioridad) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('isss', $idUnidad, $titulo, $desc, $prioridad);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function updateEstado(int $id, string $estado): bool {
        $allowed = ['abierto', 'en_proceso', 'resuelto', 'cerrado'];
        if (!in_array($estado, $allowed)) return false;
        $cierre = in_array($estado, ['cerrado', 'resuelto']) ? ', fecha_cierre = NOW()' : '';
        $stmt = $this->db->prepare(
            "UPDATE incidente SET estado = ? {$cierre} WHERE id_incidente = ?"
        );
        $stmt->bind_param('si', $estado, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

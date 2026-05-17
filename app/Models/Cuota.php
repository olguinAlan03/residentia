<?php
namespace App\Models;

class Cuota {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT c.id_cuota as id, c.concepto, c.monto, c.fecha_vencimiento,
                    c.estado, c.fecha_pago,
                    u.numero as numero_unidad
             FROM cuota c
             JOIN unidad u ON c.id_unidad = u.id_unidad
             ORDER BY c.fecha_vencimiento DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pendientes(): int {
        return (int)$this->db->query(
            "SELECT COUNT(*) FROM cuota WHERE estado IN ('pendiente','vencida')"
        )->fetch_row()[0];
    }

    public function create(int $idUnidad, string $concepto, float $monto, string $fechaVenc): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO cuota (id_unidad, concepto, monto, fecha_vencimiento) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('isds', $idUnidad, $concepto, $monto, $fechaVenc);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function marcarPagada(int $id): bool {
        $stmt = $this->db->prepare(
            "UPDATE cuota SET estado = 'pagada', fecha_pago = CURDATE() WHERE id_cuota = ?"
        );
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM cuota WHERE id_cuota = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

<?php
namespace App\Models;

class Unidad {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT u.id_unidad as id,
                    u.numero, u.torre, u.piso, u.tipo, u.estado,
                    CONCAT(r.nombre, ' ', r.apellido_paterno) as residente_nombre
             FROM unidad u
             LEFT JOIN residente r ON r.id_unidad = u.id_unidad
             ORDER BY u.torre, u.piso, u.numero"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function allSimple(): array {
        $result = $this->db->query(
            "SELECT id_unidad as id, numero, torre FROM unidad ORDER BY torre, numero"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create(string $numero, string $torre, int $piso, string $tipo): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO unidad (numero, torre, piso, tipo) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param('ssis', $numero, $torre, $piso, $tipo);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM unidad WHERE id_unidad = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function count(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM unidad")->fetch_row()[0];
    }
}

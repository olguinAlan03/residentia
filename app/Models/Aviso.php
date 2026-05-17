<?php
namespace App\Models;

class Aviso {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT a.*, CONCAT(adm.nombre,' ',adm.apellido_paterno) as autor
             FROM aviso a
             LEFT JOIN administrador adm ON a.id_administrador = adm.id_administrador
             ORDER BY a.fecha_publicacion DESC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function activos(): array {
        $result = $this->db->query(
            "SELECT titulo, contenido, fecha_publicacion FROM aviso WHERE activo = 1 ORDER BY fecha_publicacion DESC LIMIT 10"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create(string $titulo, string $contenido, int $idAdmin): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO aviso (titulo, contenido, id_administrador) VALUES (?, ?, ?)"
        );
        $stmt->bind_param('ssi', $titulo, $contenido, $idAdmin);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function toggle(int $id): bool {
        $stmt = $this->db->prepare("UPDATE aviso SET activo = NOT activo WHERE id_aviso = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM aviso WHERE id_aviso = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

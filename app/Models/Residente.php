<?php
namespace App\Models;

class Residente {
    private \mysqli $db;

    public function __construct() { $this->db = Database::connect(); }

    public function all(): array {
        $result = $this->db->query(
            "SELECT r.id_residente as id,
                    r.id_unidad,
                    r.nombre,
                    r.apellido_paterno  as apP_Residente,
                    r.apellido_materno  as apM_Residente,
                    r.telefono,
                    r.correo,
                    CONCAT(u.numero, IF(u.torre IS NOT NULL, CONCAT(' - ', u.torre), '')) as numero_unidad
             FROM residente r
             LEFT JOIN unidad u ON r.id_unidad = u.id_unidad
             ORDER BY r.apellido_paterno"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function count(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM residente")->fetch_row()[0];
    }

    public function findByCredentials(string $idResidente, string $password): ?array {
        $stmt = $this->db->prepare(
            "SELECT r.id_residente, r.nombre, r.apellido_paterno, r.apellido_materno,
                    r.telefono, r.correo, r.id_unidad
             FROM usuarios_pag u_pag
             JOIN residente r ON u_pag.id_residente = r.id_residente
             WHERE u_pag.id_residente = ? AND u_pag.passwor = ?
             LIMIT 1"
        );
        $stmt->bind_param('ss', $idResidente, $password);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(int $idUnidad, string $nombre, string $apPat, string $apMat, string $tel, string $correo, string $pass): bool {
        $this->db->begin_transaction();
        try {
            $s1 = $this->db->prepare(
                "INSERT INTO residente (id_unidad, nombre, apellido_paterno, apellido_materno, telefono, correo) VALUES (?,?,?,?,?,?)"
            );
            $s1->bind_param('isssss', $idUnidad, $nombre, $apPat, $apMat, $tel, $correo);
            $s1->execute();
            $idResidente = $this->db->insert_id;
            $s1->close();

            $s2 = $this->db->prepare("INSERT INTO usuarios_pag (id_residente, passwor) VALUES (?,?)");
            $s2->bind_param('is', $idResidente, $pass);
            $s2->execute();
            $s2->close();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }

    public function update(int $id, string $nombre, string $apPat, string $apMat, string $tel, string $correo): bool {
        $stmt = $this->db->prepare(
            "UPDATE residente SET nombre=?, apellido_paterno=?, apellido_materno=?, telefono=?, correo=? WHERE id_residente=?"
        );
        $stmt->bind_param('sssssi', $nombre, $apPat, $apMat, $tel, $correo, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool {
        $stmt1 = $this->db->prepare("DELETE FROM usuarios_pag WHERE id_residente = ?");
        $stmt1->bind_param('i', $id);
        $stmt1->execute();
        $stmt1->close();
        $stmt = $this->db->prepare("DELETE FROM residente WHERE id_residente = ?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}

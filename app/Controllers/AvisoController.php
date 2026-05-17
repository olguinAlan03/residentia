<?php
namespace App\Controllers;

use App\Models\Aviso;

class AvisoController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/avisos/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Aviso())->all()]);
    }

    public function activos(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Aviso())->activos()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $titulo    = trim($_POST['titulo']    ?? '');
        $contenido = trim($_POST['contenido'] ?? '');
        $idAdmin   = (int)($_SESSION['id_administrador'] ?? 1);

        if (!$titulo || !$contenido) {
            echo json_encode(['ok' => false, 'msg' => 'Título y contenido son obligatorios']);
            return;
        }
        $ok = (new Aviso())->create($titulo, $contenido, $idAdmin);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo publicar el aviso']);
    }

    public function toggle(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Aviso())->toggle($id);
        echo json_encode(['ok' => $ok]);
    }

    public function destroy(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Aviso())->delete($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo eliminar']);
    }
}

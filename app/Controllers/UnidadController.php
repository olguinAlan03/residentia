<?php
namespace App\Controllers;

use App\Models\Unidad;

class UnidadController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/unidades/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Unidad())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $numero = trim($_POST['numero'] ?? '');
        $torre  = trim($_POST['torre']  ?? '');
        $piso   = (int)($_POST['piso']  ?? 0);
        $tipo   = trim($_POST['tipo']   ?? 'departamento');

        if (!$numero) {
            echo json_encode(['ok' => false, 'msg' => 'El número o identificador es requerido']);
            return;
        }
        $ok = (new Unidad())->create($numero, $torre, $piso, $tipo);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo crear la unidad']);
    }

    public function destroy(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Unidad())->delete($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo eliminar']);
    }
}

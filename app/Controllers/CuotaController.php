<?php
namespace App\Controllers;

use App\Models\Cuota;

class CuotaController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/cuotas/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Cuota())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $idUnidad  = (int)($_POST['id_unidad']        ?? 0);
        $concepto  = trim($_POST['concepto']          ?? '');
        $monto     = (float)($_POST['monto']          ?? 0);
        $fechaVenc = trim($_POST['fecha_vencimiento'] ?? '');

        if (!$idUnidad || !$concepto || !$monto || !$fechaVenc) {
            echo json_encode(['ok' => false, 'msg' => 'Todos los campos son obligatorios']);
            return;
        }
        $ok = (new Cuota())->create($idUnidad, $concepto, $monto, $fechaVenc);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar la cuota']);
    }

    public function marcarPagada(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Cuota())->marcarPagada($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo actualizar']);
    }

    public function destroy(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Cuota())->delete($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo eliminar']);
    }
}

<?php
namespace App\Controllers;

use App\Models\Visita;

class VisitaController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/visitas/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Visita())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $nombre   = trim($_POST['nombre_visitante'] ?? '');
        $idUnidad = (int)($_POST['id_unidad']       ?? 0);
        $motivo   = trim($_POST['motivo']           ?? '');

        if (!$nombre || !$idUnidad) {
            echo json_encode(['ok' => false, 'msg' => 'Nombre del visitante y unidad son obligatorios']);
            return;
        }
        $ok = (new Visita())->create($nombre, $idUnidad, $motivo);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar la visita']);
    }

    public function registrarSalida(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Visita())->registrarSalida($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar la salida']);
    }
}

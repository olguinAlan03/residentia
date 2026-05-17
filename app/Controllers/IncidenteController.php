<?php
namespace App\Controllers;

use App\Models\Incidente;

class IncidenteController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/incidentes/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Incidente())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $idUnidad  = (int)($_POST['id_unidad']  ?? 0);
        $titulo    = trim($_POST['titulo']       ?? '');
        $desc      = trim($_POST['descripcion']  ?? '');
        $prioridad = trim($_POST['prioridad']    ?? 'media');

        if (!$titulo || !$desc) {
            echo json_encode(['ok' => false, 'msg' => 'Título y descripción son obligatorios']);
            return;
        }
        $ok = (new Incidente())->create($idUnidad, $titulo, $desc, $prioridad);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar el incidente']);
    }

    public function updateEstado(): void {
        header('Content-Type: application/json');
        $id     = (int)($_POST['id']     ?? 0);
        $estado = trim($_POST['estado']  ?? '');
        if (!$id || !$estado) {
            echo json_encode(['ok' => false, 'msg' => 'Datos inválidos']);
            return;
        }
        $ok = (new Incidente())->updateEstado($id, $estado);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'Estado no permitido o no se pudo actualizar']);
    }
}

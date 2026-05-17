<?php
namespace App\Controllers;

use App\Models\Reserva;

class ReservaController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/reservas/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Reserva())->all()]);
    }

    public function areas(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Reserva())->areas()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $area        = trim($_POST['area_comun']          ?? '');
        $fecha       = trim($_POST['fecha_reserva']       ?? '');
        $horario     = trim($_POST['horario']             ?? '');
        $comprobante = trim($_POST['id_comprobante_pago'] ?? '');

        if (!$area || !$fecha) {
            echo json_encode(['ok' => false, 'msg' => 'Área y fecha son obligatorios']);
            return;
        }

        $ok = (new Reserva())->create($area, $fecha, $horario, $comprobante);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar la reserva']);
    }
}

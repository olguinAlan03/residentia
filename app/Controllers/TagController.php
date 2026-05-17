<?php
namespace App\Controllers;

use App\Models\Tag;

class TagController {
    public function list(): void {
        header('Content-Type: application/json');
        $idVehiculo = (int)($_GET['idVehiculo'] ?? 0);

        if (!$idVehiculo) {
            echo json_encode(['Estado' => 'ERROR', 'respuesta' => []]);
            return;
        }

        echo json_encode(['Estado' => 'OK', 'respuesta' => (new Tag())->findByVehiculo($idVehiculo)]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $codigo       = trim($_POST['n_tag']          ?? '');
        $idVehiculo   = (int)($_POST['id_vehiculo']   ?? 0);
        $fRegistro    = trim($_POST['f_registro']     ?? '');
        $fVencimiento = trim($_POST['f_vencimiento']  ?? '');

        if (!$codigo || !$idVehiculo) {
            echo json_encode(['Estado' => 'ERROR', 'respuesta' => 'Datos incompletos']);
            return;
        }

        $ok = (new Tag())->create($codigo, $idVehiculo, $fRegistro, $fVencimiento);
        echo json_encode(['Estado' => $ok ? 'OK' : 'ERROR']);
    }
}

<?php
namespace App\Controllers;

use App\Models\Vehiculo;

class VehiculoController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/vehiculos/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['Estado' => 'OK', 'respuesta' => (new Vehiculo())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $idResidente = (int)($_POST['id_residente'] ?? 0) ?: null;
        $marca       = trim($_POST['marca']         ?? '');
        $modelo      = trim($_POST['modelo']        ?? '');
        $color       = trim($_POST['color']         ?? '');
        $matricula   = trim($_POST['num_matricula'] ?? '');

        if (!$marca || !$modelo || !$matricula) {
            echo json_encode(['Estado' => 'ERROR', 'respuesta' => 'Datos incompletos']);
            return;
        }

        $ok = (new Vehiculo())->create($marca, $modelo, $color, $matricula, $idResidente);
        echo json_encode(['Estado' => $ok ? 'OK' : 'ERROR']);
    }

    public function destroy(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id_vehiculo'] ?? 0);

        if (!$id) {
            echo json_encode(['Estado' => 'ERROR', 'respuesta' => 'ID inválido']);
            return;
        }

        $ok = (new Vehiculo())->delete($id);
        echo json_encode(['Estado' => $ok ? 'OK' : 'ERROR']);
    }
}

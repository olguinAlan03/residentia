<?php
namespace App\Controllers;

use App\Models\Residente;
use App\Models\Vehiculo;
use App\Models\Unidad;
use App\Models\Visita;
use App\Models\Cuota;
use App\Models\Incidente;

class DashboardController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        $stats = $this->getStats();
        require_once __DIR__ . '/../Views/dashboard/index.php';
    }

    public function stats(): void {
        header('Content-Type: application/json');
        echo json_encode($this->getStats());
    }

    private function getStats(): array {
        return [
            'residentes'  => (new Residente())->count(),
            'vehiculos'   => count((new Vehiculo())->all()),
            'unidades'    => (new Unidad())->count(),
            'visitas_hoy' => (new Visita())->hoy(),
            'cuotas_pend' => (new Cuota())->pendientes(),
            'incidentes'  => (new Incidente())->abiertos(),
        ];
    }
}

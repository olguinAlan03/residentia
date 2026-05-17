<?php
namespace App\Controllers;

use App\Models\Aviso;
use App\Models\Reserva;
use App\Models\Incidente;

class PortalController {
    private function requireResident(): void {
        if (!isset($_SESSION['residente'])) {
            header('Location: /login');
            exit();
        }
    }

    public function index(): void {
        $this->requireResident();
        require_once __DIR__ . '/../Views/portal/index.php';
    }

    public function misReservas(): void {
        $this->requireResident();
        require_once __DIR__ . '/../Views/portal/reservas.php';
    }

    public function misIncidentes(): void {
        $this->requireResident();
        require_once __DIR__ . '/../Views/portal/incidentes.php';
    }

    public function listIncidentes(): void {
        header('Content-Type: application/json');
        $this->requireResident();
        $idUnidad = (int)($_SESSION['id_unidad'] ?? 0);
        echo json_encode(['ok' => true, 'data' => (new Incidente())->byUnidad($idUnidad)]);
    }

    public function listReservas(): void {
        header('Content-Type: application/json');
        $this->requireResident();
        $idResidente = (int)($_SESSION['residente'] ?? 0);
        echo json_encode(['ok' => true, 'data' => (new Reserva())->byResidente($idResidente)]);
    }

    public function reportarIncidente(): void {
        header('Content-Type: application/json');
        $this->requireResident();
        $titulo    = trim($_POST['titulo']      ?? '');
        $desc      = trim($_POST['descripcion'] ?? '');
        $prioridad = trim($_POST['prioridad']   ?? 'media');
        $idUnidad  = (int)($_SESSION['id_unidad'] ?? 0);

        if (!$titulo || !$desc) {
            echo json_encode(['ok' => false, 'msg' => 'Título y descripción son obligatorios']);
            return;
        }
        $ok = (new Incidente())->create($idUnidad, $titulo, $desc, $prioridad);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo enviar el reporte']);
    }

    public function crearReserva(): void {
        header('Content-Type: application/json');
        $this->requireResident();
        $idArea    = (int)($_POST['id_area']    ?? 0);
        $fecha     = trim($_POST['fecha']       ?? '');
        $horaIni   = trim($_POST['hora_inicio'] ?? '');
        $horaFin   = trim($_POST['hora_fin']    ?? '');
        $idRes     = (int)($_SESSION['residente'] ?? 0);

        if (!$idArea || !$fecha || !$horaIni || !$horaFin) {
            echo json_encode(['ok' => false, 'msg' => 'Completa todos los campos']);
            return;
        }

        $reserva = new Reserva();
        $areas   = $reserva->areas();
        $areaArr = array_values(array_filter($areas, fn($a) => $a['id_area'] == $idArea));
        $areaNombre = $areaArr ? $areaArr[0]['nombre'] : 'Área ' . $idArea;

        $ok = $reserva->create($areaNombre, $fecha, "{$horaIni} - {$horaFin}", '', $idRes);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo crear la reserva']);
    }
}

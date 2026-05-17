<?php
namespace App\Controllers;

use App\Models\Residente;

class ResidenteController {
    public function index(): void {
        if (!isset($_SESSION['admin'])) { header('Location: /admin/login'); exit(); }
        require_once __DIR__ . '/../Views/residentes/index.php';
    }

    public function list(): void {
        header('Content-Type: application/json');
        echo json_encode(['ok' => true, 'data' => (new Residente())->all()]);
    }

    public function store(): void {
        header('Content-Type: application/json');
        $idUnidad = (int)($_POST['id_unidad']      ?? 0);
        $nombre   = trim($_POST['nombre']           ?? '');
        $apPat    = trim($_POST['apP_Residente']    ?? '');
        $apMat    = trim($_POST['apM_Residente']    ?? '');
        $tel      = trim($_POST['telefono']         ?? '');
        $correo   = trim($_POST['correo']           ?? '');
        $pass     = trim($_POST['password']         ?? '');

        if (!$nombre || !$apPat || !$correo || !$pass) {
            echo json_encode(['ok' => false, 'msg' => 'Nombre, apellido, correo y contraseña son obligatorios']);
            return;
        }

        $ok = (new Residente())->create($idUnidad, $nombre, $apPat, $apMat, $tel, $correo, $pass);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo registrar el residente']);
    }

    public function update(): void {
        header('Content-Type: application/json');
        $id     = (int)($_POST['id']             ?? 0);
        $nombre = trim($_POST['nombre']          ?? '');
        $apPat  = trim($_POST['apP_Residente']   ?? '');
        $apMat  = trim($_POST['apM_Residente']   ?? '');
        $tel    = trim($_POST['telefono']        ?? '');
        $correo = trim($_POST['correo']          ?? '');

        if (!$id || !$nombre || !$apPat) {
            echo json_encode(['ok' => false, 'msg' => 'Datos inválidos']);
            return;
        }
        $ok = (new Residente())->update($id, $nombre, $apPat, $apMat, $tel, $correo);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo actualizar']);
    }

    public function destroy(): void {
        header('Content-Type: application/json');
        $id = (int)($_POST['id'] ?? 0);
        if (!$id) { echo json_encode(['ok' => false, 'msg' => 'ID inválido']); return; }
        $ok = (new Residente())->delete($id);
        echo json_encode(['ok' => $ok, 'msg' => $ok ? null : 'No se pudo eliminar']);
    }
}

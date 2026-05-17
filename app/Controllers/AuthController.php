<?php
namespace App\Controllers;

use App\Models\Residente;
use App\Models\Administrador;

class AuthController {
    public function loginView(): void {
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function adminLoginView(): void {
        require_once __DIR__ . '/../Views/auth/loginAdm.php';
    }

    public function login(): void {
        header('Content-Type: application/json');

        if (!isset($_POST['user'], $_POST['password'])) {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
            return;
        }

        $residente = (new Residente())->findByCredentials($_POST['user'], $_POST['password']);

        if ($residente) {
            $_SESSION['residente']     = $residente['id_residente'];
            $_SESSION['nombre']        = $residente['nombre'];
            $_SESSION['apP_Residente'] = $residente['apellido_paterno'];
            $_SESSION['apM_Residente'] = $residente['apellido_materno'];
            $_SESSION['telefono']      = $residente['telefono'];
            $_SESSION['id_unidad']     = (int)($residente['id_unidad'] ?? 0);
            echo json_encode(['Estado' => 'Ok', 'respuesta' => 'YES']);
        } else {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
        }
    }

    public function adminLogin(): void {
        header('Content-Type: application/json');

        if (!isset($_POST['correo'], $_POST['pass'])) {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
            return;
        }

        $admin = (new Administrador())->findByCredentials($_POST['correo'], $_POST['pass']);

        if ($admin) {
            $_SESSION['admin']              = true;
            $_SESSION['nombre']             = $admin['nombre'];
            $_SESSION['correo']             = $admin['correo'];
            $_SESSION['id_administrador']   = $admin['id_administrador'];
            echo json_encode(['Estado' => 'Ok', 'respuesta' => 'YES']);
        } else {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
        }
    }

    public function logout(): void {
        session_destroy();
        header('Location: /login');
        exit();
    }
}

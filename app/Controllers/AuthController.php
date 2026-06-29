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

        $passwordEnviado = $_POST['password'];
        $residenteModel  = new Residente();
        $residente       = $residenteModel->findByIdResidente($_POST['user']);

        if (!$residente || !$this->verificarYMigrar($passwordEnviado, $residente['passwor'], function (string $hash) use ($residenteModel, $residente) {
            $residenteModel->updatePassword((int)$residente['id_residente'], $hash);
        })) {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
            return;
        }

        $_SESSION['residente']     = $residente['id_residente'];
        $_SESSION['nombre']        = $residente['nombre'];
        $_SESSION['apP_Residente'] = $residente['apellido_paterno'];
        $_SESSION['apM_Residente'] = $residente['apellido_materno'];
        $_SESSION['telefono']      = $residente['telefono'];
        $_SESSION['id_unidad']     = (int)($residente['id_unidad'] ?? 0);
        echo json_encode(['Estado' => 'Ok', 'respuesta' => 'YES']);
    }

    public function adminLogin(): void {
        header('Content-Type: application/json');

        if (!isset($_POST['correo'], $_POST['pass'])) {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
            return;
        }

        $passwordEnviado = $_POST['pass'];
        $adminModel      = new Administrador();
        $admin           = $adminModel->findByCorreo($_POST['correo']);

        if (!$admin || !$this->verificarYMigrar($passwordEnviado, $admin['passwor'], function (string $hash) use ($adminModel, $admin) {
            $adminModel->updatePassword((int)$admin['id_administrador'], $hash);
        })) {
            echo json_encode(['Estado' => 'Error', 'respuesta' => 'NO']);
            return;
        }

        $_SESSION['admin']            = true;
        $_SESSION['nombre']           = $admin['nombre'];
        $_SESSION['correo']           = $admin['correo'];
        $_SESSION['id_administrador'] = $admin['id_administrador'];
        echo json_encode(['Estado' => 'Ok', 'respuesta' => 'YES']);
    }

    /**
     * Verifica la contraseña contra el hash almacenado. Si el hash todavía es texto
     * plano de la era pre-bcrypt y coincide, lo migra a bcrypt mediante $onMigrate.
     */
    private function verificarYMigrar(string $passwordEnviado, string $hashOTextoPlano, callable $onMigrate): bool {
        if (password_verify($passwordEnviado, $hashOTextoPlano)) {
            return true;
        }

        if (hash_equals($hashOTextoPlano, $passwordEnviado)) {
            $onMigrate(password_hash($passwordEnviado, PASSWORD_BCRYPT));
            return true;
        }

        return false;
    }

    public function logout(): void {
        session_destroy();
        header('Location: /login');
        exit();
    }
}

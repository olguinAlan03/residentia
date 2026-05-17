<?php
namespace App\Controllers;

class LandingController {
    public function index(): void {
        if (isset($_SESSION['admin'])) { header('Location: /dashboard'); exit(); }
        if (isset($_SESSION['residente'])) { header('Location: /portal'); exit(); }
        require_once __DIR__ . '/../Views/landing/index.php';
    }
}

<?php
require_once __DIR__ . '/../config/bootstrap.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\VehiculoController;
use App\Controllers\ReservaController;
use App\Controllers\TagController;
use App\Controllers\ResidenteController;
use App\Controllers\UnidadController;
use App\Controllers\AvisoController;
use App\Controllers\VisitaController;
use App\Controllers\CuotaController;
use App\Controllers\IncidenteController;
use App\Controllers\PortalController;
use App\Controllers\LandingController;

session_start();

$method = $_SERVER['REQUEST_METHOD'];
$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri    = rtrim($uri, '/') ?: '/';

$routes = [
    'GET' => [
        // Pública
        '/'                         => [LandingController::class,    'index'],
        '/login'                    => [AuthController::class,       'loginView'],
        '/admin/login'              => [AuthController::class,       'adminLoginView'],
        '/logout'                   => [AuthController::class,       'logout'],

        // Portal residente
        '/portal'                   => [PortalController::class,     'index'],
        '/portal/reservas'          => [PortalController::class,     'misReservas'],
        '/portal/incidentes'        => [PortalController::class,     'misIncidentes'],

        // Admin — vistas
        '/dashboard'                => [DashboardController::class,  'index'],
        '/residentes'               => [ResidenteController::class,  'index'],
        '/unidades'                 => [UnidadController::class,     'index'],
        '/vehiculos'                => [VehiculoController::class,   'index'],
        '/avisos'                   => [AvisoController::class,      'index'],
        '/visitas'                  => [VisitaController::class,     'index'],
        '/cuotas'                   => [CuotaController::class,      'index'],
        '/incidentes'               => [IncidenteController::class,  'index'],
        '/reservas'                 => [ReservaController::class,    'index'],

        // Admin — APIs GET
        '/api/residentes'           => [ResidenteController::class,  'list'],
        '/api/unidades'             => [UnidadController::class,     'list'],
        '/api/vehiculos'            => [VehiculoController::class,   'list'],
        '/api/avisos'               => [AvisoController::class,      'list'],
        '/api/avisos/activos'       => [AvisoController::class,      'activos'],
        '/api/visitas'              => [VisitaController::class,     'list'],
        '/api/cuotas'               => [CuotaController::class,      'list'],
        '/api/incidentes'           => [IncidenteController::class,  'list'],
        '/api/reservas'             => [ReservaController::class,    'list'],
        '/api/areas'                => [ReservaController::class,    'areas'],
        '/api/tags'                 => [TagController::class,        'list'],
        '/api/dashboard/stats'      => [DashboardController::class,  'stats'],

        // Portal — APIs GET
        '/api/portal/incidentes'    => [PortalController::class,     'listIncidentes'],
        '/api/portal/reservas'      => [PortalController::class,     'listReservas'],
    ],
    'POST' => [
        // Auth
        '/api/login'                => [AuthController::class,       'login'],
        '/api/admin/login'          => [AuthController::class,       'adminLogin'],

        // Residentes
        '/api/residentes'           => [ResidenteController::class,  'store'],
        '/api/residentes/update'    => [ResidenteController::class,  'update'],
        '/api/residentes/delete'    => [ResidenteController::class,  'destroy'],

        // Unidades
        '/api/unidades'             => [UnidadController::class,     'store'],
        '/api/unidades/delete'      => [UnidadController::class,     'destroy'],

        // Vehículos
        '/api/vehiculos'            => [VehiculoController::class,   'store'],
        '/api/vehiculos/delete'     => [VehiculoController::class,   'destroy'],

        // Tags
        '/api/tags'                 => [TagController::class,        'store'],

        // Avisos
        '/api/avisos'               => [AvisoController::class,      'store'],
        '/api/avisos/toggle'        => [AvisoController::class,      'toggle'],
        '/api/avisos/delete'        => [AvisoController::class,      'destroy'],

        // Visitas
        '/api/visitas'              => [VisitaController::class,     'store'],
        '/api/visitas/salida'       => [VisitaController::class,     'registrarSalida'],

        // Cuotas
        '/api/cuotas'               => [CuotaController::class,      'store'],
        '/api/cuotas/pagar'         => [CuotaController::class,      'marcarPagada'],
        '/api/cuotas/delete'        => [CuotaController::class,      'destroy'],

        // Incidentes
        '/api/incidentes'           => [IncidenteController::class,  'store'],
        '/api/incidentes/estado'    => [IncidenteController::class,  'updateEstado'],

        // Reservas
        '/api/reservas'             => [ReservaController::class,    'store'],

        // Portal residente
        '/api/portal/incidentes'    => [PortalController::class,     'reportarIncidente'],
        '/api/portal/reservas'      => [PortalController::class,     'crearReserva'],
    ],
];

if (isset($routes[$method][$uri])) {
    [$class, $action] = $routes[$method][$uri];
    (new $class())->$action();
} else {
    http_response_code(404);
    echo "<h3 style='font-family:sans-serif;margin:2rem'>404 — Ruta no encontrada: {$method} {$uri}</h3>";
}

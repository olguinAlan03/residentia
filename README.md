# Residentia

Sistema de gestión de condominios construido en **PHP 8.2 vanilla** con arquitectura Front Controller, consultas MySQLi con prepared statements y despliegue 100% Dockerizado.

Permite administrar unidades, residentes, vehículos, visitas, cuotas, incidentes y reservas de áreas comunes desde un panel administrativo, además de exponer un **Portal del Residente** para que cada propietario gestione sus propias reservas e incidentes.

---

## Tabla de contenidos

- [Características](#características)
- [Stack tecnológico](#stack-tecnológico)
- [Arquitectura](#arquitectura)
- [Seguridad](#seguridad)
- [Estructura del proyecto](#estructura-del-proyecto)
- [Puesta en marcha](#puesta-en-marcha)
- [Variables de entorno](#variables-de-entorno)
- [Modelo de datos](#modelo-de-datos)
- [Credenciales de prueba](#credenciales-de-prueba)
- [Roadmap](#roadmap)

---

## Características

### Panel de administración
- **Dashboard** con métricas en vivo: residentes, vehículos, unidades, visitas del día, cuotas pendientes e incidentes abiertos.
- **Unidades** — alta, baja y listado de departamentos/casas del condominio.
- **Residentes** — gestión de propietarios/arrendatarios, vinculados a su unidad.
- **Vehículos + Tags RFID** — registro de vehículos por residente y de los tags de acceso vehicular, con fecha de registro y vencimiento.
- **Visitas** — control de acceso de visitantes con hora de entrada/salida.
- **Cuotas** — generación de cobros por unidad, con estados `pendiente` / `vencida` / `pagada`.
- **Incidentes** — reportes con prioridad (`alta`/`media`/`baja`) y flujo de estados (`abierto` → `en_proceso` → `resuelto`/`cerrado`).
- **Avisos** — comunicados generales, activables/desactivables.
- **Reservas** — gestión de áreas comunes con capacidad y horarios.

### Portal del residente
- Login independiente del panel admin.
- Reserva de áreas comunes y reporte de incidentes acotado a la propia unidad (`$_SESSION['id_unidad']`).
- Consulta del historial de reservas e incidentes propios.

### Landing page
- Página pública de presentación del condominio.

---

## Stack tecnológico

| Capa | Tecnología |
|---|---|
| Lenguaje | PHP 8.2 (sin framework) |
| Base de datos | MariaDB 11 |
| Acceso a datos | MySQLi + prepared statements (sin ORM) |
| Autoload | Composer, PSR-4 (`App\` → `app/`) |
| Frontend | AdminLTE 3, jQuery, DataTables, SweetAlert2 |
| Contenedores | Docker + Docker Compose (PHP-Apache, MariaDB, Adminer) |
| Gestión de secretos | `vlucas/phpdotenv` (`.env`, ignorado por git) |

---

## Arquitectura

El proyecto sigue el patrón **Front Controller**: toda petición HTTP entra por [`public/index.php`](public/index.php), que resuelve un array de rutas `GET`/`POST` hacia `[Controller::class, 'método']`.

```
Cliente
  │
  ▼
public/index.php  (router / front controller)
  │
  ▼
app/Controllers/   → orquesta la petición, valida sesión, llama al Model, responde vista o JSON
  │
  ▼
app/Models/        → una clase por entidad, queries MySQLi con prepared statements
  │
  ▼
MariaDB
```

- `app/Views/` contiene los templates PHP, con `layout/top.php` y `layout/bottom.php` compartidos entre vistas del panel admin.
- Las respuestas de API siguen el formato `{ok: true|false, data: [...], msg: string}` en los módulos nuevos, y el formato legado `{Estado, respuesta}` en Vehículos/Tags.
- Autenticación dual por sesión: `$_SESSION['admin']` para el panel y `$_SESSION['residente']` + `$_SESSION['id_unidad']` para el portal.

---

## Seguridad

- **Contraseñas con hash bcrypt** (`password_hash` / `password_verify`) tanto para administradores (`administrador.passwor`) como para residentes (`usuarios_pag.passwor`). El `WHERE` de las consultas de login filtra únicamente por identificador (`correo` / `id_residente`); la comparación de contraseña ocurre en PHP, nunca en SQL.
- **Migración transparente de contraseñas legadas**: si un usuario aún tiene su contraseña en texto plano (datos previos a la migración a bcrypt), el primer login exitoso la re-hashea automáticamente y actualiza el registro en base de datos — sin pedirle al usuario que cambie su clave.
- Todas las consultas usan **prepared statements** (MySQLi `bind_param`), evitando inyección SQL.
- Secretos (credenciales de BD) fuera del código, vía `.env` (excluido de git por `.gitignore`).

---

## Estructura del proyecto

```
Residentia/
├── app/
│   ├── Controllers/      # Un controller por módulo (vistas + endpoints API)
│   ├── Models/            # Acceso a datos (MySQLi)
│   └── Views/             # Templates PHP por módulo
├── config/
│   └── bootstrap.php      # Autoload + carga de .env
├── database/
│   └── init.sql           # Esquema inicial, ejecutado por MariaDB al primer arranque
├── public/
│   └── index.php          # Front controller / router
├── dist/, img/, plugins/   # Assets de AdminLTE 3
├── apache/                 # Configuración de VirtualHost
├── Dockerfile
├── docker-compose.yml
├── docker-entrypoint.sh    # Instala dependencias de Composer si vendor/ no existe
├── composer.json
└── .env.example
```

---

## Puesta en marcha

### Requisitos

- [Docker](https://www.docker.com/) y Docker Compose
- (Opcional) [Composer](https://getcomposer.org/) si quieres correr el proyecto fuera de Docker

### 1. Clonar el repositorio

```bash
git clone https://github.com/<tu-usuario>/Residentia.git
cd Residentia
```

### 2. Configurar variables de entorno

```bash
cp .env.example .env
```

Los valores por defecto ya coinciden con los definidos en `docker-compose.yml`, no es necesario editarlos para correr el proyecto localmente.

### 3. Levantar los contenedores

```bash
docker compose up -d --build
```

Esto levanta tres servicios:

| Servicio | Contenedor | Puerto | Descripción |
|---|---|---|---|
| `app` | `residentia_app` | `8080` | PHP 8.2 + Apache |
| `db` | `residentia_db` | `3306` | MariaDB 11 |
| `adminer` | `residentia_adminer` | `8081` | Cliente web de administración de BD |

Al primer arranque, MariaDB ejecuta [`database/init.sql`](database/init.sql) y crea el esquema completo. El [`docker-entrypoint.sh`](docker-entrypoint.sh) corre `composer install` automáticamente si la carpeta `vendor/` no existe.

### 4. Acceder a la aplicación

| Recurso | URL |
|---|---|
| Landing page | http://localhost:8080 |
| Login residente | http://localhost:8080/login |
| Login administrador | http://localhost:8080/admin/login |
| Dashboard admin | http://localhost:8080/dashboard |
| Adminer | http://localhost:8081 |

**Conexión en Adminer:** sistema `MySQL`, servidor `db`, usuario `residentia_user`, contraseña `residentia_pass`, base de datos `residentia`.

### Comandos útiles

```bash
# Ver logs de la app
docker compose logs -f app

# Detener los contenedores (conserva los datos)
docker compose down

# Resetear la base de datos desde cero (vuelve a ejecutar init.sql)
docker compose down -v && docker compose up -d --build
```

---

## Variables de entorno

Definidas en `.env` (ver [`.env.example`](.env.example)):

| Variable | Descripción | Valor por defecto |
|---|---|---|
| `DB_HOST` | Host de la base de datos | `db` |
| `DB_NAME` | Nombre de la base de datos | `residentia` |
| `DB_USER` | Usuario de la base de datos | `residentia_user` |
| `DB_PASS` | Contraseña de la base de datos | `residentia_pass` |
| `APP_ENV` | Entorno de ejecución | `development` |
| `APP_DEBUG` | Mostrar errores detallados | `true` |

> El archivo `.env` está excluido de git — nunca commitees credenciales reales.

---

## Modelo de datos

Tablas principales definidas en [`database/init.sql`](database/init.sql):

`rol`, `unidad`, `residente`, `usuarios_pag`, `administrador`, `vehiculo`, `tag`, `area_comun`, `reserva`, `aviso`, `visita`, `cuota`, `incidente`.

Relaciones clave:
- `residente.id_unidad` → `unidad.id_unidad`
- `usuarios_pag.id_residente` → `residente.id_residente` (credenciales del portal)
- `vehiculo.id_residente` → `residente.id_residente`
- `tag.id_vehiculo` → `vehiculo.id_vehiculo`
- `cuota.id_unidad`, `incidente.id_unidad`, `visita.id_unidad` → `unidad.id_unidad`
- `reserva.id_residente` → `residente.id_residente`, `reserva.area_comun` → `area_comun`

---

## Credenciales de prueba

| Rol | Usuario | Contraseña |
|---|---|---|
| Administrador | `admin@residentia.com` | `Admin123` |
| Residente | `1` (id de residente) | `123` |

---

## Roadmap

- [ ] Middleware centralizado de autenticación/autorización por rol
- [ ] Cobertura de pruebas automatizadas (PHPUnit)
- [ ] Paginación server-side en listados grandes
- [ ] Notificaciones por correo para avisos y vencimiento de cuotas

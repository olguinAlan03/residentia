-- ============================================================
-- Residentia — Script de inicialización de base de datos
-- ============================================================

CREATE DATABASE IF NOT EXISTS residentia
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE residentia;

-- ------------------------------------------------------------
-- Roles del sistema
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS rol (
    id_rol     INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);

INSERT INTO rol (nombre_rol) VALUES ('Administrador'), ('Residente');

-- ------------------------------------------------------------
-- Unidades (departamentos / casas del condominio)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS unidad (
    id_unidad INT AUTO_INCREMENT PRIMARY KEY,
    numero    VARCHAR(20)  NOT NULL,
    torre     VARCHAR(50),
    piso      INT          DEFAULT 0,
    tipo      ENUM('departamento','casa','local') DEFAULT 'departamento',
    estado    ENUM('activo','desocupado','moroso') DEFAULT 'activo'
);

-- ------------------------------------------------------------
-- Residentes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS residente (
    id_residente     INT AUTO_INCREMENT PRIMARY KEY,
    id_unidad        INT,
    nombre           VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100),
    telefono         VARCHAR(20),
    correo           VARCHAR(150),
    FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad)
);

-- ------------------------------------------------------------
-- Usuarios del portal (login de residentes)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios_pag (
    id_usuario   INT AUTO_INCREMENT PRIMARY KEY,
    id_residente INT NOT NULL,
    passwor      VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_residente) REFERENCES residente(id_residente)
);

-- ------------------------------------------------------------
-- Administradores
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS administrador (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    id_rol           INT DEFAULT 1,
    nombre           VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100) NOT NULL,
    apellido_materno VARCHAR(100),
    telefono         VARCHAR(20),
    correo           VARCHAR(150) NOT NULL,
    passwor          VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

-- ------------------------------------------------------------
-- Vehículos
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS vehiculo (
    id_vehiculo   INT AUTO_INCREMENT PRIMARY KEY,
    id_residente  INT NULL,
    marca         VARCHAR(80) NOT NULL,
    modelo        VARCHAR(80) NOT NULL,
    color         VARCHAR(50),
    num_matricula VARCHAR(20) NOT NULL UNIQUE,
    FOREIGN KEY (id_residente) REFERENCES residente(id_residente) ON DELETE SET NULL
);

-- ------------------------------------------------------------
-- Tags RFID
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tag (
    id_tag        INT AUTO_INCREMENT PRIMARY KEY,
    codigo_tag    VARCHAR(100) NOT NULL UNIQUE,
    id_vehiculo   INT NOT NULL,
    f_registro    DATE,
    f_vencimiento DATE,
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculo(id_vehiculo)
);

-- ------------------------------------------------------------
-- Áreas comunes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS area_comun (
    id_area    INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    capacidad  INT DEFAULT 10
);

-- ------------------------------------------------------------
-- Reservas de áreas comunes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS reserva (
    id_reserva          INT AUTO_INCREMENT PRIMARY KEY,
    area_comun          VARCHAR(100) NOT NULL,
    fecha_reserva       DATE         NOT NULL,
    horario             VARCHAR(50),
    id_comprobante_pago VARCHAR(100),
    id_residente        INT,
    fecha_registro      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_residente) REFERENCES residente(id_residente)
);

-- ------------------------------------------------------------
-- Avisos / Comunicados
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS aviso (
    id_aviso         INT AUTO_INCREMENT PRIMARY KEY,
    titulo           VARCHAR(200) NOT NULL,
    contenido        TEXT         NOT NULL,
    id_administrador INT,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo           TINYINT(1) DEFAULT 1,
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

-- ------------------------------------------------------------
-- Registro de visitas
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS visita (
    id_visita        INT AUTO_INCREMENT PRIMARY KEY,
    nombre_visitante VARCHAR(150) NOT NULL,
    id_unidad        INT          NOT NULL,
    motivo           VARCHAR(200),
    hora_entrada     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    hora_salida      TIMESTAMP NULL,
    FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad)
);

-- ------------------------------------------------------------
-- Cuotas de mantenimiento
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS cuota (
    id_cuota         INT AUTO_INCREMENT PRIMARY KEY,
    id_unidad        INT             NOT NULL,
    concepto         VARCHAR(200)    NOT NULL,
    monto            DECIMAL(10,2)   NOT NULL,
    fecha_vencimiento DATE           NOT NULL,
    estado           ENUM('pendiente','pagada','vencida') DEFAULT 'pendiente',
    fecha_pago       DATE NULL,
    FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad)
);

-- ------------------------------------------------------------
-- Incidentes / Reportes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS incidente (
    id_incidente  INT AUTO_INCREMENT PRIMARY KEY,
    id_unidad     INT,
    titulo        VARCHAR(200) NOT NULL,
    descripcion   TEXT         NOT NULL,
    estado        ENUM('abierto','en_proceso','resuelto','cerrado') DEFAULT 'abierto',
    prioridad     ENUM('baja','media','alta')            DEFAULT 'media',
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_cierre  TIMESTAMP NULL,
    FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad)
);

-- ============================================================
-- Datos de prueba
-- ============================================================

INSERT INTO area_comun (nombre, capacidad) VALUES
    ('Salón de Eventos', 80),
    ('Alberca', 30),
    ('Gimnasio', 15),
    ('Cancha de Futbol', 22);

INSERT INTO unidad (numero, torre, piso, tipo) VALUES
    ('101', 'A', 1, 'departamento'),
    ('102', 'A', 1, 'departamento'),
    ('201', 'A', 2, 'departamento'),
    ('Casa-1', NULL, 0, 'casa');

INSERT INTO residente (id_unidad, nombre, apellido_paterno, apellido_materno, telefono, correo)
VALUES (1, 'Alan', 'Olguin', 'Olguin', '5510001234', 'alan@residentia.com');

INSERT INTO usuarios_pag (id_residente, passwor) VALUES (1, '123');

INSERT INTO administrador (id_rol, nombre, apellido_paterno, correo, passwor)
VALUES (1, 'Admin', 'Sistema', 'admin@residentia.com', 'Admin123');

INSERT INTO vehiculo (id_residente, marca, modelo, color, num_matricula)
VALUES (1, 'Toyota', 'Corolla', 'Blanco', 'ABC-123');

INSERT INTO aviso (titulo, contenido, id_administrador) VALUES
    ('Bienvenidos a Residentia', 'Sistema de gestión del condominio activo. Cualquier duda contactar a administración.', 1),
    ('Mantenimiento Alberca', 'La alberca estará fuera de servicio el próximo sábado de 8am a 2pm por mantenimiento.', 1);

INSERT INTO cuota (id_unidad, concepto, monto, fecha_vencimiento, estado) VALUES
    (1, 'Mantenimiento Mayo 2026', 850.00, '2026-05-31', 'pendiente'),
    (2, 'Mantenimiento Mayo 2026', 850.00, '2026-05-31', 'pendiente'),
    (3, 'Mantenimiento Mayo 2026', 850.00, '2026-05-31', 'pagada'),
    (1, 'Mantenimiento Abril 2026', 850.00, '2026-04-30', 'vencida');

INSERT INTO incidente (id_unidad, titulo, descripcion, prioridad) VALUES
    (1, 'Fuga de agua en cocina', 'Hay una fuga debajo del fregadero desde el lunes.', 'alta'),
    (2, 'Foco fundido en pasillo', 'El foco del pasillo del piso 1 está fundido.', 'baja');

-- Create database (optional)
CREATE DATABASE IF NOT EXISTS brixo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE brixo;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables if exist (in FK-safe order)
DROP TABLE IF EXISTS PAGO_PAYOUT;
DROP TABLE IF EXISTS PAGO;
DROP TABLE IF EXISTS RESENA;
DROP TABLE IF EXISTS CONTRATISTA_SERVICIO;
DROP TABLE IF EXISTS CLIENTE_UBICACION;
DROP TABLE IF EXISTS CONTRATISTA_UBICACION;
DROP TABLE IF EXISTS CERTIFICACION;
DROP TABLE IF EXISTS CONTRATO;
DROP TABLE IF EXISTS COTIZACION;
DROP TABLE IF EXISTS SERVICIO;
DROP TABLE IF EXISTS CATEGORIA;
DROP TABLE IF EXISTS UBICACION;
DROP TABLE IF EXISTS ADMINISTRADOR;
DROP TABLE IF EXISTS CONTRATISTA;
DROP TABLE IF EXISTS CLIENTE;

SET FOREIGN_KEY_CHECKS = 1;

-- Core tables
CREATE TABLE CLIENTE (
  id_cliente INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  telefono VARCHAR(50),
  fecha_de_registro DATE,
  contrasena VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CONTRATISTA (
  id_contratista INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  experiencia VARCHAR(100),
  portafolio VARCHAR(255),
  telefono VARCHAR(50),
  correo VARCHAR(255) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ADMINISTRADOR (
  id_administrador INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  rol VARCHAR(255),
  contrasena VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CATEGORIA (
  id_categoria INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE SERVICIO (
  id_servicio INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT,
  precio_estimado DECIMAL(12,2),
  id_categoria INT NULL,
  CONSTRAINT fk_servicio_categoria
    FOREIGN KEY (id_categoria) REFERENCES CATEGORIA(id_categoria)
    ON DELETE SET NULL ON UPDATE CASCADE,
  INDEX idx_servicio_categoria (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE UBICACION (
  id_ubicacion INT AUTO_INCREMENT PRIMARY KEY,
  ciudad VARCHAR(255),
  departamento VARCHAR(255),
  direccion VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE COTIZACION (
  id_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
  estado ENUM('PENDIENTE','ACEPTADA','RECHAZADA','EXPIRADA') DEFAULT 'PENDIENTE',
  fecha DATE,
  observaciones VARCHAR(255),
  id_cliente INT NOT NULL,
  id_servicio INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_cotizacion_cliente
    FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_cotizacion_servicio
    FOREIGN KEY (id_servicio) REFERENCES SERVICIO(id_servicio)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  INDEX idx_cotizacion_cliente (id_cliente),
  INDEX idx_cotizacion_servicio (id_servicio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CONTRATO (
  id_contrato INT AUTO_INCREMENT PRIMARY KEY,
  fecha_inicio DATE,
  fecha_fin DATE,
  costo_total DECIMAL(12,2),
  estado ENUM('EN_PROCESO','ACTIVO','COMPLETADO','CANCELADO') DEFAULT 'EN_PROCESO',
  comision_brixo DECIMAL(12,2),
  id_cotizacion INT NOT NULL,
  id_contratista INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_contrato_cotizacion
    FOREIGN KEY (id_cotizacion) REFERENCES COTIZACION(id_cotizacion)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_contrato_contratista
    FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY ux_contrato_cotizacion (id_cotizacion),
  INDEX idx_contrato_contratista (id_contratista)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CERTIFICACION (
  id_certificado INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  entidad_emisora VARCHAR(255),
  fecha_obtenida DATE,
  id_contratista INT NOT NULL,
  CONSTRAINT fk_cert_contratista
    FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista)
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_cert_contratista (id_contratista)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Junctions
CREATE TABLE CLIENTE_UBICACION (
  id_cliente INT NOT NULL,
  id_ubicacion INT NOT NULL,
  PRIMARY KEY (id_cliente, id_ubicacion),
  CONSTRAINT fk_cliubi_cliente
    FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_cliubi_ubicacion
    FOREIGN KEY (id_ubicacion) REFERENCES UBICACION(id_ubicacion)
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_cliubi_ubicacion (id_ubicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CONTRATISTA_UBICACION (
  id_contratista INT NOT NULL,
  id_ubicacion INT NOT NULL,
  PRIMARY KEY (id_contratista, id_ubicacion),
  CONSTRAINT fk_ctsubi_contratista
    FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_ctsubi_ubicacion
    FOREIGN KEY (id_ubicacion) REFERENCES UBICACION(id_ubicacion)
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_ctsubi_ubicacion (id_ubicacion)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CONTRATISTA_SERVICIO (
  id_contratista INT NOT NULL,
  id_servicio INT NOT NULL,
  PRIMARY KEY (id_contratista, id_servicio),
  CONSTRAINT fk_cts_contratista
    FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista)
    ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_cts_servicio
    FOREIGN KEY (id_servicio) REFERENCES SERVICIO(id_servicio)
    ON DELETE CASCADE ON UPDATE CASCADE,
  INDEX idx_cts_servicio (id_servicio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Payments (client payments tied to a contract)
CREATE TABLE PAGO (
  id_pago INT AUTO_INCREMENT PRIMARY KEY,
  id_contrato INT NOT NULL,
  id_cliente INT NOT NULL,
  monto DECIMAL(12,2) NOT NULL,
  moneda CHAR(3) NOT NULL DEFAULT 'USD',
  fecha_de_pago DATETIME NULL,
  medio_de_pago VARCHAR(255),
  referencia VARCHAR(255),
  estado ENUM('PENDIENTE','APROBADO','FALLIDO','REEMBOLSADO') DEFAULT 'PENDIENTE',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_pago_contrato
    FOREIGN KEY (id_contrato) REFERENCES CONTRATO(id_contrato)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_pago_cliente
    FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  INDEX idx_pago_contrato (id_contrato),
  INDEX idx_pago_cliente (id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Payouts (transfers to contractors)
CREATE TABLE PAGO_PAYOUT (
  id_payout INT AUTO_INCREMENT PRIMARY KEY,
  id_contrato INT NOT NULL,
  id_contratista INT NOT NULL,
  monto DECIMAL(12,2) NOT NULL,
  moneda CHAR(3) NOT NULL DEFAULT 'USD',
  fecha_de_pago DATETIME NULL,
  medio_de_pago VARCHAR(255),
  estado ENUM('PENDIENTE','ENVIADO','FALLIDO') DEFAULT 'PENDIENTE',
  processed_by INT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_payout_contrato
    FOREIGN KEY (id_contrato) REFERENCES CONTRATO(id_contrato)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_payout_contratista
    FOREIGN KEY (id_contratista) REFERENCES CONTRATISTA(id_contratista)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_payout_admin
    FOREIGN KEY (processed_by) REFERENCES ADMINISTRADOR(id_administrador)
    ON DELETE SET NULL ON UPDATE CASCADE,
  INDEX idx_payout_contrato (id_contrato),
  INDEX idx_payout_contratista (id_contratista),
  INDEX idx_payout_admin (processed_by)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reviews (per contract; one review per cliente-contrato)
CREATE TABLE RESENA (
  id_resena INT AUTO_INCREMENT PRIMARY KEY,
  comentario TEXT,
  fecha DATE,
  calificacion TINYINT UNSIGNED NOT NULL,
  id_contrato INT NOT NULL,
  id_cliente INT NOT NULL,
  CONSTRAINT chk_resena_calificacion CHECK (calificacion BETWEEN 1 AND 5),
  CONSTRAINT fk_resena_contrato
    FOREIGN KEY (id_contrato) REFERENCES CONTRATO(id_contrato)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_resena_cliente
    FOREIGN KEY (id_cliente) REFERENCES CLIENTE(id_cliente)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY ux_resena_contrato_cliente (id_contrato, id_cliente),
  INDEX idx_resena_cliente (id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
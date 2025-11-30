-- Create database (optional)
-- CREATE DATABASE IF NOT EXISTS brixo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE brixo;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Drop tables if exist (in FK-safe order for this minimal schema)
DROP TABLE IF EXISTS RESENA;
DROP TABLE IF EXISTS CONTRATO;
DROP TABLE IF EXISTS COTIZACION;
DROP TABLE IF EXISTS USUARIO;

SET FOREIGN_KEY_CHECKS = 1;

-- Tabla USUARIO (unifica clientes, contratistas y admin)
CREATE TABLE USUARIO (
  id_usuario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  correo VARCHAR(255) NOT NULL UNIQUE,
  contrasena VARCHAR(255) NOT NULL,
  telefono VARCHAR(50),
  foto_perfil VARCHAR(255),
  rol ENUM('cliente','contratista','admin') NOT NULL DEFAULT 'cliente',
  creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
  actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla COTIZACION (creada por un usuario con rol cliente)
CREATE TABLE COTIZACION (
  id_cotizacion INT AUTO_INCREMENT PRIMARY KEY,
  estado ENUM('PENDIENTE','ACEPTADA','RECHAZADA','EXPIRADA') DEFAULT 'PENDIENTE',
  fecha DATE,
  descripcion TEXT,
  precio_estimado DECIMAL(12,2),
  id_cliente INT NOT NULL,
  creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
  actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_cotizacion_cliente
    FOREIGN KEY (id_cliente) REFERENCES USUARIO(id_usuario)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  INDEX idx_cotizacion_cliente (id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla CONTRATO (aceptación de una cotización por un contratista)
CREATE TABLE CONTRATO (
  id_contrato INT AUTO_INCREMENT PRIMARY KEY,
  fecha_inicio DATE,
  fecha_fin DATE,
  costo_total DECIMAL(12,2),
  estado ENUM('EN_PROCESO','ACTIVO','COMPLETADO','CANCELADO') DEFAULT 'EN_PROCESO',
  id_cotizacion INT NOT NULL,
  id_contratista INT NOT NULL,
  creado_en DATETIME DEFAULT CURRENT_TIMESTAMP,
  actualizado_en DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_contrato_cotizacion
    FOREIGN KEY (id_cotizacion) REFERENCES COTIZACION(id_cotizacion)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT fk_contrato_contratista
    FOREIGN KEY (id_contratista) REFERENCES USUARIO(id_usuario)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY ux_contrato_cotizacion (id_cotizacion),
  INDEX idx_contrato_contratista (id_contratista)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabla RESENA (reseña del cliente sobre el contrato)
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
    FOREIGN KEY (id_cliente) REFERENCES USUARIO(id_usuario)
    ON DELETE RESTRICT ON UPDATE CASCADE,
  UNIQUE KEY ux_resena_contrato_cliente (id_contrato, id_cliente),
  INDEX idx_resena_cliente (id_cliente)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
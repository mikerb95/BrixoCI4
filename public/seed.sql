-- Seed compatible con el esquema Legacy + Features
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Limpiar tablas
TRUNCATE TABLE RESENA;
TRUNCATE TABLE CONTRATO;
TRUNCATE TABLE CONTRATISTA_SERVICIO;
TRUNCATE TABLE CONTRATISTA_UBICACION;
TRUNCATE TABLE SERVICIO;
TRUNCATE TABLE CATEGORIA;
TRUNCATE TABLE UBICACION;
TRUNCATE TABLE CONTRATISTA;
TRUNCATE TABLE CLIENTE;

SET FOREIGN_KEY_CHECKS = 1;

-- 1. Categorías
INSERT INTO CATEGORIA (id_categoria, nombre, descripcion, imagen_url) VALUES
(1, 'Hogar', 'Servicios generales para el hogar', 'https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&fit=crop&w=500&q=60'),
(2, 'Construcción', 'Obras y remodelaciones', 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=500&q=60'),
(3, 'Plomería', 'Reparación e instalación de tuberías', 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?auto=format&fit=crop&w=500&q=60'),
(4, 'Electricidad', 'Instalaciones y reparaciones eléctricas', 'https://images.unsplash.com/photo-1621905251189-fcfa35257645?auto=format&fit=crop&w=500&q=60'),
(5, 'Limpieza', 'Servicios de limpieza profesional', 'https://images.unsplash.com/photo-1581578731117-104f2a863a30?auto=format&fit=crop&w=500&q=60');

-- 2. Servicios
INSERT INTO SERVICIO (id_servicio, nombre, descripcion, precio_estimado, imagen_url, id_categoria) VALUES
(1, 'Limpieza General', 'Limpieza profunda de casas y apartamentos', 50000.00, 'https://images.unsplash.com/photo-1584622050111-993a426fbf0a?auto=format&fit=crop&w=500&q=60', 5),
(2, 'Reparación de Tuberías', 'Arreglo de fugas y tuberías rotas', 80000.00, 'https://images.unsplash.com/photo-1607472586893-edb57bdc0e39?auto=format&fit=crop&w=500&q=60', 3),
(3, 'Instalación Eléctrica', 'Cableado y puntos de luz', 120000.00, 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?auto=format&fit=crop&w=500&q=60', 4),
(4, 'Pintura de Interiores', 'Pintura de paredes y techos', 25000.00, 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=500&q=60', 1),
(5, 'Remodelación de Baños', 'Cambio de enchapes y sanitarios', 1500000.00, 'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?auto=format&fit=crop&w=500&q=60', 2);

-- 3. Clientes (Contraseña: password)
INSERT INTO CLIENTE (nombre, correo, contrasena, telefono, foto_perfil) VALUES
('Juan Pérez', 'juan.perez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3001234567', 'https://randomuser.me/api/portraits/men/1.jpg'),
('Maria Gomez', 'maria.gomez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3007654321', 'https://randomuser.me/api/portraits/women/2.jpg'),
('Carlos Lopez', 'carlos.lopez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3101112233', 'https://randomuser.me/api/portraits/men/3.jpg');

-- 4. Contratistas (Contraseña: password)
INSERT INTO CONTRATISTA (nombre, correo, contrasena, telefono, foto_perfil, experiencia, portafolio, descripcion_perfil, verificado) VALUES
('Pedro Rodriguez', 'pedro.rodriguez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3209998877', 'https://randomuser.me/api/portraits/men/4.jpg', '10 años en plomería', 'https://portfolio.example.com/pedro', 'Experto en reparaciones urgentes', 1),
('Ana Martinez', 'ana.martinez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3155556677', 'https://randomuser.me/api/portraits/women/5.jpg', '5 años en diseño de interiores y pintura', 'https://portfolio.example.com/ana', 'Transformo espacios con color', 1),
('Luis Hernandez', 'luis.hernandez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3004443322', 'https://randomuser.me/api/portraits/men/6.jpg', 'Ingeniero eléctrico certificado', 'https://portfolio.example.com/luis', 'Seguridad y eficiencia eléctrica', 1),
('Sofia Ramirez', 'sofia.ramirez@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3112223344', 'https://randomuser.me/api/portraits/women/7.jpg', 'Especialista en limpieza profunda', 'https://portfolio.example.com/sofia', 'Tu casa impecable en horas', 0),
('Jorge Torres', 'jorge.torres@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3123334455', 'https://randomuser.me/api/portraits/men/8.jpg', 'Maestro de obra', 'https://portfolio.example.com/jorge', 'Construcción y remodelación garantizada', 1);

-- 5. Ubicaciones
INSERT INTO UBICACION (ciudad, departamento, direccion, latitud, longitud) VALUES
('Bogotá', 'Cundinamarca', 'Calle 123 # 45-67', 4.7110, -74.0721),
('Medellín', 'Antioquia', 'Carrera 10 # 20-30', 6.2442, -75.5812),
('Cali', 'Valle del Cauca', 'Avenida 6 # 12-34', 3.4516, -76.5320);

-- 6. Relación Contratista - Servicio
-- Pedro (Plomero) -> Reparación de Tuberías
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(1, 2, 85000.00, 'Incluye materiales básicos');

-- Ana (Pintora) -> Pintura de Interiores
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(2, 4, 28000.00, 'Precio por metro cuadrado');

-- Luis (Electricista) -> Instalación Eléctrica
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(3, 3, 130000.00, 'Revisión inicial gratuita');

-- Sofia (Limpieza) -> Limpieza General
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(4, 1, 55000.00, 'Turno de 4 horas');

-- Jorge (Constructor) -> Remodelación de Baños
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(5, 5, 1600000.00, 'Mano de obra completa');

-- 7. Relación Contratista - Ubicación
INSERT INTO CONTRATISTA_UBICACION (id_contratista, id_ubicacion) VALUES
(1, 1), -- Pedro en Bogotá
(2, 2), -- Ana en Medellín
(3, 3), -- Luis en Cali
(4, 1), -- Sofia en Bogotá
(5, 2); -- Jorge en Medellín

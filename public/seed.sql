-- Disable FK checks to allow bulk insertion order flexibility
SET FOREIGN_KEY_CHECKS = 0;

-- 1. CATEGORIAS
INSERT INTO CATEGORIA (nombre, descripcion) VALUES
('Hogar y Mantenimiento', 'Reparaciones, instalaciones y mantenimiento general del hogar'),
('Tecnología', 'Soporte técnico, reparación de computadores y redes'),
('Limpieza', 'Limpieza profunda, doméstica y de oficinas'),
('Construcción y Remodelación', 'Obras civiles, pintura, drywall y acabados'),
('Mecánica Automotriz', 'Reparación y mantenimiento de vehículos a domicilio'),
('Belleza y Cuidado', 'Peluquería, manicure y estética a domicilio'),
('Clases Particulares', 'Refuerzo escolar, idiomas y música'),
('Eventos', 'Organización, decoración y catering');

-- 2. SERVICIOS
INSERT INTO SERVICIO (nombre, descripcion, precio_estimado, id_categoria, imagen_url) VALUES
('Plomería General', 'Reparación de fugas, instalación de grifos y destape de cañerías.', 80000.00, 1, 'https://images.unsplash.com/photo-1585704032915-c3400ca199e7?w=800&q=80'),
('Instalación Eléctrica', 'Instalación de tomas, lámparas y revisión de circuitos.', 95000.00, 1, 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=800&q=80'),
('Limpieza Profunda Apartamento', 'Limpieza general de pisos, baños, cocina y vidrios.', 120000.00, 3, 'https://images.unsplash.com/photo-1581578731117-104f2a863a30?w=800&q=80'),
('Mantenimiento de Computadores', 'Limpieza física, optimización de software y antivirus.', 70000.00, 2, 'https://images.unsplash.com/photo-1597872250977-479f7bf775a1?w=800&q=80'),
('Pintura de Interiores', 'Pintura de muros y techos por metro cuadrado.', 15000.00, 4, 'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?w=800&q=80'),
('Manicure y Pedicure', 'Servicio completo de arreglo de uñas a domicilio.', 45000.00, 6, 'https://images.unsplash.com/photo-1632345031435-8727f6897d53?w=800&q=80'),
('Clases de Matemáticas', 'Hora de clase particular para primaria o bachillerato.', 50000.00, 7, 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&q=80'),
('Cambio de Aceite y Filtros', 'Mano de obra para cambio de aceite a domicilio.', 60000.00, 5, 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=800&q=80'),
('Armado de Muebles', 'Ensamble de muebles modulares tipo IKEA/Homecenter.', 55000.00, 1, 'https://images.unsplash.com/photo-1581141849291-1125c7b692b5?w=800&q=80'),
('Fotografía de Eventos', 'Servicio de fotografía por hora para eventos sociales.', 150000.00, 8, 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&q=80');

-- 3. UBICACIONES (Bogotá coordinates)
-- Generamos 50 ubicaciones variadas en Bogotá
INSERT INTO UBICACION (ciudad, departamento, direccion, latitud, longitud) VALUES
('Bogotá', 'Cundinamarca', 'Cra 7 # 123-45', 4.7005, -74.0305),
('Bogotá', 'Cundinamarca', 'Calle 85 # 15-20', 4.6685, -74.0550),
('Bogotá', 'Cundinamarca', 'Av Suba # 100-10', 4.6920, -74.0710),
('Bogotá', 'Cundinamarca', 'Calle 26 # 68-50', 4.6550, -74.1050),
('Bogotá', 'Cundinamarca', 'Cra 15 # 93-60', 4.6780, -74.0520),
('Bogotá', 'Cundinamarca', 'Calle 53 # 20-15', 4.6420, -74.0700),
('Bogotá', 'Cundinamarca', 'Cra 30 # 45-10', 4.6350, -74.0850),
('Bogotá', 'Cundinamarca', 'Calle 140 # 11-20', 4.7210, -74.0350),
('Bogotá', 'Cundinamarca', 'Av Boyacá # 80-10', 4.6950, -74.0950),
('Bogotá', 'Cundinamarca', 'Calle 72 # 7-50', 4.6550, -74.0580),
('Bogotá', 'Cundinamarca', 'Cra 50 # 26-10', 4.6400, -74.1000),
('Bogotá', 'Cundinamarca', 'Calle 100 # 19-45', 4.6850, -74.0550),
('Bogotá', 'Cundinamarca', 'Cra 9 # 116-20', 4.6980, -74.0320),
('Bogotá', 'Cundinamarca', 'Calle 13 # 65-10', 4.6250, -74.1150),
('Bogotá', 'Cundinamarca', 'Av Esperanza # 50-20', 4.6450, -74.1050),
('Bogotá', 'Cundinamarca', 'Calle 170 # 45-10', 4.7550, -74.0550),
('Bogotá', 'Cundinamarca', 'Cra 7 # 32-10', 4.6180, -74.0680),
('Bogotá', 'Cundinamarca', 'Calle 63 # 24-10', 4.6520, -74.0750),
('Bogotá', 'Cundinamarca', 'Av Americas # 68-10', 4.6280, -74.1250),
('Bogotá', 'Cundinamarca', 'Calle 80 # 50-10', 4.6820, -74.0800),
('Bogotá', 'Cundinamarca', 'Cra 11 # 82-10', 4.6650, -74.0520),
('Bogotá', 'Cundinamarca', 'Calle 127 # 15-10', 4.7080, -74.0450),
('Bogotá', 'Cundinamarca', 'Av 19 # 140-10', 4.7250, -74.0480),
('Bogotá', 'Cundinamarca', 'Calle 116 # 45-10', 4.7020, -74.0600),
('Bogotá', 'Cundinamarca', 'Cra 68 # 95-10', 4.6880, -74.0850),
('Bogotá', 'Cundinamarca', 'Calle 134 # 19-10', 4.7180, -74.0480),
('Bogotá', 'Cundinamarca', 'Av Cali # 10-10', 4.6500, -74.1550),
('Bogotá', 'Cundinamarca', 'Calle 153 # 45-10', 4.7420, -74.0550),
('Bogotá', 'Cundinamarca', 'Cra 5 # 26-10', 4.6120, -74.0680),
('Bogotá', 'Cundinamarca', 'Calle 19 # 4-10', 4.6050, -74.0700),
('Bogotá', 'Cundinamarca', 'Cra 10 # 20-10', 4.6080, -74.0750),
('Bogotá', 'Cundinamarca', 'Calle 45 # 13-10', 4.6320, -74.0650),
('Bogotá', 'Cundinamarca', 'Av Caracas # 53-10', 4.6450, -74.0680),
('Bogotá', 'Cundinamarca', 'Calle 106 # 15-10', 4.6920, -74.0450),
('Bogotá', 'Cundinamarca', 'Cra 15 # 122-10', 4.7050, -74.0420),
('Bogotá', 'Cundinamarca', 'Calle 93 # 11-10', 4.6750, -74.0480),
('Bogotá', 'Cundinamarca', 'Av NQS # 75-10', 4.6720, -74.0720),
('Bogotá', 'Cundinamarca', 'Calle 147 # 7-10', 4.7320, -74.0280),
('Bogotá', 'Cundinamarca', 'Cra 9 # 72-10', 4.6580, -74.0550),
('Bogotá', 'Cundinamarca', 'Calle 26 # 100-10', 4.6950, -74.1250),
('Bogotá', 'Cundinamarca', 'Av El Dorado # 68-10', 4.6620, -74.1050),
('Bogotá', 'Cundinamarca', 'Calle 13 # 30-10', 4.6150, -74.0950),
('Bogotá', 'Cundinamarca', 'Cra 50 # 64-10', 4.6650, -74.0850),
('Bogotá', 'Cundinamarca', 'Calle 161 # 19-10', 4.7450, -74.0450),
('Bogotá', 'Cundinamarca', 'Av Suba # 127-10', 4.7150, -74.0750),
('Bogotá', 'Cundinamarca', 'Calle 80 # 68-10', 4.6920, -74.0880),
('Bogotá', 'Cundinamarca', 'Cra 30 # 19-10', 4.6180, -74.0880),
('Bogotá', 'Cundinamarca', 'Calle 68 # 15-10', 4.6580, -74.0650),
('Bogotá', 'Cundinamarca', 'Av Chile # 7-10', 4.6550, -74.0550),
('Bogotá', 'Cundinamarca', 'Calle 100 # 15-10', 4.6880, -74.0480);

-- 4. CONTRATISTAS (30 Profesionales)
INSERT INTO CONTRATISTA (nombre, experiencia, portafolio, foto_perfil, descripcion_perfil, verificado, telefono, correo, contrasena) VALUES
('Carlos Rodríguez', 'Plomero Certificado - 10 años', 'https://portfolio.com/carlos', 'https://randomuser.me/api/portraits/men/1.jpg', 'Especialista en detección de fugas y reparaciones hidráulicas complejas. Garantía en todos mis trabajos.', 1, '3001234567', 'carlos.rodriguez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('María González', 'Electricista Residencial', 'https://portfolio.com/maria', 'https://randomuser.me/api/portraits/women/2.jpg', 'Técnica electricista con certificación RETIE. Instalaciones seguras y normativas.', 1, '3001234568', 'maria.gonzalez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Juan Pérez', 'Técnico en Sistemas', 'https://portfolio.com/juan', 'https://randomuser.me/api/portraits/men/3.jpg', 'Reparación de computadores Mac y PC. Recuperación de datos y redes.', 1, '3001234569', 'juan.perez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Ana Martínez', 'Especialista en Limpieza', 'https://portfolio.com/ana', 'https://randomuser.me/api/portraits/women/4.jpg', 'Servicio de limpieza detallada y desinfección. Productos ecológicos.', 0, '3001234570', 'ana.martinez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Luis Hernández', 'Pintor Profesional', 'https://portfolio.com/luis', 'https://randomuser.me/api/portraits/men/5.jpg', 'Acabados perfectos en estuco y pintura. Trabajo limpio y rápido.', 1, '3001234571', 'luis.hernandez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sofía López', 'Estilista Profesional', 'https://portfolio.com/sofia', 'https://randomuser.me/api/portraits/women/6.jpg', 'Cortes, color y peinados a domicilio. Asesoría de imagen.', 1, '3001234572', 'sofia.lopez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Jorge García', 'Profesor de Matemáticas', 'https://portfolio.com/jorge', 'https://randomuser.me/api/portraits/men/7.jpg', 'Licenciado en matemáticas. Clases dinámicas para todos los niveles.', 1, '3001234573', 'jorge.garcia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Elena Torres', 'Mecánica Automotriz', 'https://portfolio.com/elena', 'https://randomuser.me/api/portraits/women/8.jpg', 'Diagnóstico y reparación a domicilio. Especialista en inyección electrónica.', 1, '3001234574', 'elena.torres@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Pedro Ramírez', 'Carpintero Ebanista', 'https://portfolio.com/pedro', 'https://randomuser.me/api/portraits/men/9.jpg', 'Diseño y fabricación de muebles a medida. Restauración de madera.', 0, '3001234575', 'pedro.ramirez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Laura Sánchez', 'Fotógrafa Profesional', 'https://portfolio.com/laura', 'https://randomuser.me/api/portraits/women/10.jpg', 'Capturo tus mejores momentos. Bodas, cumpleaños y eventos corporativos.', 1, '3001234576', 'laura.sanchez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Diego Flores', 'Maestro de Obra', 'https://portfolio.com/diego', 'https://randomuser.me/api/portraits/men/11.jpg', 'Remodelaciones integrales. Albañilería, enchapes y plomería.', 1, '3001234577', 'diego.flores@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Valentina Ruiz', 'Manicurista', 'https://portfolio.com/valentina', 'https://randomuser.me/api/portraits/women/12.jpg', 'Uñas acrílicas, semipermanente y nail art. Servicio a domicilio.', 1, '3001234578', 'valentina.ruiz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Andrés Gómez', 'Técnico de Lavadoras', 'https://portfolio.com/andres', 'https://randomuser.me/api/portraits/men/13.jpg', 'Reparación de lavadoras y neveras todas las marcas.', 1, '3001234579', 'andres.gomez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Camila Díaz', 'Organizadora de Eventos', 'https://portfolio.com/camila', 'https://randomuser.me/api/portraits/women/14.jpg', 'Planeación y decoración de fiestas temáticas.', 1, '3001234580', 'camila.diaz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Fernando Vargas', 'Jardinero Paisajista', 'https://portfolio.com/fernando', 'https://randomuser.me/api/portraits/men/15.jpg', 'Diseño y mantenimiento de jardines. Poda y control de plagas.', 0, '3001234581', 'fernando.vargas@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Isabella Castro', 'Profesora de Inglés', 'https://portfolio.com/isabella', 'https://randomuser.me/api/portraits/women/16.jpg', 'Clases conversacionales y preparación para exámenes internacionales.', 1, '3001234582', 'isabella.castro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Ricardo Morales', 'Cerrajero 24/7', 'https://portfolio.com/ricardo', 'https://randomuser.me/api/portraits/men/17.jpg', 'Apertura de puertas, cambio de guardas y cerraduras de seguridad.', 1, '3001234583', 'ricardo.morales@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Gabriela Ortiz', 'Maquilladora', 'https://portfolio.com/gabriela', 'https://randomuser.me/api/portraits/women/18.jpg', 'Maquillaje social y artístico para toda ocasión.', 1, '3001234584', 'gabriela.ortiz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Javier Mendoza', 'Instalador de Drywall', 'https://portfolio.com/javier', 'https://randomuser.me/api/portraits/men/19.jpg', 'Divisiones, cielos rasos y figuras en drywall.', 1, '3001234585', 'javier.mendoza@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Daniela Silva', 'Entrenadora Personal', 'https://portfolio.com/daniela', 'https://randomuser.me/api/portraits/women/20.jpg', 'Planes de entrenamiento funcional y nutrición deportiva.', 1, '3001234586', 'daniela.silva@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Manuel Rojas', 'Impermeabilizador', 'https://portfolio.com/manuel', 'https://randomuser.me/api/portraits/men/21.jpg', 'Soluciones para humedades en terrazas y cubiertas.', 1, '3001234587', 'manuel.rojas@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Lucía Herrera', 'Chef a Domicilio', 'https://portfolio.com/lucia', 'https://randomuser.me/api/portraits/women/22.jpg', 'Cenas románticas y eventos privados. Cocina internacional.', 1, '3001234588', 'lucia.herrera@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Roberto Cruz', 'Tapicero', 'https://portfolio.com/roberto', 'https://randomuser.me/api/portraits/men/23.jpg', 'Restauración y tapizado de muebles de sala y comedor.', 0, '3001234589', 'roberto.cruz@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Mariana Vega', 'Paseadora de Perros', 'https://portfolio.com/mariana', 'https://randomuser.me/api/portraits/women/24.jpg', 'Paseos recreativos y cuidado de mascotas.', 1, '3001234590', 'mariana.vega@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Hugo Reyes', 'Técnico de Gas', 'https://portfolio.com/hugo', 'https://randomuser.me/api/portraits/men/25.jpg', 'Instalación y mantenimiento de gasodomésticos. Certificado.', 1, '3001234591', 'hugo.reyes@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Paula Jiménez', 'Contadora', 'https://portfolio.com/paula', 'https://randomuser.me/api/portraits/women/26.jpg', 'Asesoría tributaria y contable para personas y empresas.', 1, '3001234592', 'paula.jimenez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Alberto Nuñez', 'Vidriero', 'https://portfolio.com/alberto', 'https://randomuser.me/api/portraits/men/27.jpg', 'Instalación de ventanas, divisiones de baño y espejos.', 1, '3001234593', 'alberto.nunez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Carolina Rios', 'Diseñadora de Interiores', 'https://portfolio.com/carolina', 'https://randomuser.me/api/portraits/women/28.jpg', 'Asesoría en decoración y optimización de espacios.', 1, '3001234594', 'carolina.rios@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Sergio Paredes', 'Mensajero', 'https://portfolio.com/sergio', 'https://randomuser.me/api/portraits/men/29.jpg', 'Diligencias, trámites y envíos express en moto.', 1, '3001234595', 'sergio.paredes@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Natalia Cordero', 'Fisioterapeuta', 'https://portfolio.com/natalia', 'https://randomuser.me/api/portraits/women/30.jpg', 'Rehabilitación física y masajes terapéuticos a domicilio.', 1, '3001234596', 'natalia.cordero@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 5. CLIENTES (20 Clientes)
INSERT INTO CLIENTE (nombre, correo, telefono, foto_perfil, contrasena) VALUES
('Alejandro Ruiz', 'cliente1@email.com', '3101112233', 'https://randomuser.me/api/portraits/men/31.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Beatriz Lopez', 'cliente2@email.com', '3101112234', 'https://randomuser.me/api/portraits/women/32.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Camilo Torres', 'cliente3@email.com', '3101112235', 'https://randomuser.me/api/portraits/men/33.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Diana Garcia', 'cliente4@email.com', '3101112236', 'https://randomuser.me/api/portraits/women/34.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Esteban Diaz', 'cliente5@email.com', '3101112237', 'https://randomuser.me/api/portraits/men/35.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Fernanda Gomez', 'cliente6@email.com', '3101112238', 'https://randomuser.me/api/portraits/women/36.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Gabriel Martinez', 'cliente7@email.com', '3101112239', 'https://randomuser.me/api/portraits/men/37.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Helena Rodriguez', 'cliente8@email.com', '3101112240', 'https://randomuser.me/api/portraits/women/38.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Ivan Perez', 'cliente9@email.com', '3101112241', 'https://randomuser.me/api/portraits/men/39.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Julia Sanchez', 'cliente10@email.com', '3101112242', 'https://randomuser.me/api/portraits/women/40.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Kevin Ramirez', 'cliente11@email.com', '3101112243', 'https://randomuser.me/api/portraits/men/41.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Laura Hernandez', 'cliente12@email.com', '3101112244', 'https://randomuser.me/api/portraits/women/42.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Mateo Flores', 'cliente13@email.com', '3101112245', 'https://randomuser.me/api/portraits/men/43.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Natalia Vargas', 'cliente14@email.com', '3101112246', 'https://randomuser.me/api/portraits/women/44.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Oscar Castro', 'cliente15@email.com', '3101112247', 'https://randomuser.me/api/portraits/men/45.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Patricia Morales', 'cliente16@email.com', '3101112248', 'https://randomuser.me/api/portraits/women/46.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Quique Ortiz', 'cliente17@email.com', '3101112249', 'https://randomuser.me/api/portraits/men/47.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Rosa Mendoza', 'cliente18@email.com', '3101112250', 'https://randomuser.me/api/portraits/women/48.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Santiago Silva', 'cliente19@email.com', '3101112251', 'https://randomuser.me/api/portraits/men/49.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Tatiana Rojas', 'cliente20@email.com', '3101112252', 'https://randomuser.me/api/portraits/women/50.jpg', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- 6. ASIGNAR UBICACIONES A CONTRATISTAS (Randomly assign 1 location per contractor)
INSERT INTO CONTRATISTA_UBICACION (id_contratista, id_ubicacion) VALUES
(1, 1), (2, 2), (3, 3), (4, 4), (5, 5), (6, 6), (7, 7), (8, 8), (9, 9), (10, 10),
(11, 11), (12, 12), (13, 13), (14, 14), (15, 15), (16, 16), (17, 17), (18, 18), (19, 19), (20, 20),
(21, 21), (22, 22), (23, 23), (24, 24), (25, 25), (26, 26), (27, 27), (28, 28), (29, 29), (30, 30);

-- 7. ASIGNAR SERVICIOS A CONTRATISTAS (Offers)
-- Each contractor offers 1-2 services related to their profession
INSERT INTO CONTRATISTA_SERVICIO (id_contratista, id_servicio, precio_personalizado, descripcion_personalizada) VALUES
(1, 1, 85000.00, 'Servicio express de plomería 24 horas.'),
(2, 2, 90000.00, 'Instalaciones eléctricas certificadas.'),
(3, 4, 75000.00, 'Mantenimiento preventivo y correctivo de computadores.'),
(4, 3, 110000.00, 'Limpieza profunda con vapor.'),
(5, 5, 16000.00, 'Pintura profesional, incluye resanes menores.'),
(6, 6, 50000.00, 'Manicure spa con exfoliación.'),
(7, 7, 55000.00, 'Clases de cálculo y física.'),
(8, 8, 65000.00, 'Cambio de aceite a domicilio, incluye revisión de niveles.'),
(9, 9, 60000.00, 'Armado de closets y bibliotecas.'),
(10, 10, 160000.00, 'Cobertura fotográfica de eventos sociales.'),
(11, 5, 14000.00, 'Pintura de fachadas e interiores.'),
(12, 6, 40000.00, 'Uñas acrílicas y decoración.'),
(13, 2, 95000.00, 'Reparación de electrodomésticos.'),
(14, 10, 180000.00, 'Decoración y fotografía para fiestas.'),
(15, 3, 130000.00, 'Limpieza de jardines y zonas verdes.'),
(16, 7, 45000.00, 'Clases de inglés conversacional.'),
(17, 9, 50000.00, 'Instalación de cerraduras y armado de muebles.'),
(18, 6, 80000.00, 'Maquillaje y peinado para novias.'),
(19, 5, 18000.00, 'Instalación de drywall y pintura.'),
(20, 7, 60000.00, 'Entrenamiento personalizado en casa.'),
(21, 1, 90000.00, 'Impermeabilización de cubiertas.'),
(22, 10, 200000.00, 'Catering para eventos pequeños.'),
(23, 9, 70000.00, 'Tapizado de sillas y sofás.'),
(24, 3, 30000.00, 'Paseo de perros por hora.'),
(25, 1, 80000.00, 'Instalación de redes de gas.'),
(26, 7, 70000.00, 'Asesoría contable y financiera.'),
(27, 9, 55000.00, 'Instalación de vidrios y espejos.'),
(28, 5, 20000.00, 'Asesoría en color y pintura.'),
(29, 8, 25000.00, 'Mensajería express en moto.'),
(30, 6, 90000.00, 'Masajes relajantes y descontracturantes.');

-- 8. COTIZACIONES Y CONTRATOS (10 Contratos)
-- Create 10 accepted quotes that became contracts
INSERT INTO COTIZACION (estado, fecha, observaciones, id_cliente, id_servicio) VALUES
('ACEPTADA', '2023-10-01', 'Urgente, fuga en el baño principal', 1, 1),
('ACEPTADA', '2023-10-05', 'Revisión de cableado sala', 2, 2),
('ACEPTADA', '2023-10-10', 'Limpieza general apartamento vacio', 3, 3),
('ACEPTADA', '2023-10-15', 'Computador lento, necesita formato', 4, 4),
('ACEPTADA', '2023-10-20', 'Pintar habitación principal blanco', 5, 5),
('ACEPTADA', '2023-10-25', 'Manicure y pedicure semipermanente', 6, 6),
('ACEPTADA', '2023-11-01', 'Clase de refuerzo matemáticas 8vo grado', 7, 7),
('ACEPTADA', '2023-11-05', 'Cambio de aceite Chevrolet Spark', 8, 8),
('ACEPTADA', '2023-11-10', 'Armar biblioteca nueva', 9, 9),
('ACEPTADA', '2023-11-15', 'Fotos cumpleaños 50 años', 10, 10);

INSERT INTO CONTRATO (fecha_inicio, fecha_fin, costo_total, estado, comision_brixo, id_cotizacion, id_contratista) VALUES
('2023-10-02', '2023-10-02', 85000.00, 'COMPLETADO', 8500.00, 1, 1),
('2023-10-06', '2023-10-06', 90000.00, 'COMPLETADO', 9000.00, 2, 2),
('2023-10-11', '2023-10-11', 110000.00, 'COMPLETADO', 11000.00, 3, 4),
('2023-10-16', '2023-10-16', 75000.00, 'COMPLETADO', 7500.00, 4, 3),
('2023-10-21', '2023-10-22', 160000.00, 'COMPLETADO', 16000.00, 5, 5),
('2023-10-26', '2023-10-26', 50000.00, 'COMPLETADO', 5000.00, 6, 6),
('2023-11-02', '2023-11-02', 55000.00, 'COMPLETADO', 5500.00, 7, 7),
('2023-11-06', '2023-11-06', 65000.00, 'COMPLETADO', 6500.00, 8, 8),
('2023-11-11', '2023-11-11', 60000.00, 'COMPLETADO', 6000.00, 9, 9),
('2023-11-16', '2023-11-16', 160000.00, 'COMPLETADO', 16000.00, 10, 10);

-- 9. RESEÑAS (Reviews for the completed contracts)
INSERT INTO RESENA (comentario, fecha, calificacion, id_contrato, id_cliente) VALUES
('Excelente trabajo, llegó puntual y solucionó el problema rápido.', '2023-10-03', 5, 1, 1),
('Buen servicio, aunque llegó un poco tarde.', '2023-10-07', 4, 2, 2),
('Quedó todo impecable, muy recomendada.', '2023-10-12', 5, 3, 3),
('El computador quedó como nuevo, gracias.', '2023-10-17', 5, 4, 4),
('Trabajo limpio y ordenado.', '2023-10-23', 4, 5, 5),
('Me encantó el diseño de las uñas.', '2023-10-27', 5, 6, 6),
('Explica muy bien, mi hijo entendió todo.', '2023-11-03', 5, 7, 7),
('Rápido y sin complicaciones.', '2023-11-07', 4, 8, 8),
('Armó el mueble muy rápido y dejó todo limpio.', '2023-11-12', 5, 9, 9),
('Las fotos quedaron hermosas, muy profesional.', '2023-11-17', 5, 10, 10);

SET FOREIGN_KEY_CHECKS = 1;

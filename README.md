Brixo 🛠️
Conectando necesidades con soluciones locales.

Brixo es una plataforma web que conecta a usuarios con profesionales locales (contratistas) para servicios del hogar como obra, carpintería, plomería y más. Permite publicar solicitudes de servicio, buscar profesionales en un mapa interactivo y gestionar contrataciones.

🚀 Características Principales
Roles de Usuario: Perfiles diferenciados para Clientes y Contratistas.
Geolocalización: Búsqueda de profesionales cercanos mediante mapa interactivo (Leaflet/OpenStreetMap).
Solicitudes de Servicio:
Abiertas: Publicadas en un tablón para cualquier contratista.
Directas: Enviadas a un profesional específico.
Gestión de Perfiles: Portafolio, experiencia y ubicación para contratistas.
Sistema de Reseñas: Calificación de servicios completados.
🛠️ Tecnologías
Backend: PHP 8.x (CodeIgniter 4 Framework)
Frontend: HTML5, CSS3 (Bootstrap 5), JavaScript
Base de Datos: MySQL
Mapas: Leaflet.js + OpenStreetMap
Infraestructura: Compatible con despliegue en Render/XAMPP/Apache.
📦 Instalación Local
Clonar el repositorio:

Configurar Base de Datos:

Crea una base de datos MySQL llamada brixo.
Importa el esquema inicial desde schema.sql.
(Opcional) Ejecuta los scripts de setup en public si es necesario (setup_db.php, etc.).
Configurar Entorno:

Copia env a .env.
Configura las credenciales de base de datos (database.default...) y la app.baseURL.
Ejecutar:

Si usas XAMPP,
coloca el proyecto en htdocs.
* O usa el servidor de desarrollo de Spark:
bash         php spark serve         

📄 Licencia
Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

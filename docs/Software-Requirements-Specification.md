# Especificación de Requerimientos de Software (ERS)

**Proyecto:** Brixo – Plataforma de servicios del hogar  
**Versión:** 2.0 (Spring Boot)  
**Fecha:** 2026-04-08  
**Estándar:** IEEE 830 / ISO/IEC 29148  

---

## Índice

1. [Introducción](#1-introducción)
2. [Descripción general del sistema](#2-descripción-general-del-sistema)
3. [Requerimientos funcionales](#3-requerimientos-funcionales)
   - 3.1 Autenticación y registro
   - 3.2 Cotizador inteligente (IA)
   - 3.3 Solicitudes de servicio
   - 3.4 Perfiles de usuario
   - 3.5 Mensajería
   - 3.6 Exploración y mapa
   - 3.7 Contratos y reseñas
   - 3.8 Administración
   - 3.9 Analíticas
4. [Requerimientos no funcionales](#4-requerimientos-no-funcionales)
   - 4.1 Rendimiento
   - 4.2 Seguridad
   - 4.3 Disponibilidad
   - 4.4 Escalabilidad
   - 4.5 Mantenibilidad
   - 4.6 Usabilidad
   - 4.7 Portabilidad
   - 4.8 Privacidad
5. [Restricciones del sistema](#5-restricciones-del-sistema)
6. [Matriz de trazabilidad](#6-matriz-de-trazabilidad)

---

## 1. Introducción

### 1.1 Propósito

Este documento especifica los requerimientos funcionales y no funcionales del sistema **Brixo**, una plataforma web que conecta clientes con contratistas de servicios del hogar (plomería, albañilería, electricidad, carpintería, etc.). Su característica diferenciadora es el **Cotizador Inteligente**, que usa modelos de lenguaje (LLM) para generar presupuestos desglosados a partir de descripciones en lenguaje natural.

### 1.2 Alcance

El sistema cubre:
- Registro y autenticación de clientes y contratistas.
- Generación de cotizaciones con IA (Groq, OpenAI, Anthropic).
- Publicación y gestión de solicitudes de servicio.
- Perfiles públicos de contratistas con certificaciones y reseñas.
- Mensajería interna entre usuarios.
- Mapa interactivo de contratistas.
- Panel de administración y analíticas de primera parte.

### 1.3 Tecnología base

| Componente | Tecnología |
|------------|------------|
| Backend | Java 17 + Spring Boot 3.2 |
| Persistencia | Spring Data JPA + MySQL 8 |
| Vistas | Thymeleaf + Bootstrap 5 |
| Seguridad | Spring Security (BCrypt, sesión) |
| IA | Groq / OpenAI / Anthropic (RestClient) |
| Contenedores | Docker (Eclipse Temurin 17) |

### 1.4 Definiciones

| Término | Definición |
|---------|------------|
| **Cliente** | Usuario que busca y contrata servicios |
| **Contratista** | Profesional que ofrece servicios del hogar |
| **Cotización** | Estimación de materiales, mano de obra y complejidad generada por IA |
| **Solicitud** | Petición publicada por un cliente para que contratistas respondan |
| **LLM** | Large Language Model — modelo de lenguaje de gran escala |

---

## 2. Descripción general del sistema

### 2.1 Perspectiva del producto

Brixo es una aplicación web de tres capas (presentación, lógica de negocio, datos) desplegable en contenedores Docker. Se integra con APIs externas de LLM para la función de cotización inteligente.

```
┌──────────────────────────────────────────────────┐
│                  Navegador (Cliente)              │
│           HTML5 + Bootstrap 5 + JS (Fetch)        │
└────────────────────────┬─────────────────────────┘
                         │ HTTPS
┌────────────────────────▼─────────────────────────┐
│           Spring Boot 3.2 (Tomcat embebido)       │
│  Controllers → Services → Repositories → JPA     │
│                LlmService (RestClient)            │
└──────┬──────────────────────────┬────────────────┘
       │                          │ HTTPS
┌──────▼──────┐         ┌─────────▼────────┐
│  MySQL 8    │         │  API LLM externa │
│  (esquema   │         │  Groq/OpenAI/    │
│   Brixo)    │         │  Anthropic       │
└─────────────┘         └──────────────────┘
```

### 2.2 Roles del sistema

| Rol | Acceso | Tabla BD |
|-----|--------|----------|
| Visitante | Rutas públicas únicamente | — |
| Cliente | Panel, cotizador, solicitudes, mensajes | `CLIENTE` |
| Contratista | Panel, solicitudes abiertas, mensajes | `CONTRATISTA` |
| Administrador | Todo el sistema + `/admin/**` | `ADMIN` |

---

## 3. Requerimientos Funcionales

### Convención de prioridad

| Prioridad | Descripción |
|-----------|-------------|
| **Alta** | Indispensable para la operación básica del sistema |
| **Media** | Importante pero no bloquea el lanzamiento |
| **Baja** | Mejora la experiencia; puede diferirse |

---

### 3.1 Autenticación y Registro

#### RF-01 · Registro de cliente

| Campo | Detalle |
|-------|---------|
| **ID** | RF-01 |
| **Nombre** | Registro de cliente |
| **Prioridad** | Alta |
| **Descripción** | El sistema permite que un visitante cree una cuenta de cliente proporcionando nombre, correo, contraseña, teléfono y ciudad. |

**Entradas:** nombre (obligatorio), correo (obligatorio, único), contraseña (mín. 8 caracteres), teléfono, ciudad.

**Proceso:**
1. Validar que el correo no exista en las tablas `CLIENTE` ni `CONTRATISTA`.
2. Cifrar la contraseña con BCrypt (coste 10).
3. Insertar el registro en `CLIENTE`.
4. Redirigir a `/login` con mensaje de confirmación.

**Salidas:** Cuenta creada, sesión no iniciada automáticamente.

**Excepciones:**
- Correo duplicado → error `"El correo ya está registrado."`.
- Contraseña menor a 8 caracteres → error de validación.

---

#### RF-02 · Inicio de sesión

| Campo | Detalle |
|-------|---------|
| **ID** | RF-02 |
| **Nombre** | Inicio de sesión |
| **Prioridad** | Alta |

**Proceso:**
1. Buscar correo en `CLIENTE`; si no existe, buscar en `CONTRATISTA`.
2. Verificar contraseña con BCrypt.
3. Crear sesión HTTP con `BrixoUserDetails` (id, nombre, rol, foto).
4. Redirigir a `/panel` o al parámetro `redirect_to` si estaba presente.

**Excepciones:**
- Credenciales inválidas → redirigir a `/login?error=true` con mensaje genérico (no indica cuál campo falló).

---

#### RF-03 · Cierre de sesión

| Campo | Detalle |
|-------|---------|
| **ID** | RF-03 |
| **Prioridad** | Alta |

**Proceso:** Invalidar sesión del servidor, eliminar cookie `JSESSIONID`, redirigir a `/login?logout=true`.

---

#### RF-04 · Recuperación de contraseña

| Campo | Detalle |
|-------|---------|
| **ID** | RF-04 |
| **Prioridad** | Media |

**Proceso:**
1. El usuario solicita restablecimiento por correo.
2. El sistema genera un token seguro con expiración de 24 horas.
3. Se envía enlace por email con el token.
4. El usuario ingresa nueva contraseña; se valida el token y se actualiza con BCrypt.

---

### 3.2 Cotizador Inteligente (IA)

#### RF-05 · Generar cotización con IA

| Campo | Detalle |
|-------|---------|
| **ID** | RF-05 |
| **Nombre** | Generación de cotización con LLM |
| **Prioridad** | Alta |
| **Descripción** | El sistema recibe una descripción en texto libre, la envía al LLM configurado y devuelve un presupuesto estructurado en JSON. |

**Entradas:** `descripcion` — texto libre, entre 10 y 2000 caracteres.

**Proceso:**
1. Validar longitud de entrada.
2. Seleccionar proveedor LLM según `llm.provider` (groq | openai | anthropic).
3. Enviar descripción al LLM con el `SYSTEM_PROMPT` estricto.
4. Limpiar posibles bloques Markdown (` ```json ``` `).
5. Deserializar JSON de respuesta a `CotizacionResult`.
6. Validar esquema: `servicio_principal`, `materiales[]`, `personal[]`, `complejidad`.
7. Guardar resultado en sesión con clave `ultima_cotizacion`.
8. Devolver JSON `{ ok: true, data: {...} }` si AJAX, o renderizar vista.

**Esquema de respuesta esperado:**
```json
{
  "servicio_principal": "string",
  "materiales": [
    { "nombre": "string", "cantidad_estimada": "string" }
  ],
  "personal": [
    { "rol": "string", "horas_estimadas": number }
  ],
  "complejidad": "bajo | medio | alto"
}
```

**Excepciones:**
- `LLM_API_KEY` no configurada → error `"No se ha configurado LLM_API_KEY."`.
- Error HTTP del proveedor → mensaje con código HTTP.
- JSON inválido del LLM → `"La IA no devolvió un JSON válido. Intenta reformular tu solicitud."`.
- Esquema incompleto → mensaje indicando el campo faltante.

**Proveedores soportados:**

| Proveedor | Modelo por defecto | URL |
|-----------|-------------------|-----|
| Groq | `llama-3.3-70b-versatile` | `https://api.groq.com/openai/v1/chat/completions` |
| OpenAI | `gpt-4o-mini` | `https://api.openai.com/v1/chat/completions` |
| Anthropic | `claude-sonnet-4-20250514` | `https://api.anthropic.com/v1/messages` |

---

#### RF-06 · Confirmar cotización

| Campo | Detalle |
|-------|---------|
| **ID** | RF-06 |
| **Prioridad** | Alta |

**Precondición:** Usuario autenticado con rol `CLIENTE` y cotización en sesión.

**Proceso:**
1. Leer `ultima_cotizacion` de la sesión HTTP.
2. Insertar en `COTIZACION_CONFIRMADA` con estado `pendiente`.
3. Generar texto de desglose (materiales + personal + complejidad).
4. Guardar en sesión `prefill_solicitud` con título y descripción pre-llenados.
5. Eliminar `ultima_cotizacion` de sesión.
6. Redirigir a `/solicitud/nueva`.

**Excepciones:**
- Usuario no autenticado → redirigir a `/login`.
- Rol distinto de CLIENTE → error `"Solo los clientes pueden confirmar cotizaciones."`.
- No hay cotización en sesión → redirigir a `/cotizador` con error.

---

#### RF-07 · Historial de cotizaciones

| Campo | Detalle |
|-------|---------|
| **ID** | RF-07 |
| **Prioridad** | Media |

**Descripción:** El panel del cliente muestra la lista de cotizaciones confirmadas ordenadas por `confirmado_en DESC`, con servicio principal, complejidad, estado y fecha.

---

### 3.3 Solicitudes de Servicio

#### RF-08 · Crear solicitud

| Campo | Detalle |
|-------|---------|
| **ID** | RF-08 |
| **Prioridad** | Alta |

**Entradas:** `titulo` (obligatorio, máx. 150 chars), `descripcion` (obligatorio), `presupuesto` (decimal, opcional), `ubicacion` (texto, opcional).

**Proceso:** Crear registro en `SOLICITUD` con estado `ABIERTA` y `creado_en = NOW()`. Si existe `prefill_solicitud` en sesión, los campos se pre-llenan.

---

#### RF-09 · Listar solicitudes del cliente

| Campo | Detalle |
|-------|---------|
| **ID** | RF-09 |
| **Prioridad** | Alta |

**Descripción:** El cliente ve sus solicitudes ordenadas por fecha descendente con estado diferenciado visualmente (ABIERTA=verde, ASIGNADA=naranja, COMPLETADA=gris, CANCELADA=rojo).

---

#### RF-10 · Eliminar solicitud

| Campo | Detalle |
|-------|---------|
| **ID** | RF-10 |
| **Prioridad** | Media |

**Precondición:** La solicitud pertenece al cliente autenticado.  
**Proceso:** Eliminar registro de `SOLICITUD`. Requiere confirmación en cliente.

---

#### RF-11 · Ver solicitudes abiertas (contratista)

| Campo | Detalle |
|-------|---------|
| **ID** | RF-11 |
| **Prioridad** | Alta |

**Descripción:** El contratista ve todas las solicitudes con estado `ABIERTA` ordenadas por fecha. Puede iniciar contacto directo desde la lista mediante mensajería.

---

### 3.4 Perfiles de Usuario

#### RF-12 · Ver perfil público de contratista

| Campo | Detalle |
|-------|---------|
| **ID** | RF-12 |
| **Prioridad** | Alta |

**Descripción:** Cualquier usuario (incluso no autenticado) puede ver el perfil de un contratista con: nombre, foto, ciudad, descripción, experiencia, portafolio, servicios ofrecidos con precios, certificaciones y reseñas.

---

#### RF-13 · Editar perfil propio

| Campo | Detalle |
|-------|---------|
| **ID** | RF-13 |
| **Prioridad** | Media |

**Cliente:** nombre, teléfono, ciudad, foto de perfil.  
**Contratista:** incluye además descripción, experiencia, portafolio y ubicación en mapa.

---

### 3.5 Mensajería

#### RF-14 · Enviar mensaje

| Campo | Detalle |
|-------|---------|
| **ID** | RF-14 |
| **Prioridad** | Alta |

**Descripción:** Usuarios autenticados pueden enviarse mensajes directos. El mensaje se persiste en `MENSAJE` con `remitente_id`, `remitente_rol`, `destinatario_id`, `destinatario_rol`, `contenido`, `leido = false` y `creado_en`.

---

#### RF-15 · Ver conversación

| Campo | Detalle |
|-------|---------|
| **ID** | RF-15 |
| **Prioridad** | Alta |

**Descripción:** Al abrir un chat se recuperan todos los mensajes entre los dos usuarios (independientemente de quién inició). Los mensajes no leídos se marcan como `leido = true` automáticamente al abrir la conversación.

---

### 3.6 Exploración y Mapa

#### RF-16 · Explorar por categorías

| Campo | Detalle |
|-------|---------|
| **ID** | RF-16 |
| **Prioridad** | Media |

**Descripción:** `/especialidades` muestra todas las categorías con imagen. Al seleccionar una, se listan los servicios con nombre, descripción y precio estimado.

---

#### RF-17 · Mapa interactivo de contratistas

| Campo | Detalle |
|-------|---------|
| **ID** | RF-17 |
| **Prioridad** | Media |

**Descripción:** `/map` muestra un mapa Leaflet/OpenStreetMap centrado en Colombia con marcadores de contratistas. Al hacer clic en un marcador aparece el nombre y un enlace al perfil.

---

### 3.7 Contratos y Reseñas

#### RF-18 · Registrar contrato

| Campo | Detalle |
|-------|---------|
| **ID** | RF-18 |
| **Prioridad** | Media |

**Entradas:** contratista, cliente, fecha inicio, fecha fin, costo total.  
**Estado inicial:** `PENDIENTE`. Transiciones válidas: `PENDIENTE → ACTIVO → COMPLETADO | CANCELADO`.

---

#### RF-19 · Dejar reseña

| Campo | Detalle |
|-------|---------|
| **ID** | RF-19 |
| **Prioridad** | Media |

**Precondición:** El contrato tiene estado `COMPLETADO` y el cliente aún no ha dejado reseña.  
**Entradas:** calificación (1–5), comentario (texto libre).

---

### 3.8 Administración

#### RF-20 · Gestionar usuarios

| Campo | Detalle |
|-------|---------|
| **ID** | RF-20 |
| **Prioridad** | Alta |

**Descripción:** El administrador puede listar, crear, editar y eliminar cuentas de clientes y contratistas. Puede activar/desactivar la verificación de un contratista. Todas las rutas `/admin/**` requieren rol `ADMIN`.

---

#### RF-21 · Generar reportes Excel

| Campo | Detalle |
|-------|---------|
| **ID** | RF-21 |
| **Prioridad** | Baja |

**Descripción:** El administrador puede descargar reportes `.xlsx` de contratistas (nombre, correo, ciudad, verificado, fecha) y solicitudes (título, estado, presupuesto, fechas).

---

### 3.9 Analíticas de Primera Parte

#### RF-22 · Registrar eventos de analítica

| Campo | Detalle |
|-------|---------|
| **ID** | RF-22 |
| **Prioridad** | Baja |

**Endpoint:** `POST /api/v1/track`  
**Descripción:** Recibe eventos del cliente JS (`pageview`, `click_cta`, `cotizador_*`, etc.), anonimiza la IP (elimina último octeto en IPv4) y persiste en `analytics_events`. Responde `204 No Content`. Sin CSRF (usa `sendBeacon`).

**Validaciones:**
- Payload máximo 4 KB.
- Solo se procesa si el usuario dio consentimiento de cookies.
- Se respeta el header `DNT: 1`.
- Se ignoran User-Agents de bots conocidos.

---

#### RF-23 · Dashboard de analíticas

| Campo | Detalle |
|-------|---------|
| **ID** | RF-23 |
| **Prioridad** | Baja |

**Descripción:** El administrador accede a `/analytics/dashboard` para ver: visitantes únicos, sesiones, pageviews, duración promedio, páginas más visitadas, desglose por dispositivo y distribución de eventos. Rango configurable de 1 a 365 días.

---

## 4. Requerimientos No Funcionales

### 4.1 Rendimiento

| ID | Requerimiento | Métrica | Prioridad |
|----|---------------|---------|-----------|
| RNF-01 | Tiempo de carga de página principal | < 2 s (red 4G) | Alta |
| RNF-02 | Tiempo de respuesta del cotizador IA | < 8 s (incluye llamada LLM) | Alta |
| RNF-03 | Tiempo de respuesta de endpoints propios | < 500 ms (p95) | Alta |
| RNF-04 | Endpoint de analíticas (`/api/v1/track`) | < 100 ms | Alta |
| RNF-05 | Carga del mapa interactivo | < 3 s | Media |
| RNF-06 | Usuarios concurrentes soportados | ≥ 200 sesiones simultáneas | Media |
| RNF-07 | Payload máximo por request de analítica | 4 KB | Alta |

**Estrategias implementadas:**
- Archivos estáticos (CSS, JS) servidos desde CDN (Bootstrap, Font Awesome).
- Pool de conexiones JDBC (HikariCP, Spring Boot por defecto).
- Thymeleaf cache desactivado solo en desarrollo (`spring.thymeleaf.cache=false`).
- Timeout de llamadas LLM: 30 s conexión / 60 s lectura.

---

### 4.2 Seguridad

| ID | Requerimiento | Descripción | Implementación |
|----|---------------|-------------|----------------|
| RNF-08 | Hash de contraseñas | BCrypt con coste mínimo 10 | `BCryptPasswordEncoder` de Spring Security |
| RNF-09 | Protección CSRF | Token en cada formulario | Spring Security + Thymeleaf (`th:action`) |
| RNF-10 | Protección XSS | Escape automático de salidas | Thymeleaf escapa `th:text` por defecto |
| RNF-11 | Protección SQL Injection | Consultas parametrizadas | Spring Data JPA / JPQL con parámetros |
| RNF-12 | Autorización por rol | Rutas protegidas según rol | `@AuthenticationPrincipal` + `SecurityConfig` |
| RNF-13 | HTTPS obligatorio | TLS en producción | Proveedor de nube (Render / Railway) |
| RNF-14 | Sesión segura | Timeout 30 min, invalidación al logout | `server.servlet.session.timeout=30m` |
| RNF-15 | Variables de entorno | Credenciales nunca en código fuente | `.env` en `.gitignore` |
| RNF-16 | Cabeceras de seguridad HTTP | X-Content-Type, X-Frame-Options | Spring Security por defecto |
| RNF-17 | Claves LLM no expuestas | API keys solo en variables de entorno | `@Value("${llm.api-key}")` |

---

### 4.3 Disponibilidad

| ID | Requerimiento | Métrica |
|----|---------------|---------|
| RNF-18 | SLA de disponibilidad | ≥ 99.5 % mensual |
| RNF-19 | Tiempo de recuperación (RTO) | < 5 minutos |
| RNF-20 | Punto de recuperación (RPO) | < 1 hora de pérdida de datos |
| RNF-21 | Degradación elegante | Si el LLM falla, el resto del sitio sigue operativo |
| RNF-22 | Páginas de error personalizadas | Páginas 404 y 500 amigables |
| RNF-23 | Logs de error | Nivel INFO en producción; ERROR notificado |

**RNF-21 — Degradación elegante del cotizador:**  
Si la API del LLM devuelve error o excede el timeout, el sistema muestra un mensaje amigable al usuario. El fallo del cotizador no afecta login, panel, solicitudes ni mensajería.

---

### 4.4 Escalabilidad

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| RNF-24 | Arquitectura stateless | Las sesiones HTTP pueden externalizarse a Redis sin cambios de código |
| RNF-25 | Contenedores Docker | Imagen reproducible basada en `eclipse-temurin:17-jre-alpine` |
| RNF-26 | Configuración por entorno | 100 % por variables de entorno (sin cambiar código al desplegar) |
| RNF-27 | Base de datos externa | MySQL no está embebido; compatible con cloud (PlanetScale, Aiven, RDS) |
| RNF-28 | Soporte multi-proveedor LLM | Cambiar de Groq a OpenAI/Anthropic solo cambiando `LLM_PROVIDER` |
| RNF-29 | Multi-instancia | Sin estado en memoria; múltiples instancias pueden atender el mismo dominio |

---

### 4.5 Mantenibilidad

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| RNF-30 | Separación de capas | Controller → Service → Repository (sin lógica de negocio en controllers) |
| RNF-31 | Cobertura de tests | ≥ 70 % en capa de servicio (unit tests con JUnit 5 + Mockito) |
| RNF-32 | Test de contexto | `BrixoApplicationTests` verifica que el contexto Spring arranca |
| RNF-33 | Código documentado | Javadoc en servicios y métodos públicos no obvios |
| RNF-34 | Gestión de dependencias | Maven (`pom.xml`), sin versiones duplicadas (Spring BOM) |
| RNF-35 | Migraciones de BD | Flyway o Liquibase para cambios de esquema (recomendado) |
| RNF-36 | Logging estructurado | SLF4J + Logback (incluido en Spring Boot) con niveles por paquete |

---

### 4.6 Usabilidad

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| RNF-37 | Diseño responsivo | Funcional desde 375 px de ancho (Bootstrap 5) |
| RNF-38 | Compatibilidad de navegadores | Chrome 100+, Firefox 100+, Safari 15+, Edge 100+ |
| RNF-39 | Tiempo de aprendizaje | Un usuario nuevo puede generar su primera cotización en < 2 minutos |
| RNF-40 | Retroalimentación visual | Spinner durante la llamada al LLM; mensajes de éxito/error en todas las acciones |
| RNF-41 | Idioma | Interfaz completamente en español (es-CO) |
| RNF-42 | Accesibilidad básica | Atributos `alt` en imágenes, `label` en todos los campos de formulario |

---

### 4.7 Portabilidad

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| RNF-43 | Plataformas de despliegue | Compatible con Render, Railway, Fly.io, AWS ECS, Google Cloud Run |
| RNF-44 | Sistema operativo | Linux (Alpine), sin dependencias del SO host |
| RNF-45 | Base de datos compatible | MySQL 8+ o MariaDB 10.6+ (mismo esquema SQL) |
| RNF-46 | Empaquetado | JAR ejecutable autónomo (`java -jar app.jar`) |

---

### 4.8 Privacidad

| ID | Requerimiento | Descripción |
|----|---------------|-------------|
| RNF-47 | Anonimización de IP | Se elimina el último octeto (IPv4) antes de persistir en analíticas |
| RNF-48 | Do-Not-Track | Se respeta el header `DNT: 1`; no se registra ningún evento si está activo |
| RNF-49 | Consentimiento de cookies | El tracking JS solo se activa tras aceptación explícita del banner |
| RNF-50 | Sin telemetría a terceros | No se usa Google Analytics ni herramientas de terceros; analíticas propias |
| RNF-51 | Datos de contraseña | Las contraseñas nunca se registran en logs ni se devuelven en respuestas API |

---

## 5. Restricciones del Sistema

| ID | Restricción | Descripción |
|----|-------------|-------------|
| R-01 | Java 17 mínimo | Uso de `record`, text blocks y `switch` expresión requieren Java 17+ |
| R-02 | MySQL 8+ | Uso del tipo de dato `JSON` nativo en `materiales_json` y `personal_json` |
| R-03 | Clave LLM obligatoria | Sin `LLM_API_KEY` el cotizador IA no funciona (resto del sistema sí) |
| R-04 | Esquema pre-existente | `spring.jpa.hibernate.ddl-auto=validate`; el esquema debe aplicarse manualmente antes del primer arranque |
| R-05 | HTTPS en producción | Spring Security y las cookies de sesión requieren HTTPS en despliegue real |
| R-06 | Zona horaria | El servidor debe configurarse en UTC para consistencia de timestamps |

---

## 6. Matriz de Trazabilidad

Relaciona cada historia de usuario con sus requerimientos funcionales y no funcionales.

| Historia | Requerimientos Funcionales | Requerimientos No Funcionales |
|----------|---------------------------|-------------------------------|
| HU-01 Registro cliente | RF-01 | RNF-08, RNF-11, RNF-15 |
| HU-02 Inicio de sesión | RF-02 | RNF-08, RNF-09, RNF-12, RNF-14 |
| HU-03 Cierre de sesión | RF-03 | RNF-14 |
| HU-04 Recuperar contraseña | RF-04 | RNF-08, RNF-13 |
| HU-05 Cotizar con IA | RF-05 | RNF-01, RNF-02, RNF-17, RNF-21, RNF-28 |
| HU-06 Confirmar cotización | RF-06 | RNF-09, RNF-12 |
| HU-07 Historial cotizaciones | RF-07 | RNF-03 |
| HU-08 Crear solicitud | RF-08 | RNF-09, RNF-10, RNF-12 |
| HU-09 Ver mis solicitudes | RF-09 | RNF-03, RNF-37 |
| HU-10 Eliminar solicitud | RF-10 | RNF-09, RNF-12 |
| HU-11 Solicitudes abiertas | RF-11 | RNF-03 |
| HU-12 Perfil contratista | RF-12 | RNF-03, RNF-10 |
| HU-13 Editar perfil | RF-13 | RNF-09, RNF-10, RNF-12 |
| HU-14 Enviar mensaje | RF-14 | RNF-09, RNF-11, RNF-12 |
| HU-15 Ver conversación | RF-15 | RNF-03, RNF-40 |
| HU-16 Explorar categorías | RF-16 | RNF-01, RNF-37 |
| HU-17 Mapa contratistas | RF-17 | RNF-05, RNF-37 |
| HU-18 Gestionar usuarios | RF-20 | RNF-12, RNF-16 |
| HU-19 Reportes Excel | RF-21 | RNF-12 |
| HU-20 Dashboard analíticas | RF-22, RF-23 | RNF-04, RNF-47, RNF-48 |
| HU-21 Registrar contrato | RF-18 | RNF-09, RNF-12 |
| HU-22 Dejar reseña | RF-19 | RNF-09, RNF-12 |
| HU-23 Consentimiento cookies | RF-22 | RNF-47, RNF-48, RNF-49, RNF-50 |
| HU-24 Responsive | — | RNF-37, RNF-38, RNF-41, RNF-42 |

---

*Este documento debe revisarse ante cualquier cambio de alcance, tecnología o requerimiento de negocio.*

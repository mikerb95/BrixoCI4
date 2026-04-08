# Historias de Usuario – Brixo

**Proyecto:** Brixo – Plataforma de servicios del hogar  
**Versión:** 1.0  
**Fecha:** 2026-04-08  

---

## Roles del sistema

| Rol | Descripción |
|-----|-------------|
| **Cliente** | Usuario que busca y contrata servicios del hogar |
| **Contratista** | Profesional que ofrece servicios (plomero, albañil, electricista, etc.) |
| **Administrador** | Gestiona usuarios, categorías y el sistema en general |
| **Visitante** | Usuario no autenticado que navega la plataforma |

---

## Módulo 1 – Autenticación y Registro

### HU-01 · Registro de cliente
**Como** visitante,  
**quiero** registrarme como cliente con mi nombre, correo, contraseña, teléfono y ciudad,  
**para** poder acceder a las funciones de la plataforma y solicitar servicios.

**Criterios de aceptación:**
- El correo debe ser único en el sistema (no puede estar registrado en CLIENTE ni CONTRATISTA).
- La contraseña se almacena cifrada con BCrypt.
- Tras el registro exitoso, el sistema redirige al login con un mensaje de confirmación.
- Si el correo ya existe, se muestra un error descriptivo sin revelar a qué rol pertenece.

---

### HU-02 · Inicio de sesión
**Como** usuario registrado (cliente o contratista),  
**quiero** iniciar sesión con mi correo y contraseña,  
**para** acceder a mi panel y gestionar mis actividades en la plataforma.

**Criterios de aceptación:**
- El sistema busca el correo en las tablas CLIENTE y CONTRATISTA.
- Credenciales incorrectas muestran un mensaje genérico (no indica cuál campo falló).
- Al autenticarse correctamente, el usuario es redirigido a `/panel`.
- La sesión expira tras 30 minutos de inactividad.

---

### HU-03 · Cierre de sesión
**Como** usuario autenticado,  
**quiero** cerrar sesión de forma segura,  
**para** proteger mi cuenta en dispositivos compartidos.

**Criterios de aceptación:**
- Al cerrar sesión se invalida la sesión del servidor y se elimina la cookie `JSESSIONID`.
- El usuario es redirigido al login con un mensaje de confirmación.

---

### HU-04 · Recuperación de contraseña
**Como** usuario registrado,  
**quiero** recuperar mi contraseña mediante mi correo electrónico,  
**para** no perder acceso a mi cuenta si la olvido.

**Criterios de aceptación:**
- Se envía un enlace de restablecimiento válido por 24 horas.
- El enlace solo puede usarse una vez.
- La nueva contraseña se cifra antes de almacenarse.

---

## Módulo 2 – Cotizador Inteligente (IA)

### HU-05 · Generar cotización con IA
**Como** visitante o cliente,  
**quiero** describir en texto libre el trabajo que necesito y obtener una cotización desglosada al instante,  
**para** tener una estimación de materiales, mano de obra y complejidad antes de contratar.

**Criterios de aceptación:**
- El campo de descripción acepta entre 10 y 2000 caracteres.
- La IA devuelve un JSON con: `servicio_principal`, `materiales` (nombre + cantidad), `personal` (rol + horas) y `complejidad` (bajo/medio/alto).
- El resultado se muestra en la misma página sin recargar (AJAX).
- Si la IA no responde o devuelve un formato inválido, se muestra un error amigable.
- Los chips de ejemplo permiten probar el cotizador con un clic.
- El sistema soporta los proveedores Groq, OpenAI y Anthropic, configurables por variable de entorno.

---

### HU-06 · Confirmar cotización y crear solicitud
**Como** cliente autenticado,  
**quiero** confirmar la cotización generada por IA,  
**para** convertirla en una solicitud de servicio pre-llenada con el desglose estimado.

**Criterios de aceptación:**
- Solo usuarios con rol CLIENTE pueden confirmar cotizaciones.
- La cotización se persiste en la tabla `COTIZACION_CONFIRMADA` con estado `pendiente`.
- El formulario de nueva solicitud se pre-llena automáticamente con el título y desglose de la IA.
- Si el usuario no está autenticado, se redirige al login y luego de vuelta al cotizador.
- La cotización se elimina de la sesión tras ser confirmada.

---

### HU-07 · Ver historial de cotizaciones
**Como** cliente,  
**quiero** ver un historial de las cotizaciones que he confirmado,  
**para** tener registro de los servicios que he consultado.

**Criterios de aceptación:**
- Se muestra el servicio principal, complejidad, estado y fecha de confirmación.
- Las cotizaciones aparecen ordenadas de más reciente a más antigua.
- La complejidad se diferencia visualmente: verde (bajo), naranja (medio), rojo (alto).

---

## Módulo 3 – Solicitudes de Servicio

### HU-08 · Crear solicitud de servicio
**Como** cliente,  
**quiero** publicar una solicitud con título, descripción, presupuesto y ubicación,  
**para** que los contratistas disponibles puedan verla y contactarme.

**Criterios de aceptación:**
- El título es obligatorio (máximo 150 caracteres).
- La descripción es obligatoria.
- Presupuesto y ubicación son opcionales.
- La solicitud se crea con estado `ABIERTA` por defecto.
- El cliente es redirigido a su panel con un mensaje de éxito.

---

### HU-09 · Ver mis solicitudes
**Como** cliente,  
**quiero** ver la lista de todas mis solicitudes con su estado actual,  
**para** hacer seguimiento del progreso de cada una.

**Criterios de aceptación:**
- Se muestran todas las solicitudes del cliente ordenadas por fecha descendente.
- El estado se diferencia visualmente (ABIERTA=verde, ASIGNADA=naranja, COMPLETADA=gris, CANCELADA=rojo).
- Cada solicitud muestra título, estado, presupuesto y fecha de creación.

---

### HU-10 · Eliminar solicitud
**Como** cliente,  
**quiero** eliminar una solicitud que ya no necesito,  
**para** mantener mi panel limpio y actualizado.

**Criterios de aceptación:**
- Solo el cliente propietario puede eliminar su solicitud.
- Se solicita confirmación antes de eliminar.
- Tras eliminar, el cliente regresa al panel con un mensaje de confirmación.

---

### HU-11 · Ver solicitudes abiertas (contratista)
**Como** contratista,  
**quiero** ver todas las solicitudes abiertas en la plataforma,  
**para** encontrar trabajos disponibles que coincidan con mi especialidad.

**Criterios de aceptación:**
- Se listan todas las solicitudes con estado `ABIERTA`.
- Se muestra título, nombre del cliente, presupuesto, ubicación y fecha.
- El contratista puede iniciar una conversación directamente desde la lista.

---

## Módulo 4 – Perfiles

### HU-12 · Ver perfil público de contratista
**Como** visitante o cliente,  
**quiero** ver el perfil público de un contratista,  
**para** conocer su experiencia, servicios, certificaciones y reseñas antes de contratarlo.

**Criterios de aceptación:**
- Se muestra nombre, foto, ciudad, descripción, experiencia y portafolio.
- Se listan los servicios que ofrece con precios personalizados.
- Se muestran sus certificaciones con entidad emisora y fecha.
- Se muestran las reseñas con calificación (1-5 estrellas) y comentario.
- El perfil muestra un indicador de "verificado" si aplica.

---

### HU-13 · Editar perfil propio
**Como** usuario autenticado (cliente o contratista),  
**quiero** editar mi información de perfil,  
**para** mantener mis datos actualizados.

**Criterios de aceptación:**
- El cliente puede editar: nombre, teléfono, ciudad y foto de perfil.
- El contratista puede editar adicionalmente: descripción, experiencia, portafolio y ubicación en mapa.
- Los cambios se reflejan de inmediato en el panel y perfil público.

---

## Módulo 5 – Mensajería

### HU-14 · Enviar mensaje a otro usuario
**Como** cliente o contratista autenticado,  
**quiero** enviar mensajes directos al otro usuario,  
**para** coordinar los detalles del servicio sin salir de la plataforma.

**Criterios de aceptación:**
- El mensaje se guarda con remitente, destinatario, rol de cada uno y timestamp.
- El mensaje aparece en la conversación inmediatamente tras enviarlo.
- El chat se desplaza automáticamente al mensaje más reciente.

---

### HU-15 · Ver conversaciones
**Como** usuario autenticado,  
**quiero** ver la lista de mis conversaciones activas,  
**para** acceder rápidamente a cada chat.

**Criterios de aceptación:**
- Se listan todas las conversaciones del usuario.
- Se indica cuántos mensajes no leídos hay en cada conversación.
- Al abrir un chat, los mensajes no leídos se marcan como leídos automáticamente.

---

## Módulo 6 – Exploración y Mapa

### HU-16 · Explorar especialidades por categoría
**Como** visitante o cliente,  
**quiero** navegar los servicios disponibles agrupados por categoría,  
**para** encontrar el tipo de profesional que necesito.

**Criterios de aceptación:**
- Las categorías se muestran con imagen, nombre y descripción.
- Al seleccionar una categoría, se listan los servicios disponibles dentro de ella.
- Cada servicio muestra nombre, descripción y precio estimado.

---

### HU-17 · Ver contratistas en mapa interactivo
**Como** visitante o cliente,  
**quiero** ver la ubicación de los contratistas en un mapa,  
**para** encontrar profesionales cercanos a mi ubicación.

**Criterios de aceptación:**
- El mapa se centra en Colombia por defecto.
- Cada contratista se representa con un marcador en su ubicación registrada.
- Al hacer clic en un marcador se muestra el nombre del contratista y un enlace a su perfil.
- El mapa es interactivo: permite zoom y desplazamiento.

---

## Módulo 7 – Administración

### HU-18 · Gestionar usuarios (admin)
**Como** administrador,  
**quiero** listar, crear, editar y eliminar usuarios (clientes y contratistas),  
**para** mantener el sistema limpio y operativo.

**Criterios de aceptación:**
- El dashboard muestra el total de clientes, contratistas y solicitudes activas.
- Se puede buscar un usuario por nombre o correo.
- Se puede activar o desactivar la verificación de un contratista.
- Al eliminar un usuario se requiere confirmación.
- Solo usuarios con rol ADMIN pueden acceder a `/admin/**`.

---

### HU-19 · Ver reportes del sistema (admin)
**Como** administrador,  
**quiero** descargar reportes de contratistas y solicitudes en formato Excel,  
**para** analizar la actividad de la plataforma.

**Criterios de aceptación:**
- El reporte de contratistas incluye nombre, correo, ciudad, verificado y fecha de registro.
- El reporte de solicitudes incluye título, estado, presupuesto y fechas.
- Los archivos se generan en formato `.xlsx` y se descargan directamente desde el navegador.

---

### HU-20 · Ver dashboard de analíticas (admin)
**Como** administrador,  
**quiero** visualizar métricas de uso de la plataforma,  
**para** entender el comportamiento de los visitantes y tomar decisiones.

**Criterios de aceptación:**
- Se muestran: visitantes únicos, sesiones, pageviews y duración promedio.
- Se incluye un gráfico de pageviews por día (rango configurable: 1–365 días).
- Se listan las páginas más visitadas, distribución de dispositivos y eventos registrados.
- Las IPs se anonimizan (se elimina el último octeto en IPv4).
- Se respeta el header `Do-Not-Track` del navegador.

---

## Módulo 8 – Contratos y Reseñas

### HU-21 · Registrar contrato
**Como** administrador o contratista,  
**quiero** registrar un contrato entre un cliente y un contratista,  
**para** formalizar el acuerdo de servicio en la plataforma.

**Criterios de aceptación:**
- El contrato requiere: contratista, cliente, fecha de inicio, fecha de fin y costo total.
- El estado inicial es `PENDIENTE`.
- El estado puede avanzar a: `ACTIVO`, `COMPLETADO` o `CANCELADO`.

---

### HU-22 · Dejar reseña de un contrato
**Como** cliente,  
**quiero** dejar una reseña con calificación (1 a 5) y comentario sobre un contrato completado,  
**para** ayudar a otros clientes a elegir contratistas de calidad.

**Criterios de aceptación:**
- Solo se puede reseñar un contrato con estado `COMPLETADO`.
- La calificación debe estar entre 1 y 5 (entero).
- La reseña queda asociada al contrato y se muestra en el perfil del contratista.
- Solo el cliente del contrato puede dejar la reseña.

---

## Módulo 9 – No funcionales

### HU-23 · Consentimiento de cookies
**Como** visitante,  
**quiero** ser informado sobre el uso de cookies y dar mi consentimiento,  
**para** tener control sobre mi privacidad.

**Criterios de aceptación:**
- Se muestra un banner de cookies en la primera visita.
- El tracking de analíticas solo se activa tras aceptar.
- La preferencia se persiste en el navegador y no vuelve a mostrarse el banner.

---

### HU-24 · Experiencia responsive
**Como** usuario desde un dispositivo móvil,  
**quiero** que la plataforma se adapte correctamente a mi pantalla,  
**para** poder usarla cómodamente desde el teléfono.

**Criterios de aceptación:**
- Todas las vistas son responsive (Bootstrap 5).
- El navbar colapsa en menú hamburguesa en pantallas pequeñas.
- Los formularios y tablas son usables en pantallas de 375px en adelante.

---

## Resumen de historias por módulo

| Módulo | IDs | Total |
|--------|-----|-------|
| Autenticación y registro | HU-01 a HU-04 | 4 |
| Cotizador IA | HU-05 a HU-07 | 3 |
| Solicitudes | HU-08 a HU-11 | 4 |
| Perfiles | HU-12 a HU-13 | 2 |
| Mensajería | HU-14 a HU-15 | 2 |
| Exploración y mapa | HU-16 a HU-17 | 2 |
| Administración | HU-18 a HU-20 | 3 |
| Contratos y reseñas | HU-21 a HU-22 | 2 |
| No funcionales | HU-23 a HU-24 | 2 |
| **Total** | | **24** |

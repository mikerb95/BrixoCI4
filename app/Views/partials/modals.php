<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow">
            <div class="modal-header border-0 p-0 mb-4">
                <h2 class="modal-title fs-4 fw-bold" id="loginModalLabel">Iniciar sesión</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <?php if (!empty($login_error)): ?>
                    <div class="alert alert-danger mb-4"><?= esc($login_error) ?></div>
                <?php endif; ?>
                <form method="post" action="/login">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="login_correo" class="form-label fw-semibold">Correo electrónico</label>
                        <input id="login_correo" name="correo" type="email" class="form-control p-3 rounded-3"
                            placeholder="nombre@ejemplo.com" required>
                    </div>
                    <div class="mb-4">
                        <label for="login_contrasena" class="form-label fw-semibold">Contraseña</label>
                        <input id="login_contrasena" name="contrasena" type="password"
                            class="form-control p-3 rounded-3" placeholder="Tu contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Entrar</button>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">¿No tienes una cuenta? 
                            <a href="#" class="text-primary fw-bold text-decoration-none" data-bs-toggle="modal" data-bs-target="#registerModal">Regístrate</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4 rounded-4 shadow">
            <div class="modal-header border-0 p-0 mb-4">
                <h2 class="modal-title fs-4 fw-bold" id="registerModalLabel">Crear cuenta</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <?php $registerOld = $register_old ?? []; ?>
                <?php if (!empty($register_error)): ?>
                    <div class="alert alert-danger mb-4"><?= esc($register_error) ?></div>
                <?php endif; ?>
                <form method="post" action="/register" id="registerForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="action" value="register">
                    <div class="mb-3">
                        <label for="registro_nombre" class="form-label fw-semibold">Nombre</label>
                        <input id="registro_nombre" name="nombre" type="text" class="form-control p-3 rounded-3"
                            placeholder="Tu nombre" value="<?= esc($registerOld['nombre'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="registro_correo" class="form-label fw-semibold">Correo electrónico</label>
                        <input id="registro_correo" name="correo" type="email" class="form-control p-3 rounded-3"
                            placeholder="nombre@ejemplo.com" value="<?= esc($registerOld['correo'] ?? '') ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="registro_telefono" class="form-label fw-semibold">Teléfono</label>
                        <input id="registro_telefono" name="telefono" type="tel" class="form-control p-3 rounded-3"
                            placeholder="3101234567" value="<?= esc($registerOld['telefono'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="registro_contrasena" class="form-label fw-semibold">Contraseña</label>
                        <input id="registro_contrasena" name="contrasena" type="password"
                            class="form-control p-3 rounded-3" placeholder="Crea una contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="registro_contrasena_confirm" class="form-label fw-semibold">Confirmar
                            contraseña</label>
                        <input id="registro_contrasena_confirm" name="contrasena_confirm" type="password"
                            class="form-control p-3 rounded-3" placeholder="Repite la contraseña" required>
                    </div>
                    <div class="mb-3">
                        <label for="registro_rol" class="form-label fw-semibold">Tipo de cuenta</label>
                        <select id="registro_rol" name="rol" class="form-select p-3 rounded-3" required>
                            <option value="cliente" <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'cliente') ? 'selected' : '' ?>>Cliente</option>
                            <option value="contratista" <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'contratista') ? 'selected' : '' ?>>Contratista</option>
                        </select>
                    </div>

                    <!-- Location Fields (Required for everyone) -->
                    <div class="mb-3">
                        <label for="registro_departamento" class="form-label fw-semibold">Departamento</label>
                        <select id="registro_departamento" class="form-select p-3 rounded-3" required></select>
                    </div>
                    <div class="mb-3">
                        <label for="registro_ciudad" class="form-label fw-semibold">Ciudad</label>
                        <select id="registro_ciudad" name="ciudad" class="form-select p-3 rounded-3" disabled
                            required></select>
                    </div>

                    <div id="contractorFields"
                        class="mb-3 <?= (isset($registerOld['rol']) && $registerOld['rol'] === 'contratista') ? '' : 'd-none' ?>">
                        <div class="mb-3">
                            <label for="registro_ubicacion" class="form-label fw-semibold">Ubicación exacta</label>
                            <div id="mapaRegistro"
                                style="height: 300px; width: 100%; border-radius: 10px; margin-bottom: 10px;"></div>
                            <input id="registro_ubicacion" name="ubicacion_mapa" type="text"
                                class="form-control p-3 rounded-3" placeholder="Selecciona en el mapa"
                                value="<?= esc($registerOld['ubicacion_mapa'] ?? '') ?>" readonly>
                            <small class="text-muted">Arrastra el marcador azul para indicar tu ubicación.</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold">Registrarme</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="/js/colombia-locations.js"></script>

<script>
    (function () {
        const roleSelect = document.getElementById('registro_rol');
        const contractorFields = document.getElementById('contractorFields');
        const deptInput = document.getElementById('registro_departamento');
        const cityInput = document.getElementById('registro_ciudad');
        const mapInput = document.getElementById('registro_ubicacion');

        // Initialize Colombia Selects
        const oldCity = "<?= esc($registerOld['ciudad'] ?? '') ?>";
        if (typeof initColombiaSelects === 'function') {
            initColombiaSelects('registro_departamento', 'registro_ciudad', oldCity);
        }

        let map = null;
        let marker = null;

        const initMap = () => {
            if (map) return; // Ya inicializado

            // Coordenadas por defecto (Bogotá)
            const defaultLat = 4.6097;
            const defaultLng = -74.0817;

            map = L.map('mapaRegistro').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Icono personalizado (opcional, usando el default por ahora)

            // Crear marcador arrastrable
            marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

            // Evento al arrastrar
            marker.on('dragend', function (event) {
                const position = marker.getLatLng();
                mapInput.value = `${position.lat},${position.lng}`;
            });

            // Evento al hacer clic en el mapa
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                mapInput.value = `${e.latlng.lat},${e.latlng.lng}`;
            });

            // Intentar geolocalización
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const newLatLng = new L.LatLng(lat, lng);
                    marker.setLatLng(newLatLng);
                    map.setView(newLatLng, 15);
                    mapInput.value = `${lat},${lng}`;
                });
            }

            // Si ya había un valor (ej. error de validación), poner el marcador ahí
            if (mapInput.value) {
                const parts = mapInput.value.split(',');
                if (parts.length === 2) {
                    const lat = parseFloat(parts[0]);
                    const lng = parseFloat(parts[1]);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const savedLatLng = new L.LatLng(lat, lng);
                        marker.setLatLng(savedLatLng);
                        map.setView(savedLatLng, 15);
                    }
                }
            }
        };

        const toggleContractorFields = () => {
            const isContractor = roleSelect.value === 'contratista';
            contractorFields.classList.toggle('d-none', !isContractor);
            // Dept and City are always required now
            if (mapInput) mapInput.required = isContractor;

            if (isContractor) {
                // Pequeño retraso para asegurar que el div sea visible antes de cargar el mapa
                setTimeout(() => {
                    initMap();
                    if (map) map.invalidateSize(); // Arregla problemas de renderizado en modales
                }, 200);
            }
        };

        if (roleSelect && contractorFields && cityInput && mapInput) {
            roleSelect.addEventListener('change', toggleContractorFields);
            // Ejecutar al inicio por si el navegador guardó la selección
            if (roleSelect.value === 'contratista') {
                toggleContractorFields();
            }
        }

        // Asegurar que el mapa se redibuje correctamente cuando se abre el modal
        const registerModalEl = document.getElementById('registerModal');
        if (registerModalEl) {
            registerModalEl.addEventListener('shown.bs.modal', function () {
                if (roleSelect.value === 'contratista' && map) {
                    map.invalidateSize();
                }
            });
        }

        <?php if (!empty($login_error)): ?>
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            loginModal.show();
        <?php endif; ?>

        <?php if (!empty($register_error)): ?>
            const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
            registerModal.show();
        <?php endif; ?>
    })();
</script>
